<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Repositories\banner\BannerInterface;
use App\Repositories\banner\BannerRepository;
use Illuminate\Http\Request;

class BannerController extends Controller

{
    protected $bannerInterface;
    protected $bannerRepository;

    public function __construct(
        BannerInterface $bannerInterface,
        BannerRepository $bannerRepository
    ) {
        $this->bannerInterface  = $bannerInterface;
        $this->bannerRepository  = $bannerRepository;
    }
    public function index()
    {
        return view('admin.banner.index');
    }

    public function getList() {
        return $this->bannerInterface->getList();
    }

    public function create() {
        return view('admin.banner.create');
    }

    public function store(Request $request){
        dd($request);
    }

    public function edit(Banner $banner) {
        return view('admin.banner.edit',[
            'banner' => $banner,
        ]);
    }

    public function update(Request $request, Banner $banner){
        return $this->bannerInterface->update($request,$banner);
    }
}
