$(document).ready(function() {
	$("input[name='userEmail']").focus(function() {
		if ($(this).val() == "Email адрес") {
			$(this).val("");
		}
		return false;
	});

	$("input[name='userEmail']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Email адрес");
		}
		return false;
	});

	$("input[name='userPassword']").focus(function() {
		if ($(this).val() == "Пароль") {
			$(this).val("");
		}
		return false;
	});

	$("input[name='userPassword']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Пароль");
		}
		return false;
	});

	$("input[name='searchField']").focus(function() {
		if ($(this).val() == "Поиск по сайту") {
			$(this).val("");
		}
		return false;
	});

	$("input[name='searchField']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Поиск по сайту");
		}
	});

	$("input[name='userName']").focus(function() {
		if ($(this).val() == "Ваше имя") {
			$(this).val("");
		}
		return false;
	});

	$("input[name='userName']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Ваше имя");
		}
		return false;
	});

	$("input[name='subscribeEmail']").focus(function() {
		if ($(this).val() == "Email адрес") {
			$(this).val("");
		}
		return false;
	});

	$("input[name='subscribeEmail']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Email адрес");
		}
		return false;
	});

	$("input[name='feedbackUser']").focus(function() {
		if ($(this).val() == "Ваше имя") {
			$(this).val("");
			$(this).css({'color':'#555'});
		}
		return false;
	});

	$("input[name='feedbackUser']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Ваше имя");
			$(this).css({'color':'#ccc'});
		}
		return false;
	});

	$("input[name='feedbackEmail']").focus(function() {
		if ($(this).val() == "Email адрес") {
			$(this).val("");
			$(this).css({'color':'#555'});
		}
		return false;
	});

	$("input[name='feedbackEmail']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Email адрес");
			$(this).css({'color':'#ccc'});
		}
		return false;
	});

	$("textarea[name='feedback-textarea']").focus(function() {
		if ($(this).val() == "Ваше сообщение") {
			$(this).val("");
			$(this).css({'color':'#555'});
		}
		return false;
	});

	$("textarea[name='feedback-textarea']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Ваше сообщение");
			$(this).css({'color':'#ccc'});
		}
		return false;
	});

	$('.delete-btn').click(function() {
		var w = $(window).width();
		var offset = $(this).offset();
		var posW = (w / 2) - 130;
		var posH = offset.top - 75;
		var newsId = $("input[name='newsId']").val();
		var category = $("input[name='category']").val();
		var commId = $(this).val();
		$('body').append("<div class='black-frame'>\
							<div class='dialog'>\
								<div class='dialog-title'>Удаление</div>\
								<div class='dialog-text'>\
									Удалить комментарий?\
								</div>\
								<div class='dialog-buttons'>\
									<form action='/comments/delete/"+commId+"' method='POST'>\
										<input type='hidden' name='newsId' value='"+newsId+"'>\
										<input type='hidden' name='category' value='"+category+"'>\
										<button>Да</button>\
										<button class='last' onclick='hideDialog(); return false;'>Нет</button>\
									</form>\
								</div>\
							</div>\
						</div>");
		$(".dialog").offset({top: posH, left: posW});
		return false;
	});

	$(".edit-btn").click(function() {
		var commentText = $(this).parent("li").parent("ul").parent(".edit-panel").siblings(".comment-text");
		var area = commentText.children("form");
		var newsId = $("input[name='newsId']").val();
		var category = $("input[name='category']").val();
		if (area.length == 0) {
			commentText.append("<form action='/comments/edit/"+$(this).val()+"' method='POST'>\
									<div class='edt-panel'>\
										<input type='hidden' name='newsId' value='"+newsId+"'>\
										<input type='hidden' name='category' value='"+category+"'>\
										<textarea name='editComment'>"+commentText.html()+"</textarea>\
										<div class='btns-block'>\
											<button>Сохранить</button>\
											<button class='last' name='cancel' onclick='closeEdit(); return false;'>Отменить</button>\
										</div>\
									</div>\
								</form>");
		}
	});

	$("#feedback").submit(function(event) {
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		var feedbackUser = $.trim($("input[name='feedbackUser']").val());
		var feedbackEmail = $.trim($("input[name='feedbackEmail']").val());
		var feedbackMessage = $.trim($("textarea[name='feedback-textarea']").val());
		if (feedbackUser === "Ваше имя" || feedbackUser === "") {
			showDialog("Пустое имя пользователя");
			event.preventDefault();
			return false;
		} else if (feedbackEmail === "Email адрес" || feedbackEmail === "") {
			showDialog("Пустой email адрес");
			event.preventDefault();
			return false;
		} else if (feedbackMessage === "Ваше сообщение" || feedbackMessage === "") {
			showDialog("Пустое сообщение!");
			event.preventDefault();
			return false;
		} else if (!pattern.test(feedbackEmail)) {
			showDialog("Не правильный email адрес!");
			event.preventDefault();
			return false;
		}
	});

	$("#subscribe").submit(function(event) {
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		var subscriberName = $.trim($("input[name='userName']").val());
		var subscriberEmail = $.trim($("input[name='subscribeEmail']").val());
		//alert (subscriberName+subscriberEmail);
		if (subscriberName === "Ваше имя" || subscriberName === "") {
			showDialog("Пустое имя пользователя");
			event.preventDefault();
			return false;
		} else if (subscriberEmail === "Email адрес" || subscriberEmail === "") {
			showDialog("Пустой email адрес");
			event.preventDefault();
			return false;
		} else if (!pattern.test(subscriberEmail)) {
			showDialog("Не правильный email адрес!");
			event.preventDefault();
			return false;
		}
	});
});

function hideDialog() {
	$(".black-frame").remove(".black-frame");
}

function closeEdit() {
	var tarea = $("textarea[name='editComment']");
	var frm = tarea.parent("div").parent("form");
	frm.remove();
}

function showDialog(warningMsg) {
	$("#page-wrapper").append("<div class='black-frame'>\
									<div class='dialog'>\
										<div class='dialog-title'>Предупреждение!</div>\
										<div class='dialog-text'>"+warningMsg+"</div>\
										<div class='dialog-buttons'>\
											<button class='last' onclick='hideDialog(); return false;'>Ок</button>\
										</div>\
									</div>\
								</div>");
}