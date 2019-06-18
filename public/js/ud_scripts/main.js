// JavaScript Document

/* calendar default variables */
var dateObj = new Date();
var myMonth = dateObj.getMonth()+1;
var myYear = dateObj.getFullYear();
var rightMargin = 5; // initial margin of category divs
var months = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
var img01, img02, img03; /* ajax loading images */

$(document).ready(function(){
	img01 = $("<div class='loadingImg01'><img src='"+getHomeRoute()+"img/ud_images/loader01.gif' /></div>");
	img02 = $("<div class='loadingImg02'><img src='"+getHomeRoute()+"img/ud_images/loader02.gif' /></div>");
	img03 = $("<div class='loadingImg02'><img src='"+getHomeRoute()+"img/ud_images/loader03.gif' /></div>");
	toggleMenu(); 
	toggleFloater();
	loadHome();
	loadCalendar();
	navBlog(); // handles asynchronous ajax request for navigation the blog page from thumb-nails
	loadPost(); // handles asynchronous ajax request for loading the blog by archive-links
	inputTextHandler();
	toggleComments();
	animateComments();
	processComments();
	//sniffText();
	loginCheck();
	//textBoxHandler();
	navCategory();
	notify();
	initializeEditor();
	// styleSelect(); // Style all select tags within widget
	$(window).scrollTop(0).promise().done(function() {
		animateDBoard();
	});
});

function initializeEditor() {
	if($('#post').length) {
		tinymce.init({
			selector: '#post',
			plugins : 'advlist anchor autolink autoresize autosave charmap code codesample directionality emoticons fullpage fullscreen help hr image imagetools importcss insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak paste preview print quickbars save searchreplace spellchecker tabfocus table toc visualblocks visualchars wordcount',
			toolbar : 'image media code codesample numlist bullist forecolor backcolor ltr rtl emoticons fullpage fullscreen hr insertdatetime nonbreaking pagebreak paste preview print quickbars save table searchreplace spellchecker toc visualblocks visualchars wordcount help',
			image_caption: true,
			image_advtab: true,
			image_title: true,
			imagetools_cors_hosts: ['udsd.test'],
			autoresize_bottom_margin: 20,
			max_height: 900,
			min_height: 600,
			content_css: '/css/ud_css/tinymce.css',
			importcss_append: true,
			insertdatetime_element: true,
			media_live_embeds: true,
			nonbreaking_force_tab: true,
			pagebreak_separator: '____________________________________________________',
			pagebreak_split_block: true,
			paste_data_images: true,
			paste_as_text: true,
			paste_retain_style_properties: 'all',
			quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
			quickbars_insert_toolbar: 'quickimage quicktable'
		});
	}
}

function toggleFloater() {
	var floater =  $('#floater').show().css('right', '-280px');
	$('.floater-menu-icon').on('click', function() {
		$('#sideNav .active').removeClass('active');
		floater.animate({right: '-280px'}, 'fast', function() {
			floater.children('div').hide();
		});
		return false;
	});
	$('#sideNav a').on('click', function() {
		var source = $(this).parent();
		var target = source.is('#sideArchive')?$('#archiveFloater'):$('#calendarFloater');
		if(source.is('.active')) {
			source.removeClass('active');
			floater.animate({right: '-280px'}, 'fast', function() {
				target.hide();
			});
		} else {
			source.addClass('active').siblings().removeClass('active');
			target.siblings('div').hide('fast').end().show('fast').promise().done(function() {
				floater.animate({right: 0}, 'slow', 'swing');
			});
		}
		return false;
	});
}

function calendarQtip() {
	$('.postdaywrapper, .wrapper').off('click').on('click', function() {	
		if($(this).is('.postdaywrapper')) {
			var source = $(this).toggleClass('active');
			var id = '.calendar_post' + parseInt($(this).filter(':only-child:last').text());
			var target = $(this).parents('.ajax_content_calendar').find(id);
			var sourcerow = $(this).parents('.calRow');
			target.off('click').slideToggle(function() {
				if($(this).is(':visible')) {
					$(this).find('.close-menu').on('click', function() {
						source.removeClass('active');
						$(this).off('click');
						target.slideUp().next().slideUp('slow').promise().done(function() {
							sourcerow.nextAll().not('.calendar-archive').filter(':last').after(target.parent());
						});
						return false;
					});
					sourcerow.nextAll().not('.calendar-archive').slideUp('slow').promise().done(function() {
						sourcerow.after(target.parent()).nextAll().slideDown();
					})
				} else {
					$(this).find('.close-menu').off('click');
					sourcerow.nextAll().not('.calendar-archive').filter(':last').after(target.parent());
				}
			}).next().slideToggle();
		}
		return false;
	});
}

// executes for all sent ajax requests
$(document).ajaxSend(function(event, requestObj, settings){
		if(settings.id === 1) {
			settings.target.text("").append(img01); // empty the target and append loading image
		} else {
			settings.target.prepend(img03);
		}
	requestObj.done(function(data){
		if(settings.id === 1) {
			settings.target.html(data); // insert requested data
		} else {
			settings.target.find('.loadingImg02').remove();
			settings.target.prepend(data);
		}
	}).fail(function(requestObj, textStatus, errorThrown){
		settings.target.html('Sorry! Your request could not be completed at this time: ' + errorThrown);
	}).always(function(){
		settings.callBack();
	});
});

// perform the ajax request
function doAjax(type, id, url, data, target, callBack) {
	var jqXHR = $.ajax({
		url: url, // url to retrieve data from
		type: type, // method used to send request: either 'get' or 'post'
		data: data, // data request to be sent to the server
		cache: false, // do not load from cache
		dataType: 'html', // retrieve data strictly of type html and not xml
		id: id, // arbitrary option used to identify each request
		target: target, // html object into which data is to be loaded
		callBack: callBack // function to call after request is completed
	});
}

// get the home url from the routing table
function getHomeRoute() {
	return $('#routingTable a:first').prop('href');
}

// use routing table to identify ajax links from normal links
function getAjaxRoute(url) {
	// seperate actual url from get parameters if any
	var linkArray = url.split('?'); 
	var link = linkArray[0];
	var params = (linkArray.length>1)?('?'+linkArray[1]):"";
	// var params = "";
	// if (linkArray.length > 1) params = '?' + linkArray[1];

	// get the corresponding ajax route from routing table
	var urlRoute = $('#routingTable a').filter(function() {
		return $(this).prop('href') === link;
	});

	// if the supplied url is non-ajax route get the ajax route
	// else if it is an ajax route return it as well
	if (urlRoute.prop('class') === 'urlRoute')
		return urlRoute.next().prop('href') + params;
	else return urlRoute.prop('href') + params;
}

// convert form data in the form of name-value pairs to object
function formArrayToObject(arr) {
	var obj = {};
	$.each(arr, function(i, e) {
		obj[e.name] = e.value;
	});	
	return obj;
}

// capture all major navigation links that will use ajax and attach custom click handler
function loadHome() {
	// for main navigation, sub navigation and pagination links
	$('#mainNav a, #subNav > a[href], #paginator a, #menu ul a, .show-post-link').off('click').on('click.loadHome', function(){
		if($(this).is('#mainNav a')) {
			// make only the currently clicked main navigation link active and make others inactive
			$(this).children('div').addClass('active').end().siblings().children('div').removeClass('active');
			if($(this).is('#mainNav a:first')) $('#subNav').show();
			else $('#subNav').hide();
		}
		if($(this).is('#subNav > a')) {
			// make only the blog link and the currently clicked sub navigation link active and make others inactive
			$('#mainNav div, #subNav a').removeClass('active');
			$('#mainNav div:first').addClass('active');
			$(this).addClass('active');
		}
		if($(this).is('.show-post-link')) {
			var posttype = $(this).find('.posttype').text();
			// move div to end of the div collection
			restackCategory(posttype);
		}
		var ajaxRoute = getAjaxRoute($(this).prop('href'));
		// perform ajax
		doAjax('get', 1, ajaxRoute, "", $('#mcontent'), function(){
			loadHome(); // to recapture reloaded paginations
			toggleComments();
			postComment();
		});
		return false;
	});
}

// handles asynchronous ajax request for loading calendar by select tags
function loadCalendar() { 
	// trigger initial change of select tag
	$('.select_mth').val(myMonth).change();
	$('.select_yr').val(myYear).change();
	// show the initially selected month and year
	$('.cal_nav_text span').append(months[myMonth-1] + " " + myYear);
	// from routing table
	var route = $('#calendarRoute a:nth-child(2)').prop('href');
	//perform ajax
	doAjax('get', 1, route, {month: myMonth, year: myYear}, $('.ajax_content_calendar'), function(){
		loadArchive();
		// selectWidget(); // chain the next ajax request
		navCalendar(); // add handlers to the loaded calendar navigation buttons
		// animateWidgets();
		calendarQtip();
	});
}

// handles asyncronous ajax request for loading achives by select tags
function loadArchive() {
	// trigger initial change of select tag
	$('.sort_by').val('category').change();
	// from routing table
	var route = $('#archiveRoute a:nth-child(2)').prop('href');
	// perform ajax
	doAjax('get', 1, route, "", $('.ajax_content_archive'), function(){
		animateWidgets('*'); // for animating the loaded archive
		selectWidget(); // chain the next ajax request
		// loadCalendar(); // chain the next ajax request
	});
}

// animate the opening and closing of widget options
function animateWidgets(context) {
	if(context === '*') context = $('*');
	context.find('.archive_level_2 li').off('click').on('click', function(){
		// from routing table
		var route = getAjaxRoute($(this).find('a').prop('href'));
		// category of this post
		var posttype = $(this).find('.posttype').text();
		// move div to end of the div collection
		restackCategory(posttype);
		// do ajax
		doAjax('get', 1, route, "", $('#mcontent'), function(){
			toggleComments();
			postComment();
		});	
		return false;
	});
	// hide inner list items with links
	// $('.archive_level_2 ul').hide();
	// click handler to toggle display of the select menus for all widgets
	context.find('.widget_option_btn').off('.animateWidgets').on('click.animateWidgets', function(){
		$(this).toggleClass('widget_option_clicked').parent().next().slideToggle();
	});
	// click handler to toggle display of each list section in archive
	context.find('.archive_level_3').next().hide().end().off('.animateWidgets').on('click.animateWidgets', function(){
		// toggle display of the associated links and attach click handlers for each link 
		$(this).toggleClass('ul_selected').next().toggle('slow');
	});
}

// handles asyncronous ajax request for loading achives by select tags
function selectWidget() {
	// attach click handler to all select tags in widget
	$('.widget_parent select').on('change.selectWidget', function(){
		var context = $(this).parents('.widget_parent');
		// get route from parent form action
		var form = $(this).parents('form');
		var route = getAjaxRoute(form.attr('action'));
		// convert form data to object
		var data = formArrayToObject(form.serializeArray());
		// the calendar select also update the displayed month and year
		if($(this).is('.calendar_select')) {
			$(this).parents('.widget_calendar').find('.cal_nav_text span').html(months[data.month-1] + " " + data.year);
		};
		// perform ajax
		doAjax('get', 1, route, data, context.find('.ajax_content'), function() {
			animateWidgets(context); // reanimate the loaded widgets
			calendarQtip();
		});
		return false;
	});
}

// handles asynchronous ajax request for loading calendar by navigation buttons
function navCalendar() {
	$('.cal_nav_left, .cal_nav_right').click(function(){
		var context = $(this).parents('.widget_parent');
		var selectmth = context.find('.select_mth').off('change.selectWidget');
		var selectyr = context.find('.select_yr').off('change.selectWidget');
		// $(this).parents('.widget_content').find('.select_mth, .select_yr').off('change.selectWidget');
		var route = getAjaxRoute(context.find('form').attr('action'));
		var nav = 1;
		if($(this).is('.cal_nav_left')) {
			nav = -1;
		} 
		var month = parseInt(selectmth.val()) + nav;
		var year = parseInt(selectyr.val());
		if(month > 12) {
			month = 1;
			year = year + 1;
			if (year > 3000) {
				month = 12;
				year = 3000;
			}
		} else if(month < 1) {
			month = 12;
			year = year - 1;
			if (year < 2000) {
				month = 1;
				year = 2000;
			}
		}
		selectmth.val(month).change();
		selectyr.val(year).change();
		$(this).parents('.cal_nav').find('.cal_nav_text span').html(months[month-1] + " " + year);
		doAjax('get', 1, route, {'month': month, 'year': year}, context.find('.ajax_content'), function(){
			selectWidget();
			animateWidgets(context);
			calendarQtip();
		});
		return false;
	});
}

// handles blog navigation using category links instead of the select menu
function navCategory() {
	var zOrder = 0; // track stacking order of categories
	// var count = 0; // track number of categories
	var maxWidth = 0; // track the category div with the maximum width
	// get route from parent form action 
	var route = $('#postCategory').parent('form').prop('action');
	// attach span to subNav to collect all category divs
	$('#subNav').append($("<span id='catCollection'></span>"));
	// convert all select menu options to divs and remove them
	$('#postCategory option').each(function(index) {
		if(index !== 0 && $(this).val() !== '') {
			// attach new divs to span
			$('#catCollection').prepend(
				$("<a class='cat-link' href='"+ route + "?posttype=" + $(this).val() + "'></a>").append(
					$("<div id='cat" + index + "'></div>").css({marginRight: rightMargin*(index-1)}).append(
						$(this).val()
					)
				)
			);
			// determine the maximum width
			maxWidth = (maxWidth < $("#cat"+ index).width()) ? $("#cat"+ index).width() : maxWidth;
			count++; // track the number of divs
		}
	}).parents('a').remove();

	var count = $('#catCollection div').width(maxWidth).length; // set the width of all divs to same width and attach click handles to them;
	var newMargin = $('#catCollection div:first').outerWidth()/2;
	$('#catCollection').on('mouseenter.navCategory, focusin, click', function(e){
		$(document).on('click.navCategory', function(e) {
			if(!$(e.target).is('#catCollection, #catCollection *')) {
				restackCategory("");
				// $('#catCollection').off('click').find('a').off('click');
				$(document).off('click.navCategory');
			}
		});
		$(this).find('a').on('click', function(){
			// from routing table
			var ajaxRoute = getAjaxRoute($(this).prop('href'));
			// restack and animate divs
			restackCategory($(this).children('div').text()).find('.active').stop(true, false).animate({marginRight: 0}, 'slow', function() {
				doAjax('get', 1, ajaxRoute, "", $('#mcontent'), function(){
					loadHome(); // to recapture reloaded paginations
					toggleComments();
					postComment();
				});	
			});
			return false;
		});
		$(this).find('div').each(function(index, element) {
			$(element).stop(true, false).animate({marginRight: newMargin*(count-index-1)}, 'slow', 'swing');
		});
		return false;
	}).on('mouseleave.navCategory, focusout', function(e){
		// rightMargin = 5;
		$(this).find('div').each(function(index, element) {
			$(element).stop(true, false).animate({marginRight: rightMargin*(count-index-1)}, 'slow', 'swing');
			zOrder = 0;
		});
		return false;
	});
}

function toggleMenu() {
	$('.menu-icon').on('click', function() {
		if($('#dashboard').css('top') === '-50px') {
			$('#menu').css('top','0');
		} else {
			$('#menu').css('top','50px');
		}
		$('#menu').slideToggle();
		$(document).on('click.toggleMenu', function(e) {
			if(!$(e.target).closest('#menu').length && $('#menu').is(":visible")) {
				$('#menu').slideUp();
				$(document).off('click.toggleMenu');
			}
		});
		return false;
	});
}

function toggleComments() {
	$('.hidden-comment').hide();
	$('.show-comments').on('click', function() {
		var targetDiv = $(this).parent().find('.hidden-comment');
		var targetText = $(this); 
		var size = targetDiv.length.toString();
		targetDiv.slideToggle(function() {
			if($(this).is(':visible')) {
				targetText.text('Hide Comments');
			}
			else {
				targetText.text('Show more Comments(' + size + ')');
			}
		});
	});
}

function postComment() {
	$('.btn-comment').on('click', function() {
		var form = $(this).parents('form');
		var ajaxRoute = getAjaxRoute(form.prop('action'));
		var data = formArrayToObject(form.serializeArray());
		var title = $(this).parents('.comments').find('.comment-ajax-title').css('display', 'block');
		var count = $(this).parents('.comments').find('.ajax-comment').length + 1;
		// var textArea = $(this).parents('form').find('textArea');
		// alert(textArea.val());
		doAjax('post', 2, ajaxRoute, data, $(this).parents('.comments').find('.commentAjax'), function(){
			title.text("New Comments(" + count + ")");
			form.find('textarea').val('');
		});
		return false;
	});
}

function animateDBoard() {
	//$('*').off('.animateDBoard');
	var eObj = $('#dashboard');
	var eH = eObj.height();
	var scrollVal = $(window).scrollTop();
	var status = true, iniVal = scrollVal, finVal = 0-eH, prevM = 0, pace = 0;
	eObj.css({position: 'fixed'}).offset({top: iniVal}).prev().css({display: 'block', marginTop: prevM+'px'});
	scrollCheck();
	$('#loginBtn').on('click.animateDBoard', function(){
		if(!status) {
			iniVal = 0-eH; finVal = 0; pace = 5;
			scrollCheck();
		}
		else {
			iniVal = 0; finVal = 0-eH; pace = -5;
			$(document).off('scroll.animateDBoard');
		}
		moveUi();
	});
	function moveUi() {
		iniVal += pace; prevM += pace;
		eObj.css({top: iniVal+'px'}).prev().css('marginTop', prevM+'px');
		if(iniVal == finVal) {status=!status; return;}
		setTimeout(moveUi,10);
	}
	function scrollCheck() {
		$(document).on('scroll.animateDBoard', function(){
			if($(window).scrollTop() > 200) eObj.hide();
			else eObj.show();
		});
	}
}

// restacks the category divs by placing selected target in front
function restackCategory(category) {
	// number of category divs
	var count = $('#catCollection div').length;
	// find matching div in subNav for this category
	var target = $('#catCollection div').filter(function(){
		return category === $(this).text();
	});
	if(target.length) {
		// inactivate all subnav links
		$('#mainNav div, #subNav a').removeClass('active');
		// make home div in mainNav active
		$('#mainNav div:first').addClass('active');
		// clone the parent link of the present matching div
		var element = target.parent().clone(true);
		// the parent span of all the divs for category navigation
		var parent = target.parents('span');
		// remove the parent link of the target
		target.parent().remove();
		// activate this class
		element.addClass('active');
		// add cloned element to end of parent span
		parent.append(element);
		// adjust right margins
	}
	$('#catCollection div').each(function(index, element) {
		// alert('i entered');
		$(element).stop(true, false).animate({marginRight: rightMargin*(count-index-1)}, 'slow', 'swing', function() {
			// alert('i closed');
			$('#catCollection a').off('click');
		});
	});
	return parent;
}

function navBlog() {
	//$('*').off('.navBlog');
	$('.navbtn').off('.navBlog').on('click.navBlog', function(e){
		ajaxHandler(4, 'ud_ajax/home-ajax.php', {pageSection: $(this).attr('id')}, $('#mcontent'), function(){
			//$(*).off('.inputTextHandler').off('.animateComments');
			inputTextHandler();
			animateComments();
		});
		e.preventDefault();
	});
}

function loadPost() {
	//$('*').off('.loadPost');
	$('.archive_level_2 li').off('.loadPost').on('click.loadPost', function(e){
		var ilink = $('a',this).attr('href');
		var arr = ilink.split('?pId=');
		arr = arr[1].split('&pTitle=');
		ajaxHandler(5, 'ud_ajax/blog-ajax.php', {pId: arr[0], pTitle: arr[1]}, $('#mcontent'), function(){
			//$(*).off('.inputTextHandler').off('.animateComments');
			inputTextHandler();
			animateComments();
		});
		e.preventDefault();
	});
}

function handleText(eObj, eStr, iniStyle, finStyle, callBack1, callBack2) {
	var status = false;
	eObj.off('.inputTextHandler').on('focusin.inputTextHandler', function(){
		if(!status) {
			$(this).attr('value', '').css(finStyle);
			callBack1();
			status = true;
		}
	});
	eObj.on('focusout.inputTextHandler', function(){ 
		if(status && $(this).attr('value') == '') {
			$(this).attr('value', eStr).css(iniStyle);
			callBack2();
			status = false;
		}
	});
}

function inputTextHandler() {
	//$('*').off('.inputTextHandler');
	handleText($('#searchf'), 
		'Custom Search', 
		{color: '#9D9D9D', fontStyle: 'italic'}, 
		{color: '#121212', fontStyle: 'normal'}, 
		function(){$('#searchf').animate({width:'+=50'}, 'fast', 'swing');}, 
		function(){$('#searchf').animate({width:'-=50'}, 'fast', 'swing');}
	);
	/*handleText($('#loginUname'),
				'username or email',
				{color: '#666677'},
				{color: '#111111', backgroundColor: '#fff'},
				function(){},
				function(){}
	);
	handleText($('#loginPass'),
				'password',
				{color: '#666677'},
				{color: '#111111', backgroundColor: '#fff'},
				function(){},
				function(){}
	);*/
	/* this next block is equivalent to the 2 above */
	$('.authTxt').each(function() { // use this method when you want to handle a single class with multiple objects
		var eObj = $(this);
		handleText(eObj,
			'password',
			{color: '#666677'},
			{color: '#111111', backgroundColor: '#fff'},
			function(){},
			function(){}
		);
	});
	$('.commentTxt').each(function() { // use this method when you want to handle a single class with multiple objects
		var eObj = $(this);
		handleText(eObj,
			'leave a comment',
			{color: '#3b3b3b', fontStyle: 'italic', fontSize: '0.9em'},
			{color: '#121212', fontStyle: 'normal', fontSize: '0.86em'},
			function(){eObj.animate({height:'+=17'}, 'fast', 'swing', function(){eObj.next().slideDown()});}, 
			function(){eObj.next().slideUp(function(){eObj.animate({height:'-=17'}, 'fast', 'swing');});}
	 	);
	});
}

function loginCheck() {
	//$('*').off('.loginCheck');
	$('#f1').on('submit.loginCheck', function(e){
		var validateName = '';
		var validatePass = ''; 
		validateName = checkUsername($(this).children('input[name="uname"]').val());
		validatePass = checkPassword($(this).children('input[name="paswod"]').val());
		if(validatePass != '' || validateName != '') {
			if(validatePass!='') {$(this).children('input[name="paswod"]').css({backgroundColor: '#f55', color: '#111'})}
			if(validateName!='') {$(this).children('input[name="uname"]').css({backgroundColor: '#f55', color: '#111'})}
			alert(validateName + validatePass);
			e.preventDefault();
		}
	});
}

function notify() {
	//$('*').off('.notify');
	if($('#errorSignin').text() != '' || $('#logout').text() != '') {
		$('#loginBtn').trigger('click.notify');
	}
}

function animateComments() {
	$('*').off('.animateComments');
	$('.commentlink').each(function(){
		var status = false;
		var eObj = $(this);
		eObj.show();
		var targetId = '#'+eObj.attr('id')+'group';
		var initext = eObj.text(); 
		$(targetId).hide();
		eObj.off('.animateComments').on('mouseover.animateComments', function(){
			eObj.css('textDecoration', 'underline');
		}).on('mouseout.animateComments', function(){
			eObj.css('textDecoration', 'none');
		}).on('click.animateComments', function(e){
			$(targetId).slideToggle(function(){
				if(!status) {
					eObj.text('hide older comments');
					status=!status;
				}
				else {
					eObj.text(initext);
					status=!status;
				}
			});
			return false; // does not resets page position
			//preventDefault(e); // resets page position
		});
	});
}

function processComments() {
	/*function postComment(form) {
		formObj = form;
<?php 	if($loggedin) {?>
			doComment(formObj);
<?php 	} else {?>
		YAHOO.udoShareDesk.container.panel3.show();
		var ev = YAHOO.util.Event.addListener("ctsbt", "click", submitCaptcha, YAHOO.udoShareDesk.container.panel3, false);
<?php 	} ?>
	}*/
	
	$('.postContainer').each(function(){
		var eObj = $(this);
		var form = eObj.children('.commentFormDiv').children('.commentForm');
		form.on('submit.processComments', function(){
			eObj.children('.comments').children('.commentAjax').append("<div class='pastcomment inactive'><img style='width:16px; height:16px; position:relative; left:428px;' src='ud_images/loader03.gif' /></div>")
			ajaxHandler(6, 'ud_extensions/postcomment.php', {comment: form.children('.commentTxt').val(), postid: form.children('.commentId').val(), posttitle: form.children('.commentTitle').val(), commenter: form.children('.commenter').val()}, eObj.find('.inactive').last(), function(){});
			return false;
		});
	});
}


// function widgetLinksHandler(target) {
// 	// from routing table
// 	var route = getAjaxRoute(target.find('a').prop('href'));
// 	// category of this post
// 	var posttype = target.find('.posttype').text();
// 	// move div to end of the div collection
// 	restackCategory(posttype);
// 	// do ajax
// 	doAjax('get', 1, route, "", $('#mcontent'), function(){
// 		toggleComments();
// 		postComment();
// 	});	
// }

// load() no longer supported in jQuery 3.4
// $(window).load(function(){
// 	// loadArchive();
// });

// not working as expected
// function getRoute(link) {
// 	$.expr[':'].myLink = function(e) {
// 		return $(e).prop('href') === link;
// 	};
// 	alert($('#routingTable a:first').length);
// }

// use with Uniform select styler - no longer supported for jQuery 3.4
// function styleSelect() {
// 	$('.ajax_select select').uniform({
// 		selectAutoWidth: true,
// 		focusClass: 'mouseleave'
// 	});
// }

// making ajax content loaded with the select tag unscrollable
// use Select2 for styling the select menus
// function styleSelect() {
// 	$('.ajax_select select').select2({
// 		dropdownCss: {
// 			color: '#111',
// 			textAlign: 'left'
// 		}
// 	});

// 	$('*').off('scroll.select2');
// }