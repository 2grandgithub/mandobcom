<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class MembershipConfirmed extends Notification
{
  use Queueable;

  public $companyMembership;
  public $membership;

  public function __construct($companyMembership)
  {
      $this->companyMembership = $companyMembership;
      $this->membership = \App\Membership::whereId($companyMembership->membership_id)->first();

     
  }


  public function via($notifiable)
  {
      return ['database'];  // ,'broadcast'
  }


  public function toArray($notifiable)
  {
      return [
          'title' => 'تم قبول عضويتك' ,
          'message' => ' تم قبول عضويتك  '. $this->membership->name_ar
                        .' <br> من: '.  Carbon::parse($this->companyMembership->from)->toDateString()
                        .' -- اللي: '.  Carbon::parse($this->companyMembership->to)->toDateString()
                        // .' -- اللي: '.  $this->companyMembership->to
      ];
  }
}
