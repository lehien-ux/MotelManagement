@extends("customer.master")
@section("content")
    <div class="detail-bill-content">
        <h3>Chi tiết hóa đơn</h3>
        <table class="table">
            <tr>
                <td>Tên phòng</td>
                <td>{{ $bill->room->number }}</td>
            </tr>
            <tr>
                <td>Số tiền cần thanh toán</td>
                <td>{{ number_format($bill->total_price) }} vnđ</td>
            </tr>
            <tr>
                <td>Tháng</td>
                <td>{{ \Carbon\Carbon::parse($bill->month)->format('m-Y') }}</td>
            </tr>
            <tr>
                <td>Trạng thái</td>
                <td>{{ $bill->status == \App\Enums\Constant::PAID ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
            </tr>
            <tr>
                <td>Ngày thanh toán</td>
                <td>{{ $bill->payment_at ?? 'Chưa thanh toán' }}</td>
            </tr>
            <tr>
                <td>Tên phòng</td>
                <td>{{ $bill->room->number }}</td>
            </tr>
        </table>
        <h3>Danh sách dịch vụ</h3>
        <table class="table">
            <tr class="service-usage-header">
                <td>Tên dịch vụ</td>
                <td>Đơn giá</td>
                <td>Số lượng sử dụng</td>
                <td>Thành tiền</td>
            </tr>
            <?php $total = $bill->room->price; ?>
            @foreach($bill->detailBills as $detailBill)
                <tr>
                    <td>{{ $detailBill->service->name }}</td>
                    <td>{{ number_format($detailBill->service->price) }} ({{ $detailBill->service->unit_price }})</td>
                    <td>
                        {{
                            $detailBill->usage == 1 ? $detailBill->usage . ' tháng' : $detailBill->usage . ' ' . $detailBill->service->unit_price
                        }}
                    </td>
                    <td>{{ number_format($detailBill->usage * $detailBill->service->price) }}</td>
                    <?php $total += $detailBill->usage * $detailBill->service->price ?>
                </tr>
            @endforeach
            <tr>
                <td>Tiền phòng</td>
                <td>{{ number_format($bill->room->price) }} vnđ</td>
                <td>1 tháng</td>
                <td>{{ number_format($bill->room->price) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Tồng tiền</td>
                <td>{{ number_format($total) }}</td>
            </tr>
        </table>
        @if(!$bill->status == \App\Enums\Constant::PAID)
            <a href="{{ route('customer.bills-payment', ['id' => $bill->id]) }}" class="btn btn-primary">Thanh toán</a>
        @endif
    </div>
@endsection
