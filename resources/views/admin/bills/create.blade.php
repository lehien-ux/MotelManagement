@extends("admin.redirect")
@section("content")
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Hóa đơn</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        @include("admin.breadcrumb.home")
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Thêm mới hóa đơn</header>
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
                        <form action="{{route('bills.handle-create')}}"
                              id="bills-form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
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
                                            <select name="room_id" id="room_id" class="form-control" required>
                                                <option value="" disabled selected hidden>Chọn phòng</option>
                                                @foreach($rooms as $room)
                                                    <option class="id-room"
                                                            value="{{ $room->room->id }}">
                                                        {{ $room->room->number }}
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{ $room->room->status == 1 ? ' Đang sử dụng' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        Tên khách hàng:
                                        <label id="customer-label"></label>
                                        <input type="hidden" name="customer_id" class="bill-customer-id">
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div>Ngày bắt đầu</div>
                                        <input class="mdl-textfield__input" type="date" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div>Ngày kết thúc</div>
                                        <input class="mdl-textfield__input" type="date" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 detail-bills">
                                    <div class="col-lg-6 p-t-20">
                                        <label class="mdl-color--red-50">Nhập dịch vụ đã đăng ký</label>
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            @foreach($services as $service)
                                                @if($service->service_type == 2)
                                                    <label class="col-lg-6">{{ $service->name }} ({{ $service->price }}
                                                        vnd
                                                        / {{ $service->unit_price }})</label>
                                                    <input
                                                        type="checkbox" name="{{ $service->id }}"
                                                        disabled
                                                        class="col-lg-5 check-service">
                                                    <br>
                                                @else
                                                    <label>{{ $service->name }} ({{ $service->price }}vnd
                                                        / {{ $service->unit_price }})</label>
                                                    <input
                                                        class="mdl-textfield__input services form-control remove-Invalid"
                                                        type="number"
                                                        placeholder="Số lượng sử dụng"
                                                        value=""
                                                        name="{{ $service->id }}"
                                                        disabled
                                                        required
                                                    >
                                                    <br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label for="text7">Tiền phòng: </label>
                                            <div id="room-price">

                                            </div>
                                            <input type="hidden" id="room_price" name="room_price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="create-bill-btn mdl-js-ripple-effect m-b-10 m-r-20 btn btn-pink">
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
