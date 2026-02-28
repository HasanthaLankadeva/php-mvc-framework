<?php
class Request
{
    public static function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}
?>