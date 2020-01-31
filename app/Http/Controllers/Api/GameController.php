<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\GameHelper as Helper;

use Illuminate\Support\Facades\Auth;
use App\Game;

class GameController extends Controller
{
    function new(Request $request) {
        $input = $request->all();
        $new_game = Helper::CreateNewGame($input);

        return $new_game;
    }

    function resume(Request $request) {
        $input = $request->all();
        $game = Helper::resumeGame($input);
        if(!$game) {
            return false;
        }
        return $game;
    }

    function pick(Request $request) {
        $input = $request->all();
        $game = Helper::PickSpot($input);
        return $game;

    }

    function flag(Request $request) {
        $input = $request->all();
        $game = Helper::FlagSpot($input);
        return $game;

    }


}
