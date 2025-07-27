<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVersion;
use App\Models\Tag;
use App\Services\AuthService;
use App\Services\CityService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $authService;
    protected $cityService;
    use ApiResponse;

    public function __construct(
        AuthService $authService,
        CityService $cityService,
    ) {
        $this->authService = $authService;
        $this->cityService = $cityService;
    }


    public function index()
    {
        $product_version = ProductVersion::whereHas('products', function ($query) {
            $query->where('status', StatusEnum::ON);
        })->with([
            'products' => function ($query) {
                $query->where('status', StatusEnum::ON);
            }
        ])->get();
        $category_product = CategoryProduct::get();
        return view('outside.index', [
            'banners' => Banner::query()->where('status', StatusEnum::ON)->orderBy('id', 'desc')->get(),
            'product_version' => $product_version,
            'category_product' => $category_product,
            'title' => 'K-tech'
        ]);
    }

    public function product_detail(ProductVersion $productVersion)
    {
        $product = Product::with(['productImages', 'productVersions.phoneSpecs', 'productVersions.laptopSpecs'])
            ->whereHas('productVersions', function ($query) use ($productVersion) {
                $query->where('id', $productVersion->id);
            })
            ->first();
        $title = $product->name;
        return view('outside.product_detail', [
            'product' => $product,
            'productVersion' => $productVersion,
            'title' => $title
        ]);
    }

    public function login()
    {
        return view('outside.login', [
            'title' => 'Đăng nhập'
        ]);
    }

    public function loginProcess(LoginRequest $request)
    {
        $success = $this->authService->customerLogin($request);
        if (!$success) {
            return $this->errorResponse('messages.login_error');
        }
        return $this->successResponse('messages.login_success');
    }

    public function register()
    {
        return view('outside.register', [
            'title' => 'Đăng ký'
        ]);
    }

    public function registerProcess(RegisterRequest $request)
    {
        $success = $this->authService->customerRegister($request);
        if (!$success) {
            return $this->errorResponse('messages.register_error');
        }
        return $this->successResponse('messages.register_success');
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect()->route('home.index');
    }

    public function searchProcess(Request $request)
    {
        return response()->json([
            'redirect' => route('home.searchResult', ['q' => $request->keyword])
        ]);
    }

    public function searchResult(Request $request)
    {
        $keyword = $request->query('q');
        $result = ProductVersion::where('name', 'like', '%' . $keyword . '%')->get();
        $brand = Brand::get(['id', 'name']);
        $tag = Tag::with('tagDetails')->get();
        return view('outside.search-result', [
            'product' => $result,
            'keyword' => $keyword,
            'brand' => $brand,
            'title' => 'Kết quả tìm kiếm',
            'tag' => $tag
        ]);
    }

    public function cart()
    {
        $customer_id = Auth::guard('customers')->user()->id;
        $cart = Cart::where('customer_id', $customer_id)->first('id');
        $cart_item = CartItem::where('cart_id', $cart->id)
            ->with('productVersion.products')
            ->get();
        return view('outside.cart', [
            'title' => 'Giỏ hàng của tôi',
            'cart_item' => $cart_item
        ]);
    }

    public function order()
    {
        $city = $this->cityService->get_all();
        $customer_id = Auth::guard('customers')->user()->id;
        $customer = Customer::where('id', $customer_id)->first(Customer::getInfo());
        return view('outside.order', [
            'title' => 'Ktech Order',
            'city' => $city,
            'customer' => $customer
        ]);
    }

    public function productFillter(Request $request)
    {
        $filters = $request->input('data', []);
        // Lấy các filter riêng
        $brand = $filters['brand'] ?? [];
        $usage_type = $filters['usage_need'] ?? [];
        $price = $request->price ?? '';
        // Các filter còn lại (liên quan đến laptopSpecs)
        $laptopSpecFilters = [
            'gpu' => $filters['graphic_card'] ?? [],
            'cpu' => $filters['cpu'] ?? [],
            'display_size' => $filters['display_size'] ?? [],
            'ram_size' => $filters['ram_size'] ?? [],
            'storage_size' => $filters['ssd_size'] ?? [],
            'display_resolution' => $filters['display_resolution'] ?? [],
        ];

        $result = ProductVersion::with(['products.brands', 'laptopSpecs'])

            ->when($brand, function ($query) use ($brand) {
                $query->whereHas('products.brands', function ($q) use ($brand) {
                    $q->whereIn('name', $brand);
                });
            })
            ->when($price, function ($query) use ($price) {
                // Nếu $price là dạng mảng [min, max]
                $query->whereBetween('final_price', [0, $price]);
            })
            ->when($usage_type, function ($query) use ($usage_type) {
                $query->whereHas('products.usageTypes', function ($q) use ($usage_type) {
                    $q->whereIn('name', $usage_type);
                });
            })

            ->whereHas('laptopSpecs', function ($q) use ($laptopSpecFilters) {
                foreach ($laptopSpecFilters as $field => $values) {
                    if (!empty($values)) {
                        $q->where(function ($query) use ($field, $values) {
                            foreach ($values as $value) {
                                $query->orWhere($field, 'LIKE', '%' . $value . '%');
                            }
                        });
                    }
                }
            });


        return response()->json([
            'data' => $result->get()
        ]);
    }

    public function ShowProduct(Request $request)
    {

        $brand = Brand::get(['id', 'name']);
        $tag = Tag::with('tagDetails')->get();
        $category = CategoryProduct::where('slug', $request->data)->first();
        $product = ProductVersion::with(['products'])
            ->whereHas('products', function ($query) use ($category) {
                $query->where('category_product_id', $category->id);
            })
            ->get();
        return view('outside.show_product', [
            'brand' => $brand,
            'title' => 'Kết quả tìm kiếm',
            'tag' => $tag,
            'product' => $product,
            'category' => $category
        ]);
    }

    public function thanks()
    {
        $order = session()->pull('order_info');

        return view('outside.thanks', compact('order'));
    }
}
