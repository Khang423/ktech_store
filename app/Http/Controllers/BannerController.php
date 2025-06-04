<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Repositories\banner\BannerInterface;
use App\Repositories\banner\BannerRepository;
use App\Services\BannerSerivce;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BannerController extends Controller

{
    protected $bannerService;
    use ApiResponse;
    public function __construct(
        BannerSerivce $bannerService,
    ) {
        $this->bannerService  = $bannerService;
    }
    public function index()
    {
        return view('admin.banner.index');
    }

    public function getList() {
        return $this->bannerService->getList();
    }

    public function create() {
        return view('admin.banner.create');
    }

    public function store(Request $request){
        $result = $this->bannerService->store($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Banner $banner) {
        return view('admin.banner.edit',[
            'banner' => $banner,
        ]);
    }

    public function update(Request $request, Banner $banner){
        return $this->bannerService->update($request,$banner);
    }

    public function delete(Request $request){
        $result = $this->bannerService->delete($request);
        if($result){
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
