@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة منتج
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة منتج </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        <form class="form" action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنتج </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> اسم المنتج </label>
                                                            <input type="text" value="" id="name" class="form-control" name="name">
                                                            @error("name")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="active" id="active" class="switchery" data-color="success" checked/>
                                                            <label for="switcheryColor4" class="card-title ml-1">الحالة  </label>
                                                            @error("active")
                                                                <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="details">  تفاصيل  المنتج   </label>
                                                            <input type="text" value="" id="details" class="form-control" name="details">
                                                            @error("details")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="size"> القياس </label>
                                                            <input type="number" value="" id="size" class="form-control" name="size">
                                                            @error("size")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price"> السعر الافرادي </label>
                                                            <input type="number" value="" id="price" class="form-control" name="price">
                                                            @error("price")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> الكمية </label>
                                                            <input type="number" value="" id="amount" class="form-control" name="amount">
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
                                                                            <option value="{{$mainCategory -> id }}">{{$mainCategory -> name}}</option>
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
                                                                            <option value="{{$subCategory -> id }}">{{$subCategory -> name}}</option>
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
                                                                            <option value="{{$vendor -> id }}">{{$vendor -> name}}</option>
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
                                                                <img id="show_photo" src="{{asset('assets\img\admin\undraw_posting_photo.svg')}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
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
                                                                <img id="show_photo" src="{{asset('assets\img\admin\undraw_posting_photo.svg')}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
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
                                                                <img id="show_photo" src="{{asset('assets\img\admin\undraw_posting_photo.svg')}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
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
                                                    <i class="la la-check-square-o"></i> حفظ
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

