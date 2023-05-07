@extends("admin.redirect")
@section("content")

<script>
function getRoom(idRoom) {
    const newAjax = $.ajax({
        type: 'GET',
        cache: false,
        url: "{{ route('customer.get.room.for.customer') }}",
        data: {
            "_token": '{{ csrf_token() }}'
        },
        success: function(data) {
            // console.log(data);
            $.each(data['data'], function(index, value) {
                globalKH = data['data'];
                // console.log(globalTaikhoan);
                const Selected = idRoom && idRoom == value['id'] ? 'selected' : '';
                var option_room = $("<option " + Selected + " data-city='" + value["id"] +
                    "' value='" +
                    value["id"] + "' id=" + value["id"] + " >" + value["id"] + "</option>");
                //alert(ac);
                option_room.appendTo(".id-room");
            });
        },
        error: function(accounts) {
            console.log('Lỗi...');
        }
    });
    return newAjax;
}

$(document).ready(function() {
    // nếu click vào button thêm sẽ hiển thị button thêm ở dưới modal và ẩn button edit
    $(".add_customer").click(function() {
        isAdded = true;
        $("#add").show();
        $("#edit").hide();
    })
    // ngược lại
    $(".edit_customer").click(function() { // muốn tìm kiếm nhanh dung ctrol + d nhé à mà phải bôi đen
        isAdded = false;
        $("#add").hide();
        $("#edit").show();
    })

    //select2
    function formatResultMulti(data) {
        var city = $(data.element).data('city');
        var classAttr = $(data.element).attr('class');
        var hasClass = typeof classAttr != 'undefined';
        classAttr = hasClass ? ' ' + classAttr : '';
        var $result = $(
            '<div class="row">' +
            '<div class="col-md-6 col-xs-6' + classAttr + '">' + data.text + '</div>' +
            '<div class="col-md-6 col-xs-6' + classAttr + '">' + city + '</div>' +
            '</div>'
        );
        return $result;
    }

    //
    $('.selector').select2({
        width: '100%',
        formatResult: formatResultMulti
    });
    $('.addCustomer').on('show.bs.modal', function(event) {
        if (isAdded) {
            modal = $(this);
            $('.remove-Invalid').removeClass('is-invalid');
            $('.remove-Invalid').removeClass('border-invalid');
            $('.validation-danger').removeClass('alert-danger');
            $('.remove-border').removeClass('Invalid-border');
            $('.validation-danger').addClass('d-none');
            // modal.find(".selector").select2('val', '');
            $('.form-control').val('');
            modal.find(".selector").select2().val('').trigger("change");

        }
    });

    $('.editCustomer').on('show.bs.modal', function(event) { // modal có class là editCustomer
        if (isAdded) {
            return;
        }
        // mấy cái thông báo lỗi
        $('.remove-Invalid').removeClass('is-invalid');
        $('.remove-Invalid').removeClass('border-invalid');
        $('.validation-danger').removeClass('alert-danger');
        $('.remove-border').removeClass('Invalid-border');
        $('.validation-danger').addClass('d-none');
        //
        id = $(event.relatedTarget).attr('data_id'); //lấy id của khách hàng cần edit
        modal = $(this);
        $.ajax({
            type: 'GET',
            cache: false,
            url: "{{ route('customer.get.id.customer') }}",
            data: {
                "_token": '{{ csrf_token() }}',
                "id": id
            },
            success: function(data) {
                var date_of_birth = moment(data["data"]["date_of_birth"]).format(
                    'YYYY-MM-DD');

                var room = data["data_room"]["room_id"];
                // var ngayketthuc = moment(data["data"]["ngayketthuc"]).format('YYYY-MM-DD');
                // var tienngoaite = Number(data["data"]["tienngoaite"]);
                // var thuengoaite = Number(data["data"]["thuengoaite"]);
                // var tienvnd = Number(data["data"]["tienvnd"]);
                // var thuevnd = Number(data["data"]["thuevnd"]);

                modal.find("#id_edit").val(data["data"][
                    "id"
                ]); //lấy id,name... câu truy vấn trả về
                modal.find("#name").val(data["data"]["name"]);
                modal.find("#id_card").val(data["data"]["id_card"]);
                modal.find("#job").val(data["data"]["job"]);
                modal.find("#address").val(data["data"]["address"]);
                modal.find("#date_of_birth").val(date_of_birth);
                modal.find("#email").val(data["data"]["email"]);
                modal.find("#phone").val(data["data"]["phone"]);
                modal.find("#sex").val(data["data"]["sex"]);
            },
            error: function(data) {
                console.log('An error occurred.');
                console.log(data);
            }
        });
    })

})
</script>

<div class="page-wrapper">

    <!-- start page container -->
    <div class="page-content">

        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Danh sách khách hàng</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    @include("admin.breadcrumb.home")
                    <li><a class="parent-item" href="">Khách hàng</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <!-- <li class="active">All Staffs</li> -->
                </ol>
            </div>
        </div>
        <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a data-toggle="modal" data-target=".addCustomer"
                    class="add_customer nav-link active show">
                    <i class="fa fa-plus-square">
                    </i> Thêm mới
                </a></li>
        </ul>
        <div class="contract-search-form">
            <form action="{{ route('customer.view') }}" method="get">
                <div class="card-body row">
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Tên người dùng</label>
                            <input class="mdl-textfield__input" type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Nghề nghiệp</label>
                            <input class="mdl-textfield__input" type="text" name="job" value="{{ old('job') }}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield mdl-js-textfield txt-full-width">Địa chỉ</label>
                            <input class="mdl-textfield__input" type="text" name="address" value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield txt-full-width">
                            <label>Ngày sinh</label>
                            <input class="mdl-textfield__input" type="date" name="date_of_birth"
                                value="{{ old('date_of_birth') }}">
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield txt-full-width">
                            <label>Giới tính</label>
                            <select name="sex" id="" class="mdl-js-textfield form-control form-control txt-full-width">
                                <option value="" {{ old('sex') == null ? 'selected' : '' }}></option>
                                <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Nữ</option>
                                <option value="1" {{ old('sex') == 1 ? 'selected' : '' }}>Nam</option>
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
        <div style="text-align: right">
            <a href="{{ route('customer.export') }}" class="btn btn-dark">Xuất file</a>
        </div>
        <hr>
        <hr>
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
                                                <th>ID</th>
                                                <th class="center"> HỌ VÀ TÊN</th>
                                                <th class="center">SỐ ĐIỆN THOẠI</th>
                                                <th class="center">Phòng đang ở</th>
                                                <th class="center">EMAIL</th>
                                                <th class="center"> NGÀY SINH</th>
                                                <th class="center"> NGHỀ NGHIỆP</th>
                                                <th class="center"> GIỚI TÍNH</th>
                                                <th class="center"> ĐỊA CHỈ</th>
                                                <th class="center">NGÀY THÊM</th>
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
                                                <td class="center">{{$item->phone}}</td>
                                                <td class="center">
                                                    {{$item->contract ? $item->contract->room->number : '' }}</td>
                                                <td class="center">{{$item->email}}</td>
                                                <td class="center">{{$item->date_of_birth}}</td>
                                                <td class="center">{{$item->job}}</td>
                                                <td class="center">{{$item->sex == 0 ? 'Nữ' : 'Nam'}}</td>
                                                <td class="center">{{$item->address}}</td>
                                                <td class="center">
                                                    {{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</td>
                                                <td class="center">
                                                    <a data-target=".editCustomer" data-toggle="modal"
                                                        class="btn btn-tbl-edit btn-xs edit_customer"
                                                        data-original-title="Sửa" data_id="{{$item->id}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href='{{URL::asset("admin/customer/delete/$item->id")}}'
                                                        data-toggle="tooltip"
                                                        onclick="return confirm('Xoá khách hàng {{$item->name}}?')"
                                                        title="" class="btn btn-tbl-delete btn-xs delete-confirm"
                                                        data-original-title="Xoá"><i class="fa fa-trash-o"></i></a>
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
        <div style="text-align: center !important"> {{$list->appends(request()->query())}}</div>
    </div>
    @include("admin.customer.add_customer")
    <!-- end footer -->
</div>
@endsection