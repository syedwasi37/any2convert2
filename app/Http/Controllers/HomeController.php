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
                'label' => 'Instant Processing',
                'desc' => 'At Any2Convert, we understand that your time is valuable. That\'s why we\'ve engineered our tools to provide instant processing for all your file conversion and utility needs. Our platform is optimized for speed, ensuring that you can get your tasks done quickly and efficiently, without any unnecessary delays. We believe that you shouldn\'t have to wait to get the results you need, and our commitment to instant processing is a testament to that belief.',
                'keywords' => 'instant processing, fast file conversion, quick tools, efficient processing, speed optimization',
            ],
            'files-never-leave-your-device' => [
                'label' => 'Files Never Leave Your Device',
                'desc' => 'Your privacy is our top priority at Any2Convert. We\'ve designed our platform to keep your files secure and private by processing them directly on your device whenever possible. This means that sensitive documents, personal photos, and important data never leave your computer or mobile device. Our local-first approach ensures that you have full control over your files, reducing the risk of data breaches or unauthorized access. With Any2Convert, you can work with confidence, knowing that your information stays exactly where it belongs - on your device.',
                'keywords' => 'privacy, local processing, file security, no uploads, data protection',
            ],
            'no-file-uploads' => [
                'label' => 'No File Uploads',
                'desc' => 'Experience the convenience of processing files without the hassle of uploads. At Any2Convert, many of our tools work directly in your browser, eliminating the need to send your files to remote servers. This approach not only saves time but also enhances your privacy by keeping your data local. Whether you\'re converting documents, compressing images, or performing other tasks, you can complete your work instantly without waiting for uploads or downloads. Our no-upload philosophy makes file processing faster, safer, and more efficient for everyday users.',
                'keywords' => 'no uploads, local processing, browser tools, privacy, fast processing',
            ],
            'free-forever' => [
                'label' => 'Free Forever',
                'desc' => 'Any2Convert is committed to providing free access to our comprehensive suite of online tools. We believe that essential file processing and conversion utilities should be available to everyone without cost barriers. Our free-forever model means you can use our platform for all your document, image, and data needs without worrying about subscriptions, hidden fees, or premium upgrades. We\'re dedicated to keeping our tools accessible and useful for individuals, small businesses, and organizations of all sizes, ensuring that quality file processing remains within reach for everyone.',
                'keywords' => 'free tools, no cost, free forever, accessible tools, no subscriptions',
            ],
            'works-in-browser' => [
                'label' => 'Works in Browser',
                'desc' => 'Our browser-based tools offer unparalleled convenience and accessibility. With Any2Convert, you can perform complex file operations directly in your web browser without installing any software or applications. This approach works seamlessly across all modern browsers and operating systems, giving you the freedom to work from any device with an internet connection. Whether you\'re using Chrome, Firefox, Safari, or Edge, our tools deliver consistent performance and functionality. The browser-based design also means automatic updates and compatibility, so you always have access to the latest features and improvements.',
                'keywords' => 'browser tools, web based, no installation, cross browser, online tools',
            ],
            'works-on-any-device' => [
                'label' => 'Works on Any Device',
                'desc' => 'Any2Convert is designed to work flawlessly across all your devices. Our responsive web platform adapts to desktops, laptops, tablets, and smartphones, providing a consistent and optimized experience regardless of screen size or operating system. Whether you\'re working on a Windows PC, Mac, iPhone, Android device, or any other modern platform, our tools deliver the same powerful functionality and user-friendly interface. This cross-device compatibility ensures that you can continue your work seamlessly, whether you\'re at your desk, on the go, or switching between devices throughout your day.',
                'keywords' => 'cross device, responsive, mobile friendly, desktop tools, any device',
            ],
            'always-free-no-watermarks' => [
                'label' => 'Always Free, No Watermarks',
                'desc' => 'We provide our tools completely free of charge and without any watermarks or branding on your processed files. At Any2Convert, we believe that your work should remain yours, unmarred by promotional marks or restrictions. Our commitment to watermark-free processing means you can use our tools for professional projects, personal documents, or any other purpose without compromise. This policy extends to all our tools and features, ensuring that you receive clean, professional results every time you use our platform.',
                'keywords' => 'no watermarks, free tools, clean output, professional results, no branding',
            ],
            'instant-results' => [
                'label' => 'Instant Results',
                'desc' => 'Get immediate results with Any2Convert\'s optimized processing engine. Our tools are designed to deliver fast, reliable performance for all your file conversion and processing needs. Whether you\'re converting documents, compressing images, or performing data transformations, you can expect quick turnaround times that keep your workflow moving. The instant results approach eliminates waiting and allows you to complete tasks efficiently, making Any2Convert the ideal choice for users who value speed and productivity in their daily file processing activities.',
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
            'description' => 'Discover step-by-step guides, privacy tips, and tutorials for 80+ PDF, image, document, and utility tools on Any2Convert.',
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