<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DiscountEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $product, $user;

    public function __construct($product, $user)
    {
        $this->product = $product;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("🎉 Special Offer on {$this->product->name}!")
                    ->view('emails.discount')
                    ->with([
                        'productName' => $this->product->name,
                        'discount' => $this->product->discount,
                        'price' => $this->product->price,
                        'user' => $this->user,
                    ]);
    }
}
