<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type , $user;

    public function __construct($type,$id)
    {
        $this->type = $type;

        if ($type == 'Buyer' || $type == 'buyer' ){
              $user = \App\Buyer::whereId($id)->first();
        }
        else if($type == 'Recycable'){
              $user = \App\Recycable::whereId($id)->first();
        }
        else if($type == 'ProducerFamily'){
              $user = \App\ProducerFamily::whereId($id)->first();
        }
        else if($type == 'Company' || $type == 'company'){
              $user = \App\Company::whereId($id)->first();
        }
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('Mail\Register');
        return $this->markdown('Mail_after_Register');
    }
}
