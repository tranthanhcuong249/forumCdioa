<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;

class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $orderdetails = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $orderdetails)
    {
        //
        $this->order = $order;
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.shopping') ->with([
            'order', 'orderdetails']);
    }
}
