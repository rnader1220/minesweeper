var minesweeper = (function($, undefined) {

	var session_id = null;

	var initialize = function() {		
		$('.content').hide();
		session_id = null;
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

					$('#login').fadeOut(300);
					session_id = resp;
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
					session_id = resp.session_id;
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

