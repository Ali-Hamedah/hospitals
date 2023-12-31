<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chatbox extends Component
{

    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;
    public $auth_id;
    public $event_name;
    public $chat_page;

    //protected $listeners = ['load_conversationDoctor', 'load_conversationPatient', 'pushMessage'];

    public function mount()
    {
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->auth_id = Auth::guard('patient')->user()->id;
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->auth_id = Auth::guard('doctor')->user()->id;
        }
    }

    public function getListeners()
    {
        if (Auth::guard('patient')->check()) {
            $auth_id = Auth::guard('patient')->user()->id;
            $this->event_name = "MassageSent2";
            $this->chat_page = "chat2";
        } elseif (Auth::guard('doctor')->check()) {
            $auth_id = Auth::guard('doctor')->user()->id;
            $this->event_name = "MassageSent";
            $this->chat_page = "chat";
        }

        return [
            "echo-private:$this->chat_page.{$auth_id},$this->event_name" => 'broadcastMassage', 'load_conversationPatient', 'load_conversationDoctor', 'pushMessage'
        ];
    }

    public function broadcastMassage($event)
    {
        $broadcastMessage = Message::find($event['message']);
        $broadcastMessage->read1 = 1;
        $broadcastMessage->read2 = 1;
        //
        if ($broadcastMessage->conversation_id == $this->selected_conversation->id) {
            $this->pushMessage($broadcastMessage->id);
        }
    }

    public function pushMessage($messageId)
    {
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);
        $this->dispatchBrowserEvent('rowChatToBottom');

        //هذا اذا كان في المجادثه موجود مباشرة يتم تغيير حالة الرسالة الئ مقروة
        if ($this->auth_email == Auth::guard('patient')->check()) {
            Message::where('conversation_id', $this->selected_conversation->id)
                ->update(['read1' => 1]);
        } else
            Message::where('conversation_id', $this->selected_conversation->id)
                ->update(['read2' => 1]);
    }


    public function load_conversationDoctor(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
        //يخلي السكرول في الاسفل عند فتح الصفحه
        $this->dispatchBrowserEvent('chatSelected');
    }

    public function load_conversationPatient(Conversation $conversation, Patient $receiver)
    {

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id', $this->selected_conversation->id)->get();
        //يخلي السكرول في الاسفل عند فتح الصفحه
        $this->dispatchBrowserEvent('chatSelected');
    }


    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
