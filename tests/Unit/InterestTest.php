<?php

namespace Tests\Unit;

use App\Models\Interest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class InterestTest extends TestCase
{
    use WithoutMiddleware;
    use WithFaker;

    protected $endpoint = 'interests';

    public function testIndex()
    {
        $dataArray = $this->getDataArray();

        Interest::factory()->make($dataArray);

        $this->get($this->endpoint)
            ->assertSuccessful()
            ->assertSee('csrf-token');
    }

    public function testStore()
    {
        $dataArray = $this->getDataArray();

        Interest::where('name', $dataArray['name'])->forceDelete();

        $this->postJson($this->endpoint, $dataArray)->assertSuccessful();

        $this->assertDatabaseHas($this->endpoint, $dataArray);
    }

    public function testStoreDuplicateFails()
    {
        $interest = Interest::inRandomOrder()->first();

        $dataArray = [
            'name' => $interest->name,
        ];

        $this->postJson($this->endpoint, $dataArray)->assertStatus(422);
    }

    public function testShow()
    {
        $interest_id = Interest::inRandomOrder()->firstOrFail()->id;

        $this->get("{$this->endpoint}/${interest_id}")
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => Interest::RESPONSE_ARRAY,
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
        $interest = Interest::inRandomOrder()->first();

        $dataArray = [
            'name' => $interest->name,
        ];

        $this->putJson("{$this->endpoint}/1", $dataArray)->assertStatus(422);
    }

    public function testDelete()
    {
        $interest_id = Interest::whereDoesntHave('users')->inRandomOrder()->firstOrFail()->id;

        $this->delete("{$this->endpoint}/${interest_id}")->assertSuccessful();

        $this->assertDatabaseMissing($this->endpoint, [
            'id' => $interest_id,
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
            'name' => $this->getRandomString(25),
        ];
    }
}
