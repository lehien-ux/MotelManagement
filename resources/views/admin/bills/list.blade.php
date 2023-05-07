@extends("admin.redirect")
@section("content")
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Danh sách hóa đơn</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        @include("admin.breadcrumb.home")
                        <li><a class="parent-item" href="#">Phòng trọ</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <!-- <li class="active">All Staffs</li> -->
                    </ol>
                </div>
            </div>
            <ul class="nav nav-pills nav-pills-rose">
                <li class="nav-item tab-all"><a class="nav-link active show" href="{{route("bills.create")}}">Thêm
                        mới</a></li>
            </ul>
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
            <div class="contract-search-form">
                <form action="{{ route('bills.list') }}" method="get">
                    <div class="card-body row">
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Số phòng</label>
                                <div class="room-id-wrapper">
                                    <select name="room_id" id="search-room-id" class="form-control">
                                        <option value="">--none--</option>
                                        @foreach($rooms as $room)
                                            <option class="id-room"
                                                    value="{{ $room->id }}"
                                                {{ old('room_id') == $room->id ? 'selected' : '' }}
                                            >
                                                {{ $room->number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Tên người dùng</label>
                                <input class="mdl-textfield__input" type="text" name="customer"
                                       value="{{ old('customer') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Chọn tháng</label>
                                <select name="month" class="form-control" id="">
                                    <option value=""></option>
                                    @foreach(\App\Enums\Constant::MONTH as $key => $item)
                                        <option value="{{ $key }}" {{ old('month') == $key ? 'selected':'' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 p-t-20 text-center">
                            <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
                                Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-content tab-space">
                <div class="tab-pane active show" id="tab1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <button id="panel-button"
                                            class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                            data-upgraded=",MaterialButton">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                        data-mdl-for="panel-button">
                                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                        </li>
                                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something
                                            else here
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body ">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                               id="example4">
                                            <thead>
                                            <tr>
                                                <th class="center">Số phòng</th>
                                                <th class="center">Tên khách hàng</th>
                                                <th class="center">Số tiền đã đóng</th>
                                                <th class="center">Tổng tiền</th>
                                                <th class="center">Ngày đóng</th>
                                                <th class="center">Từ ngày</th>
                                                <th class="center">Đến ngày</th>
                                                <th class="center">Số điện thoại</th>
                                                <th class="center"> Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bills as $bill)
                                                <tr class="odd gradeX">
                                                    <td class="center">
                                                        {{ $bill->room->number ?? '' }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $bill->customer->name ?? ''}}
                                                    </td>
                                                    <td class="center">
                                                        {{ number_format($bill->deposited) }} vnd
                                                    </td>
                                                    <td class="center">
                                                        {{ number_format($bill->total_price) }} vnd
                                                    </td>
                                                    <td class="center">
                                                        {{ $bill->payment_at == null ? 'Chưa đóng tiền' : $bill->payment_at }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $bill->start_date }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $bill->end_date }}
                                                    </td>
                                                    <td class="center">
                                                        {{ $bill->phone }}
                                                    </td>
                                                    <td class="center">
                                                        <a href="{{ route('bills.update', ['id' => $bill->id]) }}"
                                                           class="btn btn-tbl-edit btn-xs">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('bills.delete', ['id' => $bill->id]) }}"
                                                           onclick="return confirm('Bạn có muốn xóa không')"
                                                           class="btn btn-tbl-delete btn-xs">
                                                            <i class="fa fa-trash-o "></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center !important"> {{$bills->appends(request()->query())}}</div>
    </div>
@endsection
