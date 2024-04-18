<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register_success(): void
    {
        $this ->post('/api/users/register',[
            "name" => "ryugen",
            "username" => "ryugenxd",
            "password" => "12345678",
        ])->assertStatus(201)
        ->assertJson([
            "data"=>[
                "name" => "ryugen",
                "username" => "ryugenxd",
            ]
            ]);
        
    }

    public function test_register_failed(): void 
    {
        User::create([
            "name"=>"idham",
            "username"=>"idham01",
            "password"=>"12345678"
        ]);

        $this ->post('/api/users/register',[
            "name" => "idham",
            "username" => "idham01",
            "password" => "12345678",
        ])->assertStatus(401)
        ->assertJson([
            "errors"=>[
                "username"=>[
                   "username already to exists"
                ]
            ]
        ]);
    }

    public function test_login_success(): void
    {
        User::create([
            "name"=>"idham",
            "username"=>"idham01",
            "password"=> Hash::make("12345678")
        ]);
        $this ->post('/api/users/login',[
            "username" => "idham01",
            "password" => "12345678"
        ])->assertStatus(200)
        -> assertJson([
            "data"=>[
                "name" => "idham",
                "username" => "idham01",
            ]
        ]);
    }

    public function test_login_failed(): void

    {
        $this -> post('/api/users/login',[
            "username" => "idham01",
            "password" => "12345678"
        ])->assertStatus(401)
        ->assertJson([
            "errors"=>[
                "message"=>[
                    "username or password is wrong"
                ]
    ]]);
    }
}
