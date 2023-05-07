@extends("customer.master")
@section("content")
    <div class="contract-customer">
        @if(!$contracts)
            <h3>Bạn không có hợp đồng</h3>
        @else
            <h3>Danh sách hợp đồng</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="center">SỐ PHÒNG</th>
                    <th class="center">Số tiền đặt cọc</th>
                    <th class="center">Ngày bắt đầu</th>
                    <th class="center">Ngày kết thúc</th>
                    <th class="center">Trạng thái</th>
                    <th class="center"> Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contracts as $contract)
                    <tr class="odd gradeX">
                        <td class="center">
                            {{ $contract->room->number ?? '' }}
                        </td>
                        <td class="center">
                            {{ number_format($contract->deposited) }} vnd
                        </td>
                        <td class="center">
                            {{ $contract->start_date }}
                        </td>
                        <td class="center">
                            {{ $contract->end_date }}
                        </td>
                        <td class="center">
                            @if($contract->status == 0)
                                <span>Đã kết thúc</span>
                            @elseif($contract->status == 1)
                                <span>Đang sử dụng</span>
                            @elseif($contract->status == 2)
                                <span>Đang chờ</span>
                            @else
                                <span>Chờ duyệt</span>
                            @endif
                        </td>
                        <td class="center">
                            <a href="{{ route('customer.contract-show', ['id' => $contract->id]) }}"
                               class="btn btn-tbl-edit btn-xs">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
