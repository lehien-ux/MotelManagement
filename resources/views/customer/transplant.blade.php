@extends("customer.master")
@section("content")
    <div class="transplant-wrap">
        <div class="transplant-rooms">
            <div class="details">
                <h3 style="text-align: center">Thông tin phòng và chủ phòng</h3>
                <table class="table table-stripe">
                    <tr>
                        <td>Tên phòng</td>
                        <td>{{ $room->number }}</td>
                    </tr>
                    <tr>
                        <td>Hình ảnh</td>
                        <td>
                            <img src="{{ url('upload/images/' . $room->images[0]->path) }}" alt="" />
                        </td>
                    </tr>
                    <tr>
                        <td>Giá</td>
                        <td>{{ $room->price }}</td>
                    </tr>
                    <tr>
                        <td>Kích thước</td>
                        <td>{{ $room->size }}</td>
                    </tr>
                    @if($room->customers)
                        <tr>
                            <td>Chủ phòng</td>
                            <td>{{ $room->customers[0]->name }}</td>
                        </tr>
                        <tr>
                            <td>Giới tính</td>
                            <td>{{ $room->customers[0]->sex == 1 ? 'Nam' : 'Nữ' }}</td>
                        </tr>
                        <tr>
                            <td>Ngày sinh</td>
                            <td>{{ $room->customers[0]->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoai</td>
                            <td>{{ $room->customers[0]->phone }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
