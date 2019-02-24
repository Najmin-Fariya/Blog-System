<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;


class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::latest()->get();
        return view('admin.category.categoryIndex', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.category.createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'categoryName' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);
        //get image from form
        $image = $request->file('image');
        $slug = str_slug($request->categoryName);
        if (isset($image)) {
            //make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //check category directory is exist?
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
            //resize image category and upload

            $category = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/' . $imageName, $category);

            //check category slider is exist?
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //resize image gor category andupload

            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        } else {
            $imageName = "default.png";
        }
        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category added successfully', 'success');
        //return redirect()->back();
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
        $category = Category::find($id);
        return view('admin.category.editCategory', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
       $this->validate($request, [
            'categoryName' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);
        //get image from form
        $image = $request->file('image');
        $slug = str_slug($request->categoryName);
        $category = Category::find($id);
        if (isset($image)) {
            //make uniq name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //check category directory is exist?
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }
//                delete old image and restore new image
            if (Storage::disk('public')->exists('category/'.$category->image)) 
                {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            //resize image category and upload

            $categoryImage = Image::make($image)->resize(1600, 479)->stream();
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);

            //check category slider is exist?
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //  delete old image and restore new image
            if (Storage::disk('public')->exists('category/slider/' .$category->image)) 
                {
                Storage::disk('public')->delete('category/slider/' .$category->image);
            }

            //resize image gor category andupload

            $slider = Image::make($image)->resize(500, 333)->stream();
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);
        } else {
            $imageName = $category->image;
        }
        
        $category->categoryName = $request->categoryName;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category Updated successfully', 'success');
        //return redirect()->back();
        return redirect()->route('admin.category.index')->with('message', 'Data saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Category::find($id)->delete();
        Toastr::warning('Data successfully deleted','success');
        return redirect()->back();
    }

}
