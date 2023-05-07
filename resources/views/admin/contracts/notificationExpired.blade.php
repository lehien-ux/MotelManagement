<h3>Hơp đồng thuê phòng</h3>
<br>
<br>
<h3>Hợp đồng của quý khách sắp hết hạn vào ngày: {{ $contract->end_date }}</h3>
<table cellpadding="1" cellspacing="1">
    <tr>
        <td colspan="3">Tên người thuê</td>
        <td colspan="3">{{ $contract->customer->name }}</td>
    </tr>
    <tr>
        <td colspan="3">Số phòng</td>
        <td colspan="3">{{ $contract->room->number }}</td>
    </tr>
    <tr>
        <td colspan="3">Số tiền phòng/tháng</td>
        <td colspan="3">{{ number_format($contract->room->price) }} vnd</td>
    </tr>
    <tr>
        <td colspan="3">Tiền đặt cọc</td>
        <td colspan="3">{{ number_format($contract->deposited) }} vnd</td>
    </tr>
    <tr>
        <td colspan="3">Ngày bắt đầu</td>
        <td colspan="3">{{ $contract->start_date }}</td>
    </tr>
    <tr>
        <td colspan="3">Ngày kết thúc</td>
        <td colspan="3">{{ $contract->end_date }}</td>
    </tr>
</table>
