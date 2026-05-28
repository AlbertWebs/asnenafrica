<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PaymentSetting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'group', 'sort_order'];

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::cached()[$key] ?? $default;
    }

    /** @return array<string, string> */
    public static function cached(): array
    {
        return Cache::remember('payment_settings', 3600, function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('payment_settings');
    }

    /** @return list<string> */
    public static function paymentModeOptions(): array
    {
        $settings = static::cached();

        return array_values(array_filter([
            $settings['option_kcb'] ?? null,
            $settings['option_paybill'] ?? null,
            $settings['option_cheque'] ?? null,
        ]));
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }
}
