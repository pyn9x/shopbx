$(initUserPage);
function initUserPage(){
	$('#userChangePassword').bind( 'click', userChangePassword );
}

function userChangePassword()
{
	let csrf_token = $('#csrf_token').val();
	let currentPassword = $('#currentPassword').val();
	let newPassword = $('#newPassword').val();
	let repeatNewPassword = $('#repeatNewPassword').val();
	$.ajax({
		url: "/admin/userChange/saved",
		type: "POST",
		data: {"csrf_token": csrf_token,"currentPassword": currentPassword, "newPassword": newPassword, "repeatNewPassword": repeatNewPassword},
		success: function(data) {
			alert(data);
		}
	})
}