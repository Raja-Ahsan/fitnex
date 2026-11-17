<?php

namespace App\Services;

use App\Models\PageSetting;
use Throwable;

/**
 * Platform commission / fee rules for Stripe Connect payouts.
 */
class StripeConnectSettings
{
    public const SLUG = 'stripe-connect';

    protected const KEYS = [
        'commission_percent',
        'fee_bearer',
        'payout_trigger',
    ];

    public static function defaults(): array
    {
        return [
            'commission_percent' => 10,
            'fee_bearer' => 'trainer', // trainer | platform
            'payout_trigger' => 'session_complete', // session_complete | booking
        ];
    }

    public static function stored(): array
    {
        $values = self::defaults();

        try {
            $rows = PageSetting::where('parent_slug', self::SLUG)->get(['key', 'value']);
            foreach ($rows as $row) {
                if (array_key_exists($row->key, $values) && $row->value !== null && $row->value !== '') {
                    $values[$row->key] = $row->value;
                }
            }
        } catch (Throwable $e) {
            // Keep defaults if settings table is unavailable.
        }

        $values['commission_percent'] = (float) $values['commission_percent'];

        return $values;
    }

    public static function save(array $data): void
    {
        foreach (self::KEYS as $key) {
            if (!array_key_exists($key, $data)) {
                continue;
            }

            $value = $data[$key];
            if ($key === 'commission_percent') {
                $value = max(0, min(100, (float) $value));
            }

            PageSetting::updateOrCreate(
                ['parent_slug' => self::SLUG, 'key' => $key],
                ['value' => (string) $value]
            );
        }
    }

    public static function commissionPercent(): float
    {
        return (float) self::stored()['commission_percent'];
    }

    public static function feeBearer(): string
    {
        return (string) self::stored()['fee_bearer'];
    }

    public static function payoutOnSessionComplete(): bool
    {
        return self::stored()['payout_trigger'] === 'session_complete';
    }
}
