@extends("customer.master")
@section("content")
    <div class="change-password">
        <h3>Thay đổi mật khẩu</h3>
        @if(session('message'))
            <h3>{{ session('message') }}</h3>
        @endif
        <form action="{{ route('customer.change-password') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu cũ</label>
                <input type="password" class="form-control" name="password" id="exampleInputEmail1"
                       value="">
            </div>
            @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu mới</label>
                <input type="password" class="form-control" name="newPassword" id="exampleInputEmail1"
                       value="">
            </div>
            @if($errors->has('newPassword'))
                <div class="error">{{ $errors->first('newPassword') }}</div>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="rePassword" id="exampleInputEmail1"
                       value="">
            </div>
            @if($errors->has('rePassword'))
                <div class="error">{{ $errors->first('rePassword') }}</div>
            @endif
            <div class="customer-info-footer">
                <input class="btn btn-primary" type="submit" value="Cập nhật">
                <a href="{{ route('home') }}">Quay về</a>
            </div>
        </form>
    </div>
@endsection
