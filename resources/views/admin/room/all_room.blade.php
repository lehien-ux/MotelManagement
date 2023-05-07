@extends("admin.redirect")
@section("content")
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Danh sách phòng trọ</div>
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
                <li class="nav-item tab-all"><a class="nav-link active show" href="{{route("room.add.room")}}">Thêm
                        mới</a></li>
                <!-- <li class="nav-item tab-all"><a class="nav-link" href="#tab2" data-toggle="tab">Grid View</a></li> -->
            </ul>
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
            <div class="contract-search-form">
                <form action="{{ route('room.view') }}" method="get">
                    <div class="card-body row">
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Số phòng</label>
                                <input class="mdl-textfield__input" type="text" name="number"
                                       value="{{ old('number') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Giá từ</label>
                                <input class="mdl-textfield__input" type="text" name="start_price"
                                       value="{{ old('start_price') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20">
                            <div
                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield mdl-js-textfield txt-full-width">Đến</label>
                                <input class="mdl-textfield__input" type="text" name="end_price"
                                       value="{{ old('end_price') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield txt-full-width">
                                <label>Trạng thái phòng</label>
                                <select name="status" id="" class="mdl-js-textfield txt-full-width form-control">
                                    <option value="" {{ old('status') == null ? 'selected' : '' }}></option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Chưa sử dụng</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Đã sử dụng</option>
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
                                                <th></th>
                                                <th class="center"> SỐ PHÒNG</th>
                                                <th class="center">GIÁ PHÒNG</th>
                                                <th class="center">KÍCH THƯỚC</th>
                                                <th class="center">TRẠNG THÁI</th>
                                                <th class="center">HÌNH ẢNH</th>
                                                <th class="center">THỜI GIAN</th>
                                                <th class="center"> Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                                <tr class="odd gradeX">
                                                    <td class="user-circle-img sorting_1">
                                                        {{$item->id}}
                                                    </td>
                                                    <td class="center">{{$item->number}}</td>
                                                    <td class="center">{{number_format($item->price)}}</td>
                                                    <td class="center">{{$item->size}}</td>
                                                    <td class="center">
                                                        @if($item->status == 1)
                                                            Đã sử dụng
                                                        @else
                                                            Chưa được sử dụng
                                                        @endif
                                                    </td>
                                                    <td class="center">
                                                        <img
                                                            src="{{ empty($item->images[0]) ? "" : url('upload/images/' . $item->images[0]->path) }}"
                                                            height="120"
                                                            width="120"></td>
                                                    <td class="center">{{$item->created_at}}</td>
                                                    <td>
                                                        <a href="{{ route('room.edit', ['id' => $item->id]) }}"
                                                           class="btn btn-tbl-edit btn-xs">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('room.delete', ['id' => $item->id]) }}"
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
                                <div style="text-align: center !important"> {{$list->appends(request()->query())}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end footer -->
    </div>
@endsection
