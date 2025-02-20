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
        $messageData = [
            'title' => 'Mi primer mensaje',
            'content' => 'Este es el contenido del mensaje',
            'url' => 'https://example.com'
        ];

        $response = $this->post('/message', $messageData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('messages', $messageData);

        $response = $this->get('/');
        $response
            ->assertStatus(200)
            ->assertSee($messageData['title']);
    }

    #[Test]
    public function only_url_is_optional_when_store_messages(): void
    {
        $response = $this->post('/message', []);

        $response
            ->assertRedirect()
            ->assertValid(['url'])
            ->assertInvalid(['title', 'content']);
    }
}
