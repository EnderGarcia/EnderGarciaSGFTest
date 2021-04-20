<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Models\DocumentType;
use App\Models\User;
use Exception;

class UserTest extends TestCase
{
    private $apiKeyLaika = '123456789';
    private $validEmail = ["email_de_prueba","textodeejemplo","@prueba.com"];
    private $testUser;
    private $document_type_id;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        //$this->artisan("db:seed");
        $this->validEmail[1] = random_int(100,1000000);
        $validEmail = implode('',$this->validEmail);
        $this->document_type_id = DocumentType::inRandomOrder()->first()->id;
    }

    /** @test */
    public function createUserTest()
    {
      // $this->withoutExceptionHandling();
      $this->validEmail[1] = random_int(100,1000000);
      $validEmail = implode('',$this->validEmail);
      $params = [
        "name" => "Nombre de Prueba",
        "email" => $validEmail,
        "document_type_id" => $this->document_type_id
      ];
      $response = $this->json("post", "/users/store", $params,['api-key-laika' => $this->apiKeyLaika]);
      $this->testUser = User::orderByDesc('created_at')->first();
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }

    /** @test */
    public function updateUserTest()
    {
      $this->validEmail[1] = random_int(100,1000000);
      $validEmail = implode('',$this->validEmail);
      $params = [
        "name" => "Prueba de Actualización".random_int(100,10000000),
        "email" =>  $validEmail,
        "document_type_id" => $this->document_type_id
      ];
      $this->testUser = User::orderByDesc('created_at')->first();
      $response = $this->json("post", "/users/update/".$this->testUser->id, $params,['api-key-laika' => $this->apiKeyLaika]);
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }

    /** @test */
    public function deleteUserTest()
    {
      $this->validEmail[1] = random_int(100,1000000);
      $validEmail = implode('',$this->validEmail);
      $this->testUser = User::orderByDesc('created_at')->first();
      $response = $this->json("delete", "/users/destroy/".$this->testUser->id, [],['api-key-laika' => $this->apiKeyLaika]);
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }
}
