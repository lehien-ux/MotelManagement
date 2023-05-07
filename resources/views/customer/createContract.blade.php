@extends("customer.master")
@section("content")
    <div class="customer-contract">
        <div class="page-content">
            <h3 style="text-align: center">Đặt phòng</h3>
            <div class="card-box">
                <form action="{{route('rooms.book')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body row">
                        <div class="col-lg-12 p-t-20">
                            <div class="room-id-wrapper">
                                <h3>Tên phòng: {{ $room->number }}</h3>
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <h3>Ảnh phòng</h3>
                            <div class="book-room-images">
                                @foreach($room->images as $image)
                                    <img src="{{ url("upload/images/$image->path") }}" alt="">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <h3>Số tiền cọc: 500,000 vnd</h3>
                            </div>
                        </div>
                        <div class="col-lg-6 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield txt-full-width">
                                <label for="text7">Ngày bắt đầu</label>
                                <input class="form-control" type="date" name="start_date" required>
                            </div>
                        </div>
                        <div class="col-lg-6 p-t-20">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Ngày kết thúc</label>
                            <div class="wr_input">
                                <input class="form-control" type="date" name="end_date" required>
                            </div>
                        </div>

                        <div class="col-lg-12 p-t-20">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Lưu ý</label>
                            <div class="wr_input">
                                   <textarea class="mdl-textfield__input" rows="8" cols="37" id="description"
                                             name="description" style="padding: 5px; outline: none"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <div>
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Đăng ký dịch vụ</label>
                                <br>
                                @foreach($services as $service)
                                    <input type="checkbox"
                                           value="{{ $service->id }}" name="service_id[]"
                                           style="-webkit-appearance: auto;"
                                    > {{ $service->name }}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Tìm người ở chung</label>
                            <div class="wr_input">
                                <input type="checkbox" style="-webkit-appearance: auto" name="transplant">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 p-t-20 text-center">
                        <button type="submit"
                                class="btn-primary btn">
                            Tạo hợp đồng
                        </button>
                        <button type="button"
                                class="btn btn-dark"
                                onclick="window.history.back()">
                            Hủy
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
