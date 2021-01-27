<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    // use RefreshDatabase;
    use WithoutMiddleware;
    use WithFaker;

    public function testStore()
    {
        $languageArray = [
            'code' => $this->getUniqueString(),
            'name' => $this->getUniqueString(),
        ];

        $this->postJson('languages', $languageArray)->assertSuccessful();

        $this->assertDatabaseHas('languages', $languageArray);
    }
}
