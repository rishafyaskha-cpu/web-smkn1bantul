<?php

namespace App\Support;

use App\Models\SiteSetting;

class Site
{
    public static function get(string $key, mixed $default = null): mixed
    {
        return SiteSetting::value($key, $default);
    }

    public static function name(): string
    {
        return static::get('school.name', 'SMK Negeri 1 Bantul');
    }

    public static function shortName(): string
    {
        return static::get('school.short_name', 'SMKN 1 Bantul');
    }

    public static function phone(): ?string
    {
        return static::get('contact.phone');
    }

    public static function address(): ?string
    {
        return static::get('contact.address');
    }

    public static function mapsUrl(): string
    {
        return static::get('contact.maps_url', 'https://maps.google.com?q=SMK+Negeri+1+Bantul');
    }

    public static function mapEmbedUrl(): string
    {
        return static::get('contact.map_embed_url', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7904.107401112937!2d110.355893!3d-7.889451!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7b00889ad8f84d%3A0x2e0009ca7815eaf0!2sSMK%20Negeri%201%20Bantul!5e0!3m2!1sen!2sus!4v1760634774433!5m2!1sen!2sus');
    }

    public static function heroImage(): string
    {
        return asset(static::get('school.hero_image', 'images/outsideOfSchool.png'));
    }

    public static function ogImage(): string
    {
        return asset(static::get('seo.og_image', 'images/outsideOfSchool.png'));
    }

    public static function logo(): string
    {
        return asset(static::get('school.logo', 'images/logo.png'));
    }

    public static function principal(): array
    {
        return [
            'name' => static::get('principal.name', 'Raharjo, S.IP, M.Pd'),
            'photo' => asset(static::get('principal.photo', 'images/kepalaSekolah.png')),
            'message' => static::get('principal.message', ''),
        ];
    }

    public static function socialLinks(): array
    {
        return array_values(array_filter([
            ['label' => 'YouTube', 'url' => static::get('social.youtube'), 'icon' => 'images/YouTube.png'],
            ['label' => 'Instagram', 'url' => static::get('social.instagram'), 'icon' => 'images/instagram.png'],
            ['label' => 'Telegram', 'url' => static::get('social.telegram'), 'icon' => 'images/telegramppdb.png'],
            ['label' => 'TikTok', 'url' => static::get('social.tiktok'), 'icon' => 'images/Tiktok.png'],
        ], fn ($item) => filled($item['url'])));
    }
}
