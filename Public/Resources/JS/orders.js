function saveOrder(idOrder,fioOrder,emailOrder,phoneOrder,statusOrder, commentOrder)
{
	orderFioValue = $('#'+fioOrder).val();
	orderEmailValue = $('#'+emailOrder).val();
	orderPhoneValue = $('#'+phoneOrder).val();
	orderstatusValue = $('#'+statusOrder).val();
	ordersCommentValue = $('#'+commentOrder).val();
	$.ajax({
		url: "/admin/orders/saved",
		type: "POST",
		data: {"idOrder": idOrder, "fioOrder" : orderFioValue,
		"emailOrder" : orderEmailValue, "phoneOrder" : orderPhoneValue,
		"statusOrder" : orderstatusValue, 'commentOrder' : ordersCommentValue},
		success: function(data) {
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
			paginate();
		}
	});
}

function deleteOrder(idOrder)
{

	$.ajax({
		url: "/admin/orders/deleted",
		type: "POST",
		data: {"idOrder": idOrder},
		success: function(data) {
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
			paginate();
		}
	});
}

function findOrdersByClientName(clientName)
{
	clientNameValue = $('#'+clientName).val();
	$.ajax({
		url: "/admin/orders/find",
		type: "POST",
		data: {"clientName": clientNameValue},
		success: function(data) {
			$('#order').empty();
			document.getElementById('order').innerHTML = data;
			paginate();
		}
	});
}