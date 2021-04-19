<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Richard's Minesweeper</title>
		<link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@800&display=swap" rel="stylesheet">
		<script
			 src="https://code.jquery.com/jquery-3.4.1.min.js"
			 integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			 crossorigin="anonymous"></script>
			 <script type="text/javascript" src="minesweeper.js?v=0.9.0.9"></script>

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
			<a id='menu-login'>Login</a>
			<a id='menu-register'>Register</a>
			<a id='menu-start'>New Game</a>
			<a id='menu-logout'>Good Bye!</a>
		</div>

		<div id='title'>
			<div class="title m-b-md">
			Death From Below!
			</div>
		</div>
		<div id='login' class="content">
			<div>
				<div>
					<h4>Back for more punishment?</h4>
				</div>
				<form>
					<div>
						<label for="email">E-Mail Address</label>
						<div>
							<input id="email" type="email"  name="email" required>
						</div>
					</div>

					<div>
						<label for="password">Password</label>
						<div>
							<input id="password" type="password"  name="password" required>

						</div>
					</div>
					<br>
					<div>
						<div>
							<button type="submit">
								Log in
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div id='register' class='content'>
			<div>
				<div>
					<h4>Join us, if you dare!</h4>
				</div>
					<form>
						<div>
							<label for="name">Name</label>
							<div>
								<input id="name" type="text"  name="name" required autofocus>
							</div>
						</div>

						<div>
							<label for="email">E-Mail Address</label>
							<div>
								<input id="email" type="email"  name="email" required>
							</div>
						</div>

						<div>
							<label for="password">Password</label>
							<div>
								<input id="password" type="password"  name="password" required>

							</div>
						</div>

						<div>
							<label for="c_password">Confirm Password</label>
							<div>
								<input id="c_password" type="password"  name="c_password" required>
							</div>
						</div>
						<br>
						<div>
							<div>
								<button type="submit">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
		<div id='start' class="content">
			<form>
				<div>
					<h4>Challenge is why we're here!</h4>
				</div>

			<ul style='list-style:none'>
				<li><input id='size', name='size' type='radio', value = 10> Small Game (8x8, 10 mines)</li>
				<li><input id='size', name='size' type='radio', value = 40> Medium Game (16x16, 40 mines)</li>
				<li><input id='size', name='size' type='radio', value = 99> Large Game (30x16, 99 mines)</li>

			</ul>
			<button type="submit">
				Lets Go
			</button>

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

