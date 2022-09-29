<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // use RefreshDatabase;
    
 
    // Website view testing
    public function test_a_welcome_view_can_be_rendered()
    {
        $view = $this->get('/');
 
        $view->assertSee('Blog');
        $view->assertSee('My Profile');
        $view->assertSee('Full Name');
        $view->assertSee('Interests');
        $view->assertSee('LinkedIn');
        $view->assertSee('Github Projects');
    }
    public function test_registration_view_can_be_rendered()
    {
        $view = $this->get('/register');

        $view->assertSee('Register');
        $view->assertSee('Name');
        $view->assertSee('Email Address');
        $view->assertSee('Password');
        $view->assertSee('Confirm Password');
    }

    public function test_login_view_can_be_rendered()
    {
        $view = $this->get('/login');

        $view->assertSee('Login');
        $view->assertSee('Email Address');
        $view->assertSee('Password');
    }

    public function test_home_dashboard_view_can_be_rendered()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ];

        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/logout';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->post($api, $loginData);

        $view = $this->get('/home');

        $view->assertSee('Dashboard');
        $view->assertSee('You are logged in!');
    }
 
    public function test_new_users_can_register()
    {

        $api = '/api/v1/register';
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ];
        $response = $this->postJson($api, $data);
        $response->assertStatus(200);
    }


    // API testing
    public function test_user_can_login()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ];
        User::factory()->create($data);
        $api = '/api/v1/login';
        $loginData = ['email' => 'test@example.com', 'password' => 'password'];

        $response = $this->postJson($api, $loginData);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['user','token']));
    }

    public function test_user_can_logout()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ];

        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/logout';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->post($api, $loginData);
        $response->assertJson(['message' => 'Logged out']);
    }

}
