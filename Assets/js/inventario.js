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
	const $createForm = $("#inventoryCreateForm");
	const $editForm = $("#inventoryEditForm");
	const $deleteForm = $("#inventoryDeleteForm");
	const $enterForm = $("#inventoryEnterForm");
	const $outForm = $("#inventoryOutForm");
	const $enterQuantity = $("#enterProductStock");
	const $enterUnitCost = $("#enterProductUnitCost");
	const $enterTotalCost = $("#enterProductTotalCost");
	const $outQuantity = $("#outProductStock");
	const $outUnitCost = $("#outProductUnitCost");
	const $outTotalCost = $("#outProductTotalCost");
	const $providerSelectEnter = $("#enterProductProvider");
	const $recipientSelectOut = $("#outProductRecipient");
	const $providerError = $("#providerError");
	const $recipientError = $("#recipientError");
	const todayIso = new Date().toISOString().slice(0, 10);
	let selectedProduct = null;

	$("#createProductDate").val(todayIso);

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
			baseBackdrop.style.zIndex = BACKDROP_BASE_Z_INDEX;
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
		const productPrice = toNumber($link.data("product-price"));
		selectedProduct = {
			id: $link.data("product-id") || "",
			name: $link.data("product-name") || "Sin nombre",
			category: $link.data("product-category") || "--",
			date: $link.data("product-date") || "--",
			stock: $link.data("product-stock") || "--",
			price: productPrice
		};

		$("#inventoryProductName").text(selectedProduct.name);
		$("#inventoryProductCategory").text(selectedProduct.category);
		$("#inventoryProductDate").text(selectedProduct.date);
		$("#inventoryProductQuantity").text(selectedProduct.stock);
		$("#inventoryProductPrice").text(formatDecimal(selectedProduct.price));

		$detailModal.modal("show");
	});

	$(".js-open-edit").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#editProductId").val(selectedProduct.id);
		$("#editProductName").val(selectedProduct.name);
		$("#editProductCategory").val(selectedProduct.category);
		$("#editProductDate").val(normalizeDateInput(selectedProduct.date));
		$("#editProductStock").val(selectedProduct.stock);
		$("#editProductPrice").val(formatForInput(selectedProduct.price));
		$editModal.modal("show");
	});

	$(".js-open-delete").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#deleteProductId").val(selectedProduct.id);
		$("#deleteProductName").val(selectedProduct.name);
		$("#deleteProductCategory").val(selectedProduct.category);
		$("#deleteProductStock").val(selectedProduct.stock);
		$("#deleteProductPrice").val(formatDecimal(selectedProduct.price));
		$deleteModal.modal("show");
	});

	$(".js-open-enter, .js-open-add-enter").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#enterProductId").val(selectedProduct.id);
		$("#enterProductName").val(selectedProduct.name);
		$("#enterProductCategory").val(selectedProduct.category);
		$("#enterProductDate").val(todayIso);
		$enterQuantity.val("");
		$enterUnitCost.val(formatForInput(selectedProduct.price));
		$enterTotalCost.val("");
		$providerSelectEnter.val("");
		$providerError.text("");
		updateCostTotals($enterQuantity, $enterUnitCost, $enterTotalCost);
		$enterModal.modal("show");
	});

	$(".js-open-out, .js-open-add-out").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$("#outProductId").val(selectedProduct.id);
		$("#outProductName").val(selectedProduct.name);
		$("#outProductCategory").val(selectedProduct.category);
		$("#outProductDate").val(todayIso);
		$outQuantity.val("");
		$outUnitCost.val(formatForInput(selectedProduct.price));
		$outTotalCost.val("");
		$recipientSelectOut.val("");
		$recipientError.text("");
		updateCostTotals($outQuantity, $outUnitCost, $outTotalCost);
		$outModal.modal("show");
	});

	$("#submitCreateInventory").on("click", function () {
		$createForm.trigger("submit");
	});

	$("#submitEditInventory").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$editForm.trigger("submit");
	});

	$("#submitDeleteInventory").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		$deleteForm.trigger("submit");
	});

	$("#submitEnterInventory").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		if (!validatePositiveNumber($enterQuantity.val())) {
			$enterQuantity.focus();
			return;
		}
		if (!validatePositiveNumber($enterUnitCost.val())) {
			$enterUnitCost.focus();
			return;
		}
		if ($providerSelectEnter.length && !$providerSelectEnter.val()) {
			$providerError.text("Seleccione un proveedor");
			return;
		}
		$providerError.text("");
		updateCostTotals($enterQuantity, $enterUnitCost, $enterTotalCost);
		$enterForm.trigger("submit");
	});

	$("#submitOutInventory").on("click", function () {
		if (!selectedProduct) {
			return;
		}
		if (!validatePositiveNumber($outQuantity.val())) {
			$outQuantity.focus();
			return;
		}
		if (!validatePositiveNumber($outUnitCost.val())) {
			$outUnitCost.focus();
			return;
		}
		if ($recipientSelectOut.length && !$recipientSelectOut.val()) {
			$recipientError.text("Seleccione un destinatario");
			return;
		}
		$recipientError.text("");
		updateCostTotals($outQuantity, $outUnitCost, $outTotalCost);
		$outForm.trigger("submit");
	});

	$enterQuantity.on("input", function () {
		updateCostTotals($enterQuantity, $enterUnitCost, $enterTotalCost);
	});
	$enterUnitCost.on("input", function () {
		updateCostTotals($enterQuantity, $enterUnitCost, $enterTotalCost);
	});
	$outQuantity.on("input", function () {
		updateCostTotals($outQuantity, $outUnitCost, $outTotalCost);
	});
	$outUnitCost.on("input", function () {
		updateCostTotals($outQuantity, $outUnitCost, $outTotalCost);
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

	function validatePositiveNumber(value) {
		if (value === undefined || value === null) {
			return false;
		}
		const numberValue = Number(value);
		return !Number.isNaN(numberValue) && numberValue > 0;
	}

	function toNumber(value) {
		if (value === undefined || value === null || value === "") {
			return null;
		}
		if (typeof value === "number" && !Number.isNaN(value)) {
			return value;
		}
		const sanitized = String(value).replace(/,/g, ".");
		const numberValue = Number(sanitized);
		return Number.isNaN(numberValue) ? null : numberValue;
	}

	function formatDecimal(value) {
		const numberValue = toNumber(value);
		if (numberValue === null) {
			return "--";
		}
		return numberValue.toFixed(2);
	}

	function formatForInput(value) {
		const numberValue = toNumber(value);
		if (numberValue === null) {
			return "";
		}
		return numberValue.toFixed(2);
	}

	function updateCostTotals($quantityInput, $unitInput, $totalInput) {
		const quantity = toNumber($quantityInput.val());
		const unit = toNumber($unitInput.val());
		if (quantity === null || unit === null) {
			$totalInput.val("");
			return;
		}
		const total = quantity * unit;
		$totalInput.val(total.toFixed(2));
	}

	function normalizeDateInput(value) {
		if (typeof value !== "string" || !value.trim()) {
			return todayIso;
		}
		const parsed = Date.parse(value);
		if (Number.isNaN(parsed)) {
			return todayIso;
		}
		const dateObj = new Date(parsed);
		return dateObj.toISOString().slice(0, 10);
	}
});
