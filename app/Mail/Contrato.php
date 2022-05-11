<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contrato extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre,$nombres,$numero,$correos,$fecha,$cant,$nombreCat,$lugar,$funcion,$disp2,$transp,$precioCt,$imprte,$iva,$totl,$comsion){
        $this->nombre = $nombre;
        $this->nombres = $nombres;
        $this->numero = $numero;
        $this->correos = $correos;
        $this->fecha =$fecha;
        $this->cant =$cant;
        $this->nombreCat=$nombreCat;
        $this->lugar=$lugar;
        $this->funcion=$funcion;
        $this->disp2=$disp2;
        $this->transp=$transp;
        $this->precioCt=$precioCt;
        $this->imprte=$imprte;
        $this->iva=$iva;
        $this->totl=$totl;
        $this->comsion=$comsion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this->view('correos/contrato')->from('sistemasfabok@gmail.com')->subject('Oferta de Trabajo| EDCR Business')->with([
            'nombre' => $this->nombre,
        ]);*/
        return $this->view('correos/contrato')->from('sistemasfabok@gmail.com')->subject('Oferta Laboral| EDCR Business')->with([
            'nombre' => $this->nombre,
            'nombres'=>$this->nombres,
            'numero'=>$this->numero,
            'correos'=>$this->correos,
            'fecha'=>$this->fecha,
            'cant'=>$this->cant,
            'nombreCat'=>$this->nombreCat,
            'lugar'=>$this->lugar,
            'funcion'=>$this->funcion,
            'disp2'=>$this->disp2,
            'transp'=>$this->transp,
            'precioCt'=>$this->precioCt,
            'imprte'=>$this->imprte,
            'iva'=>$this->iva,
            'totl'=>$this->totl,
            'comsion'=>$this->comsion
        ]);        
    }
}
