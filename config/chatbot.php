return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration for connecting to OpenAI services. This includes API keys,
    | model selection, token limits, temperature, and other related settings.
    |
    */

    'openai' => [
        'api_key' => env('OPENAI_API_KEY', 'your-default-api-key'), // Use this API key to authenticate with OpenAI
        'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'), // Default model
        'max_tokens' => env('OPENAI_MAX_TOKENS', 150), // Max tokens for OpenAI responses
        'temperature' => env('OPENAI_TEMPERATURE', 0.7), // Randomness of responses
        'top_p' => env('OPENAI_TOP_P', 1.0), // Top probability for token selection
        'presence_penalty' => env('OPENAI_PRESENCE_PENALTY', 0), // Penalize repeated topics
        'frequency_penalty' => env('OPENAI_FREQUENCY_PENALTY', 0), // Penalize repeated phrases
        'context_length' => env('OPENAI_CONTEXT_LENGTH', 5), // Number of previous interactions to consider
    ],

    /*
    |--------------------------------------------------------------------------
    | Chatbot Specific Configuration
    |--------------------------------------------------------------------------
    |
    | These settings are for chatbot-specific logic, including greeting, fallback messages,
    | and context length for conversation.
    |
    */

    'chatbot' => [
        'greeting' => env('CHATBOT_GREETING', 'Hello! How can I assist you today?'),
        'fallback_message' => env('CHATBOT_FALLBACK_MESSAGE', 'I’m sorry, I didn’t understand that.'),
    ],

];
