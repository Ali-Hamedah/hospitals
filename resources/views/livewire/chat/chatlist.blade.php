<div wire:ignore>
    <div class="main-chat-list" id="ChatList">
        @foreach ($conversations as $conversation)
            <div class="media new"
                wire:click="chatUserSelected({{ $conversation }},'{{ $this->getUsers($conversation, $name = 'id') }}')">
                <div class="main-img-user online">
                    <img alt="" src="{{ asset('Dashboard/img/doctor_default.png') }}">
                    @if (Auth::guard('patient')->check())
                        @if ($conversation->messages->where('read1', 0)->where('conversation_id', Auth::guard('patient')->check())->count(0))
                            <span>{{ $conversation->messages->where('read1', 0)->count() }}</span>
                        @endif
                    @endif
                    @if (Auth::guard('doctor')->check())
                        @if ($conversation->messages->where('read2', 0)->where('conversation_id', Auth::guard('doctor')->check())->count(0))
                            <span>{{ $conversation->messages->where('read2', 0)->count() }}</span>
                        @endif
                    @endif

                </div>
                <div class="media-body">
                    <div class="media-contact-name">
                        <span>{{ $this->getUsers($conversation, $name = 'name') }}</span>
                        <span>{{ optional($conversation->messages->last())->created_at->shortAbsoluteDiffForHumans() }}</span>
                    </div>
                    <p>{{ optional($conversation->messages->last())->body }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
