@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection


@section('css')

<style type="text/css">
a.cart:before {
    content: attr(data-content) !important;
}

</style>

@endsection

@section('js')

<script src="{{ asset('js/home.js') }}"></script>

@endsection


@section('slideProducts')
    @foreach($products as $product)
    <div class="item">

        <div class="l_product_item">
            <div class="l_p_img">
                <a href="san-pham/{{ $product->id }}">
                    <img src="/{{ $product->productimages[0]->image}}" alt="">
                </a>
                <h5 class="new">{{ \Carbon\Carbon::today()->diffInDays($product->created_at) < 3 ? 'mới' : '' }}</h5>
            </div>
            <div class="l_p_text">
                <ul>
                    <li><a class="add_cart_btn" href="javascript:void(0)" data-id="{{ $product->id }}">Thêm vào giỏ</a></li>
                </ul>
                <h4>{{ $product->name }}</h4>
                <h5>{{ number_format($product->price) }}</h5>
            </div>
        </div>

    </div>
    @endforeach
@endsection

@section('aside')
<!--================Main Content Area =================-->
<section class="home_sidebar_area">
    <div class="container">
        <div class="row row_disable">
            <div class="col-lg-9 float-md-right">
                <div class="sidebar_main_content_area">
                    <div class="main_slider_area">
                        <div id="home_box_slider" class="rev_slider" data-version="5.3.1.6">
                            <ul>
                                <li data-index="rs-1587" data-transition="fade" data-slotamount="default"
                                    data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                    data-easeout="default" data-masterspeed="300"
                                    data-thumb="{{ asset('frontend/img/home-slider/slider-1.jpg') }}" data-rotate="0"
                                    data-saveperformance="off" data-title="Creative" data-param1="01" data-param2=""
                                    data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                                    data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ asset('frontend/img/home-slider/slider-2.jpg') }}" alt=""
                                        data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                        data-bgparallax="5" class="rev-slidebg" data-no-retina>

                                    <!-- LAYER NR. 1 -->
                                    <div class="slider_text_box first_text">
                                        <div class="tp-caption tp-resizeme first_text"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top','top','top']"
                                            data-voffset="['70','70','70','70','70','70']"
                                            data-fontsize="['48','48','48','48','48','48']"
                                            data-lineheight="['56','56','56','56','56','48']"
                                            data-width="['none','none','none','none','none']" data-height="none"
                                            data-whitespace="nowrap" data-type="text" data-responsive_offset="on"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">áo phông<br> chào hè</div>

                                        <div class="tp-caption tp-resizeme secand_text"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top']"
                                            data-voffset="['190','190','190','190','190','190']"
                                            data-fontsize="['14','14','14','14','14','14']"
                                            data-lineheight="['24','24','24','24','24']"
                                            data-width="['300','300','300','300','300']" data-height="none"
                                            data-whitespace="normal" data-type="text" data-responsive_offset="on"
                                            data-transform_idle="o:1;"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">Trải nghiệm ngay !!!!!!!!!!!</div>

                                        <div class="tp-caption tp-resizeme third_btn"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top']"
                                            data-voffset="['290','290','290','290','290','290']" data-width="none"
                                            data-height="none" data-whitespace="nowrap" data-type="text"
                                            data-responsive_offset="on"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">
                                            <a class="checkout_btn" href="/shop/">Shopping</a>
                                        </div>
                                    </div>
                                </li>
                                <li data-index="rs-1588" data-transition="fade" data-slotamount="default"
                                    data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                    data-easeout="default" data-masterspeed="300"
                                    data-thumb="{{ asset('frontend/img/home-slider/slider-2.jpg') }}" data-rotate="0"
                                    data-saveperformance="off" data-title="Creative" data-param1="01" data-param2=""
                                    data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                                    data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ asset('frontend/img/home-slider/slider-2.jpg') }}" alt=""
                                        data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                        data-bgparallax="5" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->
                                    <!-- LAYERS -->

                                    <!-- LAYER NR. 1 -->
                                    <div class="slider_text_box first_text">
                                        <div class="tp-caption tp-resizeme first_text"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top','top','top']"
                                            data-voffset="['70','70','70','70','70','70']"
                                            data-fontsize="['48','48','48','48','48','48']"
                                            data-lineheight="['56','56','56','56','56','48']"
                                            data-width="['none','none','none','none','none']" data-height="none"
                                            data-whitespace="nowrap" data-type="text" data-responsive_offset="on"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">Best Winter
                                            <br> Collection</div>

                                        <div class="tp-caption tp-resizeme secand_text"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top']"
                                            data-voffset="['190','190','190','190','190','190']"
                                            data-fontsize="['14','14','14','14','14','14']"
                                            data-lineheight="['24','24','24','24','24']"
                                            data-width="['300','300','300','300','300']" data-height="none"
                                            data-whitespace="normal" data-type="text" data-responsive_offset="on"
                                            data-transform_idle="o:1;"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">There is no one
                                            who loves to be bread, who looks after it and wants to have it, simply
                                            because it is pain.
                                        </div>

                                        <div class="tp-caption tp-resizeme third_btn"
                                            data-x="['left','left','left','left','left','left']"
                                            data-hoffset="['60','60','60','60','20','0']"
                                            data-y="['top','top','top','top']"
                                            data-voffset="['290','290','290','290','290','290']" data-width="none"
                                            data-height="none" data-whitespace="nowrap" data-type="text"
                                            data-responsive_offset="on"
                                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                                            data-textAlign="['left','left','left','left','left','left']">
                                            <a class="checkout_btn" href="#">shop now</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="promotion_area">
                        <div class="feature_inner row m0">
                            <div class="left_promotion">
                                <div class="f_add_item">
                                    <div class="f_add_img"><img class="img-fluid"
                                            src="{{ asset('frontend/img/feature-add/f-add-6.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="right_promotion">
                                <div class="f_add_item right_dir">
                                    <div class="f_add_img"><img class="img-fluid"
                                            src="{{ asset('frontend/img/feature-add/f-add-7.jpg') }}" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fillter_home_sidebar">
                        <ul class="portfolio_filter">
                            <li class="active" data-filter="*"><a href="#">newest</a></li>
                        </ul>
                        <div class="newest_products_carousel owl-carousel">

                            @yield('slideProducts')

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 float-md-right">
                <div class="left_sidebar_area">
                    <aside class="l_widget l_categories_widget">
                        <div class="l_title" style="background:blueviolet">
                            <h3>Danh muc</h3>
                        </div>
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="/cat/{{ $category->id }}" data-id="{{ $category->id }}">{!! $category->name
                                    !!}</a></li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="l_widget l_supper_widget">
                        <img class="img-fluid" src="{{ asset('frontend/img/supper-add-1.jpg') }}" alt="">
                        <h4>Super Summer Collection</h4>
                    </aside>
                    <aside class="l_widget l_feature_widget">
                        <div class="verticalCarousel">
                            <div class="verticalCarouselHeader">
                                <div class="float-md-left">
                                    <h3>Mua nhiều nhất</h3>
                                </div>
                                <div class="float-md-right">
                                    <a href="#" class="vc_goUp"><i class="arrow_carrot-left"></i></a>
                                    <a href="#" class="vc_goDown"><i class="arrow_carrot-right"></i></a>
                                </div>
                            </div>
                            <ul class="verticalCarouselGroup vc_list">
                                @foreach($topSale as $product)
                                {{-- @if($product->orders()->count() >= 5) --}}
                                <li>
                                    <a href="san-pham/{{ $product->id }}">
                                        <div class="media">
                                            <div class="d-flex">
                                                <div style="max-width: 100px;">
                                                    <img src="{{ $product->productimages[0]->image }}" alt="" width="100%"
                                                        height="100%">

                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4>{{ $product->name }}</h4>
                                                <h5>{{ number_format($product->price) }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                {{-- @endif --}}
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Main Content Area =================-->
@endsection
