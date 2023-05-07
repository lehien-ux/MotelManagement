@extends("admin.redirect")
@section("content")
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">CẬP NHẬT KHÁCH HÀNG</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    @include("admin.breadcrumb.home")
                    <li><a class="parent-item" href="">Staff</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Staff Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Cập nhật thông tin khách hàng</header>
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
                    <form action="{{route('customer.update',['id' => $id])}}" method="post">
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
                                    <input class="mdl-textfield__input" type="text" id="txtFirstName" name="name"
                                        value="{{$customer->name}}">
                                    <label class="mdl-textfield__label">Họ và tên</label>
                                </div>
                            </div>

                            <div class="col-lg-6 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="designation" name="job"
                                        value="{{$customer->job}}">
                                    <label class="mdl-textfield__label">Nghề nghiệp</label>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" style="margin-top:15px;" type="date"
                                        id="dateOfBirth" name="date_of_birth" value="{{$customer->date_of_birth}}">
                                    <label class="mdl-textfield__label"> Ngày sinh</label>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">

                                <div class="mdl-textfield mdl-js-textfield txt-full-width">
                                    <label class="mdl-textfield__label" for="text7">Địa chỉ</label>
                                    <textarea class="mdl-textfield__input" rows="4" id="text7"
                                        name="address">{{$customer->address}}</textarea>

                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
                                    Cập nhật
                                </button>
                                <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">
                                    Hủy
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
