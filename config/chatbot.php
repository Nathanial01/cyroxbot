<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | This is the OpenAI API key used for authenticating requests. You should
    | set this value in your .env file as 'OPENAI_API_KEY'. If no value is
    | provided, the chatbot functionality will be disabled.
    |
    */

    'api_key' => env('OPENAI_API_KEY', 'your-default-api-key'),

    /*
    |--------------------------------------------------------------------------
    | Default OpenAI Model
    |--------------------------------------------------------------------------
    |
    | The OpenAI model to be used for generating responses. The default is
    | 'gpt-3.5-turbo', but you can set it to other models like 'gpt-4' as
    | required. Define this in your .env file as 'OPENAI_MODEL'.
    |
    */

    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | Maximum Tokens
    |--------------------------------------------------------------------------
    |
    | The maximum number of tokens the API can use to generate a response. Set
    | this value in your .env file as 'OPENAI_MAX_TOKENS'. Higher values allow
    | for longer responses but increase API usage costs.
    |
    */

    'max_tokens' => env('OPENAI_MAX_TOKENS', 150),

    /*
    |--------------------------------------------------------------------------
    | Temperature
    |--------------------------------------------------------------------------
    |
    | This value controls the randomness of responses. Use values closer to 0
    | for deterministic responses and values closer to 1 for creative ones.
    | Define this in your .env file as 'OPENAI_TEMPERATURE'.
    |
    */

    'temperature' => env('OPENAI_TEMPERATURE', 0.7),

    /*
    |--------------------------------------------------------------------------
    | Top Probability Sampling (Top P)
    |--------------------------------------------------------------------------
    |
    | An alternative to temperature. Specifies the cumulative probability for
    | token selection. Use this for narrowing down response options. Set it
    | in your .env file as 'OPENAI_TOP_P'.
    |
    */

    'top_p' => env('OPENAI_TOP_P', 1.0),

    /*
    |--------------------------------------------------------------------------
    | Presence Penalty
    |--------------------------------------------------------------------------
    |
    | Encourages discussing new topics by penalizing repeated tokens. Define
    | this in your .env file as 'OPENAI_PRESENCE_PENALTY'. Higher values
    | promote more diverse responses.
    |
    */

    'presence_penalty' => env('OPENAI_PRESENCE_PENALTY', 0),

    /*
    |--------------------------------------------------------------------------
    | Frequency Penalty
    |--------------------------------------------------------------------------
    |
    | Reduces the likelihood of repeated phrases. Set this in your .env file as
    | 'OPENAI_FREQUENCY_PENALTY'. Higher values reduce repetition.
    |
    */

    'frequency_penalty' => env('OPENAI_FREQUENCY_PENALTY', 0),

    /*
    |--------------------------------------------------------------------------
    | Context Length
    |--------------------------------------------------------------------------
    |
    | Specifies how many previous interactions to include in the request for
    | maintaining conversational context. Define this in your .env file as
    | 'OPENAI_CONTEXT_LENGTH'.
    |
    */

    'context_length' => env('OPENAI_CONTEXT_LENGTH', 5),
];
