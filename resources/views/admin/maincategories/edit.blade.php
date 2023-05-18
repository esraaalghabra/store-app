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
                                <li class="breadcrumb-item active"> تعديل - {{$mainCategory -> name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم رئيسي </h4>
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
                                        <form class="form" action="{{route('admin.maincategories.update',$mainCategory -> id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            {{-- id field --}}
                                            <input name="id" value="{{$mainCategory -> id}}" type="hidden">
                                            {{-- category fields --}}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>
                                                {{-- view photo --}}
                                                <div class="row">
                                                    {{-- category name field --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="label3"> اسم القسم </label>
                                                            <input type="text" id="name" class="form-control" value="{{$mainCategory -> name}}" name="name">
                                                            @error("name")
                                                                <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="active" id="active" class="switchery" data-color="success" @if($mainCategory -> active == 1)checked @endif/>
                                                            <label for="active" class="card-title ml-1">الحالة </label>
                                                            @error("active")
                                                            <span class="text-danger"> هذا الحقل مطلوب </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="details">  تفاصيل  القسم   </label>
                                                            <input type="text" value="{{$mainCategory -> details}}" id="details" class="form-control" name="details">
                                                            @error("details")
                                                            <span class="text-danger"> هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره القسم </label>
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
                                                                <img src="{{$mainCategory -> photo}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره القسم الأولى</label>
                                                            <label for="photo_first" class="file center-block">
                                                                <input name="photo_first" id="photo_first" type="file">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo_first')
                                                            <span class="text-danger">هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img src="{{$mainCategory -> photo_first}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> صوره القسم الثانية</label>
                                                            <label for="photo_second" class="file center-block">
                                                                <input name="photo_second" id="photo_second" type="file">
                                                                <span class="file-custom"></span>
                                                            </label>
                                                            @error('photo_second')
                                                            <span class="text-danger">هذا الحقل مطلوب</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img src="{{$mainCategory -> photo_second}}" class="ri-rounded-corner  height-250" alt="صورة القسم">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- form submit --}}
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
