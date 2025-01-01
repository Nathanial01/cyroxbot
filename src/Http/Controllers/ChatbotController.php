<?php

namespace Cyrox\Chatbot\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use OpenAI\Client;
use Cyrox\Chatbot\Models\ChatHistory;

class ChatbotController extends BaseController
{
    /**
     * Display the chatbot interface.
     */
    public function index(Request $request)
    {
        $user = $request->user(); // Retrieve authenticated user if applicable
        $name = $user ? $user->name : 'Guest';
        return view('chatbot::chatbot', compact('name'));
    }

    /**
     * Generate a chatbot response and save the conversation in the chat history.
     */
    public function generateResponse(Request $request): JsonResponse
    {
        try {
            $prompt = $request->input('prompt');
            $userId = $request->user() ? $request->user()->id : null;

            // Validate the prompt
            if (empty($prompt)) {
                return response()->json(['error' => 'Prompt cannot be empty.'], 422);
            }

            // Retrieve conversation context
            $context = $this->getContext($userId);

            // Check if the prompt is valid for e-commerce
            $response = $this->handleEcommerceFlow($prompt, $context, $userId);

            // If no specific e-commerce response, proceed with OpenAI
            if (!$response) {
                $response = $this->generateAIResponse($prompt, $context);
            }

            // Save the prompt and response to chat history
            $this->saveChatHistory($userId, $prompt, $response);

            return response()->json(['response' => $response]);

        } catch (\Exception $e) {
            \Log::error('Chatbot error: ' . $e->getMessage());
            return response()->json(['error' => 'An internal error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Retrieve the last 5 messages from the chat history for context.
     */
    private function getContext(?int $userId): array
    {
        return ChatHistory::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->pluck('message')
            ->toArray();
    }

    /**
     * Handle predefined e-commerce-related flows.
     */
    private function handleEcommerceFlow(string $prompt, array $context, ?int $userId): ?string
    {
        $allowedKeywords = [
            'order', 'track order', 'order status', 'product', 'add to cart', 
            'refund', 'return', 'help', 'support', 'shipping', 'payment'
        ];

        foreach ($allowedKeywords as $keyword) {
            if (str_contains(strtolower($prompt), $keyword)) {
                // Specific handling can be added for each keyword
                return "You asked about $keyword. Here's what you need to know.";
            }
        }

        return null; // No predefined flow triggered
    }

    /**
     * Generate an AI response using OpenAI.
     */
    private function generateAIResponse(string $prompt, array $context): string
    {
        $client = Client::factory([
            'api_key' => config('chatbot.api_key'),
        ]);

        $messages = array_merge(
            [['role' => 'system', 'content' => 'You are an e-commerce assistant.']],
            array_map(fn($message) => ['role' => 'user', 'content' => $message], $context),
            [['role' => 'user', 'content' => $prompt]]
        );

        $response = $client->chat()->create([
            'model' => 'gpt-4-turbo',
            'messages' => $messages,
            'max_tokens' => 500,
        ]);

        return $response['choices'][0]['message']['content'] ?? 'No response generated.';
    }

    /**
     * Save the prompt and response to the chat history.
     */
    private function saveChatHistory(?int $userId, string $prompt, string $response): void
    {
        ChatHistory::create([
            'user_id' => $userId,
            'message' => $prompt,
            'sender' => 'user',
        ]);

        ChatHistory::create([
            'user_id' => $userId,
            'message' => $response,
            'sender' => 'bot',
        ]);
    }
}
