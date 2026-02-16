<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $proofPath;

    public function __construct($order, $proofPath = null)
    {
        $this->order = $order;
        $this->proofPath = $proofPath;
    }

    public function build()
    {
        $mail = $this->subject('New Order Placed')->view('emails.order_placed')->with(['order'=>$this->order]);
        if ($this->proofPath && file_exists($this->proofPath)) {
            $mail->attach($this->proofPath);
        }
        return $mail;
    }
}
