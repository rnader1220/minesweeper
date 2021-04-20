<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Richard's Minesweeper</title>
		<link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

		<script
			 src="https://code.jquery.com/jquery-3.4.1.min.js"
			 integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			 crossorigin="anonymous"></script>
			 <script type="text/javascript" src="minesweeper.js?v=0.9.0.10"></script>

			 <script
			 src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

		<link rel="stylesheet" type="text/css" href="minesweeper.css?v=0.9.0.9">

	</head>
	<body style="
        background: black url('/images/minesweeper.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        ">
		<div class="menu-main">
            <button tyle='button' id='menu-login' class='btn btn-primary'>Login</button>
            <button tyle='button' id='menu-register' class='btn btn-primary'>Register</button>
            <button tyle='button' id='menu-start' class='btn btn-primary'>New Game</button>
            <button tyle='button' id='menu-logout' class='btn btn-primary'>Good Bye!</button>
		</div>

		<div id='title'>
			<div class="title m-b-md">
			Death From Below!
			</div>
		</div>
		<div id='login' class="content container">
			<div class='col-md-4 offset-md-4 mt-5 mb-5' style='opacity: 0.7; background-color: navy; border-radius:12px;'>
				<form>

                    <div class="row">
                        <div class="col-md-12">
                            <h4  style='opacity: 1.0; color:red'>Back for more punishment?</h4>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="email" class="control-label" style='color:white'>E-Mail Address</label>
                                <div class="input-group">
                                    <input class="form-control" type="email" id="email" name="email" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="password" class="control-label" style='color:white'>Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password" name="password" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <button type='submit' class='btn btn-primary col-md-10'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log in&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2">&nbsp;
                        </div>
                    </div>

                    <div class='clearfix'></div>
				</form>
			</div>
		</div>


		<div id='register' class="content container">
			<div class='col-md-4 offset-md-4 mt-5 mb-5' style='opacity: 0.7; background-color: navy; border-radius:12px;'>
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <h4  style='opacity: 1.0; color:red'>Join us, if you dare!</h4>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="name" class="control-label" style='color:white'>Name</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="name" name="name" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="email" class="control-label" style='color:white'>E-Mail Address</label>
                                <div class="input-group">
                                    <input class="form-control" type="email" id="email" name="email" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="password" class="control-label" style='color:white'>Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="password" name="password" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="c_password" class="control-label" style='color:white'>Confirm Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" id="c_password" name="c_password" required style='opacity: 1.0'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8 offset-md-2">
                            <button type='submit' class='btn btn-primary col-md-10'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2">&nbsp;
                        </div>
                    </div>

                    <div class='clearfix'></div>

    			</form>
			</div>
		</div>

		<div id='start' class="content container">
			<div class='col-md-4 offset-md-4 mt-5 mb-5' style='opacity: 0.7; background-color: navy; border-radius:12px;'>
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style='opacity: 1.0; color:red'>Challenge is why we're here!</h4>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group" style='color:white'>
                                <input type="radio" class="btn-check" name="size" id="size1" autocomplete="off" value = 10 >
                                <label class="btn btn-primary mb-2 col-md-3" for="size1"><strong>Small Game</strong><br>8x8<br>10 mines</label>
                                <input type="radio" class="btn-check" name="size" id="size2" autocomplete="off"  value = 40>
                                <label class="btn btn-primary mb-2 col-md-3" for="size2"><strong>Medium Game</strong><br>16x16<br>40 mines</label>
                                <input type="radio" class="btn-check" name="size" id="size3" autocomplete="off" value = 99>
                                <label class="btn btn-primary mb-2 col-md-3" for="size3"><strong>Large Game</strong><br>30x16<br>99 mines</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-8 offset-md-2">&nbsp;
                        </div>
                    </div>

                    <div class='clearfix'></div>

                </form>
            </div>
        </div>



		<div id='list' class="content">
		</div>
		<div id='game' class="content">
			<div style='text-align:center'>
			<table  id='game_table' style='border: collapse; margin-left:auto; margin-right:auto' cellspacing=0 cellborder=0>
			</table>
			</div>
		</div>
		<div id='result' class="content"></div>
	</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		minesweeper.initialize();
	});
	</script>

