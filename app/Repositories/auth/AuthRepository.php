<?php

namespace App\Repositories\auth;

use App\Models\Customer;
use App\Models\Member;
use App\Traits\Toast;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends Repository implements AuthInterface
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
        $dataCustomer = $request->only(['name', 'tel', 'email', 'birthday']);
        $dataCustomer['password'] = Hash::make($request->password);
        Customer::create($dataCustomer);
        return true;
    }

    public function logout() {}
}
