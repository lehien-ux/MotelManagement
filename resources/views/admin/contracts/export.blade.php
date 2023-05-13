<h1>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h1>
<h3>Độc lập – Tự do – Hạnh phúc</h3>
<h2>HỢP ĐỒNG THUÊ PHÒNG TRỌ</h2>
<br>
<p>Hôm nay, ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}. Chúng tôi ký tên dưới đây gồm có:</p>
<br>
<h4>BÊN CHO THUÊ PHÒNG TRỌ (gọi tắt là Bên A):</h4>
<p>Ông/bà (tên chủ hợp đồng): Lê Thị Hiền</p>
<p>CMND/CCCD số: 030098000201 </p>
<p>Thường trú tại: Số 28, ngõ 106/72, đường Phú Minh, Văn Trì, Minh Khai, Bắc Từ Liêm, Hà Nội </p>
<p>Số điện thoại: 0332583831</p>
<br>
<h4>BÊN THUÊ PHÒNG TRỌ (gọi tắt là Bên B):</h4>
<p>Ông/bà: {{ $contract->customer->name }}
<p>CMND/CCCD số: {{ $contract->customer->id_card }} </p>
<p>Thường trú tại: {{ $contract->customer->address }}</p>
<p>Số điện thoại: {{ $contract->customer->phone }}</p>

<p>Sau khi thỏa thuận, hai bên thống nhất như sau:</p>

<h4>1. Nội dung thuê phòng trọ</h4>
<p>Bên A cho Bên B thuê 01 phòng trọ số {{ $contract->room->number }}
     địa chỉ tại căn nhà số 18, ngõ 73, đường Phú Minh, Văn Trì, Minh Khai, Bắc Từ Liêm, Hà Nội
    <br> Với thời hạn từ {{ $contract->start_date }} đến {{ $contract->end_date }}
     <br> Giá thuê: {{ number_format($contract->room->price) }} vnd.
       (chưa bao gồm chi phí: điện sinh hoạt, nước, dịch vụ)</p>
<table>
@foreach($services as $service)
<tr>
    <td colspan="3">{{ $service -> name }}</td>
    <td colspan="3">{{ $service -> price }} {{ $service -> unit_price }} </td>
</tr>
@endforeach
</table>
<h4>2. Trách nhiệm Bên A</h4>
<p>Đảm bảo căn nhà cho thuê không có tranh chấp, khiếu kiện.</p>
<p>Đăng ký với chính quyền địa phương về thủ tục cho thuê phòng trọ.</p>
<h4>3. Trách nhiệm Bên B</h4>
<p>Đặt cọc với số tiền là {{ number_format($contract->deposited) }} đồng, thanh toán tiền thuê phòng hàng tháng vào ngày 1 hàng hàng. + tiền điện + nước và phí dịch vụ.</p>
<p>Đảm bảo các thiết bị và sửa chữa các hư hỏng trong phòng trong khi sử dụng. Nếu không sửa chữa thì khi trả phòng, bên A sẽ trừ vào tiền đặt cọc, giá trị cụ thể được tính theo giá thị trường.</p>
<p>Chỉ sử dụng phòng trọ vào mục đích ở, với số lượng tối đa không quá 04 người (kể cả trẻ em).
    <br> Không chứa các thiết bị gây cháy nổ, hàng cấm... cung cấp giấy tờ tùy thân để đăng ký tạm trú theo quy định, giữ gìn an ninh trật tự, nếp sống văn hóa đô thị.
    <br> Không tụ tập nhậu nhẹt, cờ bạc và các hành vi vi phạm pháp luật khác.</p>
<p>Không được tự ý cải tạo kiến trúc phòng hoặc trang trí ảnh hưởng tới tường, cột, nền... Nếu có nhu cầu trên phải trao đổi với bên A để được thống nhất.</p>

<h4>4. Điều khoản thực hiện</h4>
<p>Hai bên nghiêm túc thực hiện những quy định trên trong thời hạn cho thuê, nếu bên A lấy phòng phải báo cho bên B ít nhất 01 tháng, hoặc ngược lại.</p>
<br>
<br>
<tr>
    <td colspan="4"> <b>Bên B</b> </td>
    <td colspan="4"> <b>Bên A</b></td>
</tr>

<tr>
    <td colspan="4">  Ký tên, ghi rõ họ tên </td>
    <td colspan="4"> Ký tên, ghi rõ họ tên </td>
</tr>


