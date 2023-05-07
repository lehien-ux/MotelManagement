@extends("admin.redirect")
@section("content")
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">CẬP NHẬT DỊCH VỤ</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    @include("admin.breadcrumb.home")
                    <li><a class="parent-item" href="">Dịch vụ</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Cập nhật dịch vụ</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Thông tin dịch vụ</header>
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
                    <form action="{{route('service.update',['id' => $id])}}" method="post">
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

                            <div class="col-lg-12 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="txtFirstName" name="name"
                                        value="{{$service->name}}">
                                    <label class="mdl-textfield__label">Tên dịch vụ</label>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="txtFirstName" name="price"
                                           value="{{$service->price}}">
                                    <label class="mdl-textfield__label">Giá</label>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="txtFirstName" name="unit_price"
                                           value="">
                                    <select name="unit_price" id="" class="form-control" required>
                                        <option value="1 tháng" {{$service->unit_price == '1 tháng' ? 'selected' : ''}}>Tháng</option>
                                        <option value="Kw/h" {{$service->unit_price == 'Kw/h' ? 'selected' : '' }}>Kw/h</option>
                                        <option value="1m3" {{$service->unit_price == '1m3' ? 'selected' : '' }}>1m3</option>
                                    </select>
                                    <label class="mdl-textfield__label">Giá</label>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
                                    Cập nhật
                                </button>
                                <a href="{{route("service.view")}}">
                                    <button type="button"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">
                                        Hủy
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
