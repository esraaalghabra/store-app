<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    public function index(){
      $subCategories = SubCategory::selection()->paginate(PAGINATION_COUNT);
      return view('admin.subcategories.index', compact('subCategories'));
    }

    public function create(){
        $mainCategories = MainCategory::active()->selection()->get();
        return view('admin.subcategories.create', compact('mainCategories'));
    }

    public function store(SubCategoryRequest $request){
        try {
            DB::beginTransaction();
            //validation
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = uploadImage('subcategories', $request->photo);
            $filePathFirst = uploadImage('subcategories', $request->photo_first);
            $filePathSecond = uploadImage('subcategories', $request->photo_second);

            SubCategory::create([
                'name' => $request->name,
                'active' => $request->active,
                'photo' => $filePath,
                'photo_first' => $filePathFirst,
                'photo_second' => $filePathSecond,
                'main_category_id' => $request->main_category_id,
                'details' => $request->details,
            ]);
            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($subCategory_id){
        $subCategory = SubCategory::find($subCategory_id);
        if (!$subCategory)
            return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);
        $mainCategories = MainCategory::get();
        return view('admin.subcategories.edit', compact('subCategory','mainCategories'));
    }

    public function update($subCategory_id, SubCategoryRequest $request){
        try {
            $subCategory = SubCategory::find($subCategory_id);
            if (!$subCategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود']);
            if ($request->has('active') && $subCategory->mainCategory->active==0)
                return redirect()->route('admin.subcategories')->with(['error' => 'لا يمكن تغير حالة هذا القسم']);

            DB::beginTransaction();
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            $subCategory-> update(['active' =>$request->active ]);

            if ($request->has('photo')) {
                $filePath = uploadImage('subcategories', $request->photo);
                SubCategory::where('id',$subCategory_id)->update(['photo' => $filePath,]);
            }
            if ($request->has('photo_first')) {
                $filePathFirst = uploadImage('subcategories', $request->photo_first);
                SubCategory::where('id',$subCategory_id)->update(['photo_first' => $filePathFirst,]);
            }
            if ($request->has('photo_second')) {
                $filePathSecond = uploadImage('subcategories', $request->photo_second);
                SubCategory::where('id',$subCategory_id)->update(['photo_second' => $filePathSecond,]);
            }

            SubCategory::where('id', $subCategory_id)->update([
                'name' => $request->name,
                'details' => $request->details,
                'main_category_id' => $request->main_category_id,
            ]);
            DB::commit();
            return redirect()->route('admin.subcategories')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($subCategory_id){
        try {
            $subcategory = SubCategory::find($subCategory_id);
            if (!$subcategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $subcategory->vendors();
            $products = $subcategory->products();
            if ((isset($vendors) && $vendors->count() > 0)||(isset($products) && $products->count() > 0))
                return redirect()->route('admin.subcategories')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);

            $image = Str::after($subcategory->photo, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);
            $image = Str::after($subcategory->photo_first, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);
            $image = Str::after($subcategory->photo_second, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image);

            $subcategory->delete();
            return redirect()->route('admin.subcategories')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
         }
    }

    public function changeStatus($subCategory_id){
        try {
            $subcategory = SubCategory::find($subCategory_id);
            if (!$subcategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $subcategory -> active  == 0 ? 1 : 0;
            if ($status==1 && $subcategory->mainCategory->active==0)
                return redirect()->route('admin.subcategories')->with(['error' => 'لا يمكن تغير حالة هذا القسم']);
            $subcategory -> update(['active' =>$status ]);
            return redirect()->route('admin.subcategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function showVendors($subCategory_id){
        $subCategory=SubCategory::with("vendors")->find($subCategory_id);
        if(!$subCategory)
            return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);
        return view('admin.subcategories.show_vendors',compact('subCategory'));
    }
}
