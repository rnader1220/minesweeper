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
		$.ajax({
			type: "GET",
			url: '/api/v1/list',
			headers: {
				Accept: 'application/json',
				Authorization: 'Bearer '+user_token,
			},
		})
		.done(function (resp) {
			drawList(resp);
			setTimeout(function () {
				$('#list').fadeIn(300);
			}, 300);
		})
		.fail(function (message) {
			alert(JSON.stringify(message));
		});
	}

	var drawList = function(resp) {
		/// draw games table
		$('#history table tr').on('click', select(self))
	}

	var select = function(game_id) {
		$.ajax({
			type: "GET",
			url: '/api/v1/play?id='+gameid,
			headers: {
				Accept: 'application/json',
				Authorization: 'Bearer '+user_token,
			},
		})
		.done(function (resp) {
			renderBoard(resp);
			setTimeout(function () {
				$('#game').fadeIn(300);
			}, 300);
		})
		.fail(function (message) {
			alert(JSON.stringify(message));
		});
	}

	var start = function() {
//		renderBoard({rows: 10, cols: 10});
		
		$('.content').hide();
		$('#start').fadeIn(300);
		$('#start form').off('submit')
			.on('submit', function (e) {
			e.preventDefault();
			if ($(this).valid()) $.ajax({
				type: "POST",
				url: '/api/v1/new',
				data: $(this).serialize(),
				headers: {
					Accept: 'application/json',
					Authorization: 'Bearer '+user_token,
				},
	
			})
				.done(function (resp) {
					$('#start').fadeOut(300);
					renderBoard(resp);
					setTimeout(function () {
						$('#game').fadeIn(300);
					}, 300);

				})
				.fail(function (message) {
					alert(JSON.stringify(message));
				});
		}).validate();		

	}

	var renderBoard = function(gameMap) {
		$('#game_table').find('tbody').off('click', 'td');
		$('#game_table').find('tbody').off('contextmenu', 'td');
		// clear table
		var tbl = document.getElementById("game_table");
		tbl.innerHTML = "";
		// do board layout
		for(rownum = 0; rownum < gameMap.rows; rownum++) {
			var row = tbl.insertRow();
			for(colnum = 0; colnum < gameMap.cols; colnum++) {
				var cell = row.insertCell();
				$(cell).attr('row', rownum);
				$(cell).attr('col', colnum);
			}
		}
		$('#game_table').find('tbody').on('click', 'td', function() {pick(this);} );
		$('#game_table').find('tbody').on('contextmenu', 'td', function(e) {e.preventDefault();flag(this);} );

		$('#game').show();
	}

	var renderGame = function(gameMap) {
		// include token in request
		// gameMap is JSON
		// rows, columns, cells
		// set status

	}

	var flag = function(cell) {
		alert('flag ' + $(cell).attr('row') + ':' + $(cell).attr('col'));
		// ajax call
		// on success
		// renderGame(resp);
	}

	var pick = function(cell) {
		alert('pick ' + $(cell).attr('row') + ':' + $(cell).attr('col'));
		// ajax call
		// on success
		// renderGame(resp);

	}

	var logout = function() {
		user_token = null;
		setSessionState();
	}


	return {
		initialize: initialize
	};
})(jQuery);

