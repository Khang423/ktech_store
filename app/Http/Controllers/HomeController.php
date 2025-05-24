<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Banner;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVersion;
use App\Repositories\auth\AuthInterface;
use App\Repositories\auth\AuthRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class HomeController extends Controller
{
    protected $authInterface;
    protected $authRepository;
    use ApiResponse;

    public function __construct(
        AuthInterface $authInterface,
        AuthRepository $authRepository
    ) {
        $this->authInterface = $authInterface;
    }


    public function index()
    {
        $product = ProductVersion::join('products', 'product_versions.product_id', 'products.id')->get();
        $category_product = CategoryProduct::get();
        return view('outside.index', [
            'banners' => Banner::query()->where('status', StatusEnum::ON)->get(),
            'product' => $product,
            'category_product' => $category_product,
        ]);
    }

    public function product_detail(ProductVersion $productVersion)
    {
        $product = ProductVersion::with(['products', 'phoneSpecs', 'productImages', 'laptopSpecs'])
            ->where('id', $productVersion->id)
            ->first();
        return view('outside.product_detail', [
            'product' => $product,
        ]);
    }

    public function login()
    {
        return view('outside.login');
    }

    public function loginProcess(LoginRequest $request)
    {
        $success = $this->authInterface->customerLogin($request);
        if (!$success) {
            return $this->errorResponse('error', 'messages.login_error');
        }
        return $this->successResponse('success', 'messages.login_success');
    }

    public function register()
    {
        return view('outside.register');
    }

    public function registerProcess(RegisterRequest $request){
        dd($request);
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
            'keyword' => $keyword
        ]);
    }
}
