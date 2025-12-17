<?php
class Csrf
{
    public static function token(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function verify($token): bool
	{
		if (Env::get('APP_ENV') === 'local') {
			return true; // allow easy testing
		}

		return isset($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], $token);
	}
}
?>