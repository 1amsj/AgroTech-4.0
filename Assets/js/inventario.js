$(document).ready(function () {
	$(".container-cards").on("click", ".ag-courses-item_link", function (event) {
		event.preventDefault();
		$("#cardsModal").modal("show");
	});
});
