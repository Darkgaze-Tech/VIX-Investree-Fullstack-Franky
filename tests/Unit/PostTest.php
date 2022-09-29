<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */



    // Website view testing
    public function test_post_index_view_can_be_rendered()
    {
        $view = $this->get('/posts');

        $view->assertSee('Article Posts');
        $view->assertSee('Create New Post');
    }

    public function test_post_create_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/posts/create');

        $view->assertSee('Add New Article Post');
        $view->assertSee('Category');
        $view->assertSee('Title');
        $view->assertSee('Content');
        $view->assertSee('Input Image File');
        $view->assertSee('Back');
    }

    public function test_post_detail_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/posts/'.$id);

        $view->assertSee('Detail Article Post');
        $view->assertSee('Back');
    }

    public function test_post_edit_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/posts/'.$id.'/edit');

        $view->assertSee('Edit Post');
        $view->assertSee('Category');
        $view->assertSee('Title');
        $view->assertSee('Content');
        $view->assertSee('Input Image File');
        $view->assertSee('Back');
    }


    // API testing
    public function test_user_can_create_posts()
    {
        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/posts';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];
        $data = [
            'title' => 'TESTING CONTENT',
            'content' => 'Test content',
            'category_id' => 2
        ];

        $response = $this->withHeaders($headers)->post($api, $data);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
        
    }

    public function test_user_can_get_all_posts()
    {
        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/posts';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->get($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_get_detail_post()
    {
        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;

        $id = 5;
        $api = '/api/v1/posts/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->get($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_update_posts()
    {
        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $id = 7;
        $api = '/api/v1/posts/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];
        $data = [
            'title' => 'TESTING CONTENT UPDATE',
            'content' => 'Test content UPDATE',
            'category_id' => 4
        ];

        $response = $this->withHeaders($headers)->put($api, $data);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_delete_posts()
    {
        $email = User::where('id','=','2')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;

        $id = 10;
        $api = '/api/v1/posts/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->delete($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(['message' => 'Post has been deleted']);
    }
}
