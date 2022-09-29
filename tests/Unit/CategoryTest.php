<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // Website view testing
    public function test_category_index_view_can_be_rendered()
    {
        $view = $this->get('/categories');

        $view->assertSee('Categories');
        $view->assertSee('Create New Category');
    }

    public function test_category_create_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/categories/create');

        $view->assertSee('Add New Article Category');
        $view->assertSee('Category name');
        $view->assertSee('Back');
    }

    public function test_category_detail_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/categories/'.$id);

        $view->assertSee('Detail Article Category');
        $view->assertSee('Back');
    }

    public function test_category_edit_view_can_be_rendered()
    {
        $id = 1;
        $view = $this->get('/posts/'.$id.'/edit');

        $view->assertSee('Edit Category');
        $view->assertSee('Category name');
        $view->assertSee('Back');
    }

    // API testing
    public function test_user_can_create_categories()
    {
        $email = User::where('id','=','1')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/categories';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];
        $data = [
            'name' => 'HITS',
        ];

        $response = $this->withHeaders($headers)->post($api, $data);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_get_all_categories()
    {
        $email = User::where('id','=','1')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $api = '/api/v1/categories';
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->get($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_get_detail_category()
    {
        $email = User::where('id','=','1')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;

        $id = 1;
        $api = '/api/v1/categories/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->get($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_update_categories()
    {
        $email = User::where('id','=','1')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;
        $id = 1;
        $api = '/api/v1/categories/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];
        $data = [
            'name' => 'Hot Update'
        ];

        $response = $this->withHeaders($headers)->put($api, $data);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['success','data']));
    }

    public function test_user_can_delete_categories()
    {
        $email = User::where('id','=','1')->get()[0]->email;
        $password = "password";

        $api = '/api/v1/login';
        $loginData = ['email' => $email, 'password' => $password];

        $r = $this->postJson($api, $loginData);

        $token = $r["token"];

        $auth_token = 'Bearer '.$token;

        $id = 1;
        $api = '/api/v1/categories/'.$id;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => $auth_token
        ];

        $response = $this->withHeaders($headers)->delete($api);
        $this->assertAuthenticated();
        $response->assertJson(['success' => true]);
        $response->assertJson(['message' => 'Category has been deleted']);
    }
}
