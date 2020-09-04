<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneratePassword extends Mailable
{
    use Queueable, SerializesModels;
    
    private $params;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->params = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject("魔后美學")
                ->view('mail.generatepassword')
                ->with([
                    'params' => $this->params,
                ]);
    }
}
