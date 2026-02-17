<?php
class Csrf {

    public static function generate() {
        if (empty($_SESSION[CSRF_TOKEN_NAME])) {
            $_SESSION[CSRF_TOKEN_NAME] = bin2hex(
                random_bytes(CSRF_TOKEN_LENGTH)
            );
        }
        return $_SESSION[CSRF_TOKEN_NAME];
    }

    public static function validate($token) {
        if (
            empty($_SESSION[CSRF_TOKEN_NAME]) ||
            empty($token)
        ) {
            return false;
        }

        return hash_equals(
            $_SESSION[CSRF_TOKEN_NAME],
            $token
        );
    }

    public static function regenerate() {
        unset($_SESSION[CSRF_TOKEN_NAME]);
    }
}
?>