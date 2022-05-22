<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use App\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ApiResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ValidateIdsFromRequest;

class CategoryController extends Controller
{
    /**
     * Register the middlewares
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('assign.guard:users');
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('perPage')) {
            return ApiResource::collection(Category::filter($request->all())->trashed()->sorted()->paginate($request->perPage));
        }
        return ApiResource::collection(Category::filter($request->all())->trashed()->sorted()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = DB::transaction(function () use ($request) {
            $category = Category::create($request->validated());
            if ($request->image) {
                $category->addMediaFromBase64($request->image)->toMediaCollection('primary');
            }
            return $category;
        });
        return Response::success("Created successfully", $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return new ApiResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $category->update($request->validated());
            if ($request->image) {
                $category->addMediaFromBase64($request->image)->toMediaCollection('primary');
            }
        });
        return Response::success("Updated successfully", $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $productCount = $category->products()->count();
        if ($productCount) {
            return Response::error("There are {$productCount} products related to it.", [], 422);
        }
        if ($category->delete()) {
            return Response::success("Deleted successfully");
        }
    }

    // /**
    //  * Delete all the specified resource from storage.
    //  *
    //  * @param  \App\Http\Requests\ValidateIdsFromRequest $request
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function deleteAll(ValidateIdsFromRequest $request)
    // {
    //     if (Category::withTrashed()->whereIn('id', $request->ids)->delete()) {
    //         return Response::success("Deleted all successfully");
    //     };
    // }

    /**
     * Restore the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return new ApiResource($category);
    }

    // /**
    //  * Restore all the specified resource from storage.
    //  *
    //  * @param  \App\Http\Requests\ValidateIdsFromRequest $request
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function restoreAll(ValidateIdsFromRequest $request)
    // {
    //     if (Category::withTrashed()->whereIn('id', $request->ids)->restore()) {
    //         return Response::success("Restored all successfully");
    //     };
    // }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $productCount = $category->products()->count();
        if ($productCount) {
            return Response::error("There are {$productCount} products related to it.", [], 422);
        }
        if ($category->forceDelete()) {
            return Response::success("Force deleted successfully");
        };
    }

    // /**
    //  * Restore all the specified resource from storage.
    //  *
    //  * @param  \App\Http\Requests\ValidateIdsFromRequest $request
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function forceDeleteAll(ValidateIdsFromRequest $request)
    // {
    //     if (Category::withTrashed()->whereIn('id', $request->ids)->forceDelete()) {
    //         return Response::success("Force deleted all successfully");
    //     };
    // }
}