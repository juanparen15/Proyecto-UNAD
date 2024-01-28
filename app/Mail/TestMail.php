<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private string $name)
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
        return $this->view('emails.test')->subject('Prueba de correo');
    }

    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail.name',
    //         with: ['name' => $name]
    //     );
    // }
}
