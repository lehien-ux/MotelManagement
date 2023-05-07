@extends("customer.master")
@section("content")
    <div class="contract-customer">
        @if(!$contract)
            <h3>Bạn không có hợp đồng</h3>
        @else
            <h3>Thông tin người thuê</h3>
            <table class="table">
                <tr>
                    <td>Số phòng</td>
                    <td>{{ $contract->room->number }}</td>
                </tr>
                <tr>
                    <td>Số tiền đặt cọc</td>
                    <td>{{ number_format($contract->deposited) }} vnđ</td>
                </tr>
                <tr>
                    <td>Giá phòng</td>
                    <td>{{ number_format($contract->room->price) }} vnđ</td>
                </tr>
                <tr>
                    <td>Ngày bắt đầu hợp đồng</td>
                    <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>Ngày kết thúc</td>
                    <td>{{ \Carbon\Carbon::parse($contract->end_date)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>Tên người thuê</td>
                    <td>{{ $contract->customer->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $contract->customer->email }}</td>
                </tr>
                <tr>
                    <td>Sinh nhật</td>
                    <td>{{ $contract->customer->date_of_birth }}</td>
                </tr>
                <tr>
                    <td>CMT/Thẻ căn cước</td>
                    <td>{{ $contract->customer->id_card }}</td>
                </tr>
                <tr>
                    <td>Giới tính</td>
                    <td>{{ $contract->customer->sex == 1 ? 'Nam' : 'Nữ' }}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{ $contract->customer->address }}</td>
                </tr>
                <tr>
                    <td>Nghề nghiệp</td>
                    <td>{{ $contract->customer->job }}</td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>{{ $contract->customer->phone }}</td>
                </tr>
                <tr>
                    <td>Cập nhật trạng thái tìm người ở ghép</td>
                    <td>
                        <a href="{{ route('rooms.transplant-update', ['id' => $contract->room->id]) }}" class="btn btn-primary">
                            {{ $contract->room->is_transplant == \App\Enums\Constant::TRANSPLANT ? 'Tắt' : 'Bật' }}
                        </a>
                    </td>
                </tr>
            </table>
            <div>
                <a onclick="return confirm('Nếu trả phòng trước hạn họp đồng bạn sẽ không được trả tiền cọc')"
                   href="{{ route('rooms.return', ['id' => $contract->id]) }}"
                   class="btn btn-primary">Trả phòng</a>
            </div>
        @endif
    </div>
@endsection
