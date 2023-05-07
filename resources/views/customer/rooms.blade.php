@extends("customer.master")
@section("content")
<div class="customer-rooms-wrap">
    <div class="search-rooms">
        <form action="{{ route('customer.rooms') }}" method="get">
            <div class="mb-3">
                <label class="form-label">Tên phòng</label>
                <input type="text" placeholder="Nhập tên phòng" name="number" value="{{ old('number') }}"
                    class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Kích thước</label>
                <input type="text" placeholder="Nhập kích thước" name="size" value="{{ old('size') }}"
                    class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá từ</label>
                <input type="number" placeholder="" class="form-control" value="{{ old('price_start') }}"
                    name="price_start">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá đến</label>
                <input type="number" placeholder="" class="form-control" value="{{ old('price_end') }}"
                    name="price_end">
            </div>
            <div class="mb-3">
                <label class="form-label">Tìm người ở ghép</label>
                <input type="checkbox" style="-webkit-appearance: auto; margin-top: 20px"
                    {{ old('transplant') ? 'checked' : '' }} name="transplant">
            </div>
            <br>
            <input type="submit" value="Tìm kiếm" class="btn btn-primary">
        </form>
    </div>
    <div class="customer-rooms-right">
        <div class="customer-rooms">
            @foreach($rooms as $room)
            <div class="item-rooms">
                <article>
                    <div class="image list-room-image">
                        <a href="">
                            <img src="{{ url('upload/images/' . $room->images[0]->path) }}" alt="" />
                        </a>
                    </div>
                    <div class="details">
                        <div class="text">
                            <h3 class="title"><a href="">{{ $room->number }}</a></h3>
                        </div>
                        <div class="book-customer">
                            <div>
                                @if(!request()->has('transplant'))
                                <a href="{{ route('rooms.book-view', ['id' => $room->id]) }}" class="btn btn-main">Đặt
                                    phòng</a>
                                @endif
                                @if($room->is_transplant == \App\Enums\Constant::TRANSPLANT)
                                <a href="{{ route('rooms.transplant', ['id' => $room->id]) }}" class="btn btn-main">
                                    {{ $room->is_transplant == \App\Enums\Constant::TRANSPLANT ? 'Đang tìm người ở ghép' : '' }}
                                </a> ({{ $room->sex == 1 ? 'Nam' : 'Nữ' }})
                                @endif
                            </div>
                            <div class="room-info">
                                <span class="price h4">{{ number_format($room->price) }} vnđ/1 tháng</span>
                                <br>
                                <span>Kich thước: {{ $room->size }}</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div style="text-align: center !important;"> {{$rooms->appends(request()->query()) }}</div>
    </div>
</div>
@endsection