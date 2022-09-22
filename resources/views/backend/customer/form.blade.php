<form action="" method="post" class="form-horizontal">
    @csrf
    <div class="box-body">
        <div class="form-group">
            <label for="categoryName" class="col-sm-4 control-label">Họ và tên</label>
            <div class="col-sm-6">
                <input type="text" name="name"  value="{{old('name',isset($user->name) ? $user->name :'')}}" class="form-control" placeholder="Nhập tên họ và tên">
                @if($errors->has('name'))
                    <span class="text-danger">
                                    {{$errors->first('name')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="categoryName" class="col-sm-4 control-label">Địa chỉ</label>
            <div class="col-sm-6">
                <input type="text" name="address"  value="{{old('address',isset($user->address) ? $user->address :'')}}" class="form-control" placeholder="Nhập địa chỉ">
                @if($errors->has('address'))
                    <span class="text-danger">
                                    {{$errors->first('address')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="categoryName" class="col-sm-4 control-label">Số điện thoại</label>
            <div class="col-sm-6">
                <input type="text" name="phone" value="{{old('phone',isset($user->phone) ? $user->phone :'')}}"  class="form-control" placeholder="Nhập số điện thoại">
                @if($errors->has('phone'))
                    <span class="text-danger">
                                    {{$errors->first('phone')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="des" class="col-sm-4 control-label">Giới tính</label>
            <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                        <span class="custom-control custom-radio">
                            <input class="custom-control-input" value="1" type="radio" id="customRadio1" name="sex" {{ isset($user->sex)&& $user->sex==1 ?'checked':'' }} >
                            <label for="customRadio1" class="custom-control-label">Nam</label>
                        </span>
                        <span class="custom-control custom-radio">
                            <input class="custom-control-input" value="0" type="radio" id="customRadio2" name="sex" {{ isset($user->sex)&& $user->sex==0 ?'checked':'' }}>
                            <label for="customRadio2"  class="custom-control-label">Nữ</label>
                        </span>
                    </div>
                @if($errors->has('sex'))
                    <span class="text-danger">
                                    {{$errors->first('sex')}}
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="categoryName" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-6">
                <input type="text" name="email"  value="{{old('email',isset($user->email) ? $user->email :'')}}"  class="form-control" placeholder="Nhập email">
                @if($errors->has('email'))
                    <span class="text-danger">
                                    {{$errors->first('email')}}
                    </span>
                @endif</div>
        </div>
        <div class="form-group">
            <label for="keyword" class="col-sm-4 control-label">Mô tả</label>
            <div class="col-sm-6">
                <textarea name="description" id="keyword" rows="3" class="form-control">{{isset($user->description) ? $user->description :''}}</textarea>
            </div>
        </div>
        @if(!isset($user))
        <div class="form-group">
            <label for="categoryName" class="col-sm-4 control-label">Mật khẩu</label>
            <div class="col-sm-6">
                <input type="password" name="password"  value="{{old('password',isset($user->password) ? $user->password :'')}}"  class="form-control" placeholder="Nhập mật khẩu">
                @if($errors->has('password'))
                    <span class="text-danger">
                                    {{$errors->first('password')}}
                    </span>
                @endif
            </div>
        </div>
            @endif
    </div>
    <div class="box-footer" style="text-align:center">
        <a href="{{route('list.customer')}}" class="btn btn-default" style="margin:0px 15px">Trở lại</a>

        @if(!isset($user))
            <button type="submit" class="btn btn-primary align-items-center">Thêm nhân viên</button>
        @else
            <button type="submit" class="btn btn-primary  align-items-center">Cập nhật nhân viên</button>
        @endif
    </div>
</form>
