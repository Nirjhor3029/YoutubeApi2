<div class="incoming_msg">
    <div class="incoming_msg_img">
        <img src="{{asset('img/msg_icon.png')}}" alt="Ayojok">
    </div>
    <div class="received_msg">
        <div class="received_withd_msg">
            <p>Dear {{Auth::user()->name}}</p>

            <p>Thank you for sending a query from Ayojok.com. Below is the services that you have sent a query for.</p>
            <table class="table pt-2 pb-2">
                <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td><img src="{{asset($data->vendors->profile_img or $data->product->image)}}" alt="Image"
                                 style="width:4rem;"></td>
                        <td>{{$data->vendors->title or $data->product->title}}</td>
                        {{-- <td>{{$data->querys->created_at->format('M-d-Y')}}</td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>Our team will call you shortly regarding the order for confirmation. You can check the status of your
                order anytime in “query list” under “My Account”. If you feel like there should be any change in the
                cart do contact us immediately.</p>

            <p>Keep visiting www.ayojok.com for best prices on event services. Thank you for ordering from us.</p>

            <p>With regards,<br/> Ayojok team </b> +880-1959 555 666</p>
            <span class="time_date"> {{$data->created_at->format('g:i A')}}
                | {{$data->created_at->format('M d')}}</span>
        </div>
    </div>
</div>

@foreach($chat as $chat_v)
    <div class="outgoing_msg">
        <div class="sent_msg">
            <p>{{$chat_v->msg}}</p>
            <span class="time_date"> {{$chat_v->created_at->format('g:i A')}} | {{$chat_v->created_at->format('M d')}}</span>
        </div>
    </div>
@endforeach


{{--<div class="outgoing_msg">
    <div class="sent_msg">
        <p>Test which is a new approach to have all solutions</p>
        <span class="time_date"> 11:01 AM    |    June 9</span>
    </div>

</div>--}}


<div class="incoming_msg">
    <div class="incoming_msg_img">
        <img src="{{asset('img/msg_icon.png')}}" alt="sunil">
    </div>
    <div class="received_msg">
        <div class="received_withd_msg">
            <p>Test, which is a new approach to have</p>
            <span class="time_date"> 11:01 AM   |    Yesterday</span>
        </div>
    </div>
</div>
