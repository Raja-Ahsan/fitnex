<?php

namespace App\Services;

use App\Models\PageSetting;
use Illuminate\Contracts\Encryption\DecryptException;
use Throwable;

/**
 * Google OAuth credentials managed from the admin dashboard.
 * Values saved here override the GOOGLE_* entries in .env.
 */
class GoogleCalendarSettings
{
    public const SLUG = 'google-calendar';

    protected const KEYS = ['google_client_id', 'google_client_secret', 'google_redirect_uri', 'google_login_redirect_uri'];

    public static function stored(): array
    {
        $values = array_fill_keys(self::KEYS, null);

        $rows = PageSetting::where('parent_slug', self::SLUG)->get(['key', 'value']);
        foreach ($rows as $row) {
            if (array_key_exists($row->key, $values)) {
                $values[$row->key] = $row->value;
            }
        }

        if (!empty($values['google_client_secret'])) {
            try {
                $values['google_client_secret'] = decrypt($values['google_client_secret']);
            } catch (DecryptException $e) {
                $values['google_client_secret'] = null;
            }
        }

        return $values;
    }

    public static function save(array $data): void
    {
        foreach (self::KEYS as $key) {
            if (!array_key_exists($key, $data)) {
                continue;
            }

            $value = $data[$key];
            if ($key === 'google_client_secret' && $value !== null && $value !== '') {
                $value = encrypt($value);
            }

            PageSetting::updateOrCreate(
                ['parent_slug' => self::SLUG, 'key' => $key],
                ['value' => ($value === '' ? null : $value)]
            );
        }

        self::applyToConfig();
    }

    public static function applyToConfig(): void
    {
        try {
            $stored = self::stored();
        } catch (Throwable $e) {
            return;
        }

        $map = [
            'google_client_id' => 'services.google.client_id',
            'google_client_secret' => 'services.google.client_secret',
            'google_redirect_uri' => 'services.google.redirect',
            'google_login_redirect_uri' => 'services.google.login_redirect',
        ];

        foreach ($map as $key => $configKey) {
            if (!empty($stored[$key])) {
                config([$configKey => $stored[$key]]);
            }
        }
    }

    public static function maskedSecret(): ?string
    {
        $secret = (string) config('services.google.client_secret');
        if ($secret === '') {
            return null;
        }

        return str_repeat('•', 8) . substr($secret, -4);
    }
}
