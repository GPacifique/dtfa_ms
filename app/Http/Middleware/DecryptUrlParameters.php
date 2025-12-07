<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\UrlEncryptor;
use Symfony\Component\HttpFoundation\Response;

class DecryptUrlParameters
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // List of parameter names that might be encrypted
        $encryptedParams = ['id', 'encrypted_id', 'token', 'code'];

        foreach ($encryptedParams as $param) {
            if ($request->has($param)) {
                $value = $request->input($param);

                // Check if it looks like an encrypted value (contains URL-safe base64 chars)
                if ($this->isEncrypted($value)) {
                    $decrypted = UrlEncryptor::decrypt($value);

                    if ($decrypted !== null) {
                        $request->merge([$param => $decrypted]);
                    }
                }
            }
        }

        // Also handle route parameters (only if route exists)
        if ($request->route() !== null) {
            foreach ($request->route()->parameters() as $key => $value) {
                if (is_string($value) && $this->isEncrypted($value)) {
                    $decrypted = UrlEncryptor::decrypt($value);

                    if ($decrypted !== null) {
                        $request->route()->setParameter($key, $decrypted);
                    }
                }
            }
        }

        return $next($request);
    }

    /**
     * Check if a value appears to be encrypted
     * Encrypted values contain URL-safe base64 characters: A-Z, a-z, 0-9, -, _
     *
     * @param mixed $value
     * @return bool
     */
    private function isEncrypted($value): bool
    {
        if (!is_string($value) || strlen($value) < 20) {
            return false;
        }

        // Check for URL-safe base64 pattern (no +, /, = at start)
        return preg_match('/^[A-Za-z0-9_-]+$/', $value) === 1;
    }
}
