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
        $product = ProductVersion::whereHas('products', function ($query) {
            $query->where('status', StatusEnum::ON);
        })->with([
            'products' => function ($query) {
                $query->where('status', StatusEnum::ON);
            }
        ])->get();

        $category_product = CategoryProduct::get();
        return view('outside.index', [
            'banners' => Banner::query()->where('status', StatusEnum::ON)->orderBy('id', 'desc')->get(),
            'product' => $product,
            'category_product' => $category_product,
            'title' => 'K-tech'
        ]);
    }

    public function product_detail(ProductVersion $productVersion)
    {
        $product = ProductVersion::with(['products', 'phoneSpecs', 'productImages', 'laptopSpecs'])
            ->where('id', $productVersion->id)
            ->first();
        $title = $product->name;
        $productVersion = ProductVersion::where('product_id', $productVersion->product_id)->get();
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
            return $this->errorResponse('errors', 'messages.login_error');
        }
        return $this->successResponse('success', 'messages.login_success');
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
            return $this->errorResponse('error', 'messages.register_error');
        }
        return $this->successResponse('success', 'messages.register_success');
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
            ->with('productVersion')
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

    // Gộp CPU và thế hệ CPU thành một chuỗi tìm kiếm
    $searchQuery = collect($filters['cpu'] ?? [])
        ->filter()
        ->map(fn($item) => '+' . $item) // dùng toán tử '+' cho boolean mode
        ->implode(' '); // kết quả: "+core +i5 +11"

    // Các filter còn lại (liên quan đến laptopSpecs)
    $specFilters = [
        'gpu' => $filters['graphic_card'] ?? [],
        'display_size' => $filters['display_size'] ?? [],
        'ram_size' => $filters['ram_size'] ?? [],
        'storage_size' => $filters['ssd_size'] ?? [],
        'display_resolution' => $filters['display_resolution'] ?? [],
        // 'usage_need' => $filters['usage_need'] ?? [], // Bỏ comment nếu dùng
    ];

    // Bắt đầu truy vấn ProductVersion
    $result = ProductVersion::with(['products.brands', 'laptopSpecs'])
        // Lọc theo thương hiệu (brand)
        ->when($brand, function ($query) use ($brand) {
            $query->whereHas('products.brands', function ($q) use ($brand) {
                $q->whereIn('name', $brand);
            });
        })
        // Lọc theo laptopSpecs (CPU, GPU, RAM,...)
        ->whereHas('laptopSpecs', function ($q) use ($searchQuery, $specFilters) {
            // Tìm CPU theo fulltext nếu có chuỗi tìm kiếm
            if (!empty($searchQuery)) {
                $q->whereRaw("MATCH(cpu) AGAINST (? IN BOOLEAN MODE)", [$searchQuery]);
            }
            // Lọc các trường còn lại bằng LIKE
            foreach ($specFilters as $field => $values) {
                if (!empty($values)) {
                    $q->where(function ($query) use ($field, $values) {
                        foreach ($values as $value) {
                            $query->orWhere($field, 'LIKE', '%' . $value . '%');
                        }
                    });
                }
            }
        });

    dd($result);
    return response()->json([
        'data' => $result->get()
    ]);
}

}
