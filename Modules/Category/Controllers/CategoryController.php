<?php

namespace Modules\Category\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;

class CategoryController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # parent::__construct();
    }
    public function index(Request $request)
    {
        return view('Category::index');
    }

    public function details(Request $request)
    {
        // ->header('Access-Control-Allow-Origin', 'http://local-demo.com/')
        // ->header('Access-Control-Allow-Methods', '*')
        // ->header('Access-Control-Allow-Credentials', 'true')
        // ->header('Access-Control-Allow-Headers', 'X-CSRF-Token');
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function home(Request $request)
    {
        $var = 'This is Home Page';
        return $var;
    }

    public function login(Request $request, Response $response)
    {

        $user_inp= $request->post();


        if( empty($user_inp['name']) == false && empty($user_inp['password'])  == false ){
            session(['user' => $user_inp['name']]);
           return response()->json([
                "status"=>"200",
                "message"=>"Login Success"
        ])->status(200);
        }else{
           return response()->json([
                "status"=>"400",
                "message"=>"User_name and password invalid"
        ])->status(400);
        }


    }

    public function register(Request $request, Response $response)
    {

        $user_inp = $request->post();

        return response()->json([$user_inp]);
        // if( empty($user_inp['name']) == false && empty($user_inp['password'])  == false ){
        //     session(['user' => $user_inp['name']]);
        //    return response()->json([
        //         "status"=>"200",
        //         "message"=>"Login Success"
        // ])->status(200);
        // }else{
        //    return response()->json([
        //         "status"=>"400",
        //         "message"=>"User_name and password invalid"
        // ])->status(400);
        // }


    }
}
