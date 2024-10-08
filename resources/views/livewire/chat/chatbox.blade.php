<div>
    @if($selected_conversation)
    <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
            <div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/9.jpg')}}"></div>
            <div class="main-chat-msg-name">
                <h6>{{$receviverUser->name}}</h6>
            </div>

        </div><!-- main-chat-header -->
        <div  class="main-chat-body" id="ChatBody"  style="height: 300px; overflow: auto;">
            <div class="content-inner" >

                @foreach($messages as $message)
                <div class="media {{$auth_email == $message->sender_email ?'flex-row-reverse':''}}">
                    <div class="media-body">
                        <div class="main-msg-wrapper right">
                            {{$message->body}}
                        </div>
                        <div>
                            <span>{{ $message->created_at->shortAbsoluteDiffForHumans() }}</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    @endif

</div>
<script>

   window.addEventListener('rowChatToBottom', event=>{
    $('.main-chat-body').scrollTop($('.main-chat-body')[0].scrollHeight);
   });
</script>
