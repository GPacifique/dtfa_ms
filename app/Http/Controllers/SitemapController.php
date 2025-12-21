<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Report;

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

        // Public reports index
        if (Route::has('reports.index')) {
            $urls[] = [ 'loc' => route('reports.index'), 'changefreq' => 'weekly', 'priority' => '0.7' ];
        }
        // Report detail pages (limit count)
        try {
            $reports = Report::query()->select(['id','no'])->latest('id')->limit(100)->get();
            foreach ($reports as $r) {
                $urls[] = [ 'loc' => route('reports.show', $r->id), 'changefreq' => 'monthly', 'priority' => '0.5' ];
            }
        } catch (\Throwable $e) {
            // if table not available, skip gracefully
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
