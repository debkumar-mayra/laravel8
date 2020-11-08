<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Registration extends Mailable
{
    use Queueable, SerializesModels;
     public $user;
    
    public function __construct($user_id)
    {
       $this->user = User::find($user_id);
    }

    
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), env('APP_NAME'))
                     ->view('email.registration')
                    ->subject('Registration');
    }
}
