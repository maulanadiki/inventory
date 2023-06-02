<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //  unit test memanggil form login belu termasuk auth
    // php artisan test --filter test_after_login
    public function test_after_login()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;
    public function TestLogin()
    {
       // Kita memiliki 1 user terdaftar
       $user = factory(User::class)->create([
        'email'    => 'username@example.net',
        'password' => bcrypt('secret'),
    ]);

    // Kunjungi halaman '/login'
    $this->visit('/');

    // Submit form login dengan email dan password yang tepat
    $this->submitForm('Login', [
        'email'    => 'username@example.net',
        'password' => 'secret',
    ]);

    // Lihat halaman ter-redirect ke url '/home' (login sukses).
    $this->seePageIs('/home');

    // Kita melihat halaman tulisan "Dashboard" pada halaman itu.
    $this->seeText('Dashboard');
    }


}
