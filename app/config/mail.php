<?php

return [
    'host' => Env::get('MAIL_HOST'),
    'port' => Env::get('MAIL_PORT'),
    'username' => Env::get('MAIL_USERNAME'),
    'password' => Env::get('MAIL_PASSWORD'),
    'from' => Env::get('MAIL_FROM'),
    'from_name' => Env::get('MAIL_FROM_NAME')
];

?>