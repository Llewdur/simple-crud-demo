<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    public function testRoot()
    {
        $this->get('/')->assertRedirect();
    }

    public function testLogin()
    {
        $this->get('/login')->assertOk();
    }
}
