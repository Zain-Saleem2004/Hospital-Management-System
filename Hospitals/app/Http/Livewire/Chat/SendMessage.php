<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SendMessage extends Component
{

    public $body;
    public $selected_conversation;
    public $receiverUser;
    public $auth_email;
    public $sender;
    public $createdMessage;
    protected $listeners = ['updateMessage','dispatchSentMassage','updateMessage2'];

    public function mount()
    {
        // $this->auth_email = auth()->user()->email;
        if (Auth::guard('patient')->check()) {
            $this->auth_email = Auth::guard('patient')->user()->email;
            $this->sender = Auth::guard('patient')->user();
        } else {
            $this->auth_email = Auth::guard('doctor')->user()->email;
            $this->sender = Auth::guard('doctor')->user();
        }
    }

    public function updateMessage(Conversation $conversation, Doctor $receiver)
    {
        $this->selected_conversation = $conversation;
        $this->receiverUser = $receiver;
    }

    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }

        $this->createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' => $this->auth_email,
            'receiver_email' => $this->receiverUser->email,
            'body' => $this->body,
        ]);
        $this->selected_conversation->last_time_message = $this->createdMessage->created_at;
        $this->selected_conversation->save();
        $this->reset('body');
        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);
        $this->emitTo('chat.chatlist', 'refresh');
        $this->emitSelf('dispatchSentMassage');
    }

    public function dispatchSentMassage(){
        broadcast(new MessageSent(
            $this->sender,
            $this->createdMessage,
            $this->selected_conversation,
            $this->receiverUser
        ));
        }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
