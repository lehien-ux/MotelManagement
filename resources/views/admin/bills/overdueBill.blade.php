<h3>Thanh toán hóa đơn</h3>

<p>Bạn chưa thanh toán hóa đơn:</p>
<?php $i = 1; ?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>STT</th>
        <th colspan="2">Phòng:</th>
        <th colspan="2">Từ ngày:</th>
        <th colspan="2">Đến ngày:</th>
        <th colspan="2">Tổng tiền:</th>
    </tr>
    @foreach($customers->bills as $bill)
        <tr>
            <td>{{ $i++ }}</td>
            <td colspan="2">{{ $bill->room->number }}</td>
            <td colspan="2">{{ $bill->start_date }}</td>
            <td colspan="2">{{ $bill->end_date }}</td>
            <td colspan="2">{{ number_format($bill->total_price) }} vnd</td>
        </tr>
    @endforeach
</table>
<hr>
