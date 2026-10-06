<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RecordSiteAnalytics
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $response->getStatusCode() < 400 && $this->isPublicPage($request)) {
            [$eventType, $eventValue] = $this->eventFor($request);

            if ($eventValue !== null) {
                try {
                    DB::table('site_analytics_events')->insert([
                        'event_type' => $eventType,
                        'event_value' => $eventValue,
                        'created_at' => now(),
                    ]);
                } catch (Throwable $exception) {
                    // Analytics must never make a working page unavailable.
                    report($exception);
                }
            }
        }

        return $response;
    }

    private function isPublicPage(Request $request): bool
    {
        return ! $request->is('admin', 'admin/*', 'account', 'account/*', 'login', 'register', 'logout', 'auth/*', 'two-factor/*');
    }

    /** @return array{0: string, 1: ?string} */
    private function eventFor(Request $request): array
    {
        if ($request->is('tools/render')) {
            $tool = preg_replace('/[^A-Za-z0-9._-]/', '', (string) $request->query('tool', ''));

            return ['tool_open', $tool === '' ? null : Str::limit($tool, 120, '')];
        }

        $path = '/'.trim($request->path(), '/');

        return ['page_view', $path === '/' ? '/' : Str::limit($path, 160, '')];
    }
}
