@extends("customer.master")
@section("content")
    <div class="bill-content">
        @if(session('message'))
            {{ session('message') }}
        @endif
        @if($bills)
            <h3>Danh sách hóa đơn</h3>
            <table class="table">
                <thead>
                <tr>
                    <th class="center">Số phòng</th>
                    <th class="center">Tên khách hàng</th>
                    <th class="center">Số tiền đã đóng</th>
                    <th class="center">Tổng tiền</th>
                    <th class="center">Ngày đóng</th>
                    <th class="center">Hóa đơn tháng</th>
                    <th class="center">Số điện thoại</th>
                    <th class="center">Chi tiết</th>
                    <th class="center">Thanh toán</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bills as $bill)
                    <tr class="odd gradeX">
                        <td class="center">
                            {{ $bill->room->number ?? '' }}
                        </td>
                        <td class="center">
                            {{ $bill->customer->name ?? ''}}
                        </td>
                        <td class="center">
                            {{ number_format($bill->deposited) }} vnd
                        </td>
                        <td class="center">
                            {{ number_format($bill->total_price) }} vnd
                        </td>
                        <td class="center">
                            {{ $bill->payment_at == null ? 'Chưa đóng tiền' : $bill->payment_at }}
                        </td>
                        <td class="center">
                            {{ \Carbon\Carbon::parse($bill->month)->format("m-Y") }}
                        </td>
                        <td class="center">
                            {{ $bill->customer->phone }}
                        </td>
                        <td class="center">
                            <a href="{{ route('customer.bills-detail', ['id' => $bill->id]) }}"
                               class="btn btn-tbl-edit btn-xs">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td>
                            @if(!$bill->status == \App\Enums\Constant::PAID)
                                <a href="{{ route('customer.bills-payment', ['id' => $bill->id]) }}"
                                   class="btn btn-primary">Thanh toán</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>Bạn chưa có hóa đơn</h3>
        @endif
    </div>
@endsection
