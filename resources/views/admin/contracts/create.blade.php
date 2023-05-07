@extends("admin.redirect")
@section("content")
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Tạo hợp đồng</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        @include("admin.breadcrumb.home")

                    </ol>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-danger help-block">{{session('message')}}</div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Thông tin hợp đồng</header>
                            <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                    data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                data-mdl-for="panel-button">
                                <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                                <li class="mdl-menu__item"><i class="material-icons">print</i>Another action</li>
                                <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here
                                </li>
                            </ul>
                        </div>
                        <form action="{{route('contracts.handle-create')}}" method="post" enctype="multipart/form-data">
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
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div class="room-id-wrapper">
                                            <select name="room_id" id="search-room-id" class="form-control" required>
                                                <option value="" disabled selected hidden>Chọn phòng</option>
                                                @foreach($rooms as $room)
                                                    <option class="id-room"
                                                            value="{{ $room->id }}">{{ $room->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div class="customer-id-wrapper">
                                            <select class="form-control" name="customer_id" id="customer-id" required>
                                            <option value="" disabled selected hidden>Chọn tên người thuê</option>
                                            @foreach($customers as $customer)
                                                <option class="id-room"
                                                        value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label for="text7">Đăng ký dịch vụ</label>
                                        @foreach($services as $service)
                                            <input class="mdl-textfield__input" type="checkbox"
                                                   value="{{ $service->id }}" name="service_id[]"> {{ $service->name }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="number" id="size" name="deposited">
                                        <label class="mdl-textfield__label">Số tiền cọc</label>
                                    </div>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield txt-full-width">
                                        <label for="text7">Ngày bắt đầu</label>
                                        <input class="mdl-textfield__input" type="date" name="start_date">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <label class="mdl-textfield mdl-js-textfield txt-full-width">Ngày kết thúc</label>
                                    <div class="wr_input">
                                        <input class="mdl-textfield__input" type="date" name="end_date">
                                    </div>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <label class="mdl-textfield mdl-js-textfield txt-full-width">Mô tả</label>
                                    <div class="wr_input">
                                       <textarea class="mdl-textfield__input" rows="4" id="description"
                                                 name="description" style="padding: 5px; outline: none"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <label class="mdl-textfield mdl-js-textfield firm">Trạng thái</label>
                                    <select name="status" class="col-lg-6 form-control">
                                        <option value="1">Đang sử dụng</option>
                                        <option value="2">Chưa kích hoạt</option>
                                    </select>
                                </div>
                                <div class="col-lg-7 p-t-20">
                                    <label class="mdl-textfield mdl-js-textfield firm">Tìm người ở ghép</label>
                                    <input class="" type="checkbox" name="transplant">
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
                                    Thêm mới
                                </button>
                                <button type="button"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default"
                                        onclick="window.history.back()">
                                    Hủy
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
