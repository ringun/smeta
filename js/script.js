var closeModal = function(modal){
	$('.modal').fadeOut(200, function(){
		$('.modal-wrapper').fadeOut(200);
	});
}

var closeModalSuccess = function(modal){
	$('.modal-success').fadeOut(200, function(){
		$('.modal-wrapper').fadeOut(200);
	});
}

var openModal = function(){
	$('.modal-wrapper').fadeIn(200, function(){
		$('.modal').fadeIn(200);
	});
}

var successSended = function(){
	$('.preloader').fadeOut(200, function(){
		$('.modal-success').fadeIn(200);
	});
}

var sendData = function(data){
	$('.modal').fadeOut(200, function(){
		$('.preloader').fadeIn(200, function(){
			$.ajax({
				type: "POST",
				url: "/mail.php",
				data: data,
				success: function(msg){
					console.log(msg);
					if(msg == '1')
						successSended();
				}
			});
		});
	});
}


$(document).ready(function(){
	$('.header__item').on('click', function(){

	});

	$('.modal__close').on('click', function(){
		closeModal();
	});

	$('.btn-ok').on('click', function(){
		closeModalSuccess();
	});

	$('.callback-header').on('click', function(e){
		e.preventDefault();
		openModal();
	});

	$('.main-call-form').on('submit', function(e){
		e.preventDefault();

		var name = $(this).children('input[name="name"]').val();
		var phone = $(this).children('input[name="phone"]').val();

		if(name == '' || phone == '')
		{
			alert('Необходимо заполнить все поля!');
			return;
		}

		if(phone.length < 6)
		{
			alert('Телефон должен быть не менее 6 знаков');
			return;
		}
		sendData({
			name: name,
			phone: phone
		});
		$(this).children('input[name="name"]').val('');
		$(this).children('input[name="phone"]').val('');
	});

	$("a.scrollto").click(function() {
	    var elementClick = $(this).attr("href")
	    var destination = $(elementClick).offset().top - 120;
	    jQuery("html:not(:animated),body:not(:animated)").animate({
	      scrollTop: destination
	    }, 800);
	    return false;
	});
});