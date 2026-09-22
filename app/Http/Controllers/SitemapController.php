<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $siteUrl = 'https://any2convert.com';
        $slugs = require app_path('Support/tool_slugs.php');
        
        $urls = [
            [
                'loc' => $siteUrl,
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => $siteUrl . '/about',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $siteUrl . '/contact',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $siteUrl . '/privacy',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $siteUrl . '/terms',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => $siteUrl . '/blog',
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ]
        ];

        // Add all tools
        foreach ($slugs as $id => $slug) {
            $urls[] = [
                'loc' => $siteUrl . '/' . $slug,
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];
        }

        // Add all blog posts
        $allBlogPosts = \App\Support\BlogContent::getAllPosts();
        foreach ($allBlogPosts as $post) {
            $urls[] = [
                'loc' => $siteUrl . '/blog/' . $post['slug'],
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        // Add highlight pages
        $highlights = [
            'instant-processing',
            'files-never-leave-your-device',
            'no-file-uploads',
            'free-forever',
            'works-in-browser',
            'works-on-any-device',
            'always-free-no-watermarks',
            'instant-results'
        ];
        foreach ($highlights as $slug) {
            $urls[] = [
                'loc' => $siteUrl . '/highlights/' . $slug,
                'lastmod' => date('Y-m-d'),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
