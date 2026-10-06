<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $siteUrl = 'https://any2convert.com';
        $slugs = require app_path('Support/tool_slugs.php');
        
        $urls = [
            $siteUrl,
            $siteUrl . '/about',
            $siteUrl . '/contact',
            $siteUrl . '/privacy',
            $siteUrl . '/terms',
            $siteUrl . '/blog',
        ];

        // Add all tools
        foreach ($slugs as $id => $slug) {
            $urls[] = $siteUrl . '/' . $slug;
        }

        // Include only the editorial posts displayed on the blog page.
        $allBlogPosts = \App\Support\BlogContent::getAllPosts();
        foreach ($allBlogPosts as $post) {
            $urls[] = $siteUrl . '/blog/' . $post['slug'];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach (array_unique($urls) as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
