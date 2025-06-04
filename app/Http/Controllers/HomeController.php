<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CategoryProduct;
use App\Models\ProductVersion;
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
        $product = ProductVersion::join('products', 'product_versions.product_id', 'products.id')->get();
        $category_product = CategoryProduct::get();
        return view('outside.index', [
            'banners' => Banner::query()->where('status', StatusEnum::ON)->get(),
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
        return view('outside.product_detail', [
            'product' => $product,
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
            return $this->errorResponse('error', 'messages.login_error');
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
        return view('outside.search-result', [
            'product' => $result,
            'keyword' => $keyword,
            'title' => 'Kết quả tìm kiếm'
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
        return view('outside.order', [
            'title' => 'Ktech Cart',
            'city' => $city
        ]);
    }
}
