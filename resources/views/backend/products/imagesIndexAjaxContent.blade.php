@foreach($product->productimages as $image)
<div class="col-lg-2 col-sm-6 image-box">
    <div class="image-box-container {{ $image->status == 1 ? 'active' : '' }}">
        <div class="image-box-header">
            <div class="checkbox checkbox-success">
                <input id="checkbox3" class="styled" type="checkbox" data-id="{{ $image->id }}">
                <label>
                </label>
            </div>
            <a href="javascript:void(0);"
                class="btn btn-social-icon btn-default _view-image"
                style="margin-right: 5px"
                data-src="/{{ $image->image }}"><i class="fas fa-eye"></i></a>
            <a href="javascript:void(0);"
                class="btn btn-social-icon btn-google _delete-image"
                data-id="{{ $image->id }}"
                ><i class="fas fa-trash-alt"></i></a>
        </div>
        <div class="image-box-body">

            <img src="/{{ $image->image }}" alt="{{ $image->alt }}">
        </div>
    </div>
</div>
@endforeach
