<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL', 'gemini-flash-lite-latest'),
        'fallback_model' => env('GEMINI_FALLBACK_MODEL', 'gemini-flash-latest'),
        'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
    ],

    'chatbot' => [
        'enabled' => env('CHATBOT_ENABLED', true),
        'max_question_length' => env('CHATBOT_MAX_QUESTION_LENGTH', 500),
        'max_history_messages' => env('CHATBOT_MAX_HISTORY_MESSAGES', 10),
        'max_history_content_length' => env('CHATBOT_MAX_HISTORY_CONTENT_LENGTH', 2000),
        'per_ip_per_minute' => env('CHATBOT_PER_IP_PER_MINUTE', 10),
        'per_ip_daily_limit' => env('CHATBOT_PER_IP_DAILY_LIMIT', 30),
        'global_daily_limit' => env('CHATBOT_GLOBAL_DAILY_LIMIT', 300),
        'suggestions' => [
            'Apa saja program keahlian yang ada?',
            'Bagaimana cara mendaftar PPDB?',
            'Apa saja fasilitas di sekolah ini?',
            'Prestasi terbaru siswa apa saja?',
            'Ekstrakurikuler apa yang tersedia?',
            'Di mana alamat dan kontak sekolah?',
        ],
    ],

];
