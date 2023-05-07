@extends("admin.redirect")
@section("content")
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Danh sách phòng</div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-pills nav-pills-rose">
                <li class="nav-item tab-all">
                    <a class="nav-link active show"
                       href="{{route('room.customer.create')}}">
                        Thêm mới
                    </a>
                </li>
            </ul>
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
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
                                                <th class="center">Tên phòng</th>
                                                <th class="center">Người thuê</th>
                                                <th class="center">Số điện thoại</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($rooms as $room)
                                                <tr class="odd gradeX">
                                                    <td class="center">{{$room->number}}</td>
                                                    <td class="center">{{ $room->name ?? 'Phòng trống'  }}</td>
                                                    <td class="center">{{ $room->phone  }}</td>
                                                    <td class="center">
                                                        @if($room->name)
                                                            <a onclick="return confirm('Xóa người thuê khỏi phòng');"
                                                               href="{{ url("admin/room/$room->id/customer/$room->customer_id") }}"
                                                               class="btn btn-tbl-edit btn-xs">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
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
    </div>
@endsection
