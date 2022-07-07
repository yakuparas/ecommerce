<!-- header start -->
@php
    $catList=\App\Http\Controllers\HomeController::CatList();
    $getCart=\App\Http\Controllers\HomeController::getCart();
@endphp
<header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>{{$setting->company}}</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>{{__('site.Bizi Arayın')}}: {{$setting->phone}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                        </li>
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                            @guest
                            {{__('site.Hesabım')}}
                                <ul class="onhover-show-div">
                                    <li><a href="{{route('login')}}">{{__('site.Giriş Yap')}}</a></li>
                                    <li><a href="">{{{__('site.Üye Ol')}}}</a></li>
                                </ul>
                            @endguest
                           @auth
                                {{Auth::user()->name}}
                                <ul class="onhover-show-div">
                                    <li><a href="{{route('profile')}}">Hesabım</a></li>
                                    <li><a href="{{route('logout')}}">Çıkış Yap</a></li>
                                </ul>
                           @endauth







                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">

                        <div class="brand-logo">
                            <a href="/"><img src="{{$setting->logo}}" width="174px" height="34px" class="img-fluid blur-up lazyload" alt=""></a>
                        </div>

                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-end">Geri<i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                    </li>
                                    <li><a href="/">{{__('site.anasayfa')}}</a></li>


                                    @foreach($catList as $rs)
                                        <li><a href="{{route('categoryproducts',['id'=>$rs->id,'slug'=>$rs->seo_url])}}">{{$rs->title}}</a>
                                            @if(count($rs->children))
                                                @include('inc.__categorytree',['children'=>$rs->children])
                                            @endif
                                        </li>

                                    @endforeach

                                    <li><a href="{{route('zaunplanner')}}">{{__('site.planlayıcı')}}</a></li>

                                </ul>
                            </nav>
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="/frontend/assets/images/icon/search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt=""> <i class="ti-search" onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search a Product">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-setting">
                                        <div><img src="/frontend/assets/images/icon/setting.png" class="img-fluid blur-up lazyload" alt=""> <i class="ti-settings"></i></div>
                                        <div class="show-div setting">
                                            <h6>Dil</h6>
                                            <ul>
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <li>
                                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                            {{ $properties['native'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <a href="{{route('cart.show',[auth()->check() ? auth()->id() : session()->getId()])}}">
                                        <div><img src="/frontend/assets/images/icon/cart.png" class="img-fluid blur-up lazyload" alt=""> <i class="ti-shopping-cart"></i></div>
                                        <span class="cart_qty_cls">{{count($getCart)}}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- header end -->
