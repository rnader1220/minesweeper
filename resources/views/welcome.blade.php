<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Minesweeper API</title>


    </head>
    <body>
            <div class="content">
                <div class="title m-b-md">
                    Minesweeper API Help
                </div>
                <div class='help'>
                    API Calls
                    <ul>
                        <li>(get) /register<br>
                        <strong>accepts:</strong> nothing<br>
                        <strong>returns:</strong> registration form HTML<br>
                        </li>
                        <li>(post) /register
                        <strong>accepts:</strong> post of registration form<br>
                        <strong>returns on success:</strong> session id JSON<br>
                        <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>


                        <li>(get) /login<br>
                        <strong>accepts:</strong> nothing<br>
                        <strong>returns:</strong> registration form HTML<br>
                        </li>

                        <li>(post) /login<br>
                            <strong>accepts:</strong> post of login form<br>
                            <strong>returns on success:</strong> session id JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li>(get) /start<br>
                        <strong>accepts:</strong> session id<br>
                        <strong>returns:</strong> game_config form HTML<br>
                        </li>
                        <li>(post) /start<br>
                            <strong>accepts:</strong> post of game_config form<br>
                            <strong>returns on success:</strong> game id JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                        <li>(get) /history<br>
                            <strong>accepts:</strong> session id<br>
                            <strong>returns on success:</strong> user game list JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li>(get) /resume<br>
                            <strong>accepts:</strong> game id<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li>(get) /click<br>
                            location click for exposure<br>
                            <strong>accepts:</strong> coordinate pair JSON<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                        <li>(get) /flag<br>
                            location click for flag toggle<br>
                            <strong>accepts:</strong> coordinate pair JSON<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                    </ul>
                </div>
                <div class='help'>
                    Game Status Map json:<br>
                    <pre><code>
                    {
                        id: game id,
                        columns: columns,
                        rows: rows,
                        mines: minecount,
                        status: [1 = active, 0 = done],
                        cells: {
                            col = int (0 - columns-1), 
                            row = int (0 - rows-1), 
                            value = int (0::8, -1 = flagged, -2 = triggered, -3 = exposed), 
                        }
                    }
                    </code></pre>
                    notes:  
                    <ul>
                        <li>cells lists shows cells that have been selected.</li>
                        <li>positive value shows how many mines are nearby.</li>
                        <li>0 means not adjacent mines are found</li>
                        <li>-1 means user flagged the cell. (flag icon) &#9873; </li>
                        <li>-2 means user triggered that mine (red mine recommended) <span style='color:red'>&#10041;</span> </li>
                        <li>-3 means all mines are exposed, and game has ended in loss. &#10041;</li> 
                    </ul>

            </div>
        </div>
    </body>
</html>
