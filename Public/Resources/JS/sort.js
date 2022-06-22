$(initAllExcursionPage);
function initAllExcursionPage(){
	$('#findExcursionsBySearch').bind( 'click', findByName);
}
$(initAllExcursionPage());

function updateOrderType(type) {
	if (history.pushState) {
		var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
		var newUrl = baseUrl + '?order='+type;
		history.pushState(null, null, newUrl);
	}
	else {
		console.warn('History API не поддерживается');
	}
	sort(type);
}

function resetOrderType() {
	if (history.pushState) {
		var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
		history.pushState(null, null, baseUrl);
	}
	else {
		console.warn('History API не поддерживается');
	}
	$('.form_radio_btn input[type=radio]').prop('checked', false);
	sort()
}

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;
	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
}


/*сортировка,
 где type принимает численное значение,
 в качестве data возвращается строка*/
function sort(type){

	var checked = [];
	$('input:checkbox:checked').each(function() {
		checked.push($(this).val());
	});
	if(type!==undefined)
	{
		order = type;
	}
	else
	{
		order = getUrlParameter('order')
	}

	$.ajax({
		url: "http://eshop/sort",
		type: "POST",
		data: {"order": order, "tagList":checked},
		success: function(data) {
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			paginate();
		}
	});
}


function findByName(){

	resetOrderType();
	searchValue = $('#search').val();

	$('.form_radio_btn input[type=radio]').prop('checked', false);

	$.ajax({
		url: "http://eshop/allExcursions/found",
		type: "POST",
		data: {"search-excursions": searchValue },
		success: function(data) {
			$('#content').empty();
			document.getElementById('content').innerHTML = data;
			paginate();
		}
	});
}


function initCheckBox()
{
	(function($) {
		function setChecked(target)
		{
			var checked = $(target).find("input[type='checkbox']:checked").length;
			if (checked)
			{
				$(target).find('select option:first').html('Выбрано: ' + checked);
			}
			else
			{
				$(target).find('select option:first').html('Выберите из списка');
			}
		}

		$.fn.checkselect = function() {
			this.wrapInner('<div class="checkselect-popup"></div>');
			this.prepend(
				'<div class="checkselect-control">' +
				'<select class="form-control"><option></option></select>' +
				'<div class="checkselect-over"></div>' +
				'</div>'
			);

			this.each(function() {
				setChecked(this);
			});
			this.find('input[type="checkbox"]').click(function() {
				setChecked($(this).parents('.checkselect'));
			});

			this.parent().find('.checkselect-control').on('click', function() {
				$popup = $(this).next();
				$('.checkselect-popup').not($popup).css('display', 'none');
				if ($popup.is(':hidden'))
				{
					$popup.css('display', 'block');
					$(this).find('select').focus();
				}
				else
				{
					$popup.css('display', 'none');
				}
			});

			$('html, body').on('click', function(e) {
				if ($(e.target).closest('.checkselect').length == 0)
				{
					$('.checkselect-popup').css('display', 'none');
				}
			});
		};
	})(jQuery);
	$('.checkselect').checkselect();
}

$(initCheckBox())