<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\banner\StoreRequest;
use App\Models\Banner;
use App\Services\BannerService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class BannerController extends Controller
{
    protected $bannerService;
    use ApiResponse;
    public function __construct(
        BannerService $bannerService,
    ) {
        $this->bannerService = $bannerService;
    }
    public function index()
    {
        return view('admin.banner.index');
    }

    public function getList()
    {
        return $this->bannerService->getList();
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(StoreRequest $request)
    {
        $result = $this->bannerService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', [
            'banner' => $banner,
        ]);
    }

    public function update(Request $request, Banner $banner)
    {
        $result = $this->bannerService->update($request, $banner);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function destroy(Request $request)
    {
        $result = $this->bannerService->destroy($request);
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function forceDelete(Request $request)
    {
        $result = $this->bannerService->forceDelete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function restoreAll()
    {
        $result = $this->bannerService->restoreAll();
        if ($result) {
            return $this->successResponse();
        }
        return false;
    }

    public function updateStatus(Request $request)
    {
        $result = $this->bannerService->updateStatus($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
