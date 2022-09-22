<div class="carousel_menu_inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand vadu-logo-container" href="/">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="vadu-logo-image">
                            <img class="vadu-logo" src="{{ asset('frontend/img/mylogo.png') }}" alt="">
                        </div>
                        <div class="vadu-logo-text">
                            <p>Yoou Fashion</p>
                        </div>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown submenu active">
                        <a class="nav-link dropdown-toggle" href="/" role="button">
                            Trang chủ</i>
                        </a>
                    </li>
                    <li class="nav-item dropdown submenu">
                        <a class="nav-link dropdown-toggle" href="/shop/">
                            Shop
                        </a>
                    </li>
                    <li class="nav-item dropdown submenu"><a class="nav-link" href="#">Danh mục</a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li class="nav-item"><a class="nav-link" href="/cat/{{ $category->id }}" data-id="{{ $category->id }}">{!! $category->name !!}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="cart_cart">
                        <a href="/cart/" class="cart" title="Có {{ !$session ? '0' : $session->totalQty }} sản phẩm trong giỏ hàng của bạn" data-content="{{ !$session ? '0' : $session->totalQty }}">
                            <i class="icon-handbag icons"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
