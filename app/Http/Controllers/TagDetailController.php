<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagDetail;
use App\Services\TagDetailService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class TagDetailController extends Controller
{
    protected $tagDetailService;
    use ApiResponse;
    public function __construct(TagDetailService $tag_detail_service)
    {
        $this->tagDetailService = $tag_detail_service;
    }

    public function index(Tag $tag)
    {
        return view('admin.tagDetail.index',[
            'tag' => $tag
        ]);
    }

    public function getList(Tag $tag)
    {
        return $this->tagDetailService->getList($tag);
    }

    public function create(Tag $tag)
    {
        return view('admin.tagDetail.create',[
            'tag' => $tag
        ]);
    }

    public function store(Request $request)
    {
        $result = $this->tagDetailService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(TagDetail $tag_detail)
    {
        return view('admin.tagDetail.edit',[
            'tagDetail' => $tag_detail
        ]);
    }

    public function update(Request $request, TagDetail $tag_detail) {

    }

    public function delete(Request $request) {}
}
