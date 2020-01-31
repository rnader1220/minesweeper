<?php
namespace App\Helpers;
use App\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameHelper 
{

    static function createNewGame($input) {
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
        return $new_game;
    }

    static function PickSpot($input) {
        $row = intval($input['row']);
        $col = intval($input['col']);
        $game = Game::find($input['game_id']);
        $minemap = json_decode($game['minemap'], true);

        $clickmap = json_decode($game['clickmap'], true);
        $pickloc = [$row, $col];
        $pick = ['row' => $row, 'col' => $col, 'value' => 0];
        $result = 0;
        if(in_array($pickloc, $minemap)) {
            $result = -1;
            $game['status'] = -1;
        } else {
            for($peek_row = $row-1; $peek_row <= $row+1; $peek_row++) {
                for($peek_col = $col-1; $peek_col <= $col+1; $peek_col++) {
                    if(in_array([$peek_row, $peek_col], $minemap)) $result++;
                }
            }
        }
        $pick['value'] = $result;
        $clickmap[] = $pick;
        $game['clickmap'] = json_encode($clickmap);
        $game->save();      
        return $game;

    }


    static function FlagSpot($input) {
        $row = intval($input['row']);
        $col = intval($input['col']);
        $game = Game::find($input['game_id']);
        $clickmap = json_decode($game['clickmap'], true);
        $pick = ['row' => $row, 'col' => $col, 'value' => -3];
        if(in_array($pick, $clickmap)) {
            $index = array_search($pick, $clickmap);
            array_splice($clickmap, $index, 1);
        } else {
            $clickmap[] = $pick;
        }
        $game['clickmap'] = json_encode($clickmap);
        $game->save();      
        return $game;

    }

    // value = char [' ', '1', '2', '3', '4', '5', '6', '7', '8', '&#9873;', '&#10040;' , '&#10042;'), 
    private static function CheckSpot($row, $col) {
        // check if coords are already in click map
        // if it is, return null;
    }


}