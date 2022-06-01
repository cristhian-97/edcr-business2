<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contacto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$url){
        $this->name = $name;
        $this->email = $email;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('contact')->from('sistemasfabok@gmail.com')->subject('Oferta Laboral| EDCR Business')->with([
            'name' => $this->name,
            'email'=>$this->email,
            'url'=>$this->url
        ]);        
    }
}
