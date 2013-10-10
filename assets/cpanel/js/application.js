/*----------------------------------------------------*/
/*  Template Version
/*----------------------------------------------------*/
$(function () {
	var $version = '1.0';
	$('.version').text($version);
});

/*----------------------------------------------------*/
/*  Sidebar Scrollable
/*----------------------------------------------------*/
$(function () {
    if(jQuery().perfectScrollbar) {
    	$('#sidebar').perfectScrollbar();
    }
});

/*----------------------------------------------------*/
/*  Sidebar toggler
/*----------------------------------------------------*/
$(function () {
	$('[data-toggle="sidebar"]').click(function (e) {

		$(this).toggleClass('active');
		$('html').toggleClass('nav-open');

		e.preventDefault();
	});
});

/*----------------------------------------------------*/
/*  Sidebar Height - ie8 Fix
/*----------------------------------------------------*/
$(function () {
	if($('html').hasClass('lt-ie9')) {
		$('#sidebar').css('min-height', $('#main').height());
	}
	$('#sidebar').resize(function(){
		var $this = $(this);
		$('#main').css('min-height', $this.height());
	});
	$('#sidebar').resize();
});

/*----------------------------------------------------*/
/*  Widget Collapse
/*----------------------------------------------------*/
$(function () {
	$('.toolbar [data-toggle="collapse"]').on('click', function (e) {
		$icon = $(this).children('.icon');

		if($(this).hasClass('collapsed')) {
			$icon.removeClass('icone-chevron-down').addClass('icone-chevron-up');
		}else{
			$icon.removeClass('icone-chevron-up').addClass('icone-chevron-down');
		}
		e.preventDefault();
	});
});

/*----------------------------------------------------*/
/*  Widget Refresh Modal
/*----------------------------------------------------*/
$(function () {
	$('[data-widget="refresh"]').on('click', function (e) {
		var $modal = $('<div class="widget-modal"><span class="spinner spinner1"></span></div>');
		var $target = $(this).parents('.widget');

		// append to widget
		$target.append($modal);

		// remove after 3 second
		setTimeout(function () {
	        $modal.remove();
	    }, 2000);

		e.preventDefault();
	});
});

/*----------------------------------------------------*/
/*  Application Color
/*----------------------------------------------------*/
var $color = [];

// Application color as in version 1.0.0
$color['red'] = '#dc143c';
$color['teal'] = '#00A0B1';
$color['blue'] = '#2E8DEF';
$color['purple'] = '#A700AE';
$color['magenta'] = '#FF0097';
$color['lime'] = '#8CBF26';
$color['brown'] = '#A05000';
$color['pink'] = '#E671B8';
$color['orange'] = '#F09609';
$color['green'] = '#3A9548';
$color['yellow'] = '#E1B700';

/*----------------------------------------------------*/
/*  To Top Scroller
/*----------------------------------------------------*/
$(function () {
	$('.totop').click(function (e){
		$("html, body").animate({ scrollTop: 0 }, 600);
		
		e.preventDefault();
	});
});

/*----------------------------------------------------*/
/*	Generate Slug
/*----------------------------------------------------*/
$(function () {
	$('input[name=name]').bind('keyup', function() {
		if ($('input[name=slug]').length > 0) {
			var name = $('input[name=name]');
			var slug = $('input[name=slug]');

			var text = name.val().toLowerCase();
			text = text.replace(new RegExp(/[àáâãäå]/g),"a");
			text = text.replace(new RegExp(/æ/g),"ae");
			text = text.replace(new RegExp(/ç/g),"c");
			text = text.replace(new RegExp(/[èéêë]/g),"e");
			text = text.replace(new RegExp(/[ìíîï]/g),"i");
			text = text.replace(new RegExp(/ñ/g),"n");                
			text = text.replace(new RegExp(/[òóôõö]/g),"o");
			text = text.replace(new RegExp(/œ/g),"oe");
			text = text.replace(new RegExp(/[ùúûü]/g),"u");
			text = text.replace(new RegExp(/[ýÿ]/g),"y");
			text = text.replace(new RegExp(/[^\w ]/g),"");
			do { k = false; if (text.search('  ') >= 0) { text = text.replace('  ', ' '); k = true; } } while (k == true)
			text = text.replace(new RegExp(/\s/g),"-");
			if (text[text.length-1] == "-") text = text.substring(0, text.length-1);

			slug.val(text);
		}
	});
});

/*----------------------------------------------------*/
/*	Select 2
/*----------------------------------------------------*/
$(function () {
	$('.select2').each(function () {
		var placeholder = $(this).data('placeholder');
		$(this).select2({
			placeholder: placeholder
		});
	});
});

/*----------------------------------------------------*/
/*	DataTable
/*----------------------------------------------------*/
$(function () {
	$('.datatable').each(function () {
		$(this).dataTable();
	});
});

/*----------------------------------------------------*/
/*	Distribuição de imagens
/*----------------------------------------------------*/
$(function () {
	var count = $('#pictures .half').length;
	var counter = 1;
	$('#pictures .half').each(function () {
		var holder = $(this);
		var img = 'url(' + holder.find('img').attr('src') + ')';
		
		holder.css('background-image', img);
		holder.html('');

		if (count % 2 == 1 && counter >= count)
			holder.removeClass('half').addClass('full');

		counter++;
	});
	$('.last-hidden').slideUp(500);
	$('.first-hidden').delay(500).slideDown(500);
});

/*----------------------------------------------------*/
/*	Criação dos sliders
/*----------------------------------------------------*/
var refresh = function (event, ui) {
	var slider = $(this);
	var label = $('#stage-label-' + slider.data('id') + ' span');

	$('#btn-save-stages').text('Alterações Pendentes').addClass('btn-danger');

	label.text(ui.value + '%');
};

$(function () {
	$('.slider').each(function () {
		var percentage = $(this).data('percentage');
		$(this).slider({
			range: 'min',
			value: percentage,
			min: 0,
			max: 100,
			step: 10,
			slide: refresh
		});
	});
});

/*----------------------------------------------------*/
/*	Save dos sliders
/*----------------------------------------------------*/
$(function () {
	$('#btn-save-stages').click(function () {
		event.preventDefault();
		
		var item = $(this);
		var values = new Array();
		$('.slider').each(function () {
			var item = new Array();
			item.push($(this).data('id'));
			item.push($(this).slider('value'));
			
			values.push(item);
		});
		values = JSON.stringify(values);

		var url = item.attr('href');
		var posting = $.post(url,{data:values});

		posting.done(function(data) {
			item.text('Salvo com Sucesso!').effect('bounce').removeClass('btn-danger');
		});
		posting.fail(function(data) {
			item.text('Erro ao Salvar!').effect('bounce').addClass('btn-danger');
		})

		return false;
	});
});

/*----------------------------------------------------*/
/* Filtro de apartamentos
/*----------------------------------------------------*/
$(function () {
	$('.apartment-filter').click(function () {
		var value = $(this).data('id');
		$('.apartment-filter.label-success').removeClass('label-success');
		$(this).addClass('label-success');
		if (value == -1) {
			$('#apartments').find('tbody tr').show();
		} else {
			$('#apartments').find('tbody tr').each(function () {
				if ($(this).data('block') == value)
					$(this).show();
				else
					$(this).hide();
			});
		}
	});
});

/*----------------------------------------------------*/
/* Upload de arquivos dos apartamentos
/*----------------------------------------------------*/
//  https://github.com/weixiyen/jquery-filedrop/blob/master/README.md