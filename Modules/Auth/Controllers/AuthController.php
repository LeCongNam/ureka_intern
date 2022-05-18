<?php

namespace Modules\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth_Repo\AuthRepositoryInterface;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function handle()
    {
        return view('Auth::index');
    }

    public function logout(Request $request)
    {
        if ($request->isMethod('get')) {
            $request->session()->flush('group_id');
            return redirect('/auth/login');
        } else {
            return response()->json([
                'error' => 'method not allow in url !!'
            ], 400);
        }
    }



    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $user_name = trim($request->user_name);
            $password = trim($request->password);
            $email = trim($request->email);



            $validated = Validator::make($request->all(), [
                'user_name' => 'required|unique:members|min:5',
                'email' => 'required|unique:members',
                'password' => 'required|min:6',
            ]);

            // Check Validate xem đã hợp lệ chưa. Chưa thì thông báo lỗi
            if ($validated->fails()) {
                return response()->json([
                    'error' => $validated->errors()->first()
                ], 400);
            } else {
                // Pass Validate->Tiến hành check User đã tồn tại chưa
                // Chưa tồn  tại: Cho đăng kí

                if (Auth::attempt(['user_name' => $user_name, 'email' => $email, 'password' => $password]) == false) {
                    $new_password = bcrypt($password);
                    $group = null;

                    if ($user_name == 'admin') {
                        $group = 2;
                    }
                    // Phương thức từ  Repository
                    $result =  $this->authRepo->create([
                        'user_name' => $user_name,
                        'password' => $new_password,
                        'email' => $email,
                        'group_id' => $group
                    ]);
                    return response()->json([
                        'message' => 'Register ok'
                    ]);
                } else {
                    //  tồn  tại: Trả về lỗi
                    return response()->json([
                        'error' => 'User Already Exists!!'
                    ], 401);
                }
            }
        } else {
            return response()->json([
                'error' => 'method not allow in url !!'
            ], 400);
        }
    }

    public function login(Request $request)
    {

        if ($request->isMethod('post')) {

            $user_name = trim($request->user_name);
            $password = trim($request->password);

            // Kiểm tra đúng
            if (Auth::attempt(['user_name' => $user_name, 'password' => $password])) {
                $group = 1;

                if ($user_name == 'admin') {
                    $group = 2;
                    $request->session()->push('group_id', 2);
                } else {
                    $group = 1;
                    session('group_id', 1);
                }

                return response()->json([
                    'mess' => 'ok',
                    'group_id' => $group
                ]);
            } else {
                return response()->json([
                    'error' => 'user_name or password Invalid!'
                ], 401);
            }
        } else {
            return response()->json([
                'error' => 'method not allow in url !!'
            ], 400);
        }
    }
}
