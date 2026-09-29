<?php

namespace App\Exceptions;

use RuntimeException;

class ChatbotException extends RuntimeException
{
    public static function notConfigured(): self
    {
        return new self('Layanan chatbot belum dikonfigurasi.');
    }

    public static function disabled(): self
    {
        return new self('Layanan chatbot sedang dinonaktifkan.');
    }

    public static function requestFailed(int $status): self
    {
        return new self("Layanan chatbot gagal merespons (HTTP {$status}).");
    }

    public static function emptyResponse(): self
    {
        return new self('Layanan chatbot tidak mengembalikan jawaban.');
    }

    public static function perIpDailyLimitReached(): self
    {
        return new self('Batas harian pertanyaan Anda telah tercapai. Silakan coba lagi besok.');
    }

    public static function globalDailyLimitReached(): self
    {
        return new self('Kuota harian layanan chatbot telah tercapai. Silakan coba lagi besok.');
    }
}
