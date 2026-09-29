<?php

namespace App\Support;

use App\Exceptions\ChatbotException;
use Illuminate\Support\Facades\Cache;

class ChatbotUsageLimiter
{
    public function ensureWithinLimits(string $ipAddress): void
    {
        $perIpLimit = (int) config('services.chatbot.per_ip_daily_limit', 30);
        $globalLimit = (int) config('services.chatbot.global_daily_limit', 300);

        if ($perIpLimit > 0 && $this->count($this->perIpKey($ipAddress)) >= $perIpLimit) {
            throw ChatbotException::perIpDailyLimitReached();
        }

        if ($globalLimit > 0 && $this->count($this->globalKey()) >= $globalLimit) {
            throw ChatbotException::globalDailyLimitReached();
        }
    }

    public function recordUsage(string $ipAddress): void
    {
        $expiresAt = now()->endOfDay();

        foreach ([$this->perIpKey($ipAddress), $this->globalKey()] as $key) {
            Cache::add($key, 0, $expiresAt);
            Cache::increment($key);
        }
    }

    private function count(string $key): int
    {
        return (int) Cache::get($key, 0);
    }

    private function perIpKey(string $ipAddress): string
    {
        return 'chatbot:daily:ip:'.sha1($ipAddress).':'.now()->toDateString();
    }

    private function globalKey(): string
    {
        return 'chatbot:daily:total:'.now()->toDateString();
    }
}
