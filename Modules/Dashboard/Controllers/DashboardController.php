<?php

namespace Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Cache\Store;
use App\Repositories\Dashboard\DashboardRepositoryInterface;
use App\Repositories\Group_Member_Repo\GroupMemberRepositoryInterface;
use App\Repositories\Product_Repo\ProductRepositoryInterface;
use App\Repositories\Version_Repo\VersionRepositoryInterface;

class DashboardController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $dashboardRepo;
    protected $groupUserRepo;
    protected $productRepo;
    protected $versionRepo;

    /**
     * @return bool
     * @inp: - $request
     *        - $method: string
     */
    public function check_request($req, $method)
    {
        if ($req->isMethod($method) == true) {
            return true;
        }
        response()->json([
            'error' => 'method not allow is url'
        ]);

        return false;
    }

    public function __construct(
        DashboardRepositoryInterface   $dashboardRepo,
        GroupMemberRepositoryInterface $groupUserRepo,
        ProductRepositoryInterface     $productRepo,
        VersionRepositoryInterface     $versionRepo
    ) {
        $this->dashboardRepo = $dashboardRepo;
        $this->groupUserRepo = $groupUserRepo;
        $this->productRepo = $productRepo;
        $this->versionRepo = $versionRepo;
    }

    public function handle()
    {
        return view('Dashboard::index');
    }

    public function logout(Request $request)
    {
        $request->session()->flush('group_id');
        return response()->json([
            'message' => 'Ok'
        ]);
    }

    public function add_group_user(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            if ($request->cookie('group_user') == 1) {
                $result = $this->groupUserRepo->create([
                    ...$request->all()
                ]);

                return response()->json([
                    'message' => 'Ok',
                    $result
                ]);
            }
        }
    }

    public function add_user(Request $request)
    {

        if ($this->check_request($request, 'post')) {
            $user_name = $request->user_name;
            $password = $request->password;
            $email = $request->email;
            $group = (int)$request->group_id;


            $new_password = bcrypt($password);

            $result = $this->dashboardRepo->add_user_by_admin($user_name, [
                'user_name' => $user_name,
                'password' => $new_password,
                'email' => $email,
                'group_id' => $group
            ]);

            return response()->json([
                'message' => 'Ok',
                $result
            ]);
        }
    }

    public function get_list_user(Request $request)
    {
        if ($this->check_request($request, 'get')) {
            $page = $request->page;
            $total_item = $request->total;

            $result = $this->dashboardRepo->get_limit_user($total_item, $page);
            if (empty($result) == false) {
                return response()->json(
                    $result
                );
            } else {
                return response()->json([
                    'message' => 'Data emty!!'
                ], 400);
            }
        }
    }

    public function get_single_user(Request $request)
    {
        if ($this->check_request($request, 'get')) {
            $id = $request->route('id');
            $result = $this->dashboardRepo->get_single_user($id);
            return response()->json($result);
        }
    }

    public function edit_user(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $id = $request->id;
            $user_name = $request->user_name;
            $password = $request->password;
            $email = $request->email;
            $group = (int)$request->group_id;
            $new_password = null;

            $new_password = bcrypt($password);

            $result = $this->dashboardRepo->update($id, [
                'user_name' => $user_name,
                'password' => $new_password,
                'email' => $email,
                'group_id' => $group
            ]);

            return response()->json($result);
        }
    }

    public function delete_user(Request $request)
    {
        if ($this->check_request($request, 'delete')) {
            $id = $request->route('id');

            $result = $this->dashboardRepo->delete_user($id);

            return response()->json($result);
        }
    }

    public function get_product(Request $request)
    {
        //   Chỉ cho Admin Access
        // Phương thức từ  Repository
        $result = $this->versionRepo->get_single_product($request->route('id'), $request->route('type'));
        return response()->json(
            $result
        );
    }

    public function add_product(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $product_id = $request->product_id;
            $product_name = $request->product_name;
            $desc = $request->desc;
            $product_type = $request->type;
            $url = $request->url;
            $image = $request->file('icon');

            // find id product
            $check = $this->productRepo->get_product_id($product_id);

            if (empty($check) == false) {
                if (empty($image)) {
                    $image_name = $request->product_id . "_" . $request->product_type . ".jpg";
                    //----Upload hình ảnh  lên server:
                    $path_image = 'public/' . date('Y/m/');
                    Storage::putFileAs(
                        $path_image,
                        $image,
                        $image_name
                    );
                    $get_path = Storage::url($path_image . $image_name);
                    //----End upload
                }


                $result = $this->versionRepo->create([
                    'product_id' => $product_id,
                    'desc' => $desc,
                    'type' => $product_type,
                    'url' => $url,
                    'icon' => $get_path,
                ]);
            }
            return response()->json([
                'message' => 'Ok',
                $get_path
            ]);
        }
    }

    public function get_list_prod(Request $request)
    {
        if ($this->check_request($request, 'get')) {
            $page = 1;

            $group = $request->route('id');
            $page = $request->page;
            $total_item = 10;
            $start = ($page * $total_item) - $total_item;

            // Phương thức từ  Repository
            $result = $this->versionRepo->get_limit_prod($start, $total_item);
            return response()->json([
                ...$result
            ]);
        }
    }


    public function edit_product(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $product_id = $request->product_id;
            $product_name = $request->product_name;
            $desc = $request->desc;
            $product_type = $request->type;
            $url = $request->url;
            $id = $request->id;
            $image = $request->file('icon');

            if (isset($image)) {
                //----Upload hình ảnh  lên server:
                $path_image = 'public/' . date('Y/m/');
                $image_name = $request->product_id . "_" . $request->product_type . ".jpg";
                Storage::putFileAs(
                    $path_image,
                    $request->file('icon'),
                    $image_name
                );
                //----End upload
                $get_path = Storage::url($path_image . $image_name);
            }
            if (isset($get_path)) {
                // Phương thức từ  Repository
                $result = $this->versionRepo->update_versions($id,  [
                    'desc' => $desc,
                    'type' => $product_type,
                    'url' => $url,
                    'icon' => $get_path,
                ]);
            } else {
                $result = $this->versionRepo->update($id,  [
                    'desc' => $desc,
                    'type' => $product_type,
                    'url' => $url,
                ]);
            }


            if ($result) {
                return response()->json([
                    'message' => 'Ok',
                    $result
                ]);
            } else {
                return response()->json([
                    'error' => 'update error!!',
                    'message' => $result
                ], 400);
            }
        }
    }

    public function delete_product(Request $request)
    {
        if ($this->check_request($request, 'delete')) {
            $id = $request->route('id');

            // Phương thức từ  Repository
            $result = $this->versionRepo->delete_versions($id);
            if ($result) {
                return response()->json([
                    'message' => 'Ok',
                    $result
                ]);
            }
        }
    }
}
