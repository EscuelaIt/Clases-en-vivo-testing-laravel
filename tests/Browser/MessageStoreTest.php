<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MessageStoreTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[Test]
    public function visitMessageIsOnlyForAuthenticatedUsers(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/message')
                    ->assertPathIs('/login');
        });
    }

    #[Test]
    public function sendMessagesTest(): void
    {
        $user = User::factory()->create([
            'email' => 'miguel@escuela.it',
            'name' => 'Miguel A.',
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit('/message')
                ->assertPathIs('/message')
                ->type('title', 'Nuevo Curso de Azure')
                ->type('content', 'Tenemos un nuevo curso en EscuelaIT')
                ->type('url', 'https://escuela.it/cursos/curso-desarrollo-despliegue-azure')
                ->resize('420', '860')
                ->screenshot('test')
                ->press('Crear mensaje')
                ->assertPathIs('/');
            });

        $this->assertDatabaseHas('messages', [
            'title' => 'Nuevo Curso de Azure',
            'content' => 'Tenemos un nuevo curso en EscuelaIT',
        ]);
    }
}
