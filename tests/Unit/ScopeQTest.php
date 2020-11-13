<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;


class ScopeQTest extends TestCase
{
    use RefreshDatabase;

    public function testSimple()
    {
        $user = User::factory()->create([
            'name' => 'ivan',
            'surname' => 'petr',
        ]);
        $dbUser = User::q('ivan')->first();
        $this->assertTrue($dbUser->id == $user->id);
    }
}
