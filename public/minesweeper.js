var minesweeper = (function($, undefined) {

	var session_id = null;

	var initialize = function() {
		session_id = null;
		setSessionState();
	}

	var register = function() {
		$('#login').hide();
		$.ajax({
			url: '/register',
			cache: false,
		})
		.done(function(html) {
			$('#login').html(html).fadeIn(300);
			$('#login form').on('submit', function (e) {
				e.preventDefault();
				if ($(this).valid()) $.ajax({
					type: "POST",
					url: '/register',
					data: $(this).serialize(),
				})
					.done(function (resp) {

						$('#login').fadeOut(300);
						session_id = resp;
						setTimeout(function () {
							setSessionState();
						}, 300);
					})
					.fail(function (message) {
						alert(message);
					});
			}).validate();
		});
	};

	var login = function() {
		$('#login').hide();

		$.ajax({
			url: '/login',
			cache: false,
		})
		.done(function(html) {
			$('#login').html(html).fadeIn(300);

			$('#login form').on('submit', function (e) {
				e.preventDefault();
				if ($(this).valid()) $.ajax({
					type: "POST",
					url: '/login',
					data: $(this).serialize(),
				})
					.done(function (resp) {
						$('#login').fadeOut(300);
						session_id = resp.session_id;
						setTimeout(function () {
							setSessionState();
						}, 300);

					})
					.fail(function (message) {
						alert(message);
					});
			}).validate();
		});
	};

	var setSessionState = function() {
		// hide all menu items
		$('[id^=menu-]').hide().off('click');
		if(session_id == null) {
			$('#menu-login').on('click', login).show();
			$('#menu-register').on('click', register).show();
			// show login
			// show register
		} else {
			$('#menu-start').on('click', start).show();
			$('#menu-history').on('click', list).show();
			$('#menu-logout').on('click', logout).show();
		}

	}
	var list = function() {
		// load into tables grid
	}

	var select = function() {
		// get game id value
		// request game state
		// renderGame(gameMap)	
	}

	var start = function() {
		// request new game ui screen	
		// on save ...	
		// renderGame(gameMap)	
	}

	var renderGame = function(gameMap) {
		// gameMap is JSON
		// rows, columns, cells
		// set status
		// can I just draw a table??
	}

	var logout = function() {
		session_id = null;
		setSessionState();
	}


	return {
		initialize: initialize
	};
})(jQuery);

