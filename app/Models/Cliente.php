<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class Cliente extends Model
{
    use HasFactory;
    public static function autenticar($usuario, $contra){
        $cli = DB::table('tbclientes')->where('correo', $usuario)->first();
        if ($cli == null)
            return 'noregistrada';
        if (Hash::check($contra, $cli->contrasena)) {
            session_start();
            $_SESSION['cliente'] = $cli;
            return 'exito';   
        }
        return 'nologeada';
    }

    public function signedSnoozeUrl(int $minutes, string $email){
        return URL::temporarySignedRoute('signed.snooze', now()->addMinutes(1), [
            'check' => $this,
            'minutes' => $minutes,
            'email' => urlencode($email),
        ]);
    }

}
