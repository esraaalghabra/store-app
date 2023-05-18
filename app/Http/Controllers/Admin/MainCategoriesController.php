<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Store\MainCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    public function index(){
        $mainCategories = MainCategory::selection()->paginate(PAGINATION_COUNT);
        return view('admin.maincategories.index', compact('mainCategories'));
    }

    public function create(){
        return view('admin.maincategories.create');
    }

    public function store(MainCategoryRequest $request){
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = uploadImage('maincategories', $request->photo);
            $filePathFirst = uploadImage('maincategories', $request->photo_first);
            $filePathSecond = uploadImage('maincategories', $request->photo_second);

            MainCategory::create([
                'name' => $request->name,
                'details' => $request->details,
                'photo' => $filePath,
                'active' => $request->active,
            ]);
            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($subCategory_id){
        $mainCategory = MainCategory::selection()->find($subCategory_id);
        if (!$mainCategory)
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);
        return view('admin.maincategories.edit', compact('mainCategory'));
    }

    public function update($subCategory_id, MainCategoryRequest $request){
        try {
            $main_category = MainCategory::find($subCategory_id);
            if (!$main_category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            DB::beginTransaction();
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            $main_category-> update(['active' =>$request->active ]);

            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id',$subCategory_id)->update(['photo' => $filePath,]);
            }
            if ($request->has('photo_first')) {
                $filePathFirst = uploadImage('maincategories', $request->photo_first);
                MainCategory::where('id',$subCategory_id)->update(['photo_first' => $filePathFirst,]);
            }
            if ($request->has('photo_second')) {
                $filePathSecond = uploadImage('maincategories', $request->photo_second);
                MainCategory::where('id',$subCategory_id)->update(['photo_second' => $filePathSecond,]);
            }

            MainCategory::where('id', $subCategory_id)->update([
            'name' => $request->name,
            'details' => $request->details,
            ]);
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($subCategory_id){
        try {
            $maincategory = MainCategory::find($subCategory_id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $maincategory->vendors();
            $subCategories = $maincategory->subCategories();
            $products = $maincategory->products();
            if ((isset($vendors) && $vendors->count() > 0) ||(isset($subCategories) && $subCategories->count() > 0) ||(isset($products) && $products->count() > 0))
                return redirect()->route('admin.maincategories')->with(['error' => 'لأ يمكن حذف هذا القسم  ']);

            $image = Str::after($maincategory->photo, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image); //delete from folder
            $image = Str::after($maincategory->photo_first, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image); //delete from folder
            $image = Str::after($maincategory->photo_second, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image); //delete from folder

            $maincategory->delete();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم حذف القسم بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($subCategory_id){
        try {
            $maincategory = MainCategory::find($subCategory_id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);
            $status =  $maincategory -> active  == 0 ? 1 : 0;
            $maincategory -> update(['active' =>$status ]);
            return redirect()->route('admin.maincategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function showVendors($subCategory_id){
        $mainCategory=MainCategory::with("vendors")->find($subCategory_id);
        if(!$mainCategory)
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);
        return view('admin.maincategories.show_vendors',compact('mainCategory'));
    }


}
