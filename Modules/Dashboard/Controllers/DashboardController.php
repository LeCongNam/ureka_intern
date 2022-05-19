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


    public function get_list_user(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            // mặc định là trang 1
            $page = 1;

            $group = $request->group_id;
            $page = $request->page;
            $total_item = 10;
            $start = ($page * $total_item) - $total_item;

            //   Chỉ cho Admin Access
            if ($group == 2) {
                // Phương thức từ  Repository
                $result = $this->dashboardRepo->get_limit_user($start, $total_item);
                return response()->json([
                    ...$result
                ]);
            } else {
                return response()->json([
                    'error' => 'Access Denined!!'
                ], 401);
            }
        } else {
            return response()->json([
                'error' => 'method not allow in url !!'
            ], 400);
        }
    }

    public function add_group_user(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $result = $this->groupUserRepo->create([
                ...$request->all()
            ]);

            return response()->json([
                'message' => 'Ok',
                $result
            ]);
        }
    }

    public function add_user(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $result = $this->dashboardRepo->create([
                ...$request->all()
            ]);

            return response()->json([
                'message' => 'Ok',
                $result
            ]);
        }
    }

    public function add_product(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $product_id = $request->product_id;
            $product_name = $request->product_name;
            $desc = $request->desc;
            $product_type = $request->type;
            $url = $request->url;

            // find id product
            $check = $this->productRepo->get_product_id($product_id);

            if (empty($check) == false) {
                //----Upload hình ảnh  lên server:
                $path_image = 'public/' . date('Y/m/');
                $image_name = $request->product_id . "_" . $request->product_type . ".jpg";
                Storage::putFileAs(
                    $path_image,
                    $request->file('icon'),
                    $image_name
                );
                $get_path = Storage::url($path_image . $image_name);
                //----End upload

                $result = $this->versionRepo->create([
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'desc' => $desc,
                    'product_type' => $product_type,
                    'url' => $url,
                    'icon' => $get_path,
                ]);
            } else {
                // Product_id not found
                $prod = $this->productRepo->create([
                    'product_id' => $product_id,
                    'product_name' => $product_name
                ]);
                if ($prod) {
                    //----Upload hình ảnh  lên server:
                    $path_image = 'public/' . date('Y/m/');
                    $image_name = $request->product_id . "_" . $request->product_type . ".jpg";
                    Storage::putFileAs(
                        $path_image,
                        $request->file('icon'),
                        $image_name
                    );
                    $get_path = Storage::url($path_image . $image_name);
                    //----End upload
                    $result = $this->versionRepo->create([
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'desc' => $desc,
                        'product_type' => $product_type,
                        'url' => $url,
                        'icon' => $get_path,
                    ]);
                }
            }

            return response()->json([
                'message' => 'Ok',
                $get_path
            ]);
        }
    }

    public function get_list_prod(Request $request)
    {

        if ($this->check_request($request, 'post')) {
            // mặc định là trang 1
            $page = 1;

            $group = $request->group_id;
            $page = $request->page;
            $total_item = 10;
            $start = ($page * $total_item) - $total_item;

            //   Chỉ cho Admin Access
            if ($group == 2) {
                // Phương thức từ  Repository
                $result = $this->versionRepo->get_limit_prod($start, $total_item);
                return response()->json([
                    ...$result
                ]);
            } else {
                return response()->json([
                    'error' => 'Access Denined!!'
                ], 401);
            }
        }
    }

    public function get_product(Request $request)
    {
        //   Chỉ cho Admin Access
        // Phương thức từ  Repository
        $result = $this->versionRepo->get_single_product($request->route('id'), $request->route('type'));
        return response()->json([
            ...$result
        ]);
    }

    public function edit_product(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $product_id = $request->product_id;
            $product_name = $request->product_name;
            $desc = $request->desc;
            $product_type = $request->product_type;
            $url = $request->url;

            //----Upload hình ảnh  lên server:
            $path_image = 'public/' . date('Y/m/');
            $image_name = $request->product_id . "_" . $request->product_type . ".jpg";
            Storage::putFileAs(
                $path_image,
                $request->file('icon'),
                $image_name
            );
            $get_path = Storage::url($path_image . $image_name);
            //----End upload

            // Phương thức từ  Repository
            $result = $this->versionRepo->update_versions($product_id, $product_type, [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'desc' => $desc,
                'product_type' => $product_type,
                'url' => $url,
                'icon' => $get_path,
            ]);
            if ($result) {
                return response()->json([
                    'message' => 'Ok',
                    $result
                ]);
            }
        }
    }


    public function delete_product(Request $request)
    {
        if ($this->check_request($request, 'post')) {
            $product_id = $request->product_id;
            $product_type = $request->product_type;

            // Phương thức từ  Repository
            $result = $this->versionRepo->update_versions($product_id, $product_type, [
                'is_delete' => 1,
                'deleted_at' => date("Y-m-d H:i:s")
            ]);
            if ($result) {
                return response()->json([
                    'message' => 'Ok',
                    $result
                ]);
            }
        }
    }
}
