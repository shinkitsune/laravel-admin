<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\User;
use \App\Indicators;

class IndicatorsControllerTest extends TestCase
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

	    $response = $this->get('/indicators');

	   	$response->assertSee('Indicadores');

	   	$response->assertSee('Cadastrar');

	   	$response->assertViewIs('indicators.index');

		$response->assertViewHasAll(['indicators' => Indicators::all()]);

        $response->assertStatus(200);
    }

    public function testAdd()
    {
    	$user = User::first();

		$this->be($user);

	    $response = $this->get('/indicators/add');

	   	$response->assertSee('Cadastrar indicador');

	   	$response->assertSee('Cadastrar');

	   	$response->assertViewIs('indicators.add');
	
        $response->assertStatus(200);
    }

    public function testSave()
    {
    	$user = User::first();

		$this->be($user);

	    $response = $this->post('/indicators/save', [
	    	'name' => 'TESTE',
	    	'query' => 'SELECT * FROM users;',
	    	'color' => 'aqua',
	    	'description' => '', 
	    	'link' => '',
	    	'size' => 2,
	    	'glyphicon' => 'glyphicon glyphicon-signal',
	    	'r_auth' => $user->id
	    ]);

		$response->assertRedirect('/indicators');

    }

    public function testEdit()
    {
    	$user = User::first();

		$this->be($user);

		$indicator = Indicators::first();

	   	$response = $this->get('/indicators/edit/' . $indicator->id);

	   	$response->assertSee('Editar indicador');

	   	$response->assertSee('Salvar');

	   	$response->assertViewIs('indicators.edit');

	   	$indicators = Indicators::find($indicator->id);

		$response->assertViewHasAll(['indicators' => $indicators]);

        $response->assertStatus(200);

    }

    public function testUpdate()
    {
    	$user = User::first();

		$this->be($user);

		$indicator = Indicators::where('name', 'TESTE')->first();

		$rdn = str_random(10);

	    $response = $this->post('/indicators/update', [
	    	'id' => $indicator->id,
	    	'name' => 'TESTE',
	    	'query' => 'SELECT * FROM users;',
	    	'color' => $rdn,
	    	'description' => '', 
	    	'link' => '',
	    	'size' => 2,
	    	'glyphicon' => 'glyphicon glyphicon-signal',
	    	'r_auth' => $user->id
	    ]);

	    $new = Indicators::find($indicator->id);

	    $this->assertTrue($new->color == $rdn);

		$response->assertRedirect('/indicators');

    }

    public function testDelete()
    {
    	$user = User::first();

		$this->be($user);

		$indicator = Indicators::where('name', 'TESTE')->first();

	   	$response = $this->post('/indicators/delete',
	   		[
	   			'id' => $indicator->id
	   		]
	   	);

		$response->assertRedirect('/indicators');
    }
}
