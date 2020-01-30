<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    function new(Request $request) {
        $input = $request->all();
        $new_game = [];
        switch($input['size']) {
            case 10:
                $new_game['rows'] = 8;
                $new_game['cols'] = 8;
                $new_game['mines'] = 10;
            break;
            case 40:
                $new_game['rows'] = 16;
                $new_game['cols'] = 16;
                $new_game['mines'] = 40;
            break;
            case 99:
                $new_game['rows'] = 16;
                $new_game['cols'] = 30;
                $new_game['mines'] = 99;
            break;

        }



        return $new_game;

    }
}
