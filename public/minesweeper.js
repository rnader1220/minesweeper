var minesweeper = (function($, undefined) {

	var user_token = null;

	var initialize = function() {		
		$('.content').hide();
		user_token = null;
		setSessionState();
	}

	var register = function() {
		$('.content').hide();
		$('#register').fadeIn(300);
		$('#register form').off('submit')
		.on('submit', function (e) {
			e.preventDefault();
			if ($(this).valid()) $.ajax({
				type: "POST",
				url: '/api/v1/register',
				data: $(this).serialize(),
			})
				.done(function (resp) {

					$('#register').fadeOut(300);
					user_token = resp.success.token;
					setTimeout(function () {
						setSessionState();
					}, 300);
				})
				.fail(function (message) {
					alert(JSON.stringify(message));
				});
		}).validate();
	};

	var login = function() {
		$('.content').hide();
		$('#login').fadeIn(300);
		$('#login form').off('submit')
			.on('submit', function (e) {
			e.preventDefault();
			if ($(this).valid()) $.ajax({
				type: "POST",
				url: '/api/v1/login',
				data: $(this).serialize(),
			})
				.done(function (resp) {
					$('#login').fadeOut(300);
					user_token = resp.success.token;
					setTimeout(function () {
						setSessionState();
					}, 300);

				})
				.fail(function (message) {
					alert(JSON.stringify(message));
				});
		}).validate();
	};

	var setSessionState = function() {
		// hide all menu items
		$('.content').hide();
		$('[id^=menu-]').hide().off('click');
		if(user_token == null) {
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
		// include token in request
		// load into tables grid
	}

	var select = function() {
		// include token in request
		// get game id value
		// request game state
		// renderGame(gameMap)	
	}

	var start = function() {
		// show new game form
		// include token in request
		// request new game ui screen	
		// on save ...	
		// renderGame(gameMap)	
	}

	var renderGame = function(gameMap) {
		// include token in request
		// gameMap is JSON
		// rows, columns, cells
		// set status
		// can I just draw a table??
	}

	var logout = function() {
		user_token = null;
		setSessionState();
	}


	return {
		initialize: initialize
	};
})(jQuery);

