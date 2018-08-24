<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\User;
use \App\Logs;

class LogsControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexLogin()
    {
	    $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testIndex()
    {
		$user = User::first();

		$this->be($user);

	    $response = $this->get('/logs');

	   	$response->assertSee('Logs');

	   	$response->assertViewIs('logs.index');

		$response->assertViewHasAll(['logs' => Logs::all()]);

        $response->assertStatus(200);
    }
}
