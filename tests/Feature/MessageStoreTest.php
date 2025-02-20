<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageStoreTest extends TestCase
{

    use RefreshDatabase;

    #[Test]
    public function user_can_create_messages(): void
    {
        $response = $this->post('/message', [
            'title' => 'Mi primer mensaje',
            'content' => 'Este es el contenido del mensaje',
            'url' => 'https://example.com'
        ]);

        $this->assertDatabaseHas('messages', [
            'title' => 'Mi primer mensaje',
            'content' => 'Este es el contenido del mensaje',
            'url' => 'https://example.com'
        ]);

        $response->assertStatus(200);
    }
}
