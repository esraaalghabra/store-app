<?php

namespace App\Http\Controllers;

use App\Helpers\HandelResponse;
use App\Helpers\StatusCodeRequest;
use App\Http\Controllers\Controller;
use App\Models\Store\MainCategory;
use App\Models\Store\Product;
use App\Models\Store\SubCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use HandelResponse;

    public function home(){
        $mainCategories = MainCategory::selection()->get();
        if (!$mainCategories)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        $subCategories = SubCategory::selection()->get();
        if (!$subCategories)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        $products=Product::selection()->get();
        if (!$products)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData(['mainCategories'=>$mainCategories,'subCategories'=>$subCategories,'products'=>$products]
            , 'success', StatusCodeRequest::OK);
    }
    public function mainCategories(){
        $mainCategories = MainCategory::selection()->get();
        if (!$mainCategories)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData($mainCategories, 'success', StatusCodeRequest::OK);
    }
    public function mainCategory($id){
        $mainCategory = MainCategory::with([
            'subCategories' => function ($q) {
                return $q->selection();
            }, 'products' => function ($q) {
                return $q->selection()->discounts();
            },
        ])->selection()->find($id);
        if (!$mainCategory)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData($mainCategory, 'success', StatusCodeRequest::OK);
    }
    public function subCategory($id){
        $subCategory = SubCategory::with([
            'products' => function ($q) {
                return $q->selection()->discounts();
        }])->selection()->find($id);
        if (!$subCategory)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData($subCategory, 'success', StatusCodeRequest::OK);
    }
    public function products(){
        $product=Product::selection()->get();
        if (!$product)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData($product, 'success', StatusCodeRequest::OK);
    }
    public function product($id){
        $product=Product::selection()->find($id);
        if (!$product)
            return $this->handleResponseData(null, 'data not exist', StatusCodeRequest::NO_CONTENT);
        return $this->handleResponseData($product, 'success', StatusCodeRequest::OK);
    }

}

