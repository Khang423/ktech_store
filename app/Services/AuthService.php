<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Member;
use App\Traits\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService extends Controller
{
    private $Member;
    use Toast;
    public function __construct()
    {
        $this->Member = Auth::guard('members')->user();
    }

    public function login($request)
    {
        $username = $request->email_or_phone;
        $password = $request->password;
        $member = Member::where('email', $username)->orWhere('phone', $username)->first();
        if ($member) {
            if (Hash::check($password, $member->password)) {
                Auth::guard('members')->login($member);
                return true;
            }
            return false;
        }
        return false;
    }

    public function customerLogin($request)
    {
        $username = $request->email_or_phone;
        $password = $request->password;
        $customer = Customer::where('email', $username)->orWhere('tel', $username)->first();
        if ($customer) {
            if (Hash::check($password, $customer->password)) {
                Auth::guard('customers')->login($customer);
                return true;
            }
            return false;
        }
        return false;
    }

    public function customerRegister($request)
    {

        DB::beginTransaction();
        try {
            $dataCustomer = $request->only(['name', 'tel', 'email', 'birthday']);
            $dataCustomer['password'] = Hash::make($request->password);
            Customer::create($dataCustomer);
            $customer_id = Customer::max('id');
            Cart::create(['customer_id' => $customer_id]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }

    public function logout() {}
}
