<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Game;

class GameController extends Controller
{
    function new(Request $request) {
        $input = $request->all();
        $new_game = new Game();
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
        $minemap = [];
        $serialmax = $new_game['rows'] * $new_game['cols'];
        while (count($minemap) < $new_game['mines']) {
            $serial = random_int(0, $serialmax);
            $row = intval($serial / $new_game['rows']);
            $col = $serial % $new_game['rows'];
            $minemap[] = [$row, $col]; 
            $minemap = array_unique($minemap, SORT_REGULAR);
        }

        $new_game['user_id'] = Auth::user()->id;
        $new_game['minemap'] = json_encode($minemap);
        $new_game['clickmap'] = json_encode([]);

        $new_game->save();
        unset($new_game['minemap']);
        return $new_game;
    }

    function pick(Request $request) {
        $input = $request->all();
        $row = intval($input['row']);
        $col = intval($input['col']);
        $game = Game::find($input['game_id']);
        $minemap = json_decode($game['minemap'], true);

        $clickmap = json_decode($game['clickmap'], true);
        $pick = [$row, $col];
        $result = 0;
        if(in_array($pick, $minemap)) {
            $result = -1;
        } else {
            for($peek_row = $row-1; $peek_row <= $row+1; $peek_row++) {
                for($peek_col = $col-1; $peek_col <= $col+1; $peek_col++) {
                    if(in_array([$peek_row, $peek_col], $minemap)) $result++;
                }
            }
        }
        $clickmap[] = $pick;
        $game['clickmap'] = json_encode($clickmap);
        $game->save();         
        return $result;

    }


}
