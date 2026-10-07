<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class AdminStatusController extends Controller
{
    public function index(): View
    {
        try {
            DB::select('SELECT 1');
            $databaseReady = true;
        } catch (Throwable) {
            $databaseReady = false;
        }

        $analyticsReady = false;
        $contactReady = false;
        $communityReady = false;
        $supportWorkflowReady = false;
        if ($databaseReady) {
            try {
                $analyticsReady = Schema::hasTable('site_analytics_events');
                $contactReady = Schema::hasTable('contact_messages') && Schema::hasTable('contact_message_replies');
                $communityReady = Schema::hasTable('community_posts') && Schema::hasTable('community_comments');
                $supportWorkflowReady = Schema::hasColumn('contact_messages', 'tool_slug')
                    && Schema::hasColumn('contact_messages', 'resolution_rating')
                    && Schema::hasColumn('contact_messages', 'email_updates');
            } catch (Throwable) {
                // Keep the health page available if a schema check fails.
            }
        }

        $mailer = (string) config('mail.default');
        $configuredMailers = (array) config('mail.mailers', []);
        $mailReady = filled(config('mail.from.address'))
            && array_key_exists($mailer, $configuredMailers)
            && ! in_array($mailer, ['log', 'array'], true);
        $productionSafe = app()->environment('production') && ! config('app.debug');
        $httpsReady = str_starts_with((string) config('app.url'), 'https://');

        return view('admin.status', [
            'checks' => [
                ['title' => 'Database connection', 'ready' => $databaseReady, 'detail' => $databaseReady ? 'The site can reach its database.' : 'Database connection failed. Check hosting database settings.'],
                ['title' => 'Contact inbox', 'ready' => $contactReady, 'detail' => $contactReady ? 'Messages and replies tables are ready.' : 'The contact inbox needs its messages and replies tables.'],
                ['title' => 'Tool reports and email consent', 'ready' => $supportWorkflowReady, 'detail' => $supportWorkflowReady ? 'Tool context, support ratings and email consent are ready.' : 'Run the support workflow migration to enable tracked reports, ratings and explicit email consent.'],
                ['title' => 'Community feedback', 'ready' => $communityReady, 'detail' => $communityReady ? 'Public discussions and replies are ready.' : 'Run the community feedback migration before opening the community board.'],
                ['title' => 'Analytics collection', 'ready' => $analyticsReady, 'detail' => $analyticsReady ? 'Page views and tool opens are being recorded.' : 'Create the analytics events table to start collecting visits.'],
                ['title' => 'Email delivery', 'ready' => $mailReady, 'detail' => $mailReady ? 'A delivery mailer and sender address are configured.' : 'Configure a real mailer and sender before sending replies.'],
                ['title' => 'Production security', 'ready' => $productionSafe, 'detail' => $productionSafe ? 'Production mode is on and debug output is off.' : 'Use production mode and keep debug output disabled.'],
                ['title' => 'Secure site address', 'ready' => $httpsReady, 'detail' => $httpsReady ? 'The configured site address uses HTTPS.' : 'Set the public application address to HTTPS.'],
            ],
        ]);
    }
}
