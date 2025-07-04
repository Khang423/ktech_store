<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class TagController extends Controller
{
    use ApiResponse;
    protected $tagService;
    public function __construct(TagService $tag_service)
    {
        $this->tagService = $tag_service;
    }
    public function index()
    {
        return view('admin.tag.index');
    }

    public function getList()
    {
        return $this->tagService->getList();
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $result = $this->tagService->store($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function edit(Request $request, Tag $tag)
    {
        return view('admin.tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $result = $this->tagService->update($request, $tag);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }

    public function delete(Request $request)
    {
        $result = $this->tagService->delete($request);
        if ($result) {
            return $this->successResponse();
        }
        return $this->errorResponse();
    }
}
