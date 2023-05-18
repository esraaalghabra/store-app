<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-------------------- الرئيسية -------------------->
            <li class="nav-item active">
                <a href="{{route('admin.dashboard')}}">
                    <i class="la la-mouse-pointer"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span>
                </a>
            </li>
            <!------------------- الأقسام الرئيسية ------------------->
            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه</span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{App\Models\Store\MainCategory::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="active">
                        <a class="menu-item" href="{{route('admin.maincategories')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">أضافة قسم جديد </a>
                    </li>
                </ul>
            </li>

            <!-------------------- الأقسام الفرعية -------------------->
            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الفرعية   </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">400</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.subcategories')}}" data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('admin.subcategories.create')}}" data-i18n="nav.dash.crypto">أضافة قسم فرعي جديد </a>
                    </li>
                </ul>
            </li>


            <!-------------------- المنتجات -------------------->
            <li class="nav-item">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Store\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}" data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('admin.products.create')}}" data-i18n="nav.dash.crypto">أضافة منتج جديد </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
