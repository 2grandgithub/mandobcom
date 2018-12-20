<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AuctionHasNewOffer extends Notification
{
    use Queueable;

    public $AuctionOffer;
    public $AuctionRequest;

    public function __construct($AuctionOffer,$AuctionRequest)
    {
         $this->AuctionOffer = $AuctionOffer;
         $this->AuctionRequest = $AuctionRequest;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    public function toArray($notifiable)
    {
        return [
            'AuctionOffer_id' => $this->AuctionOffer->id,
            'title' => ' عرض جدد اضيف لمناقصتك ',
            'message' => ' عرض جدد لمناقصتك رقم '. $this->AuctionRequest->id
        ];
    }
}
