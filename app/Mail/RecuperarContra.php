<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarContra extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emp, $contra)
    {
        $this->nombre = $emp->nombreEmpresa;
        $this->contra = $contra;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos/cambioContra')->from('sistemasfabok@gmail.com')->subject('Recuperación de contraseña| EDCR Business')->with([
            'nombreEmpresa' => $this->nombre,
            'contra' => $this->contra
        ]);
    }
}
