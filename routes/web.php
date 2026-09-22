<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ToolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/tools/render', [ToolController::class, 'render'])->name('tools.render');
Route::post('/tools/pdf-service', [ToolController::class, 'unavailable'])->name('tools.pdf-service');
Route::post('/tools/ai-image', [ToolController::class, 'unavailable'])->name('tools.ai-image');
Route::post('/tools/youtube-download', [ToolController::class, 'youtubeDownload'])->name('tools.youtube');

Route::view('/about', 'page', [
    'title' => 'About Any2Convert Free Online Tools',
    'description' => 'Learn more about Any2Convert and our comprehensive suite of free online tools designed for privacy, efficiency, and ease of use.',
    'keywords' => 'about Any2Convert, free online tools, file conversion, privacy, digital tools',
    'subtitle' => 'Empowering Your Digital Workflow',
    'headline' => 'About Any2Convert',
    'content' => '
        <p>In a digital world that moves at lightning speed, Any2Convert stands as your reliable partner for all your file conversion and utility needs. We believe that powerful tools should be accessible to everyone, which is why we offer a comprehensive suite of free online utilities designed with privacy, efficiency, and ease of use at their core. Our mission is to empower you to manage your digital documents and media without compromising your data or your time.</p>
        
        <h2>Our Philosophy: Privacy First</h2>
        <p>At the heart of Any2Convert is a steadfast commitment to your privacy. In an era where data breaches are all too common, we\'ve engineered our platform to be a safe haven for your files. Unlike many other online services, we\'ve designed the majority of our tools to perform their magic directly on your device. This means your files are never uploaded to our servers, ensuring that your sensitive information remains in your hands, and your hands alone. For the few tools that require server-side processing, we have a strict policy of automatically deleting your files from our servers shortly after the conversion is complete. We don\'t believe in holding on to your data, and we\'re committed to being transparent about our processes.</p>
        
        <h2>A Universe of Tools at Your Fingertips</h2>
        <p>Any2Convert is more than just a single-purpose tool; it\'s a universe of utilities designed to tackle a wide array of digital tasks. Whether you\'re a student, a professional, a creative, or just someone who needs to get things done, our platform has something for you. Our extensive collection of tools includes:</p>
        <ul>
            <li><strong>PDF Tools:</strong> From converting images to PDF and vice versa, to merging, splitting, compressing, and even editing PDF files, our PDF toolkit is your one-stop-shop for all things PDF.</li>
            <li><strong>Image Utilities:</strong> Need to resize an image, compress it for the web, or remove a background? Our image tools are designed to be fast, intuitive, and powerful.</li>
            <li><strong>Converters:</strong> We support a wide range of file conversions, from documents and spreadsheets to audio and video. Our goal is to make file incompatibility a thing of the past.</li>
            <li><strong>Calculators and Generators:</strong> From simple percentage calculators to complex loan calculators and even fun tools like a gamer tag generator, we have a variety of utilities to help you with your daily tasks.</li>
        </ul>
        
        <h2>Designed for Everyone</h2>
        <p>We believe that technology should be inclusive, not exclusive. That\'s why we\'ve designed our tools to be as user-friendly as possible. You don\'t need to be a tech wizard to use Any2Convert. Our clean, intuitive interface makes it easy for anyone to get the job done quickly and efficiently. And because our tools work directly in your browser, there\'s no need to download or install any software. It\'s as simple as visiting our website, choosing your tool, and getting to work.</p>
        
        <h2>Free, and Always Will Be</h2>
        <p>We\'re passionate about providing accessible tools to everyone, which is why the vast majority of our services are completely free to use. We don\'t believe in paywalls or hidden fees. Our goal is to provide a valuable service that you can rely on, day in and day out. While we may offer premium features in the future, our core set of tools will always remain free for everyone.</p>
        
        <h2>Join Our Community</h2>
        <p>We\'re constantly working to improve and expand our platform, and we\'re always eager to hear from our users. If you have any feedback, suggestions, or ideas for new tools, we\'d love to hear from you. Together, we can build the ultimate online toolkit for a more productive and secure digital life.</p>
    '
]);

Route::view('/contact', 'page', [
    'title' => 'Contact Any2Convert Support and Feedback',
    'description' => 'Contact us for help and feedback.',
    'keywords' => 'contact Any2Convert, support, feedback, help, customer service',
    'subtitle' => 'Contact us for help.',
    'headline' => 'Contact Any2Convert',
    'content' => '<p>Do you need help or have ideas to share? Please contact us. You can report bugs, ask questions, or suggest new tools. We love to hear from you.</p>'
]);

Route::view('/privacy', 'page', [
    'title' => 'Privacy Policy for Any2Convert Online Tools',
    'description' => 'Read our detailed privacy policy to understand how we protect your data and prioritize your privacy when you use our free online tools.',
    'keywords' => 'privacy policy, data protection, privacy, security, terms',
    'subtitle' => 'Your Privacy, Our Priority',
    'headline' => 'Privacy Policy',
    'content' => '
        <p>At Any2Convert, we are deeply committed to protecting your privacy and ensuring the security of your data. This Privacy Policy outlines our practices and principles regarding the collection, use, and protection of your information when you use our website and services. We\'ve designed our platform from the ground up to be a safe and trustworthy environment for all your file conversion and utility needs.</p>
        
        <h2>Our Core Privacy Principle: On-Device Processing</h2>
        <p>The cornerstone of our privacy commitment is our emphasis on on-device processing. For the vast majority of our tools, all the work is done directly within your web browser on your own computer or mobile device. This means that your files are never uploaded to our servers, and we never have access to them. This approach provides the highest level of privacy and security, as your data never leaves your control.</p>
        
        <h2>When Server-Side Processing is Necessary</h2>
        <p>For a small number of our more complex tools, server-side processing is required to perform the requested task. In these cases, we are committed to handling your data with the utmost care and transparency. When you use one of these tools, your file is temporarily uploaded to our secure servers for processing. However, we have a strict data retention policy: all uploaded files are automatically and permanently deleted from our servers within a short period after the processing is complete. We do not store your files, and we do not share them with any third parties.</p>
        
        <h2>Information We Collect</h2>
        <p>We believe in collecting only the minimum amount of information necessary to provide and improve our services. We do not require you to create an account to use our tools, and we do not collect any personally identifiable information (PII) without your explicit consent. The information we do collect is limited to:</p>
        <ul>
            <li><strong>Usage Data:</strong> We may collect anonymous usage data, such as which tools are being used and how often. This information helps us understand how our services are being used and allows us to improve them over time. This data is always aggregated and anonymized, and it cannot be used to identify individual users.</li>
            <li><strong>Error Reports:</strong> If you encounter an error while using our tools, we may collect anonymous error reports to help us diagnose and fix the problem. These reports do not contain any personal information or file data.</li>
        </ul>
        
        <h2>Cookies and Tracking Technologies</h2>
        <p>We use a minimal number of cookies to enhance your experience on our website. These cookies are used for essential function like remembering your preferences and for analytics purposes. We do not use cookies for tracking you across other websites or for advertising purposes. You can control the use of cookies at the individual browser level, but if you choose to disable cookies, it may limit your use of certain features or functions on our website.</p>
        
        <h2>Third-Party Services</h2>
        <p>We do not share your personal information or file data with any third-party services for marketing or advertising purposes. We may use third-party services for analytics and error reporting, but all data shared with these services is anonymized and does not contain any personally identifiable information.</p>
        
        <h2>Your Rights and Choices</h2>
        <p>You have the right to control your data. Since we do not store your files or personal information, there is no data to access, modify, or delete. You can clear your browser\'s cookies to remove any stored preferences. If you have any questions or concerns about our privacy practices, please do not hesitate to contact us.</p>
        
        <h2>Changes to This Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time to reflect changes in our practices or for other operational, legal, or regulatory reasons. We encourage you to review this Privacy Policy periodically to stay informed about how we are protecting your information.</p>
    '
]);

Route::view('/terms', 'page', [
    'title' => 'Terms of Service for Any2Convert Online Tools',
    'description' => 'Read our terms of service and usage rules.',
    'keywords' => 'terms of service, usage rules, legal, terms, conditions',
    'subtitle' => 'Read our terms of service.',
    'headline' => 'Terms of Service',
    'content' => '<p>By using this site, you agree to our rules. You can use our tools for free. We try to keep all tools online, but we offer them as-is. Please use them fairly.</p>'
]);

Route::view('/login', 'page', [
    'title' => 'Login to Any2Convert Online Tool Account',
    'description' => 'Sign in to your account and access saved settings.',
    'keywords' => 'login, sign in, account, authentication, user login',
    'subtitle' => 'Sign in to your account.',
    'headline' => 'Login',
    'content' => '<p>Sign in to use your account features. A free account lets you save your settings. If you cannot sign in, please email our support team for help.</p>'
]);

Route::view('/register', 'page', [
    'title' => 'Register for Any2Convert Online Tools',
    'description' => 'Create a free account and save your preferences.',
    'keywords' => 'register, sign up, account, free account, user registration',
    'subtitle' => 'Create a free account.',
    'headline' => 'Register',
    'content' => '<p>Sign up for a free account today. An account lets you save your choices. It also helps you work faster with your files. Joining is quick and easy.</p>'
]);

Route::get('/pdf-to-word', [HomeController::class, 'tool'])->name('tools.show.pdf-to-word');
Route::get('/pdf-to-word/', function () {
    return app(App\Http\Controllers\HomeController::class)->tool('pdf-to-word');
});

Route::get('/highlights', [HomeController::class, 'legacyHighlight'])->name('highlights.legacy');
Route::get('/highlights/{topic}', [HomeController::class, 'highlight'])
    ->where('topic', '[A-Za-z0-9-]+')
    ->name('highlights');
Route::get('/blog', [HomeController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'blogArticle'])
    ->where('slug', '[a-z0-9-]+')
    ->name('blog.article');

Route::get('/highlights.php', function (Request $request) {
    $target = $request->query('topic')
        ? '/highlights/' . rawurlencode($request->query('topic'))
        : '/highlights';
    return redirect($target, 301);
});

Route::get('/about.php', fn() => redirect('/about', 301));
Route::get('/contact.php', fn() => redirect('/contact', 301));
Route::get('/privacy.php', fn() => redirect('/privacy', 301));
Route::get('/terms.php', fn() => redirect('/terms', 301));

Route::get('/blog/index.php', fn() => redirect('/blog', 301));
Route::get('/blog/qr-guide.php', fn() => redirect('/blog/qr-guide', 301));
Route::get('/blog/security-benefits.php', fn() => redirect('/blog/security-benefits', 301));
Route::get('/blog/highlights.php', function (Request $request) {
    $target = $request->query('topic')
        ? '/highlights/' . rawurlencode($request->query('topic'))
        : '/highlights';
    return redirect($target, 301);
});

Route::get('/blog/about.php', fn() => redirect('/about', 301));
Route::get('/blog/contact.php', fn() => redirect('/contact', 301));
Route::get('/blog/privacy.php', fn() => redirect('/privacy', 301));
Route::get('/blog/terms.php', fn() => redirect('/terms', 301));

Route::get('/public/about.php', fn() => redirect('/about', 301));
Route::get('/public/contact.php', fn() => redirect('/contact', 301));
Route::get('/public/privacy.php', fn() => redirect('/privacy', 301));
Route::get('/public/terms.php', fn() => redirect('/terms', 301));
Route::get('/public/blog/index.php', fn() => redirect('/blog', 301));
Route::get('/public/blog/qr-guide.php', fn() => redirect('/blog/qr-guide', 301));
Route::get('/public/blog/security-benefits.php', fn() => redirect('/blog/security-benefits', 301));
Route::get('/{slug}/', function (string $slug) {
    return redirect('/' . $slug, 301);
})->where('slug', '[a-z0-9-]+');

// --- 404 Redirects Placeholder for GSC Export ---
// Paste 404 URLs here once exported from Google Search Console to 301 redirect to valid routes.

Route::get('/{slug}', [HomeController::class, 'tool'])->name('tools.show');
