@extends("customer.master")
@section("content")
    <div class="customer-info">
        <h3>Thông tin cá nhân</h3>
        <form action="{{ route('customer.update') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                       value="{{ $customer->email }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày sinh</label>
                <input type="date" class="form-control" name="date_of_birth" id="exampleInputEmail1"
                       value="{{ $customer->date_of_birth }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">CMT/Thẻ căn cước</label>
                <input type="text" class="form-control" name="id_card" id="exampleInputEmail1"
                       value="{{ $customer->id_card }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giới tính</label>
                <select class="form-control" name="sex" id="exampleFormControlSelect1">
                    <option value="1" {{ $customer->sex == 1 ? 'selected' : '' }}>
                        Nam
                    </option>
                    <option value="0" {{ $customer->sex == 0 ? 'selected' : '' }}>
                        Nữ
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ</label>
                <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                       value="{{ $customer->address }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nghề nghiệp</label>
                <input type="text" name="job" class="form-control" id="exampleInputEmail1"
                       value="{{ $customer->job }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                       value="{{ $customer->phone }}">
            </div>
            <div class="customer-info-footer">
                <input class="btn btn-primary" type="submit" value="Cập nhật">
                <a href="{{ route('home') }}">Quay về</a>
            </div>
        </form>
    </div>
@endsection
