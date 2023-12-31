<?php

namespace App\Http\Livewire\Chat;

use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Chatlist extends Component
{
    public $conversations;
    public $auth_email;
    public $receviverUser;

    public $selected_conversation;

    protected $listeners = ['chatUserSelected','refresh'=>'$refresh'];

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function getUsers(Conversation $conversation, $request)
    {
        $receiverEmail = ($conversation->sender_email == $this->auth_email)
            ? $conversation->receiver_email
            : $conversation->sender_email;

        $this->receviverUser = Doctor::firstWhere('email', $receiverEmail) ?? Patient::firstWhere('email', $receiverEmail);

        if (isset($request)) {
            return optional($this->receviverUser)->$request;
        }
    }



     public function chatUserSelected(Conversation $conversation ,$receiver_id){

        $this->selected_conversation = $conversation;
        $this->receviverUser = Doctor::find($receiver_id);


        if (Auth::guard('patient')->check()) {
            $this->emitTo('chat.chatbox', 'load_conversationDoctor', $this->selected_conversation, $this->receviverUser);
            $this->emitTo('chat.send-message', 'updateMessage', $this->selected_conversation, $this->receviverUser);
             //تحديث حالة لرساله مقروة
        Message::where('conversation_id', $this->selected_conversation->id)
        ->update(['read1' => 1]);

        } else {
            $this->emitTo('chat.chatbox', 'load_conversationPatient', $this->selected_conversation, $this->receviverUser);
            $this->emitTo('chat.send-message', 'updateMessage2', $this->selected_conversation, $this->receviverUser);
                 //تحديث حالة لرساله مقروة
        Message::where('conversation_id', $this->selected_conversation->id)
        ->update(['read2' => 1]);
        }
     }

    public function render()
    {
        $this->conversations = Conversation::where('sender_email',$this->auth_email)->orwhere('receiver_email',$this->auth_email)
        //هذا يرتب حسب الاحدث
            ->orderBy('last_time_message','DESC')
            ->get();
        return view('livewire.chat.chatlist');
    }
}
