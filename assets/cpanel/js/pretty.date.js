/*
 * JavaScript Pretty Date
 * Copyright (c) 2011 John Resig (ejohn.org)
 * Licensed under the MIT and GPL licenses.
 */

// Takes an ISO time and returns a string representing how
// long ago the date represents.
function prettyDate(time){
	var date = new Date((time || "").replace(/-/g,"/").replace(/[TZ]/g," ")),
	diff = (((new Date()).getTime() - date.getTime()) / 1000),
	day_diff = Math.floor(diff / 86400);

	if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
		return;

	return day_diff == 0 && (
		diff < 60 && "Agora" ||
		diff < 120 && "Há 1 minuto" ||
		diff < 3600 && "Há " + Math.floor( diff / 60 ) + " minutos" ||
		diff < 7200 && "Há 1 hora" ||
		diff < 86400 && "Há " + Math.floor( diff / 3600 ) + " horas") ||
	day_diff == 1 && "Ontem" ||
	day_diff < 7 && "Há " + day_diff + " dias" ||
	day_diff < 31 && "Há " + Math.ceil( day_diff / 7 ) + " semanas";
}

// If jQuery is included in the page, adds a jQuery plugin to handle it as well
if ( typeof jQuery != "undefined" )
	jQuery.fn.prettyDate = function(){
		return this.each(function(){
			var date = prettyDate(this.title);
			if ( date )
				jQuery(this).text( date );
			else
				jQuery(this).text( 'error data conversion' );
		});
	};

$(function() {
	$('.humanize').prettyDate().css('color','#555');
	setInterval(function() {
		$('.humanize').prettyDate();
	}, 5000);
})