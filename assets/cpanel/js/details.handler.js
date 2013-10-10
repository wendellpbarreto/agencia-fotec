/**
 * ADD NEW DETAIL
 */

$(function() {
	$(document).on('click', '.add-detail', function (event) {
		event.preventDefault();

		var lastRow = $('#details tbody tr:last');
		if (lastRow.length > 0)
			var nextOrder = parseInt(lastRow.data('order'), 10) + 1;
		else
			var nextOrder = 1;
		var newRow = '<tr>' +
						 '<td contenteditable></td>' +
						 '<td contenteditable></td>' +
						 '<td class="span3"><button class="btn btn-small move-up"><i class="icon icone-arrow-up"></i></button> <button class="btn btn-small move-down"><i class="icon icone-arrow-down"></i></button> <button class="btn btn-small btn-danger remove"><i class="icon icone-remove"></i></button></td>' +
					 '</tr>';

		$('#details tbody').append(newRow);

		return false;
	});
});

$(function() {
	$(document).on('click', '.move-up', function (event) {
		event.preventDefault();

		var row = $(this).closest('tr');
		var prev = row.prev();

		if (prev.length <= 0) {
			// do nothing
		} else {
			row.insertBefore(prev);
		}

		return false;
	});
});

$(function() {
	$(document).on('click', '.move-down', function (event) {
		event.preventDefault();

		var row = $(this).closest('tr');
		var next = row.next();

		if (next.length <= 0) {
			// do nothing
		} else {
			row.insertAfter(next);
		}

		return false;
	});
});

$(function() {
	$(document).on('click', '.item-remove', function (event) {
		event.preventDefault();

		var row = $(this).closest('tr');

		row.remove();

		return false;
	});
});

$(function() {
	$(document).on('click', '.save-details', function (event) {
		event.preventDefault();

		var url = $(location).attr('href');

		var order = 1;
		var items = new Array();
		$('#details tbody > tr').each(function() {
			var item = new Object();
			item.product_id = $('#details').data('product');
			item.option = $(this).children('td:nth-child(1)').text();;
			item.value = $(this).children('td:nth-child(2)').text();
			item.order = order;

			order++;

			items.push(item);
		});

		items = JSON.stringify(items);

		var posting = $.post(url, {
			items: items
		});

		posting.done(function(data) {
			console.log("REQUISIÇÃO OK");
			console.log(data);
		});

		return false;
	});
});

