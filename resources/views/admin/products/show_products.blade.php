@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المنتجات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">  الرئيسية  </a> -></li>
                                <li class="breadcrumb-item active"> <a href="{{route('admin.vendors')}}">المتاجر </a> </li>
                                <li class="breadcrumb-item active">منتجات متجر  {{$vendor->name}}  </li>
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
                                    <h2 >منتجات متجر: {{$vendor->name}} </h2>
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
                                            @if(isset($vendor->products) && $vendor->products->count()>0)
                                                @foreach($vendor->products as $index=> $product)
                                                    @if($product->translation_lang==get_default_lang())
                                                        <div class="col-lg-6 col-sm-6 mb-4">
                                                            <div class="card " style="width: 30rem; ">
                                                                <div class="card-body box-shadow-3 mr-1 mb-1" style="width: 35rem; ">
                                                                    <h2> {{$product->name}}</h2>
                                                                    <img src="{{$product->photo}}" class="card-img-top" alt="..." style="width: 350px; height: 350px; "><br><br>
                                                                    <a class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1" data-bs-toggle="collapse" href="#product{{$index}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">تفاصيل إضافية</a>
                                                                    <div class="col">
                                                                        <div class="collapse multi-collapse" id="product{{$index}}">
                                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                                <a href="{{route('admin.products.edit',$product -> id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                                <a href="{{route('admin.products.delete',$product -> id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                                <a href="{{route('admin.products.status',$product -> id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                                    @if($product -> active == 0)تفعيل@elseالغاء تفعيل@endif
                                                                                </a>
                                                                            </div>
                                                                            <br><br><br>
                                                                            <div class="card-body box-shadow-1 mr-3 mb-3">
                                                                                <h3 >الحالة : {{$product->getActive()}}</h3>
                                                                                <h3 >قسم : {{$product->category->name}}</h3>
                                                                                <h3 >المواصفات : {{$product->details}}</h3>
                                                                                <h3 >متجر : {{$product->vendor->name}}</h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <a href="{{route('admin.products.create')}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">اضغط لإضافة منتج </a>
                                            @endif

                                        </div>
                                    </div>
                                </section>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
@endsection


{{--
                                                                <div class="card" style="width: 18rem;">
                                                                    <h2 class="text-uppercase">{{$product->name}}</h2>
                                                                    <products src="{{$product->photo}}" class="card-products-top" alt="...">
                                                                    <div class="card-body">
                                                                        <p class="card-text">التفاصيل : {{$product->details}}</p>
                                                                    </div>
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">التفاصيل : {{$product->details}}</li>
                                                                        <li class="list-group-item">الحالة : {{$product->getActive()}}</li>
                                                                        <li class="list-group-item">متجر : {{$product->vendor__products->name}}</li>
                                                                    </ul>
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a href="{{route('admin.products.edit',$product -> id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                        <a href="{{route('admin.products.delete',$product -> id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                        <a href="{{route('admin.products.status',$product -> id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                            @if($product -> active == 0)تفعيل@elseالغاء تفعيل@endif
                                                                        </a>
                                                                    </div>
                                                                </div>

--}}

