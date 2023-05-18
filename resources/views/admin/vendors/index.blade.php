@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            {{--      شريط التنقل      --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> الاقسام الرئيسية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> المتاجر
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{--      محتوى الصفحة      --}}
            <div class="content-body">
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                {{-- العنوان وأزرار التحكم  --}}
                                <div class="card-header">
                                    <h4 class="card-title">جميع المتاجر </h4>
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

                                {{-- التنبيهات  --}}
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

                                {{-- جدول المحتويات  --}}
                                <div class="card-content collapse show">
                                        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th> صورة المتجر</th>
                                                <th>اسم المتجر</th>
                                                <th>التفاصيل</th>
                                                <th>العنوان</th>
                                                <th>الهاتف</th>
                                                <th>عدد المنتجات</th>
                                                <th>القسم الرئيسي</th>
                                                <th>القسم الفرعي</th>
                                                <th> الحالة </th>
                                                <th>صوره إضافية 1</th>
                                                <th>صوره إضافية 2</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @isset($vendors)
                                                    @foreach($vendors as $vendor)
                                                        <tr>
                                                            <td><img style="width: 150px; height: 100px; " src="{{$vendor -> 	photo}}" alt="image"></td>
                                                            <td> {{$vendor -> name}} </td>
                                                            <td> {{$vendor -> details}} </td>
                                                            <td> {{$vendor -> address}} </td>
                                                            <td> {{$vendor -> mobile }} </td>
                                                            <td> {{$vendor -> products -> count()}} </td>
                                                            <td> {{$vendor -> mainCategory -> name}} </td>
                                                            <td> {{$vendor -> subCategory -> name}} </td>
                                                            <td> {{$vendor -> getActive()}}</td>
                                                            <td> <img style="width: 150px; height: 100px;" src="{{$vendor -> photo_first}}" alt="..."></td>
                                                            <td> <img style="width: 150px; height: 100px;" src="{{$vendor -> photo_second}}" alt="..."></td>
                                                            <td>
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a href="{{route('admin.vendors.show_products',$vendor->id)}}" class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">عرض المنتجات</a>
                                                                    <a href="{{route('admin.vendors.edit',$vendor -> id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                    <a href="{{route('admin.vendors.delete',$vendor -> id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                    <a href="{{route('admin.vendors.status',$vendor -> id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">@if($vendor->active==0) تفعيل @else إلغاء التفعيل  @endif</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
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
