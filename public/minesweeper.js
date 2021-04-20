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
			$('#menu-logout').on('click', logout).show();
			resume();
		}

	}

	var resume = function() {
		$.ajax({
			type: "GET",
			url: '/api/v1/resume',
			headers: {
				Accept: 'application/json',
				Authorization: 'Bearer '+user_token,
			},
		})
		.done(function (resp) {
			if(resp != 'false') {
				renderBoard(resp);

			}
		})
		.fail(function (message) {
			//alert(JSON.stringify(message));
		});
	}

	var drawList = function(resp) {
		/// draw games table
		$('#history table tr').on('click', select(self))
	}


	var start = function() {
        $('#game').slideUp(300);
        $('#result').fadeOut(300);
        setTimeout(function () {
            $('#start').slideDown(300);
        }, 600);
        $('#start form input').off('click').on('click', function (e) {
			e.preventDefault();
			curr_game = null;
			if ($(this).valid()) $.ajax({
				type: "POST",
				url: '/api/v1/new',
				data: $('#start form').serialize(),
				headers: {
					Accept: 'application/json',
					Authorization: 'Bearer '+user_token,
				},

			})
				.done(function (resp) {
					$('#start').slideUp(300);
					renderBoard(resp);
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
		$('#game_table').find('tbody').on('click', 'td', function() {pick(this, true);} );
		$('#game_table').find('tbody').on('contextmenu', 'td', function(e) {e.preventDefault();pick(this, false);} );
		renderGame(gameMap);
        $('#game').slideDown(900);
        setTimeout(function () {
            $('#result').html('Clear the way to victory!').fadeIn(300);
        }, 900);

        setTimeout(function () {
            $('#result').fadeOut(900);
        }, 1800);
	}

	var renderGame = function(gameMap) {
		var clickmap = $.parseJSON(gameMap.clickmap);
		for (t=0; t < clickmap.length; t++) {
			element = clickmap[t];
			cell = findCell(element.row * gameMap.rows + element.col);
			switch(element.value) {
				case -3:
					$(cell).html('&#9873;');
                    $(cell).css('color', 'red');
				break;
				case -1:
					$(cell).html('&#10040;');
					$(cell).css('background-color', '#ffd0d0');
                    $(cell).css('color', 'red');
					break;
				case -2:
					$(cell).html('&#10042;');
					$(cell).css('background-color', '#ffd0d0');
                    $(cell).css('color', 'red');
				break;
				case 0:
					$(cell).html(' ');
					$(cell).css('background-color', '#d0d0ff');
					break;
                case 1:
                case 2:
                case 3:
                    $(cell).html(element.value);
                    $(cell).css('background-color', '#d0d0ff');
                    $(cell).css('color', 'blue');
                    break;
                default:
                    $(cell).html(element.value);
					$(cell).css('background-color', '#d0d0ff');
					break;

			}

			switch(element.value) {
                case 1:
                    $(cell).css('color', 'blue');
                    break;
                case 2:
                    $(cell).css('color', 'orange');
                    break;
                case 3:
                    $(cell).css('color', 'green');
                    break;
                case 4:
                    $(cell).css('color', 'red');
                    break;
                case 5:
                    $(cell).css('color', 'purple');
                    break;
                case 6:
                case 7:
                case 8:
                    $(cell).css('color', 'black');
                    break;
			}
            if(element.value != -3) {
				$(cell).addClass('disabled');
			}

		}
		if(gameMap.status != 0) {
            if(gameMap.status == 1) {
				$('#result').html('You emerge victorious.').fadeIn(900);
            } else {
                $('#result').html('Darkness befalls you.').fadeIn(900);
            }
			$('#game_table').find('tbody').off('click');
			$('#game_table').find('tbody').off('contextmenu');
		}

	}

    var styleValue = function(value) {
        value = "<span color='blue'>"+value+"</span>";
        return value;
    }

	var findCell = function(index) {
		var cell = $("#game_table").find("[index]").eq(index);
		return cell;
	}


	var pick = function(cell, ispick) {
		if($(cell).hasClass('disabled')) return false;
		//if ($(cell).css('background-color') != 'silver') return false;
		var data = {
			'row': parseInt($(cell).attr('row')),
			'col': parseInt($(cell).attr('col')),
			'game_id': curr_game
		};
		if(ispick) {
			var url = '/api/v1/pick'
		} else {
			$(cell).html(' ');
			var url = '/api/v1/flag'
		}
		$.ajax({
			type: "POST",
			url: url,
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

