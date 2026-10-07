<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAnalyticsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/tools/render', [ToolController::class, 'render'])->middleware('tools.allowed')->name('tools.render');

Route::view('/about', 'page', [
    'title' => 'About Any2Convert',
    'description' => 'Learn what Any2Convert offers, how its browser-based tools work, and how to contact the team.',
    'subtitle' => 'Practical tools for everyday digital tasks',
    'headline' => 'About Any2Convert',
    'content' => '
        <p>Any2Convert is a collection of browser-based tools for common file, document, image, writing, calculation, and productivity tasks. The site brings these utilities together so people can complete supported tasks without installing a separate desktop application.</p>
        <h2>How the tools work</h2>
        <p>Processing depends on the tool. Many tools work in your browser; some features may contact an external service or use server processing. Check the individual tool and the Privacy Policy before using sensitive information. File format support, output quality, and limits can vary by task and device.</p>
        <h2>Access and features</h2>
        <p>Available features and any account or plan requirements are shown on the site. Tool availability may change as we maintain and improve the service.</p>
        <h2>Questions and feedback</h2>
        <p>If a tool does not work as expected, or you have a suggestion, please <a href="/contact">contact the team</a> with the tool name and a description of the issue. Please do not include passwords or sensitive documents in a support message.</p>
    '
]);

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:3,10')->name('contact.store');
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/community/{communityPost}', [CommunityController::class, 'show'])->whereNumber('communityPost')->name('community.show');
Route::middleware('auth')->group(function (): void {
    Route::post('/community', [CommunityController::class, 'store'])->middleware('throttle:5,10')->name('community.store');
    Route::post('/community/{communityPost}/comments', [CommunityController::class, 'comment'])->middleware('throttle:10,10')->name('community.comment');
    Route::patch('/community/{communityPost}', [CommunityController::class, 'updatePost'])->name('community.update');
    Route::delete('/community/{communityPost}', [CommunityController::class, 'deletePost'])->name('community.delete');
    Route::patch('/community/{communityPost}/comments/{comment}', [CommunityController::class, 'updateComment'])->name('community.comment.update');
    Route::delete('/community/{communityPost}/comments/{comment}', [CommunityController::class, 'deleteComment'])->name('community.comment.delete');
});
Route::patch('/admin/community/{communityPost}', [CommunityController::class, 'moderate'])->middleware(['auth', 'admin'])->name('admin.community.moderate');

Route::view('/privacy', 'page', [
    'title' => 'Privacy Policy | Any2Convert',
    'description' => 'Learn what information Any2Convert collects, how tools process data, and how to contact us about privacy.',
    'subtitle' => 'How information is handled on Any2Convert',
    'headline' => 'Privacy Policy',
    'content' => '
        <p>This policy explains how Any2Convert handles information when you browse the site, use a tool, create an account, or contact support. Processing varies by feature, so review the information shown on the tool page before using sensitive content.</p>
        <h2>Files and tool inputs</h2>
        <p>Many tools process selected files or text in your browser. Some features make requests to external services or use server processing. When a tool sends information outside your browser, the relevant tool should explain that before you use it. Do not submit information unless you are comfortable with that tool’s processing method.</p>
        <h2>Accounts and support messages</h2>
        <p>If you create an account, we store account details needed to provide sign-in and account features, including your name, email address, and a protected password credential. We store contact form details, including your name, email, subject, category, selected tool, and message, so authorized administrators can respond. Signed-in users can view their support conversation in their account. Email updates are sent only when the sender opts in; guests must opt in to receive a reply by email. Messages and replies remain in the site database until deleted.</p>
        <p>Community posts and replies are public and may be read by anyone. Do not post private account information or sensitive files. Signed-in authors and authorized administrators can edit or remove community content, and administrators may hide content that violates the site rules.</p>
        <h2>Site usage, logs, and cookies</h2>
        <p>The site records public page visits and tool opens in its database using the page path or tool identifier and event time. The hosting provider may also keep standard server and security logs. Google Analytics, Google advertising, and Microsoft Clarity may be loaded on some pages; those providers may use cookies or similar technologies according to their own policies. Essential session and preference data may also be stored by your browser.</p>
        <h2>Third-party services</h2>
        <p>Some tools rely on external libraries, content delivery networks, or service providers. For example, PDF translation may send extracted text to a translation service. Google provides advertising and analytics services, Microsoft provides Clarity analytics, and an email provider may deliver support replies. Those providers handle information under their own privacy terms. The individual tool page should be checked for any service specific to that task.</p>
        <h2>Retention and your choices</h2>
        <p>Account records are kept while needed to provide the account and related features. Support messages and replies are retained in the database until deleted. Browser storage can be cleared in your browser settings; this does not remove records already stored by the site. To ask about access to or deletion of account or support information, use the <a href="/contact">contact form</a>.</p>
        <h2>Children and policy updates</h2>
        <p>Any2Convert is a general-purpose service and is not designed to collect personal information from children. We may update this policy when site practices change. The current version is available on this page.</p>
    '
]);

Route::view('/terms', 'page', [
    'title' => 'Terms of Use | Any2Convert',
    'description' => 'Read the terms for using Any2Convert tools and services.',
    'subtitle' => 'Rules for using the site and its tools',
    'headline' => 'Terms of Use',
    'content' => '
        <p>By using Any2Convert, you agree to these terms. If you do not agree, stop using the site. These terms apply to the website, tools, and account features.</p>
        <h2>Use the tools responsibly</h2>
        <p>You are responsible for the files, text, links, and other material you submit. Use only material you own or are authorized to use. Do not use the site to break the law, infringe another person’s rights, distribute malware, interfere with the service, bypass access controls, or attempt to access another user’s information.</p>
        <h2>Community participation</h2>
        <p>Community posts and replies are public. Do not share passwords, private contact details, sensitive files, harassment, spam, or unlawful content. Authors can edit or delete their posts and replies; administrators may edit, remove, or hide content and may restrict accounts that misuse the community.</p>
        <h2>Results and limitations</h2>
        <p>Tools are provided for general convenience. Results may be incomplete, inaccurate, or unsuitable for a particular purpose. Check important outputs before relying on or sharing them. Calculators and informational tools are not professional legal, medical, tax, or financial advice. Keep your own copy of important source files.</p>
        <h2>Availability and changes</h2>
        <p>We work to keep the site useful, but do not guarantee uninterrupted access, compatibility with every device or file, or a particular conversion result. We may change, suspend, or discontinue a feature, and may set reasonable limits to protect the service.</p>
        <h2>Accounts and external services</h2>
        <p>You are responsible for keeping your sign-in credentials secure and for activity under your account. Some tools may rely on third-party services; their terms and availability may also apply when you use them.</p>
        <h2>Contact</h2>
        <p>For questions about these terms or the service, please <a href="/contact">contact Any2Convert</a>.</p>
    '
]);

Route::get('/login', fn (Request $request) => app(AuthController::class)->show($request, 'login'))->middleware('guest')->name('login');
Route::get('/register', fn (Request $request) => app(AuthController::class)->show($request, 'register'))->middleware('guest')->name('register');
Route::middleware('guest')->group(function (): void {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1')->name('auth.register');
    Route::post('/login/otp', [AuthController::class, 'sendOtp'])->middleware('throttle:10,1')->name('auth.otp.send');
    Route::post('/login/otp/verify', [AuthController::class, 'verifyOtp'])->middleware('throttle:10,1')->name('auth.otp.verify');
    Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('auth.google.redirect');
});
Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');
Route::get('/backend/google_login.php', [AuthController::class, 'googleCallback'])->name('auth.google.legacy-callback');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/account', [ProfileController::class, 'show'])->name('account.profile');
    Route::get('/account/messages', [ProfileController::class, 'supportMessages'])->name('account.messages');
    Route::post('/account/messages/{contactMessage}/replies', [ProfileController::class, 'replyToSupportMessage'])->middleware('throttle:6,10')->name('account.messages.reply');
    Route::patch('/account/messages/{contactMessage}/replies/{reply}', [ProfileController::class, 'updateSupportReply'])->name('account.messages.reply.update');
    Route::delete('/account/messages/{contactMessage}/replies/{reply}', [ProfileController::class, 'deleteSupportReply'])->name('account.messages.reply.delete');
    Route::post('/account/messages/{contactMessage}/rating', [ProfileController::class, 'rateSupport'])->middleware('throttle:5,60')->name('account.messages.rating');
    Route::patch('/account/messages/{contactMessage}/email-updates', [ProfileController::class, 'updateSupportEmailConsent'])->name('account.messages.email-updates');
    Route::patch('/account/messages/{contactMessage}', [ProfileController::class, 'updateSupportMessage'])->name('account.messages.update');
    Route::delete('/account/messages/{contactMessage}', [ProfileController::class, 'deleteSupportMessage'])->name('account.messages.delete');
    Route::patch('/account/profile', [ProfileController::class, 'updateProfile'])->name('account.profile.update');
    Route::post('/account/email/code', [ProfileController::class, 'sendEmailChangeCode'])->middleware('throttle:5,1')->name('account.email.code');
    Route::put('/account/email', [ProfileController::class, 'updateEmail'])->middleware('throttle:6,1')->name('account.email.update');
    Route::post('/account/email/confirm', [ProfileController::class, 'confirmEmailChange'])->middleware('throttle:6,1')->name('account.email.confirm');
    Route::post('/account/password/code', [ProfileController::class, 'sendPasswordCode'])->middleware('throttle:5,1')->name('account.password.code');
    Route::put('/account/password', [ProfileController::class, 'updatePassword'])->middleware('throttle:6,1')->name('account.password.update');
    Route::post('/account/two-factor/setup', [ProfileController::class, 'startTwoFactorSetup'])->middleware('throttle:5,1')->name('account.two-factor.setup');
    Route::post('/account/two-factor/confirm', [ProfileController::class, 'confirmTwoFactorSetup'])->middleware('throttle:6,1')->name('account.two-factor.confirm');
    Route::delete('/account/two-factor', [ProfileController::class, 'disableTwoFactor'])->middleware('throttle:6,1')->name('account.two-factor.disable');
});
Route::prefix('admin/contact')->name('admin.contact.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', [ContactAdminController::class, 'index'])->name('index');
    Route::get('/{contactMessage}', [ContactAdminController::class, 'show'])->name('show');
    Route::patch('/{contactMessage}', [ContactAdminController::class, 'update'])->name('update');
    Route::post('/{contactMessage}/replies', [ContactAdminController::class, 'reply'])->name('reply');
    Route::post('/{contactMessage}/replies/{reply}/resend', [ContactAdminController::class, 'resend'])->name('resend');
    Route::patch('/{contactMessage}/replies/{reply}', [ContactAdminController::class, 'updateReply'])->name('reply.update');
    Route::delete('/{contactMessage}/replies/{reply}', [ContactAdminController::class, 'deleteReply'])->name('reply.delete');
    Route::delete('/{contactMessage}', [ContactAdminController::class, 'destroy'])->name('destroy');
});
Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('analytics');
    Route::get('/status', [AdminStatusController::class, 'index'])->name('status');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}', [AdminUserController::class, 'updateStatus'])->name('users.update-status');
});
Route::middleware('guest')->group(function (): void {
    Route::get('/account/complete', [AuthController::class, 'showGoogleOnboarding'])->name('auth.google.onboarding');
    Route::post('/account/complete', [AuthController::class, 'finishGoogleOnboarding'])->middleware('throttle:5,1')->name('auth.google.onboarding.finish');
    Route::get('/two-factor/challenge', [AuthController::class, 'showTwoFactorChallenge'])->name('auth.two-factor.challenge');
    Route::post('/two-factor/challenge', [AuthController::class, 'verifyTwoFactorChallenge'])->middleware('throttle:6,1')->name('auth.two-factor.verify');
});

Route::get('/pdf-to-word', [HomeController::class, 'tool'])->name('tools.show.pdf-to-word');
Route::get('/pdf-to-word/', function () {
    return app(App\Http\Controllers\HomeController::class)->tool('pdf-to-word');
});

Route::get('/highlights', [HomeController::class, 'legacyHighlight'])->name('highlights.legacy');
Route::get('/highlights/{topic}', [HomeController::class, 'highlight'])
    ->where('topic', '[A-Za-z0-9-]+')
    ->name('highlights');
Route::redirect('/youtube-video-downloader', '/', 301);
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
