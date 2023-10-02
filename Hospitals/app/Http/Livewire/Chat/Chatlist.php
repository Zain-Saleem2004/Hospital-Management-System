<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chatlist extends Component
{
    public $conversations,$auth_email;
    public $receiverUser;
    public $selected_conversation;
    protected $listeners = ['chatUserSelected','refresh'=>'$refresh'];


    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function getUser(Conversation $conversation, $request)
    {
        if (Auth::guard('doctor')->check()) {
            $this->receiverUser = Patient::where('email', $conversation->receiver_email)->orwhere('email', $conversation->sender_email)->first();
        }
        if (Auth::guard('patient')->check()) {
            $this->receiverUser = Doctor::where('email', $conversation->sender_email)->orwhere('email', $conversation->receiver_email)->first();

        }

        if (isset($request)) {
            return $this->receiverUser->$request;
        }



    }

    public function chatUserSelected(Conversation $conversation,$receiver_id ){
        
        $this->selected_conversation = $conversation;
       

        if(Auth::guard('patient')->check()){
            $this->receiverUser = Doctor::find($receiver_id);
            $this->emitTo('chat.chatbox','load_conversationDoctor',$this->selected_conversation,$this->receiverUser);
        }

        else{      
            $this->receiverUser = Patient::find($receiver_id);      
            $this->emitTo('chat.chatbox','load_conversationPatient',$this->selected_conversation,$this->receiverUser);
        }

        $this->emitTo('chat.send-message','updateMessage',$this->selected_conversation,$this->receiverUser);


    }

    public function render()
    {
        $this->conversations = Conversation::where('sender_email',$this->auth_email)->orwhere('receiver_email',$this->auth_email )
        ->orderBy('created_at','DESC')
        ->get();
        return view('livewire.chat.chatlist');
    }
}
