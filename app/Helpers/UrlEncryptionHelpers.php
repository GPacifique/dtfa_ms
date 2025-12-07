<?php

use App\Services\UrlEncryptor;

if (!function_exists('encrypt_url')) {
    /**
     * Encrypt a value for safe URL usage
     *
     * @param mixed $value
     * @return string
     */
    function encrypt_url($value): string
    {
        return UrlEncryptor::encrypt($value);
    }
}

if (!function_exists('decrypt_url')) {
    /**
     * Decrypt a URL-encrypted value
     *
     * @param string $encrypted
     * @return string|null
     */
    function decrypt_url($encrypted): ?string
    {
        return UrlEncryptor::decrypt($encrypted);
    }
}

if (!function_exists('encrypt_id')) {
    /**
     * Encrypt an ID for safe URL usage
     *
     * @param string|int $id
     * @return string
     */
    function encrypt_id($id): string
    {
        return UrlEncryptor::encryptId($id);
    }
}

if (!function_exists('decrypt_id')) {
    /**
     * Decrypt an ID from URL
     *
     * @param string $encrypted
     * @return string|null
     */
    function decrypt_id($encrypted): ?string
    {
        return UrlEncryptor::decryptId($encrypted);
    }
}

if (!function_exists('route_encrypted')) {
    /**
     * Generate a route with encrypted parameter
     *
     * @param string $name
     * @param string|int $id
     * @param array $parameters
     * @return string
     */
    function route_encrypted($name, $id, array $parameters = []): string
    {
        $encrypted = encrypt_id($id);
        return route($name, array_merge($parameters, ['id' => $encrypted]));
    }
}

if (!function_exists('url_encrypted')) {
    /**
     * Generate a URL with encrypted parameter
     *
     * @param string $path
     * @param string|int $id
     * @return string
     */
    function url_encrypted($path, $id): string
    {
        $encrypted = encrypt_id($id);
        return url($path . '/' . $encrypted);
    }
}
