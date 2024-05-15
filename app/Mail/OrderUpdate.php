<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $user, public $message, public $route)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Virgilio Handicraft')
                    ->subject("Virgilio Handicraft - Order Update")
                    ->markdown('emails.order_update', [
                        'user' => $this->user,
                        'message' => $this->message,
                        'url' =>  $this->route,

        ]); // with params
    }
}