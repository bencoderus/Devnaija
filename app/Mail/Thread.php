<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Thread extends Mailable
{
    use Queueable, SerializesModels;

    public $thread;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thread)
    {
        //
        $this->thread=$thread;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.threadnotify', compact('thread'));
    }
}
