<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\MainCategory;
use App\Models\Store\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::selection()->paginate(PAGINATION_COUNT);
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        $mainCategories = MainCategory::active()->get();
        $subCategories = SubCategory::active()->get();
        $vendors = Vendor::active()->get();
        return view('admin.products.create',compact('mainCategories','vendors','subCategories'));
    }

    public function store(ProductRequest $request){
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = uploadImage('products', $request->photo);
            $filePathFirst = uploadImage('products', $request->photo_first);
            $filePathSecond = uploadImage('products', $request->photo_second);

            Product::create([
                'name' => $request->name,
                'details' => $request->details,
                'price' => $request->price,
                'size' => $request->size,
                'amount' => $request->amount,
                'active' => $request->active,
                'main_category_id' => $request->main_category_id,
                'sub_category_id' => $request->sub_category_id,
                'vendor_id' => $request->vendor_id,
                'photo' => $filePath,
                'photo_first' => $filePathFirst,
                'photo_second' => $filePathSecond,
            ]);
            return redirect()->route('admin.products')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($product_id){
        $mainCategories = MainCategory::selection()->get();
        $subCategories = SubCategory::selection()->get();
        $vendors = Vendor::selection()->get();
        $product = Product::selection()->find($product_id);
        if (!$product)
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
        return view('admin.products.edit', compact('product','mainCategories','subCategories','vendors'));
    }

    public function update($product_id, ProductRequest $request){
        try{
            $product = Product::find($product_id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
            if($request->has('active') && ($product->vendor->active==0 ||$product->subCategory->active==0 || $product->mainCategory->active==0) )
                return redirect()->route('admin.products')->with(['error' => ' لا بمكن تغير حالة المنتج ']);

            DB::beginTransaction();
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if ($request->has('photo')) {
                $filePath = uploadImage('products', $request->photo);
                Product::where('id',$product_id)->update(['photo' => $filePath,]);
            }
            if ($request->has('photo_first')) {
                $filePathFirst = uploadImage('products', $request->photo_first);
                Product::where('id',$product_id)->update(['photo_first' => $filePathFirst,]);
            }
            if ($request->has('photo_second')) {
                $filePathSecond = uploadImage('products', $request->photo_second);
                Product::where('id',$product_id)->update(['photo_second' => $filePathSecond,]);
            }

            Product::where('id',$product_id)->update([
                'name' => $request->name,
                'details' => $request->details,
                'price' => $request->price,
                'size' => $request->size,
                'amount' => $request->amount,
                'active' =>$request->active,
                'vendor_id' => $request->vendor_id,
                'main_category_id' => $request->main_category_id,
                'sub_category_id' => $request->sub_category_id,
            ]);
            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($product_id){
        try {
            $product = Product::find($product_id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

            $image = Str::after($product->photo, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);
            $image = Str::after($product->photo_first, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);
            $image = Str::after($product->photo_second, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);

            $product->delete();
            return redirect()->route('admin.products')->with(['success' => 'تم حذف المنتج بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($product_id){
        try {
            $product = Product::find($product_id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
            if ($product->vendor->active==0 || $product->subCategory->active==0 || $product->mainCategory->active==0)
                return redirect()->route('admin.products')->with(['error' => ' لا بمكن تغير حالة المنتج ']);
            $status =  $product -> active  == 0 ? 1 : 0;
            $product-> update(['active' =>$status ]);
            return redirect()->route('admin.products')->with(['success' => ' تم تغيير الحالة بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
