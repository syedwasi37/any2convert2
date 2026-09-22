<?php
$code = file_get_contents('C:\laragon\www\any2convert\app\Support\tool_handlers.php');
preg_match_all('/function\s+([A-Za-z0-9_]+)\(\)/', $code, $matches);
foreach($matches[1] as $func) {
    if (strpos($func, 'HTML') !== false || strpos($func, 'PureJS') !== false || strpos($func, 'Server') !== false) {
        if ($func !== 'renderToolHandlerHTML') {
            echo $func . "\n";
        }
    }
}
