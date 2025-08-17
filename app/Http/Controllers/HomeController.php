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
            },
            'stockImportDetails' => function ($query) {
                $query->where('status', StatusEnum::ON)->where('quantity', '>', '0');
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
            ->with([
                'productVersion.products',
                'productVersion.stockImportDetails' => function ($q) {
                    $q->where('status', 0)
                        ->where('stock_quantity', '>', 0);
                }
            ])
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
        $customer = Customer::with('cities', 'districts', 'wards')->where('id', $customer_id)->first();
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
                $query->whereBetween('final_price', [1, $price]);
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

    public function createPayment(Request $request)
    {
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TmnCode    = '23I03C8Z'; // Mã website của bạn tại VNPAY
        $vnp_HashSecret = 'RT5FDZR52IT47H2AZKK7FRV9FXZ2LKD3'; // Chuỗi bí mật
        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl  = route('home.vnpReturn'); // URL trả về sau khi thanh toán

        $vnp_TxnRef     = rand(1, 10000); // Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount     = '500000'; // Số tiền thanh toán (VNĐ)
        $vnp_Locale     = 'vn'; // Ngôn ngữ
        $vnp_BankCode   = ''; // Mã ngân hàng
        $vnp_IpAddr     = '192.168.1.7'; // IP khách hàng

        $inputData = array(
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount * 100, // nhân 100 theo chuẩn VNPAY
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType"  => "other",
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Bước 1: sắp xếp mảng dữ liệu
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        $vnpSecureHash = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);

        ksort($inputData);
        $hashData = urldecode(http_build_query($inputData));
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                return "Giao dịch thành công!";
            } else {
                return "Giao dịch thất bại!";
            }
        } else {
            return "Sai chữ ký!";
        }
    }
}
