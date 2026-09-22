<?php
$file = 'c:\laragon\www\any2convert\app\Support\tool_handlers.php';
$code = file_get_contents($file);

function camelCaseToReadable($str) {
    $str = str_replace(['HTML', 'PureJS', 'Server'], '', $str);
    $str = preg_replace('/(?<!^)([A-Z])/', ' $1', $str);
    return trim($str);
}

$parts = preg_split('/(?=function\s+get[A-Za-z0-9_]+\(\)\s*\{)/', $code);
$new_code = $parts[0];
$injectedCount = 0;

for ($i = 1; $i < count($parts); $i++) {
    $part = $parts[$i];
    if (preg_match('/^function\s+get([A-Za-z0-9_]+)\(\)\s*\{/', $part, $m)) {
        $funcName = $m[1];
        if ($funcName !== 'renderToolHandlerHTML' && (strpos($funcName, 'HTML') !== false || strpos($funcName, 'PureJS') !== false || strpos($funcName, 'Server') !== false)) {
            $toolReadable = camelCaseToReadable($funcName);
            $seoBlock = '
    <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-400 opacity-60 hover:opacity-100 transition-opacity" style="font-size: 11px; line-height: 1.6;">
        <p><strong>Related Searches:</strong> convert ' . $toolReadable . ' online free without email, ' . $toolReadable . ' no watermark fast for mobile, best ' . $toolReadable . ' high quality software pc mac, ' . $toolReadable . ' unlimited file size free 2026, how to use ' . $toolReadable . ' easily without app install, secure ' . $toolReadable . ' safe for business confidential files, ' . $toolReadable . ' unblocked for school chromebook.</p>
    </div>';
            
            // Find the last "';" in this function block
            $pos = strrpos($part, "';");
            if ($pos !== false) {
                // Check if we haven't already injected (idempotent)
                if (strpos($part, 'Related Searches:') === false) {
                    $part = substr_replace($part, $seoBlock, $pos, 0);
                    $injectedCount++;
                }
            }
        }
    }
    $new_code .= $part;
}

file_put_contents($file, $new_code);
echo "Successfully injected SEO blocks into $injectedCount tools!\n";
