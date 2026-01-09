<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Supported locales with their display names and flags
     */
    public static array $locales = [
        'en' => ['name' => 'English', 'native' => 'English', 'flag' => '🇬🇧'],
        'fr' => ['name' => 'French', 'native' => 'Français', 'flag' => '🇫🇷'],
        'rw' => ['name' => 'Kinyarwanda', 'native' => 'Ikinyarwanda', 'flag' => '🇷🇼'],
        'sw' => ['name' => 'Swahili', 'native' => 'Kiswahili', 'flag' => '🇹🇿'],
    ];

    /**
     * Switch the application locale
     */
    public function switch(Request $request, string $locale)
    {
        if (array_key_exists($locale, self::$locales)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }

    /**
     * Get supported locales
     */
    public static function getLocales(): array
    {
        return self::$locales;
    }
}
