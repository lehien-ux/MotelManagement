@extends("admin.redirect")
@section("content")
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Danh sách trả phòng</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        @include("admin.breadcrumb.home")
                        <li><a class="parent-item" href="#">Phòng trọ</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <!-- <li class="active">All Staffs</li> -->
                    </ol>
                </div>
            </div>
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
                                                            <a href="{{ route('contracts.confirm-return', ['id' => $contract->id]) }}" class="btn" style="color: red">
                                                                Duyệt
                                                            </a>
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
            <div style="text-align: center !important"> {{$contracts->links()}}</div>
        </div>
    </div>
@endsection
