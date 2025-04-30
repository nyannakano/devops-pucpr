<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Result;

class MainTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_result_if_none_exists()
    {
        $this->post(route('calculate', [5, 7]));

        $this->assertDatabaseHas('results', [
            'result' => 12
        ]);
    }

    /** @test */
    public function it_updates_result_if_it_already_exists()
    {
        Result::create(['result' => 100]);

        $this->post(route('calculate', [2, 3]));

        $this->assertDatabaseHas('results', [
            'result' => 5
        ]);
        $this->assertEquals(1, Result::count());
    }

    /** @test */
    public function it_returns_inexistente_if_no_result_exists()
    {
        $response = $this->get(route('status'));

        $response->assertSeeText('Inexistente');
    }

    /** @test */
    public function it_returns_par_if_result_is_even()
    {
        Result::create(['result' => 10]);

        $response = $this->get(route('status'));

        $response->assertSeeText('Par');
    }

    /** @test */
    public function it_returns_impar_if_result_is_odd()
    {
        Result::create(['result' => 11]);

        $response = $this->get(route('status'));

        $response->assertSeeText('Ímpar');
    }
}
