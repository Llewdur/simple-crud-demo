<?php

namespace Tests\Unit;

use App\Models\Language;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use WithoutMiddleware;
    use WithFaker;

    protected $endpoint = 'languages';

    public function testIndex()
    {
        $dataArray = $this->getDataArray();

        Language::factory()->create($dataArray);

        $this->get($this->endpoint)
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => Language::RESPONSE_ARRAY,
                ],
            ]);
    }

    public function testStore()
    {
        $dataArray = $this->getDataArray();

        $this->postJson($this->endpoint, $dataArray)->assertSuccessful();
        $this->assertDatabaseHas($this->endpoint, $dataArray);
    }

    public function testShow()
    {
        $dataArray = [
            'id' => 1,
        ] + $this->getDataArray();

        Language::factory()->create($dataArray);

        $this->get("{$this->endpoint}/1")
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => Language::RESPONSE_ARRAY,
            ]);
    }

    public function testUpdate()
    {
        $dataArray = $this->getDataArray();

        $this->putJson("{$this->endpoint}/1", $dataArray)->assertSuccessful();
        $this->assertDatabaseHas($this->endpoint, $dataArray);
    }

    public function testDelete()
    {
        $this->delete("{$this->endpoint}/1")->assertSuccessful();
        $this->assertDatabaseMissing($this->endpoint, [
            'id' => 1,
        ]);
    }

    private function getDataArray(): array
    {
        return [
            'code' => $this->getRandomString(10),
            'name' => $this->getRandomString(),
        ];
    }
}
