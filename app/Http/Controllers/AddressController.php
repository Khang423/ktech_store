<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\DistrictService;
use App\Services\WardService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    protected $districtService;
    protected $wardService;
    use ApiResponse;

    public function __construct(
        DistrictService $districtService,
        WardService $wardService
    ) {
        $this->districtService = $districtService;
        $this->wardService = $wardService;
    }

    public function getDistricts(Request $request)
    {
        $result = $this->districtService->getDistrictsByCityApi($request);
        return response()->json($result, 200);
    }

    public function getWards(Request $request)
    {
        $result = $this->wardService->getWardsByDistrictApi($request);
        return response()->json($result, 200);
    }
}
