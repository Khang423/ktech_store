<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Banner;
use App\Models\Customer;
use App\Traits\ImageTrait;
use Faker\Provider\el_GR\Address as El_GRAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CustomerService extends Controller
{
    private Model $model;

    public function __construct(Customer $banner)
    {
        $this->model = $banner;
    }

    public function addAddress($request)
    {
        DB::beginTransaction();
        try {
            $customer_id = Auth::guard('customers')->user()->id;
            Address::Create([
                'city_id' => $request['city'],
                'district_id' => $request['district'],
                'ward_id' => $request['ward'],
                'note' => $request['address'],
                'customer_id' => $customer_id,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function deleteAddress($request)
    {
        DB::beginTransaction();
        try {
            $customer_id = Auth::guard('customers')->user()->id;
            Address::where('customer_id', $customer_id)->where('id', $request['address_id'])->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
