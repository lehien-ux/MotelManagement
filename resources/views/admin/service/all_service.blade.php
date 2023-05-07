@extends("admin.redirect")
@section("content")

<div class="page-wrapper">

    <!-- start page container -->
    <div class="page-content">

        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Danh sách dịch vụ</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    @include("admin.breadcrumb.home")
                    <li><a class="parent-item" href="#">Dịch vụ</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <!-- <li class="active">All Staffs</li> -->
                </ol>
            </div>
        </div>
        <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a class="nav-link active show" href="{{route("service.add.service")}}">Thêm
                    mới</a></li>
            <!-- <li class="nav-item tab-all"><a class="nav-link" href="#tab2" data-toggle="tab">Grid View</a></li> -->
        </ul>
        <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="card-head">
                                <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
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
                                        <!-- <div class="row">
                                                <div class=" col-sm-12 col-md-6">
                                                    <form class="search-form-opened" action="#" method="GET">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Search..."
                                                                name="query">
                                                            <span class="input-group-btn search-btn">
                                                                <a href="javascript:;" class="btn submit">
                                                                    <i class="icon-magnifier"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div> -->
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="center">Tên dịch vụ</th>
                                                <th class="center">Giá</th>
                                                <th class="center"> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list as $item)
                                            <tr class="odd gradeX">
                                                <td class="user-circle-img sorting_1">
                                                    {{$item->id}}
                                                </td>
                                                <td class="center">{{$item->name}}</td>
                                                <td class="center">{{ number_format($item->price) }}
                                                    {{ $item->unit_price }}</td>
                                                <td class="center">
                                                    <a href="{{URL::to('admin/service/edit')}}/{{$item->id}}"
                                                        class="btn btn-tbl-edit btn-xs">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{URL::to('admin/service/delete')}}/{{$item->id}}"
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

    <!-- end footer -->
</div>
@endsection