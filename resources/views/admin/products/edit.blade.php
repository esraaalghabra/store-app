@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">

                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}   ">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.maincategories')}}"> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل -منتج: {{$product -> name}}
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل منتج </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.products.update',$product -> id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$product -> id}}" type="hidden">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنتج </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> اسم المنتج  </label>
                                                            <input type="text" id="name" class="form-control" value="{{$product -> name}}" name="name">
                                                            @error("name")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="{{$product -> active }}" name="active" id="active" class="switchery" data-color="success" @if($product -> active == 1)checked @endif/>
                                                                <label for="active" class="card-title ml-1">الحالة </label>
                                                                @error("active")
                                                                <span class="text-danger"> هذا الحقل مطلوب </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="details"> تفاصيل المنتج  </label>
                                                            <input type="text" id="details" class="form-control" value="{{$product -> details}}" name="details">
                                                            @error("details")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="size"> القياس </label>
                                                            <input type="text" value="{{$product -> size}}" id="size" class="form-control" name="size">
                                                            @error("size")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> السعر الافرادي </label>
                                                            <input type="number" value="{{$product -> price}}" id="price" class="form-control" name="price">
                                                            @error("price")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> الكمية </label>
                                                            <input type="number" value="{{$product -> amount}}" id="amount" class="form-control" name="amount">
                                                            @error("amount")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="main_category_id"> أختر القسم الرئيسي </label>
                                                            <select name="main_category_id" id="main_category_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر القسم ">
                                                                    @if($mainCategories && $mainCategories -> count() > 0)
                                                                        @foreach($mainCategories as $mainCategory)
                                                                            <option value="{{$mainCategory -> id }}" @if($product->main_category_id==$mainCategory -> id) selected @endif> {{$mainCategory -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('main_category_id')
                                                                <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="sub_category_id"> أختر القسم الفرعي </label>
                                                            <select name="sub_category_id" id="sub_category_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر القسم ">
                                                                    @if($subCategories && $subCategories -> count() > 0)
                                                                        @foreach($subCategories as $subCategory)
                                                                            <option value="{{$subCategory -> id }}" @if($product->sub_category_id==$subCategory -> id) selected @endif> {{$subCategory -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('sub_category_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="vendor_id"> أختر المتجر </label>
                                                            <select name="vendor_id" id="vendor_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر المتجر ">
                                                                    @if($vendors && $vendors -> count() > 0)
                                                                        @foreach($vendors as $vendor)
                                                                            <option value="{{$vendor -> id }}" @if($product->vendor_id==$vendor -> id) selected @endif>{{$vendor -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('vendor_id')
                                                                <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره المنتج </label>
                                                            <label for="photo" class="file center-block">
                                                                <input name="photo" id="photo" type="file">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img src="{{$product -> photo}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره المنتج  الإضافية الأولى </label>
                                                            <label for="photo_first" class="file center-block">
                                                                <input name="photo_first" id="photo_first" type="file">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo_first')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img src="{{$product -> photo_first}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره المنتج الإضافية الثانية </label>
                                                            <label for="photo_second" class="file center-block">
                                                                <input name="photo_second" id="photo_second" type="file">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo_second')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img src="{{$product -> photo_second}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

@endsection
