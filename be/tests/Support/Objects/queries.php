<?php

return [
    'login' => 'query LoginUser($email: String, $password: String) {
        loginexample(email: $email, password: $password) {
            token
            expires_at
        }
    }',
];