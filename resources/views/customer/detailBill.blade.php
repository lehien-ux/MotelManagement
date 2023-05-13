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
                <td>Thời gian sử dụng</td>
                <td>{{ \Carbon\Carbon::parse($bill->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($bill->end_date)->format('d/m/Y') }}</td>
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
        <?php
            use Carbon\Carbon;
            $total = 0;
            $date1 = Carbon::parse($bill->start_date);
            $date2 = Carbon::parse($bill->end_date);
            $startMonthDays = (int) $date1->format('t');
            $endMonthDays = (int) $date2->format('t');
            $daysInStartMonth = $startMonthDays - $date1->format('j') + 1;
            $daysInEndMonth = $date2->format('j');
            $fullMonths = ($date2->format('Y') - $date1->format('Y')) * 12 + ($date2->format('n') - $date1->format('n') - 1);
            $partialStartMonth = $daysInStartMonth / $startMonthDays;
            $partialEndMonth = $daysInEndMonth / $endMonthDays;   
            $monthsSpanned = $fullMonths + $partialStartMonth + $partialEndMonth;
        ?>
        <table class="table">
            <tr class="service-usage-header">
                <td>Tên dịch vụ</td>
                <td>Đơn giá</td>
                <td>Số lượng sử dụng</td>
                <td>Thành tiền</td>
            </tr>
            @foreach($bill->detailBills as $detailBill)
                <tr>
                    <td>{{ $detailBill->service->name }}</td>
                    <td>{{ number_format($detailBill->service->price) }} ({{ $detailBill->service->unit_price }})</td>
                    <td>
                        {{
                            $detailBill->service->service_type == 2 
                            ? ''
                            : $detailBill->usage . ' (' . $detailBill->service->unit_price . ')'
                        }}
                    </td>
                    <td>
                    {{ 
                        $detailBill->service->service_type == 2
                        ? number_format(round($monthsSpanned * $detailBill->service->price, 2))
                        : number_format($detailBill->usage * $detailBill->service->price) 
                    }}
                    </td>  
                    <?php 
                    $total += $detailBill->service->service_type == 2
                    ? $monthsSpanned * $detailBill->service->price
                    : $detailBill->usage * $detailBill->service->price;
                    ?> 
                </tr>
            @endforeach
            <tr>
                <td>Tiền phòng</td>
                <td>{{ number_format($bill->room->price) }} vnđ</td>
                <td></td>
                <td>{{ number_format(round($bill->room->price * $monthsSpanned, 2)) }}</td>

                <?php 
                $total += $bill->room->price * $monthsSpanned;
                ?>
            
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Tồng tiền đã làm tròn</b><br>
                <i>Gốc: {{ number_format($total) }}</i>
                </td>
                <td><b>{{ number_format($bill->total_price) }}<b> </td>
            </tr>
        </table>
        @if(!$bill->status == \App\Enums\Constant::PAID)
            <a href="{{ route('customer.bills-payment', ['id' => $bill->id]) }}" class="btn btn-primary">Thanh toán</a>
        @endif
    </div>
@endsection
