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
	});

	$("input[name='userPassword']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Пароль");
		}
	});

	$("input[name='searchField']").focus(function() {
		if ($(this).val() == "Поиск по сайту") {
			$(this).val("");
		}
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
	});

	$("input[name='userName']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Ваше имя");
		}
	});

	$("input[name='subscribeEmail']").focus(function() {
		if ($(this).val() == "Email адрес") {
			$(this).val("");
		}
	});

	$("input[name='subscribeEmail']").blur(function() {
		if ($(this).val() == "") {
			$(this).val("Email адрес");
		}
	});

	$('.delete-btn').click(function() {
		var w = $(window).width();
		var offset = $(this).offset();
		var posW = (w / 2) - 130;
		var posH = offset.top - 75;
		var newsId = $("input[name='newsId']").val();
		var category = $("input[name='category']").val();
		var commId = $(this).val();
		$('body').append("<div class='dialog'>\
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
});

function hideDialog() {
	$(".dialog").remove(".dialog");
}

function closeEdit() {
	var tarea = $("textarea[name='editComment']");
	var frm = tarea.parent("div").parent("form");
	frm.remove();
}