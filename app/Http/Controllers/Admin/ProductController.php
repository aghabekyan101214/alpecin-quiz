<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('current_language', 'translations.language')->get();
        return view('admin.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.products.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        $product = new Product();
        if(!is_null($request->image)){
            $image = FileUploadHelper::upload([$request->image], ["jpg", "jpeg", "png"], "products");
            $product->image = count($image) ? $image[0]['image'] : '';
        }
        $product->save();

        $product->translations()->createMany($request->data);

        DB::commit();

        session()->flash('create-message', 'Resource has been created successfully.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $languages = Language::all();
        $data = $product;
        return view('admin.products.create', compact('languages', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        if(!is_null($request->image)){
            $image = FileUploadHelper::upload([$request->image], ["jpg", "jpeg", "png"], "products");
            $product->image = count($image) ? $image[0]['image'] : '';
            $product->save();
        }
        foreach ($request->data as $d) {
            if($product->translations()->where('language_id', $d["language_id"])->exists()) {
                $product->translations()->where('language_id', $d["language_id"])->update($d);
            } else {
                $product->translations()->createMany([$d]);
            }
        }

        session()->flash('update-message', 'Resource has been updated successfully.');
        DB::commit();

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('admin.products.index'));
    }
}
