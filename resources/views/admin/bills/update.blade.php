@extends("admin.redirect")
@section("content")
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Cập nhật hóa đơn</div>
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
                            <header>Thông tin hóa đơn</header>
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
                        <form action="{{route('bills.handle-update', ['id' => $bill->id])}}"
                              id="bills" method="post" enctype="multipart/form-data">
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
                                                    <option
                                                        class="id-room"
                                                        value="{{ $room->id }}"
                                                        {{ $room->id == $bill->room_id ? 'selected' : '' }}
                                                    >
                                                        {{ $room->number }}
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{ $room->status == 1 ? ' Đang sử dụng' : '' }}
                                                    </option>
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
                                                    <option class="customer"
                                                            value="{{ $customer->id }}"
                                                        {{ $customer->id == $bill->customer_id ? 'selected' : '' }}
                                                    >
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div>Ngày bắt đầu</div>
                                        <input class="mdl-textfield__input" type="date" value="{{ $bill->start_date }}" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div>Ngày kết thúc</div>
                                        <input class="mdl-textfield__input" type="date" value="{{ $bill->end_date }}" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="number" id="size"
                                               name="deposited" value="{{ $bill->deposited ? $bill->deposited : '' }}">
                                        <label class="mdl-textfield__label">Số tiền cần đóng</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 detail-bills">
                                    <div class="col-lg-6 p-t-20">
                                        <label class="mdl-color--red-50">Nhập dịch vụ đã đăng ký</label>
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            @foreach($services as $service)
                                                @if($service->service_type == 2)
                                                    <label>{{ $service->name }} ({{ $service->price }}
                                                        vnd/{{ $service->unit_price }})</label>
                                                    <input
                                                        type="checkbox" name="{{ $service->id }}"
                                                        data-price="{{ $service->price }}"
                                                        class="col-lg-5 check-service"
                                                        @if(isset($useService[$service->id]))
                                                            {{ $useService[$service->id]['usage'] == 1 ? 'checked' : '' }}
                                                        @endif
                                                    >
                                                    <br>
                                                @else
                                                    <label>{{ $service->name }} ({{ $service->price }}vnd
                                                        / {{ $service->unit_price }})</label>
                                                    <input
                                                        class="mdl-textfield__input services form-control remove-Invalid"
                                                        type="number"
                                                        placeholder="Số lượng sử dụng"
                                                        value="{{ isset($useService[$service->id]) ? $useService[$service->id]['usage'] : '' }}"
                                                        name="{{ $service->id }}"
                                                        data-price="{{ $service->price }}"
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
                                                {{ number_format($bill->room->price) }} vnd
                                            </div>
                                            <input type="hidden" id="room_price" name="room_price"
                                                   value="{{ $bill->room->price }}">
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="mdl-textfield mdl-js-textfield txt-full-width">
                                            <label class="mdl-color-text--red">Tổng tiền: </label>
                                            <input type="hidden" id="total-price" name="total_price">
                                            <div class="total-price">
                                                {{ number_format($bill->total_price) }} vnd
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
                                    Cập nhật
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
