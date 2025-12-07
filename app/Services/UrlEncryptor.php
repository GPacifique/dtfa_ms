<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class UrlEncryptor
{
    /**
     * Encrypt a value for URL usage
     *
     * @param mixed $value
     * @return string
     */
    public static function encrypt($value): string
    {
        try {
            $encrypted = Crypt::encryptString((string)$value);
            // URL-safe encoding
            return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encrypted));
        } catch (\Exception $e) {
            \Log::warning('URL encryption failed: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Decrypt a URL-encrypted value
     *
     * @param string $encrypted
     * @return string|null
     */
    public static function decrypt($encrypted): ?string
    {
        try {
            if (empty($encrypted)) {
                return null;
            }

            // Restore base64 padding
            $padded = str_replace(['-', '_'], ['+', '/'], $encrypted);
            $padded .= str_repeat('=', (4 - strlen($padded) % 4) % 4);

            $decoded = base64_decode($padded, true);
            if ($decoded === false) {
                return null;
            }

            return Crypt::decryptString($decoded);
        } catch (\Exception $e) {
            \Log::warning('URL decryption failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create encrypted route parameter
     *
     * @param string $id
     * @return string
     */
    public static function encryptId($id): string
    {
        return self::encrypt($id);
    }

    /**
     * Decrypt route parameter
     *
     * @param string $encrypted
     * @return string|null
     */
    public static function decryptId($encrypted): ?string
    {
        return self::decrypt($encrypted);
    }

    /**
     * Encrypt entire query string
     *
     * @param array $params
     * @return string
     */
    public static function encryptQueryString(array $params): string
    {
        return self::encrypt(json_encode($params));
    }

    /**
     * Decrypt entire query string
     *
     * @param string $encrypted
     * @return array|null
     */
    public static function decryptQueryString($encrypted): ?array
    {
        $decrypted = self::decrypt($encrypted);
        if ($decrypted === null) {
            return null;
        }

        return json_decode($decrypted, true);
    }
}
