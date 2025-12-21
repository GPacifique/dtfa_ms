<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $base = url('/');
        $urls = [
            [ 'loc' => $base.'/', 'changefreq' => 'weekly', 'priority' => '1.0' ],
        ];

        if (Route::has('login')) {
            $urls[] = [ 'loc' => route('login'), 'changefreq' => 'monthly', 'priority' => '0.5' ];
        }
        if (Route::has('register')) {
            $urls[] = [ 'loc' => route('register'), 'changefreq' => 'monthly', 'priority' => '0.5' ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $u) {
            $xml .= '<url>';
            $xml .= '<loc>'.e($u['loc']).'</loc>';
            $xml .= '<changefreq>'.$u['changefreq'].'</changefreq>';
            $xml .= '<priority>'.$u['priority'].'</priority>';
            $xml .= '</url>';
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
