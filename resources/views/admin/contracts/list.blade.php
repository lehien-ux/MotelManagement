@extends("admin.redirect")
@section("content")
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Danh sách hợp đồng</div>
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
                <li class="nav-item tab-all"><a class="nav-link active show" href="{{route("contracts.create")}}">Thêm
                        mới</a></li>
            </ul>
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
            <div class="contract-search-form">
                <form action="{{ route('contracts.list') }}" method="get">
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
                        </div>
{{--                        <div class="col-lg-4 p-t-20">--}}
{{--                            <div class="mdl-textfield mdl-js-textfield txt-full-width">--}}
{{--                                <label>Ngày bắt đầu</label>--}}
{{--                                <input class="mdl-textfield__input" type="date" name="start_date"--}}
{{--                                       value="{{ old('start_date') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 p-t-20">--}}
{{--                            <div class="mdl-textfield mdl-js-textfield txt-full-width">--}}
{{--                                <label>Ngày kết thúc</label>--}}
{{--                                <input class="mdl-textfield__input" type="date" name="end_date"--}}
{{--                                       value="{{ old('end_date') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-3 p-t-20">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="" {{ old('status') == null ? 'selected' : '' }}></option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Đã hết hạn</option>
                                <option value="1" {{ old('status') == \App\Enums\Constant::CONTRACT_ACTIVE ? 'selected' : '' }}>Đang sử dụng</option>
                                <option value="2" {{ old('status') == \App\Enums\Constant::CONTRACT_PENDING ? 'selected' : '' }}>Đang chờ</option>
                                <option value="3" {{ old('status') == \App\Enums\Constant::WAIT_ADMIN_CONFIRM ? 'selected' : '' }}>Chờ duyệt</option>
                            </select>
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
            <hr>
            <hr>
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
                                                <th class="center">SỐ PHÒNG</th>
                                                <th class="center">Tên khách hàng</th>
                                                <th class="center">Số tiền đặt cọc</th>
                                                <th class="center">Mô tả</th>
                                                <th class="center">Ngày bắt đầu</th>
                                                <th class="center">Ngày kết thúc</th>
                                                <th class="center">Trạng thái</th>
                                                <th class="center"> Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contracts as $contract)
                                                @if($contract->customer)
                                                    <tr class="odd gradeX">
                                                        <td class="center">
                                                            {{ $contract->room->number ?? '' }}
                                                        </td>
                                                        <td class="center">
                                                            {{ $contract->customer->name ?? ''}}
                                                        </td>
                                                        <td class="center">
                                                            {{ number_format($contract->deposited) }} vnd
                                                        </td>
                                                        <td class="center">
                                                            {!! $contract->description !!}
                                                        </td>
                                                        <td class="center">
                                                            {{ $contract->start_date }}
                                                        </td>
                                                        <td class="center">
                                                            {{ $contract->end_date }}
                                                        </td>
                                                        <td class="center">
                                                            @if($contract->status == 0)
                                                                <span>Đã kết thúc</span>
                                                            @elseif($contract->status == 1)
                                                                <span>Đang sử dụng</span>
                                                            @elseif($contract->status == 2)
                                                                <span>Đang chờ</span>
                                                            @else
                                                                <span>Chờ duyệt</span>
                                                            @endif
                                                        </td>
                                                        <td class="center">
                                                            <a href="{{ route('contracts.update', ['id' => $contract->id]) }}"
                                                               class="btn btn-tbl-edit btn-xs">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="{{ route('contracts.delete', ['id' => $contract->id]) }}"
                                                               onclick="return confirm('Bạn có muốn xóa không')"
                                                               class="btn btn-tbl-delete btn-xs">
                                                                <i class="fa fa-trash-o "></i>
                                                            </a>
                                                            <a href="{{ route('contracts.export', ['id' => $contract->id]) }}">
                                                                Xuất file
                                                            </a>
                                                            @if($contract->status == \App\Enums\Constant::WAIT_ADMIN_CONFIRM)
                                                                <a href="{{ route('contracts.confirm', ['id' => $contract->id]) }}" class="btn" style="color: red">
                                                                    Duyệt
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
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
            <div style="text-align: center !important"> {{$contracts->appends(request()->query())}}</div>
        </div>
    </div>
@endsection
