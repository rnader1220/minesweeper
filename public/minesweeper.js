var minesweeper = (function($, undefined) {

	var user_token = null;
	var curr_game = null;

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
			url: '/api/v1/play?id='+game_id,
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
		curr_game = gameMap.id;
		var tbl = document.getElementById("game_table");
		tbl.innerHTML = "";
		// do board layout
		for(rownum = 0; rownum < gameMap.rows; rownum++) {
			var row = tbl.insertRow();
			for(colnum = 0; colnum < gameMap.cols; colnum++) {
				var cell = row.insertCell();
				$(cell).attr('row', rownum);
				$(cell).attr('col', colnum);
				$(cell).attr('index', rownum * gameMap.rows + colnum);

			}
		}
		$('#game_table').find('tbody').on('click', 'td', function() {pick(this);} );
		$('#game_table').find('tbody').on('contextmenu', 'td', function(e) {e.preventDefault();flag(this);} );
		$('#game').show();
		
	}

	var renderGame = function(gameMap) {
		var clickmap = $.parseJSON(gameMap.clickmap);
		for (t=0; t < clickmap.length; t++) {
			element = clickmap[t];
			cell = findCell(element.row * gameMap.rows + element.col);
			$(cell).css('background-color', '#d0d0ff');
			switch(element.value) {
				case -3:
					$(cell).html('&#9873;');
				break;
				case -1:
					$(cell).html('&#10040;');
				break;
				case -2:
					$(cell).html('&#10042;');
				break;
				case 0:
					$(cell).html(' ');
					break;
				default:
					$(cell).html(element.value);
				break;

			}
			$(cell).addClass('disabled');

		}
		if(gameMap.status == -1) {
			alert('game over!');
			$('#game_table').find('tbody').off('click');
			$('#game_table').find('tbody').off('contextmenu');
	
		}

	}

	var findCell = function(index) {
		var cell = $("#game_table").find("[index]").eq(index);
		$(cell).css('background-color', 'red');
		return cell;
	}

	var flag = function(cell) {
		alert('flag ' + $(cell).attr('row') + ':' + $(cell).attr('col'));
		// ajax call
		// on success
		// renderGame(resp);
	}

	var pick = function(cell) {
		if($(cell).hasClass('disabled')) return false;
		//if ($(cell).css('background-color') != 'silver') return false;
		var data = {
			'row': parseInt($(cell).attr('row')),
			'col': parseInt($(cell).attr('col')),
			'game_id': curr_game
		};

		$.ajax({
			type: "POST",
			url: '/api/v1/pick',
			data: data,
			headers: {
				Accept: 'application/json',
				Authorization: 'Bearer '+user_token,
			},
			})
			.done(function (resp) {
				renderGame(resp);
			})
			.fail(function (message) {
				alert(JSON.stringify(message));
			});
	}

	var logout = function() {
		user_token = null;
		setSessionState();
	}


	return {
		initialize: initialize
	};
})(jQuery);

