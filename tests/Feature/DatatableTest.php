<?php

namespace Tests\Feature;

use App\Http\Livewire\UsersTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
 use Livewire\Livewire;
use Tests\TestCase;

class DatatableTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_livewire_users_table_component_render_correctly()
    {
        $this->get(route('welcome'))->assertSeeLivewire('users-table');
    }

    public function test_search_functionality_works_correclty()
    {
        $john = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@live.it',
            'active' => true,
        ]);

        $mary = User::factory()->create([
            'name' => 'Mary Doe',
            'email' => 'marydoe@live.it',
            'active' => true
        ]);

        Livewire::test(UsersTable::class)
            ->set('search', 'John Doe')
            ->assertSee($john->name)
            ->assertSee($john->email)
            ->assertDontSee($mary->name)
            ->assertDontSee($mary->email);
    }

    public function test_active_status_check_functionality_works_correclty()
    {
        $john = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@live.it',
            'active' => true
        ]);

        $mary = User::factory()->create([
            'name' => 'Mary Doe',
            'email' => 'marydoe@live.it',
            'active' => false
        ]);

        Livewire::test(UsersTable::class)
            ->set('active', true)
            ->assertSee($john->name)
            ->assertSee($john->email)
            ->assertDontSee($mary->name)
            ->assertDontSee($mary->email);
    }

    public function test_sort_asc_functionality_works_correclty()
    {
        $andre = User::factory()->create([
            'name' => 'andre',
            'email' => 'andre@live.it',
            'active' => true
        ]);

        $bobby = User::factory()->create([
            'name' => 'bobby',
            'email' => 'bobby@live.it',
            'active' => true
        ]);

        $cathy = User::factory()->create([
            'name' => 'cathy',
            'email' => 'cathy@live.it',
            'active' => true
        ]);

        Livewire::test(UsersTable::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder([
                $andre->name,
                $bobby->name,
                $cathy->name,
            ]);
    }

    public function test_sort_desc_functionality_works_correclty()
    {
        $andre = User::factory()->create([
            'name' => 'andre',
            'email' => 'andre@live.it',
            'active' => true
        ]);

        $bobby = User::factory()->create([
            'name' => 'bobby',
            'email' => 'bobby@live.it',
            'active' => true
        ]);

        $cathy = User::factory()->create([
            'name' => 'cathy',
            'email' => 'cathy@live.it',
            'active' => true
        ]);

        Livewire::test(UsersTable::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder([
                $andre->name,
                $bobby->name,
                $cathy->name,
            ])
            ->call('sortBy', 'name')
            ->assertSeeInOrder([
                $cathy->name,
                $bobby->name,
                $andre->name,
            ]);
    }
}
