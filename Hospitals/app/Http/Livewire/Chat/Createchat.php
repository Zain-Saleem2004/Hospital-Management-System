<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Createchat extends Component
{
    public $users;
    public $row;
    public $auth_email;

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

    public function createConversation($receiver_email)
    {

        $check_conversation = Conversation::checkConversation($this->auth_email, $receiver_email)->get();

        if ($check_conversation->isEmpty()) {
            DB::beginTransaction();

            try {
                // createConversation
                $createConversation = Conversation::create([
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'last_time_message' => null,
                ]);
                DB::commit();

                // create message
                Message::create([
                    'conversation_id' => $createConversation->id,
                    'sender_email' => $this->auth_email,
                    'receiver_email' => $receiver_email,
                    'body' => "hi",
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        } else {
            dd("yes conversation");
        }
    }

    public function render()
    {

        if (Auth::guard("patient")->check()) {
            $this->row = "اسم الدكتور";
            $this->users = Doctor::all();
        } else {
            $this->row = "اسم المريض";
            $this->users = Patient::all();
        }

        return view('livewire.chat.createchat')->extends('Dashboard.layouts.master');
    }
}
