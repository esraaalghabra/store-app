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
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}">المتاجر </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة متجر
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة متجر </h4>
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
                                        <form class="form" action="{{route('admin.vendors.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المتجر </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"> الاسم </label>
                                                            <input name="name" id="name" type="text" value="" placeholder="" class="form-control"  >
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input name="active" id="active" type="checkbox" value="1" class="switchery" data-color="success" checked/>
                                                            <label for="active" class="card-title ml-1">الحالة </label>
                                                            @error("active")
                                                            <span class="text-danger"> </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="details"> التفاصيل </label>
                                                            <input name="details" id="details" type="text" value="" placeholder="" class="form-control"  >
                                                            @error("details")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="sub_category_id">   أختر القسم الفرعي </label>
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="address"> العنوان  </label>
                                                            <input name="address" id="pac-input" type="text" class="form-control" placeholder="  ">
                                                            @error("address")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="mobile"> رقم الهاتف </label>
                                                            <input name="mobile" id="mobile" type="number" value="" class="form-control" placeholder="">
                                                            @error("mobile")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="email"> ألبريد الالكتروني </label>
                                                            <input name="email" id="email" type="text" class="form-control" placeholder="">
                                                            @error("email")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="class col-6">
                                                        <div class="form-group">
                                                            <label for="password">كلمة المرور  </label>
                                                            <input name="password" id="password" type="password" class="form-control" placeholder="  " >
                                                            @error("password")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صورة المتجر </label>
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
                                                            <label> صورة المتجر الإضافية الأولى </label>
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
                                                            <label> صورة المتجر الإضافية الثانية </label>
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
