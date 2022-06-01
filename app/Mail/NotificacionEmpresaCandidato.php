<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionEmpresaCandidato extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreCliente,$nombreEvento,$fechaEvento,$horaEvento,$nombreLugar,$nombreCategoria,$url,
    $empresa,$categoria,$cliente,$cotizacion){
        $this->nombreCliente = $nombreCliente;
        $this->nombreEvento = $nombreEvento;
        $this->fechaEvento = $fechaEvento;
        $this->horaEvento = $horaEvento;
        $this->nombreLugar = $nombreLugar;
        $this->nombreCategoria = $nombreCategoria;
        $this->url = $url;
        $this->empresa=$empresa;
        $this->categoria=$categoria;
        $this->cliente=$cliente;
        $this->cotizacion=$cotizacion;        
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('correos/notificacionEmpresaCandidato')->from('sistemasfabok@gmail.com')->subject('Notificación Oferta Laboral Aceptada| EDCR Business')->with([
            'nombreCliente' => $this->nombreCliente,
            'nombreEvento'=>$this->nombreEvento,
            'fechaEvento'=>$this->fechaEvento,
            'horaEvento'=>$this->horaEvento,
            'nombreLugar'=>$this->nombreLugar,
            'nombreCategoria'=>$this->nombreCategoria,
            'url'=>$this->url,
            'empresa'=>$this->empresa,
            'categoria'=>$this->categoria,
            'cliente'=>$this->cliente,
            'cotizacion'=>$this->cotizacion,            
        ]);        
    }
}
