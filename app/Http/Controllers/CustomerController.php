<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Models\Address;
use App\Models\address\District;
use App\Models\address\Ward;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CityService;
use App\Services\CustomerService;
use App\Services\DistrictService;
use App\Services\WardService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    protected $customerService;
    protected $cityService;
    use ApiResponse;

    public function __construct(
        CityService $cityService,
        CustomerService $customerService
    ) {
        $this->cityService = $cityService;
        $this->customerService = $customerService;
    }

    public function index()
    {
        return view('admin.customer.index');
    }

    public function getList()
    {
        return DataTables::of(
            Customer::with(['cities', 'districts', 'wards'])->orderBy('created_at', 'desc')
                ->get()
        )
            ->editColumn('index', function ($object) {
                static $i = 0;
                return ++$i;
            })
            ->editColumn('address', function ($object) {
                return ($object->note ?? '') . ' - ' .
                    ($object->wards->name ?? '') . ' - ' .
                    ($object->districts->name ?? '') . ' - ' .
                    ($object->cities->name ?? '');
            })
            ->addColumn('actions', function ($object) {
                return [
                    'id' => $object->id,
                    'destroy' => ' ',
                    'edit' => '',
                ];
            })
            ->make(true);
    }
    public function profile()
    {
        $customer_id = Auth::guard('customers')->user()->id;
        $customer = Customer::with(['cities', 'districts', 'wards'])->where('id', $customer_id)->first();
        $order = Order::with('orderItem.productVersions.products')->where('customer_id', $customer_id)->get();
        $orde_count = Order::where('customer_id', $customer_id)->where('status', 4)->count();
        $total_price = Order::where('customer_id', $customer_id)->where('status', OrderStatusEnum::DELIVERED)->sum('total_price');
        $city = $this->cityService->get_all();
        return view('outside.profile', [
            'title' => 'Ktech - Profile',
            'city' => $city,
            'customer' => $customer,
            'order' => $order,
            'order_count' => $orde_count,
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

    public function getDataOrder(Request $request)
    {
        $statusMap = [
            'all' => 'all',
            'pending'   => OrderStatusEnum::PENDING,
            'processing' => OrderStatusEnum::PROCCESSING,
            'shiped'   => OrderStatusEnum::SHIPED,
            'delivered' => OrderStatusEnum::DELIVERED,
            'cancel'    => OrderStatusEnum::CANCEL,
        ];

        $statusKey = $request->status;
        $status = $statusMap[$statusKey] ?? 0;

        $customerId = Auth::guard('customers')->id();

        if ($status === 'all') {
            $result = Order::with('orderItem.productVersions.products')
                ->where('customer_id', $customerId)
                ->get();
        } else {
            $result = Order::with('orderItem.productVersions.products')
                ->where('status', $status)
                ->where('customer_id', $customerId)
                ->get();
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function getDataOrderItem(Request $request)
    {
        $statusMap = [
            'all' => 'all',
            'pending'   => OrderStatusEnum::PENDING,
            'processing' => OrderStatusEnum::PROCCESSING,
            'shiped'   => OrderStatusEnum::SHIPED,
            'delivered' => OrderStatusEnum::DELIVERED,
            'cancel'    => OrderStatusEnum::CANCEL,
        ];

        $statusKey = $request->status;
        $status = $statusMap[$statusKey] ?? 0;

        $customerId = Auth::guard('customers')->id();

        if ($status === 'all') {
            $result = Order::with('orderItem.productVersions.products')
                ->where('customer_id', $customerId)
                ->get();
        } else {
            $result = Order::with('orderItem.productVersions.products')
                ->where('status', $status)
                ->where('customer_id', $customerId)
                ->get();
        }

        return response()->json([
            'data' => $result
        ]);
    }

    public function infoUpdate(Request $request)
    {
        $customer_id = Auth::guard('customers')->user()->id;
        Customer::where('id', $customer_id)->update([
            'name' => $request->name,
            // 'gender' => $request->gender,
            'birthday' => $request->birthday,
            'tel' => $request->tel,
            'email' => $request->email,
        ]);
        return $this->successResponse('success');
    }

    public function addressUpdate(Request $request)
    {
        $customer_id = Auth::guard('customers')->user()->id;
        Customer::where('id', $customer_id)->update([
            'city_id' => $request->city,
            'district_id' => $request->district,
            'ward_id' => $request->ward,
            'note' => $request->note
        ]);
        return $this->successResponse('success');
    }
}
