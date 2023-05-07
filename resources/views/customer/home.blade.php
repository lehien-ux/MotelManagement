@extends("customer.master")
@section("content")
<section class="rooms rooms-widget">

    <!-- === rooms header === -->
    <div class="section-header">
        <div class="container">
            <h2 class="title">PHÒNG CÒN TRỐNG
                <a href="{{ route('customer.rooms') }}" class="btn btn-sm btn-clean-dark">Xem tất cả</a></h2>
            <!-- <p>Designed as a privileged almost private place where you'll feel right at home</p> -->
        </div>
    </div>

    <!-- === rooms content === -->

    <div class="container">

        <div class="owl-rooms owl-theme">
            @foreach($rooms as $room)
            <a href="{{ route('rooms.book-view', ['id' => $room->id]) }}">
                <div class="item">
                    <article>
                        <div class="image free-room-image">
                            <img src="{{ url('upload/images/' . $room->images[0]->path) }}" alt="" />
                        </div>
                        <div class="details">
                            <div class="text">
                                <h3 class="title"><a href="room-overview.html">{{ $room->number }}</a></h3>
                            </div>
                            <div class="book">
                                <div>
                                    <a href="{{ route('rooms.book-view', ['id' => $room->id]) }}"
                                        class="btn btn-main">Đặt
                                        phòng</a>
                                </div>
                                <div>
                                    <span class="price h4">{{ number_format($room->price) }} vnđ</span>
                                    <div>1 tháng</div>
                                    <span>Kích thước: {{ $room->size }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </a>
            @endforeach
        </div>
        <!--/owl-rooms-->

    </div>
    <!--/container-->

</section>
@endsection