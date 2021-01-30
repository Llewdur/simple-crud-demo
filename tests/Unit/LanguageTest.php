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

        Language::factory()->make($dataArray);

        $this->get($this->endpoint)
            ->assertSuccessful()
            ->assertSee('csrf-token');
    }

    public function testStore()
    {
        $dataArray = $this->getDataArray();

        Language::where('code', $dataArray['code'])->orWhere('name', $dataArray['name'])->forceDelete();

        $this->postJson($this->endpoint, $dataArray)->assertSuccessful();

        $this->assertDatabaseHas($this->endpoint, $dataArray);
    }

    public function testStoreDuplicateFails()
    {
        $language = Language::inRandomOrder()->first();

        $dataArray = [
            'code' => $language->code,
            'name' => $language->name,
        ];

        $this->postJson($this->endpoint, $dataArray)->assertStatus(422);
    }

    public function testShow()
    {
        $language_id = Language::inRandomOrder()->firstOrFail()->id;

        $this->get("{$this->endpoint}/${language_id}")
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

    public function testUpdateDuplicateFails()
    {
        $language = Language::inRandomOrder()->first();

        $dataArray = [
            'code' => $language->code,
            'name' => $language->name,
        ];

        $this->putJson("{$this->endpoint}/1", $dataArray)->assertStatus(422);
    }

    public function testDelete()
    {
        $language_id = Language::whereDoesntHave('user')->inRandomOrder()->firstOrFail()->id;

        $this->delete("{$this->endpoint}/${language_id}")->assertSuccessful();

        $this->assertDatabaseMissing($this->endpoint, [
            'id' => $language_id,
        ]);
    }

    public function testDatatable()
    {
        $this->get("{$this->endpoint}/datatable")
            ->assertSuccessful()
            ->assertSee('recordsTotal')
            ->assertSee('DT_RowIndex');
    }

    private function getDataArray(): array
    {
        return [
            'code' => $this->getRandomString(10),
            'name' => $this->getRandomString(20),
        ];
    }
}
