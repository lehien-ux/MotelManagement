<table>
    <thead>
    <tr>
        <th>Tên người thuê</th>
        <th>Email</th>
        <th>Ngày sinh</th>
        <th>Số điện thoại</th>
        <th>Giới tính</th>
        <th>Chứng minh thư</th>
        <th>Địa chỉ</th>
        <th>Nghề nghiệp</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <th>{{ $customer->name }}</th>
            <th>{{ $customer->email }}</th>
            <th>{{ $customer->date_of_birth }}</th>
            <th>{{ $customer->phone }}</th>
            <th>{{ $customer->sex == 0 ? 'Nữ' : 'Nam' }}</th>
            <th>{{ $customer->id_card }}</th>
            <th>{{ $customer->address }}</th>
            <th>{{ $customer->job }}</th>
        </tr>
    @endforeach
    </tbody>
</table>
