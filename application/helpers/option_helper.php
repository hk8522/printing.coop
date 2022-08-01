<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function option_turnaround_add_days(string $str, int $extra_days)
{
    preg_match_all('/\d+/', $str, $matches, PREG_OFFSET_CAPTURE);
    $result = '';
    $offset = 0;
    foreach ($matches[0] as $match) {
        if ($match[1] > $offset) {
            $result .= substr($str, $offset, $match[1] - 1);
        }
        $result .= $match[0] + $extra_days;
        $offset = $match[1] + strlen($match[0]);
    }
    $result .= substr($str, $offset);
    return $result;
}
