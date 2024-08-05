<?php

namespace App\Http\Controllers;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Services\ContatoService;
use App\Http\Controllers\ContatoController;
use Illuminate\Http\Request;

class ContatoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_array()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $mockService = $this->createMock(ContatoService::class);
        $mockService->method('getAll')
                    ->willReturn([
                        ['id' => 1, 'name' => 'Contato 1'],
                        ['id' => 2, 'name' => 'Contato 2'],
                    ]);

        $controller = new ContatoController($mockService);

        $request = Request::create('/api/contatos/1', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->index($request, '1');

        $data = $response->getData(true);

        $this->assertIsArray($data, "The response data should be an array.");
    }

    public function test_index_applies_filter()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $mockService = $this->createMock(ContatoService::class);
        $mockService->method('getAll')
                    ->with('test_filter', '1', false)
                    ->willReturn([
                        ['id' => 1, 'name' => 'Contato 1'],
                    ]);

        $controller = new ContatoController($mockService);

        $request = Request::create('/api/contatos/1?filter=test_filter', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->index($request, '1');

        $data = $response->getData(true);

        $this->assertIsArray($data);
        $this->assertCount(1, $data);
        $this->assertEquals('Contato 1', $data[0]['name']);
    }

    public function test_index_ignores_etapaId()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $mockService = $this->createMock(ContatoService::class);
        $mockService->method('getAll')
                    ->with(null, null, true)
                    ->willReturn([
                        ['id' => 3, 'name' => 'Contato 3'],
                    ]);

        $controller = new ContatoController($mockService);

        $request = Request::create('/api/contatos/1?ignoreEtapa=true', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->index($request, '1');

        $data = $response->getData(true);

        $this->assertIsArray($data);
        $this->assertCount(1, $data);
        $this->assertEquals('Contato 3', $data[0]['name']);
    }

    public function test_index_requires_authentication()
    {

        $response = $this->json('GET', '/api/etapas/1/contatos');

     
        $response->assertStatus(401);
    }

    public function test_index_returns_empty_array_when_no_contacts()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $mockService = $this->createMock(ContatoService::class);
        $mockService->method('getAll')
                    ->willReturn([]);

        $controller = new ContatoController($mockService);

        $request = Request::create('/api/contatos/1', 'GET');
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->index($request, '1');

        $data = $response->getData(true);

        $this->assertIsArray($data);
        $this->assertEmpty($data);
    }
}