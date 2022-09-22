<div class="row">
    @foreach($products as $product)
    <div class="col-lg-4 col-sm-6">
        <div class="l_product_item">
            <div class="l_p_img">
                <a href="/san-pham/{{ $product->id }}">
                    <img src="/{{ $product->productimages[0]->image }}" alt="{{ $product->productimages[0]->image }}">
                </a>
                <h5 class="new">{{ \Carbon\Carbon::today()->diffInDays($product->created_at) < 3 ? 'mới' : '' }}</h5>
            </div>
            <div class="l_p_text">
                <ul>
                    <li><a class="add_cart_btn" data-id="{{ $product->id }}" href="javascript:void(0)">Thêm vào giỏ</a></li>
                </ul>
                <h4>{{ $product->name }}</h4>
                <h5>{{  number_format($product->price) }}</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $products->links('layouts.partions.frontend.components.paginate') }}
