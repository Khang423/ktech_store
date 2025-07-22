<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CityService;
use App\Services\CustomerService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Colors\Rgb\Channels\Red;

class CustomerController extends Controller
{
    protected $customerService;
    protected $cityService;
    use ApiResponse;

    public function __construct(CityService $cityService, CustomerService $customerService)
    {
        $this->cityService = $cityService;
        $this->customerService = $customerService;
    }
    // view profle
    public function profile()
    {
        $customer_id = Auth::guard('customers')->user()->id;
        $city = $this->cityService->get_all();
        $customer = Customer::where('id', $customer_id)->first(['id','tel','email','birthday','name']);
        $order = Order::where('customer_id',$customer_id)->count();
        $total_price = Order::where('customer_id',$customer_id)->sum('total_price');
        return view('outside.profile', [
            'title' => 'Ktech - Profile',
            'city' => $city,
            'customer' => $customer,
            'order' => $order,
            'total_price' => $total_price,
        ]);
    }
    public function addAddress(Request $request)
    {
        $validated =  $request->validate([
            'city' => ['required', 'numeric'],
            'district' => ['required', 'numeric'],
            'ward' => ['required', 'numeric'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'city.required' => 'Vui lòng chọn Tỉnh/Thành phố.',
            'district.required' => 'Vui lòng chọn Quận/Huyện.',
            'ward.required' => 'Vui lòng chọn Phường/Xã.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ]);
        $result = $this->customerService->addAddress($validated);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function deleteAddress(Request $request)
    {
        $validated =  $request->validate([
            'address_id' => ['required', 'numeric'],
        ]);
        $result = $this->customerService->deleteAddress($validated);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
