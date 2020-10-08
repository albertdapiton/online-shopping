<?php

namespace App\Traits;

use Laravel\Passport\ClientRepository;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

trait HasAccessToken
{
    /**
     * Get personal access token for user.
     *
     * @return \Laravel\Passport\Token|null
     */
    public function getToken(): ?Token
    {
        return app(TokenRepository::class)->findValidToken(
            $this,
            app(ClientRepository::class)->personalAccessClient()
        );
    }
}