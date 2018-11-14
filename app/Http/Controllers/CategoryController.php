<?php

namespace App\Http\Controllers;

use File;
use App\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = $request->file('icon');

        $strippedName = md5(uniqid() . time()) . '.' . $image->getClientOriginalExtension();

        $photoName = date('Y-m-d-H-i-s').$strippedName;

        $avatar = Image::make($image->getRealPath());
        $avatar->resize(32, null, function ($constraint) { $constraint->aspectRatio(); });
        $avatar->save(storage_path().'/app/uploads/category/'.$photoName);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->icon = $photoName;
        $category->save();

        return redirect()->action('CategoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
            $image = $request->file('icon');

            if ( isset($image)) {
                File::delete(storage_path().'/app/uploads/category/'. $category->icon);

                $strippedName = md5(uniqid() . time()) . '.' . $image->getClientOriginalExtension();

                $photoName = date('Y-m-d-H-i-s').$strippedName;

                $avatar = Image::make($image->getRealPath());
                $avatar->resize(32, null, function ($constraint) { $constraint->aspectRatio(); });
                $avatar->save(storage_path().'/app/uploads/category/'.$photoName);
            }

            $category->name = $request->name;
            $category->description = $request->description;
            if ($image) {
                $category->icon = $photoName;
            }
            $category->save();

            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back();
    }
}
