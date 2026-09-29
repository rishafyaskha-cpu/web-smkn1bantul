<?php

namespace App\Http\Controllers;

use App\Exceptions\ChatbotException;
use App\Services\GeminiChatService;
use App\Support\ChatbotUsageLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ChatController extends Controller
{
    public function __construct(
        private readonly GeminiChatService $chat,
        private readonly ChatbotUsageLimiter $limiter,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'min:2', 'max:'.config('services.chatbot.max_question_length', 500)],
            'history' => ['sometimes', 'array', 'max:'.config('services.chatbot.max_history_messages', 10)],
            'history.*.role' => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:'.config('services.chatbot.max_history_content_length', 2000)],
        ]);

        try {
            $this->limiter->ensureWithinLimits($request->ip());

            $answer = $this->chat->ask(
                trim($validated['message']),
                $validated['history'] ?? [],
            );

            $this->limiter->recordUsage($request->ip());
        } catch (ChatbotException $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], 503);
        } catch (Throwable $exception) {
            Log::error('Chatbot unexpected error', ['message' => $exception->getMessage()]);

            return response()->json([
                'error' => 'Terjadi kendala teknis. Silakan coba lagi.',
            ], 500);
        }

        return response()->json([
            'answer' => $answer,
        ]);
    }
}
