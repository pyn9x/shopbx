$(initExcursionPage);

function initExcursionPage(){
	$('#fileImage').bind( 'change', fileImageUpload );//Событие на выбор файлов
}

function fileImageUpload()
{
	let oFiles = this.files;
	let oFormData = new FormData();
	for (index=0;index<oFiles.length;++index)
	{
		oFormData.append('file[]',oFiles[index]);
	}
	$.ajax({
		url: "/admin/imageUpload",
		type: "POST",
		data: oFormData,
		contentType: false,
		processData: false,
		success: function(data) {
			$('#fileImageList').empty();
			$('#fileImageList').append(data);
		}
	});
}

function dateDeleteAjax(dateId, dateName)
{
	$('#'+dateName).hide();
	console.log(dateId);
	$.ajax({
		url: "/admin/excursions/deleteDate",
		type: "POST",
		data: {"dateId": dateId },
		success: function(data) {
			$('#'+dateName).empty();
		}
	});
}