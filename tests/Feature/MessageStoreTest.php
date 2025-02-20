<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageStoreTest extends TestCase
{

    use RefreshDatabase;

    #[Test]
    public function user_can_create_messages(): void
    {
        $user = User::factory()->create();

        $messageData = [
            'title' => 'Mi primer mensaje',
            'content' => 'Este es el contenido del mensaje',
            'url' => 'https://example.com'
        ];

        $response = $this->actingAs($user)->post('/message', $messageData);

        $response->assertRedirect('/');
        $messageData['user_id'] = $user->id;
        $this->assertDatabaseHas('messages', $messageData);

        $response = $this->get('/');
        $response
            ->assertStatus(200)
            ->assertSee($messageData['title']);
    }

    #[Test]
    public function only_url_is_optional_when_store_messages(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/message', []);

        $response
            ->assertRedirect()
            ->assertValid(['url'])
            ->assertInvalid(['title', 'content']);
    }

    #[Test]
    public function only_users_can_create_messages(): void
    {
        $response = $this->post('/message', []);
        $response->assertRedirect('/login');
    }
}
