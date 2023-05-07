@extends("admin.redirect")
@section("content")
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">THÊM PHÒNG TRỌ</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        @include("admin.breadcrumb.home")
                        <li><a class="parent-item" href="">Phòng trọ</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Thêm mới phòng trọ</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Thông tin phòng</header>
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
                        <form action="{{route("room.save.room")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if (session('message'))
                                <div class="alert alert-success help-block">{{session('message')}}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger help-block">{{session('error')}}</div>
                            @endif
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
                                        <input class="mdl-textfield__input" type="text" id="number" name="number">
                                        <label class="mdl-textfield__label">Số phòng</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" id="price" name="price">
                                        <label class="mdl-textfield__label">Giá phòng</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input class="mdl-textfield__input" type="text" id="size" name="size">
                                        <label class="mdl-textfield__label">Kích thước</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield txt-full-width">
                                        <label for="text7" style="margin-bottom: 5px; color: #AAAAAA !important;
    font-size: 13px !important;">Mô
                                            tả</label>
                                        <textarea class="mdl-textfield__input" rows="4" id="description"
                                                  name="description"></textarea>
                                    </div>
                                </div>
{{--                                <div class="col-lg-6 p-t-20">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputPassword1" style="color: #AAAAAA;font-size: 13px">Hiển--}}
{{--                                            thị</label>--}}
{{--                                        <select name="status" class="form-control input-sm m-bot15">--}}
{{--                                            <option value="1">Hiển thị</option>--}}
{{--                                            <option value="0">Ẩn</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-lg-12 p-t-20">
                                    <label class="control-label col-md-3">Tải hình ảnh phòng</label>
                                    <div class="wr_input">
                                        <input
                                            type="file" name="images[]" required=""
                                            id="images"
                                            accept="image/x-png,image/gif,image/jpeg,image/jpg"
                                            multiple
                                        >
                                    </div>
                                    <div id="preview"></div>
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
