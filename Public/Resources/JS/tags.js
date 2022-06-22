function tagDeleteAjax(tagId)
{
	$.ajax({
		url: "/admin/tag/deleted?id="+tagId,
		type: "POST",
		data: {"tagId": tagId },
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	});
}

function typeTagDeleteAjax(typeTagId)
{
	$.ajax({
		url: "/admin/typeTag/deleted?id="+typeTagId,
		type: "POST",
		data: {"typeTagId": typeTagId },
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	});
}

function tagEditAjax(tagId, tagName,tagNameLink)
{
	$('#'+tagName).removeAttr('disabled');
	$('#'+tagNameLink).text('Сохранить');
	$('#'+tagNameLink).attr('onclick', 'tagSaveAjax("'+tagId+'","'+tagName+'")');
}

function typeTagEditAjax(typeTagId, typeTagName,typeTagNameLink)
{
	$('#'+typeTagName).removeAttr('disabled');
	$('#'+typeTagNameLink).text('Сохранить');
	$('#'+typeTagNameLink).attr('onclick', 'typeTagSaveAjax("'+typeTagId+'","'+typeTagName+'")');
}

function tagSaveAjax(tagId, tagName)
{
	tagNameValue = $('#'+tagName).val();
	$.ajax({
		url: "/admin/tag/saved",
		type: "POST",
		data: {"tagId": tagId, "tagName": tagNameValue},
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	})
}

function typeTagSaveAjax(typeTagId, typeTagName)
{
	typeTagNameValue = $('#'+typeTagName).val();
	$.ajax({
		url: "/admin/typeTag/saved",
		type: "POST",
		data: {"typeTagId": typeTagId, "typeTagName": typeTagNameValue},
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	})
}

function tagCreateAjax(typeTagId, tagName)
{
	tagNameValue = $('#'+tagName).val();
	$.ajax({
		url: "/admin/tag/created",
		type: "POST",
		data: {"typeTagId": typeTagId, "tagName": tagNameValue},
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	})
}

function typeTagCreateAjax(typeTagName)
{
	typeTagNameValue = $('#'+typeTagName).val();
	$.ajax({
		url: "/admin/typeTag/created",
		type: "POST",
		data: {"typeTagName": typeTagNameValue},
		success: function(data) {
			$('#tagsList').empty();
			document.getElementById('tagsList').innerHTML = data;
		}
	})
}