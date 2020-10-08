<?php

namespace Tests\Unit;

use Tests\Support\TestCase;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LoginTest extends TestCase
{
    protected $schema = 'login';

    /** 
     * A basic unit login example 
     */
    public function testLogin() : void
    {
        $opts = [
            'schema' => $this->schema,
        ];
        $result = GraphQL::queryAndReturnResult($this->queries['login'], $this->data['login'], $opts);
        $this->assertObjectHasAttribute('data', $result);
        $this->assertSame($result->data, $this->results['login']);
    }

    /** 
     * A basic unit login error example 
     */
    public function testLoginError() : void
    {
        $opts = [
            'schema' => $this->schema,
        ];
        $result = GraphQL::queryAndReturnResult($this->queries['login'], $this->data['login-error'], $opts);
        $this->assertObjectHasAttribute('errors', $result);
        $expected = 'Incorrect email and password';
        $this->assertSame($expected, $result->errors[0]->getMessage());
    }
}
