@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المتاجر </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">  الرئيسية  </a> -></li>
                                <li class="breadcrumb-item active"> <a href="{{route('admin.vendors')}}">الأقسام الرئيسية </a> </li>
                                <li class="breadcrumb-item active">متاجر قسم   {{$mainCategory->name}}  </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h2 >متاجر: {{$mainCategory->name}} </h2>
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

                                <section class="page-section bg-white" id="discounts">
                                    <div class="container">
                                        <div class="row">
                                            @if(isset($mainCategory->vendors) && $mainCategory->vendors->count()>0)
                                                @foreach($mainCategory->vendors as $index=> $vendor)
                                                    <div class="col-lg-6 col-sm-6 mb-4">
                                                        <div class="card " style="width: 35rem; ">
                                                            <div class="card-body box-shadow-3 mr-1 mb-1" style="width: 35rem; ">
                                                                <h2> {{$vendor->name}}</h2>
                                                                <img src="{{$vendor->photo}}" class="card-img-top" alt="..." style="width: 350px; height: 350px;"><br><br>
                                                                <p> {{$vendor->details}}</p>
                                                                <a class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1" data-bs-toggle="collapse" href="#vendor{{$index}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">تفاصيل إضافية</a>
                                                                <div class="col">
                                                                    <div class="collapse multi-collapse" id="vendor{{$index}}">
                                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                                            <a href="{{route('admin.vendors.edit',$vendor -> id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                            <a href="{{route('admin.vendors.delete',$vendor -> id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                            <a href="{{route('admin.vendors.status',$vendor -> id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">@if($vendor->active==0) تفعيل @else إلغاء التفعيل  @endif</a>
                                                                        </div>
                                                                        <br><br><br>
                                                                        <div class="card-body box-shadow-1 mr-3 mb-3">
                                                                            <h3 >الحالة : {{$vendor->getActive()}}</h3>
                                                                            <h3 >قسم : {{$vendor->mainCategory->name}}</h3>
                                                                            <h3 >رقم الهاتف : {{$vendor->mobile}}</h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <a href="{{route('admin.products.create')}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضغط لإضافة منتج </a>
                                            @endif
                                        </div>
                                    </div>
                                </section>
                            <!-- Bootstrap core JS-->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                                <script src="{{asset('js/products_scripts.js')}}"></script>
                                <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
@endsection


{{--

--}}

