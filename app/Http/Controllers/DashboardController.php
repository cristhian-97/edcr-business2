<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public static function inicio(){
       if(self::estaLogeado())
           return view('inicio');
    }

    public static function home(){
        return redirect()->back();
    }

    public static function estaLogeado(){
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (!isset($_SESSION['empresa'])) {
            header('Location: ' . URL::to('/nolog'), true, 307);
            die();
            return false;
        }
        if (isset($_SESSION['empresa'])){
            if($_SESSION['empresa']->cambioContra==1){
                header('Location: ' . URL::to('/cambioContra'), true, 307);
                die();
                return false;
            }
        }
        return true;
    }
}
