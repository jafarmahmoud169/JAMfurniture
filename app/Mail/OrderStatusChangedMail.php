<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $newStatus;

    public function __construct(Order $order, $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this->subject('Your order status has been updated')
                    ->view('emails.order_status_changed');
    }
}
