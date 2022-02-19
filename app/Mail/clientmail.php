<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class clientmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dataTemplate = $this->data;
        return $this->subject('Project Deal by Codekart Solutions Pvt. Ltd.')->view('Email.ClientMail',compact('dataTemplate'))->attach($this->data['file']->getRealPath(),['as'=>$this->data['file']->getClientOriginalName()]);
    }
}
