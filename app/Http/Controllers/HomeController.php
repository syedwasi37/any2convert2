<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function tool(string $slug): View
    {
        $toolId = $this->toolIdFromSlug($slug);

        abort_unless($toolId, 404);

        return view('home', [
            'initialToolId' => $toolId,
        ]);
    }

    public function legacyHighlight(Request $request)
    {
        $topic = $request->query('topic');

        abort_unless(is_string($topic) && $topic !== '', 404);

        return redirect('/highlights/' . rawurlencode($topic), 301);
    }

    public function highlight(string $topic): View
    {
        $topics = [
            'instant-processing' => [
                'label' => 'Quick online tools',
                'desc' => 'Use focused tools for common file and everyday tasks. Processing time depends on the tool, your file, your device, and your connection. Check the tool page for supported formats and file limits before you begin.',
                'keywords' => 'instant processing, fast file conversion, quick tools, efficient processing, speed optimization',
            ],
            'files-never-leave-your-device' => [
                'label' => 'How file handling works',
                'desc' => 'Processing depends on the tool: some tasks run in your browser, while others send files to the site server to complete the work. Review the details on the tool page and our Privacy Policy before selecting sensitive files.',
                'keywords' => 'privacy, local processing, file security, no uploads, data protection',
            ],
            'no-file-uploads' => [
                'label' => 'Browser-based tools',
                'desc' => 'Some Any2Convert tools work directly in your browser, while other tasks use server processing. Each tool explains its supported formats and processing method so you can choose the right workflow for your file.',
                'keywords' => 'no uploads, local processing, browser tools, privacy, fast processing',
            ],
            'free-forever' => [
                'label' => 'Free online tools',
                'desc' => 'Many tools are available without an account. Some features require an account or a paid plan; check the tool page and plan details to see what is included before you start.',
                'keywords' => 'free tools, no cost, free forever, accessible tools, no subscriptions',
            ],
            'works-in-browser' => [
                'label' => 'Tools in your browser',
                'desc' => 'Open Any2Convert in a modern web browser without installing a desktop app. Tool support and performance can vary by browser and device; each page lists the formats and options available for that task.',
                'keywords' => 'browser tools, web based, no installation, cross browser, online tools',
            ],
            'works-on-any-device' => [
                'label' => 'Use tools across devices',
                'desc' => 'Any2Convert is a responsive website for desktop, tablet, and mobile browsers. Some tasks may work differently on smaller screens or devices with limited memory, so check each tool’s requirements for larger files.',
                'keywords' => 'cross device, responsive, mobile friendly, desktop tools, any device',
            ],
            'always-free-no-watermarks' => [
                'label' => 'Clear output options',
                'desc' => 'Output options vary by tool and plan. Review the tool page before starting to see its formats, available features, and any account requirements.',
                'keywords' => 'no watermarks, free tools, clean output, professional results, no branding',
            ],
            'instant-results' => [
                'label' => 'Straightforward workflows',
                'desc' => 'Each tool is built around a specific task, with the available options shown before you begin. Processing time depends on your device, file size, connection, and the tool you choose.',
                'keywords' => 'instant results, fast processing, quick conversion, efficient tools, productivity',
            ],
        ];

        abort_unless(isset($topics[$topic]), 404);

        $item = $topics[$topic];

        return view('page', [
            'title' => $item['label'] . ' | Any2Convert Feature',
            'description' => $item['desc'],
            'keywords' => $item['keywords'] ?? '',
            'subtitle' => $item['label'],
            'headline' => $item['label'],
            'content' => '<p>' . $item['desc'] . '</p>',
        ]);
    }

    public function blogIndex(): View
    {
        $posts = \App\Support\BlogContent::getAllPosts();

        return view('blog', [
            'posts' => $posts,
            'title' => 'Any2Convert Blog - Free Online Tools & Conversion Tutorials',
            'description' => 'Browse practical guides, privacy information, and tutorials for file, document, image, and everyday tools on Any2Convert.',
            'keywords' => 'file conversion, digital tools, PDF guides, image compressor tutorials, formatting guides',
        ]);
    }

    public function blogArticle(string $slug): View
    {
        $article = \App\Support\BlogContent::getPostBySlug($slug);

        abort_unless($article !== null, 404);

        // Fetch a few recent/other posts for the sidebar, excluding the current article
        $allPosts = \App\Support\BlogContent::getAllPosts();
        $recentPosts = array_values(array_filter($allPosts, function($post) use ($slug) {
            return $post['slug'] !== $slug;
        }));
        
        // Pick first 3 as recent posts
        $recentPosts = array_slice($recentPosts, 0, 3);

        return view('blog_article', [
            'article' => $article,
            'recentPosts' => $recentPosts,
            'title' => $article['title'] . ' | Any2Convert Blog',
            'description' => $article['excerpt'],
            'keywords' => $article['category'] . ', tutorial, any2convert, free online tools',
        ]);
    }

    private function toolIdFromSlug(string $slug): ?string
    {
        $slugs = require app_path('Support/tool_slugs.php');
        $slugLookup = array_flip($slugs);

        $normalizedSlug = strtolower(rtrim($slug, '/'));
        if (isset($slugLookup[$normalizedSlug])) {
            return $slugLookup[$normalizedSlug];
        }

        $alternateSlug = str_replace(['_', ' '], '-', $normalizedSlug);
        return $slugLookup[$alternateSlug] ?? null;
    }
}
