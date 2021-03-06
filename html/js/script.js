/* Preloader */
$(window).on("load", function() {
	
	/*preload*/
	var preload = $('.preloader');
	preload.find('.spinner').fadeOut(function(){
		preload.fadeOut(500);
	});

});

$(function() {
	var width = $(window).width();
	var height = $(window).height();
	
	/* Clients Menu */
	$('.clients-items').on('click', '.clients-menu', function(){
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('.projects-overlay').fadeOut();
			$('.projects-popup').fadeOut();
		} else {
			$(this).addClass('active');
			$('.projects-overlay').fadeIn();
			$('.projects-popup').fadeIn();
		}
		return false;
	});
	
	/* Gallery */
	$(".gallery-group").fancybox({
		// Options will go here
	});
	
	/* Tabs */
	$('.tab-menu a').click(function(){
		var tab_bl = $(this).attr('href');
		
		$(this).closest('.tabs').find('.tab-menu li').removeClass('active');
		$(this).parent().addClass('active');
		
		$(this).closest('.tabs').find('.tab-item').hide();
		$(tab_bl).fadeIn();

		return false;
	});

	/* Balance Collapse */
	$('.balence-table').on('click', 'tr.dropdown', function(){
		if($(this).find('.dropdown-label').hasClass('opened')) {
			$(this).find('.dropdown-label').removeClass('opened');
			$(this).next().find('.subtable').slideUp();
		} else {
			$(this).find('.dropdown-label').addClass('opened');
			$(this).next().find('.subtable').slideDown();
		}
	});
	
	/* Form Styler */
	if($('.styler').length) {
		$('input.styler, select.styler').styler();
	}

	/* slimScroll */
	$('.scrollbox-x').slimScroll({
		axis: 'x',
		width: '1100px',
		height: 'auto',
		touchScrollStep: 100
	});
	
	/* Tel Mask */
	if($("input[name='tel']").length) {
		$("input[name='tel']").mask("+7 (999) 999-99-99",{placeholder:""});
	}

	/* Datepicker From-To */
	if($('.date-range').length) {
		var dateFormat = 'mm/dd/yy',

		from = $(this).find('.from').datepicker({
			defaultDate: '+1w',
			changeMonth: true
		}).on('change', function() {
			to.datepicker('option', 'minDate', getDate(this));
		}),
		to = $(this).find('.to').datepicker({
			defaultDate: '+1w',
			changeMonth: true
		}).on('change', function() {
			from.datepicker('option', 'maxDate', getDate(this));
		});

		function getDate(element) {
			var date;
			try {
				date = $.datepicker.parseDate(dateFormat, element.value);
			} catch(error) {
				date = null;
			}

			return date;
		}
	}

	if($('.datepicker').length) {
		$(function() {
			$('.datepicker').datepicker();
		});
	}

	if($('#datepicker_inline').length) {
		$('#datepicker_inline').datepicker();
	}

	/* Transactions Popup */
	$('.one-tr-btn').click(function(){
		$('.add-tr-form').fadeIn();
		return false;
	});
	$('.multi-tr-btn').click(function(){
		$('.add-multi-tr-form').fadeIn();
		return false;
	});
	
	/* Edit Client Popup */
	$('.clients-btn.edit').click(function(){
		$('.overlay').fadeIn(250, function(){
			$('#edit-client-popup').animate({'top': $(window).scrollTop() + 100}, 500);
		});
		return false;
	});
	$('.overlay, #edit-client-popup .cancel-btn, #edit-client-popup .close').click(function(){
		$('#edit-client-popup').animate({'top': '-3000px'}, 500, function(){
			$('.overlay').fadeOut(250);
		});
		return false;
	});
	
	/* Validation Forms */
	
	/* Login Form */
	$("#login-form").validate({
		success: "valid"
	});
});