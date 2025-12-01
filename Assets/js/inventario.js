$(function () {
	const MODAL_BASE_Z_INDEX = 1050;
	const BACKDROP_BASE_Z_INDEX = 1040;
	const MODAL_Z_STEP = 20;
	const $cardsContainer = $(".container-cards");
	const $detailModal = $("#cardsModal");
	const $editModal = $("#inventoryEditModal");
	const $deleteModal = $("#inventoryDeleteModal");
	const $enterModal = $("#inventoryAddEnterModal");
	const $outModal = $("#inventoryAddOutModal");
	const $managedModals = $detailModal.add($editModal).add($deleteModal).add($enterModal).add($outModal);
	let selectedProduct = null;

	const getBackdrops = () => Array.from(document.querySelectorAll(".modal-backdrop"));
	const getActiveModals = () => Array.from(document.querySelectorAll(".agro-modal.show"));

	const freezeBody = () => {
		document.body.classList.add("modal-open", "freeze-scroll");
		document.documentElement.classList.add("freeze-scroll");
		document.body.style.paddingRight = "0px";
	};

	const resetBody = () => {
		document.body.classList.remove("modal-open", "freeze-scroll");
		document.body.style.removeProperty("padding-right");
		document.documentElement.classList.remove("freeze-scroll");
	};

	const syncModalLayers = () => {
		const activeModals = getActiveModals();
		activeModals.forEach((modal, index) => {
			modal.style.zIndex = MODAL_BASE_Z_INDEX + index * MODAL_Z_STEP;
		});
	};

	const trimExtraBackdrops = () => {
		const backdrops = getBackdrops();
		if (backdrops.length <= 1) {
			return;
		}
		backdrops.slice(1).forEach((backdrop) => backdrop.remove());
		const baseBackdrop = backdrops[0];
		if (baseBackdrop) {
			baseBackdrop.style.zIndex = BACKDROP_BASE_Z_INDEX; // keep base dim layer under stack
		}
	};

	$(document).on("show.bs.modal", ".agro-modal", function () {
		freezeBody();
	});

	$(document).on("shown.bs.modal", ".agro-modal", function () {
		trimExtraBackdrops();
		syncModalLayers();
	});

	$(document).on("hidden.bs.modal", ".agro-modal", function () {
		this.style.removeProperty("z-index");
		if (getActiveModals().length > 0) {
			freezeBody();
			trimExtraBackdrops();
			syncModalLayers();
			return;
		}
		getBackdrops().forEach((backdrop) => backdrop.remove());
		resetBody();
	});

	$managedModals.each(function () {
		if (!$(this).parent().is("body")) {
			$(this).appendTo("body");
		}
	});

	$detailModal.on("show.bs.modal", function () {
		$cardsContainer.addClass("freeze-scroll");
	});

	$detailModal.on("hidden.bs.modal", function () {
		$cardsContainer.removeClass("freeze-scroll");
		$editModal.modal("hide");
		$deleteModal.modal("hide");
		$enterModal.modal("hide");
		$outModal.modal("hide");
		selectedProduct = null;
	});

	$cardsContainer.on("click", ".ag-courses-item_link", function (event) {
		event.preventDefault();
		const $link = $(this);
		selectedProduct = {
			id: $link.data("product-id") || "",
			name: $link.data("product-name") || "Sin nombre",
			category: $link.data("product-category") || "--",
			date: $link.data("product-date") || "--",
			stock: $link.data("product-stock") || "--"
		};

		$("#inventoryProductName").text(selectedProduct.name);
		$("#inventoryProductCategory").text(selectedProduct.category);
		$("#inventoryProductDate").text(selectedProduct.date);
		$("#inventoryProductQuantity").text(selectedProduct.stock);

		$detailModal.modal("show");
	});

	$(".js-open-edit").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#editProductName").val(selectedProduct.name);
		$("#editProductCategory").val(selectedProduct.category);
		$("#editProductDate").val(selectedProduct.date);
		$("#editProductStock").val(selectedProduct.stock);
		$editModal.modal("show");
	});

	$(".js-open-delete").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#deleteProductName").val(selectedProduct.name);
		$("#deleteProductCategory").val(selectedProduct.category);
		$("#deleteProductStock").val(selectedProduct.stock);
		$deleteModal.modal("show");
	});

	$(".js-open-enter, .js-open-add-enter").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#enterProductName").val(selectedProduct.name);
		$("#enterProductCategory").val(selectedProduct.category);
		$("#enterProductStock").val(selectedProduct.stock);
		$enterModal.modal("show");
	});

	$(".js-open-out, .js-open-add-out").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#outProductName").val(selectedProduct.name);
		$("#outProductCategory").val(selectedProduct.category);
		$("#outProductStock").val(selectedProduct.stock);
		$outModal.modal("show");
	});	

	$(document).on("click", function (event) {
		const target = event.target;
		if (!(target instanceof HTMLElement)) {
			return;
		}
		if (target.closest('[data-dismiss="modal"]')) {
			return;
		}
		if (target.closest('#inventoryEditModal') || target.closest('#inventoryDeleteModal') || target.closest('#inventoryAddEnterModal') || target.closest('#inventoryAddOutModal')) {
			return;
		}
		const detailModalEl = $detailModal.get(0);
		if (!detailModalEl || !detailModalEl.classList.contains("show")) {
			return;
		}
		const clickedInsideDetail = target.closest('#cardsModal');
		const clickedInsideDialog = target.closest('#cardsModal .modal-dialog');
		if (clickedInsideDetail && !clickedInsideDialog) {
			$detailModal.modal("hide");
		}
	});

	$("#inventoryEditForm, #inventoryDeleteForm, #inventoryAddOutModal, #inventoryAddEnterModal").on("submit", function (event) {
		event.preventDefault();
		// Integrar lógica de guardado o eliminación aquí
	});
});
