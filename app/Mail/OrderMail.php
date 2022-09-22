<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order,$orderCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$orderCode)
    {
        $this->order = $order;
        $this->orderCode = $orderCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Đơn hàng #'.$this->orderCode)->view('frontend.mails.orderSuccessMail');
    }
}
