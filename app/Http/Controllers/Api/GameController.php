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
        $new_game = Helper::createNewGame($input);

        unset($new_game['minemap']);
        return $new_game;
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
