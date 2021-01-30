<?php

namespace Tests\Unit;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    use WithFaker;

    protected $endpoint = 'users';

    public function testIndex()
    {
        $dataArray = $this->getDataArray();

        User::factory()->make($dataArray);

        $this->get($this->endpoint)
            ->assertSuccessful()
            ->assertSee('csrf-token');
    }

    public function testStore1()
    {
        $dataArray = $this->getDataArray();

        User::where('email', $dataArray['email'])->orWhere('idnumber', $dataArray['idnumber'])->forceDelete();

        $this->postJson($this->endpoint, $dataArray)->assertSuccessful();

        $userCount = User::where('email', $dataArray['email'])->get()->count();

        $this->assertSame(1, $userCount);
    }

    public function testStoreDuplicateFails()
    {
        $user = User::inRandomOrder()->first();

        $dataArray = [
            'email' => $user->email,
            'name' => $user->name,
        ];

        $this->postJson($this->endpoint, $dataArray)->assertStatus(422);
    }

    public function testShow()
    {
        $user_id = User::inRandomOrder()->firstOrFail()->id;

        $this->get("{$this->endpoint}/${user_id}")
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => User::RESPONSE_ARRAY,
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
        $user = User::inRandomOrder()->first();

        $dataArray = [
            'email' => $user->email,
            'name' => $user->name,
        ];

        $this->putJson("{$this->endpoint}/1", $dataArray)->assertStatus(422);
    }

    public function testDelete()
    {
        $user_id = User::whereDoesntHave('userInterests')->inRandomOrder()->firstOrFail()->id;

        $this->delete("{$this->endpoint}/${user_id}")->assertSuccessful();

        $this->assertDatabaseMissing($this->endpoint, [
            'id' => $user_id,
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
            'dob' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'idnumber' => Str::random(11),
            'language_id' => Language::inRandomOrder()->firstOrFail()->id,
            'mobile' => Str::random(11),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
        ];
    }
}
