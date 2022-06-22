
function getPageList(totalPages, page, maxLength) {
	if (maxLength < 5) throw "maxLength must be at least 5";

	function range(start, end) {
		return Array.from(Array(end - start + 1), (_, i) => i + start);
	}

	var sideWidth = maxLength < 9 ? 1 : 2;
	var leftWidth = (maxLength - sideWidth*2 - 3) >> 1;
	var rightWidth = (maxLength - sideWidth*2 - 2) >> 1;
	if (totalPages <= maxLength) {
		// no breaks in list
		return range(1, totalPages);
	}
	if (page <= maxLength - sideWidth - 1 - rightWidth) {
		// no break on left of page
		return range(1, maxLength - sideWidth - 1)
			.concat(0, range(totalPages - sideWidth + 1, totalPages));
	}
	if (page >= totalPages - sideWidth - 1 - rightWidth) {
		// no break on right of page
		return range(1, sideWidth)
			.concat(0, range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
	}
	// Breaks on both sides
	return range(1, sideWidth)
		.concat(0, range(page - leftWidth, page + rightWidth),
			0, range(totalPages - sideWidth + 1, totalPages));
}

function paginate()
{
	var numberOfItems = $("#content .block").length;
	let pathname = document.location.pathname;
	var limitPerPage = 6;
	switch (pathname)
	{
		case "/admin/excursions":
			limitPerPage = 7;
			break;
		case "/admin/orders":
			limitPerPage = 5;
			break;
	}

	var totalPages = Math.ceil(numberOfItems / limitPerPage);

	var paginationSize = 7;
	var currentPage;

	function showPage(whichPage)
	{
		if (whichPage < 1 || whichPage > totalPages) return false;
		currentPage = whichPage;
		$("#content .block").hide()
			.slice((currentPage - 1) * limitPerPage,
				currentPage * limitPerPage).show();
		$(".pagination li").slice(1, -1).remove();
		getPageList(totalPages, currentPage, paginationSize).forEach(item => {
			$("<li>").addClass("page-item")
				.addClass(item ? "current-page" : "disabled")
				.toggleClass("active", item === currentPage).append(
				$("<a>").addClass("page-link").attr({
					href: "javascript:void(0)"
				}).text(item || "...")
			).insertBefore("#next-page");
		});

		$("#previous-page").toggleClass("disabled", currentPage === 1);
		$("#next-page").toggleClass("disabled", currentPage === totalPages);
		return true;
	}

	if (numberOfItems !== 0)
	{

		$(".pagination").append(
			$("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
				$("<a>").addClass("page-link").attr({
					href: "javascript:void(0)"
				}).text("Prev")
			),
			$("<li>").addClass("page-item").attr({ id: "next-page" }).append(
				$("<a>").addClass("page-link").attr({
					href: "javascript:void(0)"
				}).text("Next")
			)
		);

		$("#content").show();
		showPage(1);

		$(document).on("click", ".pagination li.current-page:not(.active)", function() {
			return showPage(+$(this).text());
		});
		$("#next-page").on("click", function() {
			return showPage(currentPage + 1);
		});

		$("#previous-page").on("click", function() {
			return showPage(currentPage - 1);
		});
	}
	else
	{
		$(".pagination").empty();
	}
}

$(paginate());
