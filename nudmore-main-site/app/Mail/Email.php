<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    protected $detail, $isAppointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($topic, $detail, $isAppointment)
    {
        $this->subject = $topic;
        $this->detail = $detail;
        $this->isAppointment = $isAppointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->isAppointment) {
            return $this->view('mail/appointment')->with(['detail' => $this->detail, 'footer' => '<p>หมายเหตุ: หากท่านต้องการทำการเปลี่ยนแปลงการนัดหมายทำได้โดย<br>1. เปลี่ยนแปลงการนัดหมายโดยตรงกับเจ้าหน้าที่ทางโทรศัพท์<br>2. ทำการเปลี่ยนแปลงด้วยตนเองผ่านเว็บไซต์ <a href="nudmo.re">Nudmo.re</a></p>']);
        } else {
            return $this->view('mail/appointment')->with(['detail' => $this->detail, 'footer' => '']);
        }
    }
}
