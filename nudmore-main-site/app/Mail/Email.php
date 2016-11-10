<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    protected $detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($topic, $detail)
    {
        $this->subject = $topic;
        $this->detail = $detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail/appointment')->with(['detail' => $this->detail]);
    }
}
