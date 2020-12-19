<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;
use UserTypesTableSeeder;

class UsersFeatureTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function a_visitor_will_be_able_to_see_all_users()
    {
        //given
            // user types must exist
            $this -> seed(UserTypesTableSeeder::class);
            // a user must exist
            $user = factory(\App\User::class)->create();
        //when
            // when i visit route /users
            $response = $this->get('/users');
        //then
            // i expect to see the users' first name
            $response->assertSee($user->name);
    }

    /** @test */
    function a_visitor_will_be_able_to_create_a_new_user()
    {
        //given
            // user types must exist
            $this -> seed(UserTypesTableSeeder::class);
            // create a user
            $user = factory(\App\User::class)->make()->toArray();
        //when
            // post to route /users
            $response = $this->post('/users', $user);
        //then
            // i expect to be redirected to /users
            // i expect to see the user in the database
            $response->assertRedirect('/users');
            $this->assertDatabaseHas('users', $user);
    }

    
    /** @test */
    function a_user_will_be_able_to_update_his_or_her_own_account()
    {
        //given
            // user types must exist
            $this -> seed(UserTypesTableSeeder::class);
            // create a user
            $user = factory(\App\User::class)->make()->toArray();
            // login as user
            $this->loginUser($user);
            $user = [
                'first_name'=>'Kyle'
            ];
        //when
            // update to route /users/{{userID}}
            $response = $this->update('/users/'.$user->id, $user);
        //then
            // i expect to be redirected to /users
            // i expect to see the user in the database
            $response->assertRedirect('/users/'.$user->id);
            $this->assertDatabaseHas('users', $user);
    }

    /** @test */
    function a_user_will_be_able_to_delete_his_or_her_own_account()
    {
        //given
            // user types must exist
            $this -> seed(UserTypesTableSeeder::class);
            // create a user
            $user = factory(\App\User::class)->make()->toArray();
            // login as user
            $this->loginUser($user);
        //when
            // update to route /users/{{userID}}
            $response = $this->destroy('/users/'.$user->id, $user);
        //then
            // i expect to be redirected to /users
            // i expect to see the user in the database
            $response->assertRedirect('/users/'.$user->id);
            $this->assertDatabaseMissing('users', $user);
    }

    function loginUser($user){
        $this->actingAs($user);
    }
}
