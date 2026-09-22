<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ToolController extends Controller
{
    public function render(Request $request): Response
    {
        require_once app_path('Support/tool_handlers.php');

        return response(renderToolHandlerHTML((string) $request->query('tool', '')))
            ->header('X-Robots-Tag', 'noindex, nofollow');
    }

    public function unavailable(): JsonResponse
    {
        return response()->json([
            'error' => 'This server-side endpoint is not configured in the Laravel project yet.',
        ], 501);
    }

    public function youtubeDownload(Request $request): JsonResponse
    {
        set_time_limit(0);
        $url = $request->input('url');
        $format = $request->input('vQuality', '1080');

        if (!$url) {
            return response()->json(['error' => 'No URL provided'], 400);
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        // Detect OS and set appropriate executable paths
        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $binDir = base_path('bin');
        
        if ($isWindows) {
            $ytDlp = $binDir . DIRECTORY_SEPARATOR . 'yt-dlp.exe';
            $ffmpegPath = $binDir . DIRECTORY_SEPARATOR . 'ffmpeg.exe';
        } else {
            $ytDlp = $binDir . DIRECTORY_SEPARATOR . 'yt-dlp';
            $ffmpegPath = $binDir . DIRECTORY_SEPARATOR . 'ffmpeg';
        }
        
        $ffmpegLocationArg = '';
        if (file_exists($ffmpegPath)) {
            $ffmpegLocationArg = '--ffmpeg-location ' . escapeshellarg($binDir);
        }

        if (!file_exists($ytDlp)) {
            return response()->json(['error' => 'Downloader executable not found on server. Expected at: ' . $ytDlp], 500);
        }

        $uniqueId = uniqid('yt_');
        $downloadDirRelative = 'downloads/youtube/' . $uniqueId;
        $downloadDir = public_path($downloadDirRelative);
        if (!is_dir($downloadDir)) {
            mkdir($downloadDir, 0755, true);
        }

        $outputPath = $downloadDir . DIRECTORY_SEPARATOR . '%(title)s.%(ext)s';

        if ($format === 'mp3') {
            $formatArg = "-x --audio-format mp3 --audio-quality 0";
        } else {
            $formatArg = "-f \"bestvideo[height<={$format}][ext=mp4]+bestaudio[ext=m4a]/best[height<={$format}][ext=mp4]/best\" --merge-output-format mp4";
        }

        // Set TMPDIR to bypass Hostinger /tmp noexec restriction
        $tmpDir = public_path('tmp');
        if (!file_exists($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        $cmd = sprintf(
            'TMPDIR="%s" "%s" %s %s -o "%s" "%s"',
            $tmpDir,
            $ytDlp,
            $ffmpegLocationArg,
            $formatArg,
            $outputPath,
            escapeshellarg($url)
        );

        $outputStr = shell_exec($cmd . ' 2>&1');
        $output = explode("\n", (string)$outputStr);

        $files = glob($downloadDir . '/*');
        if (empty($files)) {
            return response()->json([
                'error' => 'Download failed', 
                'details' => implode("\n", $output)
            ], 500);
        }

        $downloadedFile = basename($files[0]);
        $fileUrl = asset($downloadDirRelative . '/' . rawurlencode($downloadedFile));

        return response()->json(['url' => $fileUrl, 'filename' => $downloadedFile]);
    }
}
