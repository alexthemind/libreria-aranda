<?php

namespace Aranda\Lib;

use App\Models\Usuarios;

class Credential {

    public static function getCredential($id=null) {

        $id = $id != null ? $id : 1;

        $user = Usuarios::where('id',$id)->first();

        if($user != null)
        {
            return (object)[
                "username" => $user->username,
                "password" => $user->password,
                "type" => $user->client_role,
                "idTenant" => $user->tenant,
                "idGroup" => "",
                "sid" => $user->remember_token
            ];
        }
        else
        {
            echo 'Na hay datos!';
            exit;
        }

    }

}