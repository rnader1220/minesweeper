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
                        <li style = 'color:gray'>(get) /register<br>
                            create a new user account<br>
                            <strong>accepts:</strong> nothing<br>
                            <strong>returns:</strong> registration form HTML<br>
                        </li>

                        <li style = 'color:gray'>(post) /register
                            create a new user account, start user session<br>
                            <strong>accepts:</strong> post of registration form<br>
                            <strong>returns on success:</strong> session id JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li style = 'color:gray'>(get) /login<br>
                            existing user login<br>
                            <strong>accepts:</strong> nothing<br>
                            <strong>returns:</strong> registration form HTML<br>
                        </li>

                        <li style = 'color:gray'>(post) /login<br>
                            start user session<br>
                            <strong>accepts:</strong> post of login form<br>
                            <strong>returns on success:</strong> session id JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li style = 'color:gray'>(get) /start<br>
                            start new user game<br>
                            <strong>accepts:</strong> session id<br>
                            <strong>returns:</strong> game_config form HTML<br>
                        </li>
                        <li style = 'color:gray'>(post) /start<br>
                            start new user game<br>
                            <strong>accepts:</strong> post of game_config form<br>
                            <strong>returns on success:</strong> game id JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                        <li style = 'color:gray'>(get) /list<br>
                            show user games<br>
                            <strong>accepts:</strong> session id<br>
                            <strong>returns on success:</strong> user game list JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li style = 'color:gray'>

                        <li style = 'color:gray'>(get) /resume<br>
                            resume incomplete user game<br>
                            <strong>accepts:</strong> game id<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>

                        <li style = 'color:gray'>(get) /click<br>
                            location click for exposure<br>
                            <strong>accepts:</strong> coordinate pair JSON<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                        <li style = 'color:gray'>(get) /flag<br>
                            location click for flag toggle<br>
                            <strong>accepts:</strong> coordinate pair JSON<br>
                            <strong>returns on success:</strong> game status map JSON<br>
                            <strong>returns on failure:</strong> failure reason HTML<br>
                        </li>
                    </ul>
                </div>
                <div class='help'>
                    Game List JSON:<br>
                    <pre><code>
                    {
                        id: game id,
                        columns: columns,
                        rows: rows,
                        mines: minecount,
                        status: [0 = active, -1 = lost, 1 = won],
                    }
                    </code></pre>

                    Game Status Map JSON:<br>
                    <pre><code>
                    {
                        id: game id,
                        columns: columns,
                        rows: rows,
                        mines: minecount,
                        status: [0 = active, -1 = lost, 1 = won],
                        cells: {
                            col = int (0 to columns-1), 
                            row = int (0 to rows-1), 
                            value = char [' ', '1', '2', '3', '4', '5', '6', '7', '8', '&#9873;', '&#10040;' , '&#10042;'), 
                        }
                    }
                    </code></pre>
                    notes:  
                    <ul>
                        <li>cells lists shows cells that have been selected.</li>
                        <li>'1' (etc) positive values shows how many mines are nearby.</li>
                        <li>' ' means no adjacent mines are found</li>
                        <li> '&#9873;' means user flagged the cell. (flag icon)  </li>
                        <li> '&#10040;' means user triggered that mine (red mine recommended)  </li>
                        <li> '&#10042;' means all mines are exposed, and game has ended in loss.</li> 
                    </ul>

            </div>
        </div>
    </body>
</html>
