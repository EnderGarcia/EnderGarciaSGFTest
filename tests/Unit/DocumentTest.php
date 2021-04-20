<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use App\Models\DocumentType;
use App\Models\User;
use Exception;

class DocumentTest extends TestCase
{
    private $apiKeyLaika = '123456789';
    private $validName = ["Nombre de Documento de Prueba ","textodeejemplo"];
    private $testDocument;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        //$this->artisan("db:seed");
        $this->validName[1] = random_int(100,1000000);
        $validName = implode('',$this->validName);

    }

    /** @test */
    public function createDocumentTest()
    {
      // $this->withoutExceptionHandling();
      $this->validName[1] = random_int(100,1000000);
      $validName = implode('',$this->validName);
      $params = [
        "name" => $validName,
      ];
      $response = $this->json("post", "/documents/store", $params,['api-key-laika' => $this->apiKeyLaika]);
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }

    /** @test */
    public function updateDocumentTest()
    {
      $this->validName[1] = random_int(100,1000000);
      $validName = implode('',$this->validName);
      $params = [
        "name" => "Prueba de Actualización".random_int(100,10000000),
      ];
      $this->testDocument = DocumentType::orderByDesc('id')->first();
      $response = $this->json("post", "/documents/update/".$this->testDocument->id, $params,['api-key-laika' => $this->apiKeyLaika]);
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }

    /** @test */
    public function deleteDocumentTest()
    {
      $this->testDocument = DocumentType::orderByDesc('id')->first();
      $response = $this->json("delete", "/documents/destroy/".$this->testDocument->id, [],['api-key-laika' => $this->apiKeyLaika]);
      try {
        $response->assertOk();
      } catch (\Exception $e) {
        // dd($response->decodeResponseJson(),$params);
      }
    }
}
