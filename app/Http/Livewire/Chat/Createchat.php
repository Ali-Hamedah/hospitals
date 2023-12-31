<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Createchat extends Component
{
    public $users;
    public $auth_email;

    public $receviverUser;

    public $selected_conversation;

    protected $listeners = ['chatUserSelected','refresh'=>'$refresh'];

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function createConversation($receiver_email)
    {

        $chek_Conversation = Conversation::chekConversation($this->auth_email, $receiver_email)->first();
        if (!$chek_Conversation) {
            DB::beginTransaction();
            try {
                // $createConversation
                $createConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => now(),
                ]);
                // create message
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => 'السلام عليكم',
                ]);
                $this->selected_conversation = $createConversation->id;
                $this->receviverUser = Doctor::find($receiver_email);

                if (Auth::guard('doctor')->check()) {
                    $this->redirect(route('chat.patients'));
                } else {
                    $this->redirect(route('chat.doctors'));
                }
                DB::commit();
                $this->emitSelf('render');
            } catch (\Exception $e) {
                DB::rollBack();
            }
        } else {

            if (Auth::guard('doctor')->check()) {
                $this->redirect(route('chat.patients'));
            } else {
                $this->redirect(route('chat.doctors'));
            }
        }
    }

    public function render()
    {
        if (Auth::guard('patient')->check()) {
            $this->users = Doctor::all();
        } else {
            $this->users = Patient::all();
        }
        return view('livewire.chat.createchat')->extends('Dashboard.layouts.master');
    }
}
