<?php
/**
 * Cadangan fungsi multibyte bila ekstensi mbstring tidak aktif.
 * Tujuannya agar aplikasi tetap berjalan di lingkungan PHP minimal.
 */

if (!function_exists('nk_utf8_chars')) {
    function nk_utf8_chars(string $text): array
    {
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        return $chars === false ? str_split($text) : $chars;
    }
}

if (!function_exists('mb_strlen')) {
    function mb_strlen($text, $encoding = null)
    {
        return count(nk_utf8_chars((string) $text));
    }
}

if (!function_exists('mb_substr')) {
    function mb_substr($text, $start, $length = null, $encoding = null)
    {
        $chars = nk_utf8_chars((string) $text);
        $slice = $length === null ? array_slice($chars, $start) : array_slice($chars, $start, $length);
        return implode('', $slice);
    }
}

if (!function_exists('mb_strtolower')) {
    function mb_strtolower($text, $encoding = null)
    {
        return strtolower((string) $text);
    }
}

if (!function_exists('mb_strtoupper')) {
    function mb_strtoupper($text, $encoding = null)
    {
        return strtoupper((string) $text);
    }
}

if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack, $needle, $offset = 0, $encoding = null)
    {
        return strpos((string) $haystack, (string) $needle, (int) $offset);
    }
}
