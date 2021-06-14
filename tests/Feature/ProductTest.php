<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/api/products');
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function test_store(){
        $data = [
            'name' => 'Coca Cola',
            'description' => 'Un refreso',
            'amount' => '1',
            'price' => '$20',
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('products', $data);

    }

    public function test_show(){
        $product = factory(Product::class)->create();

        $response = $this->getJson("/api/products/{$product->getKey()}");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function test_update(){

        $product = factory(Product::class)->create();
        $data = [
            'name' => 'Coca Cola',
            'description' => 'Un refreso',
            'amount' => '1',
            'price' => '$20',
        ];

        $response = $this->putJson("/api/products/{$product->getKey()}", $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('products', $data);
    }

    public function test_delete(){
        $product = factory(Product::class)->create();

        $response = $this->deleteJson("/api/products/{$product->getKey()}");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDeleted($product);
    }
}
