$(function () {
    const $createForm = $("#formDestinatarioCreate");
    const $editForm = $("#formDestinatarioEdit");
    const $deleteForm = $("#formDestinatarioDelete");
    const $table = $("#destinatarioTable");

    $("#btnRegistrarDestinatario").on("click", function () {
        if (validarEnvioCreate()) {
            $createForm.submit();
        }
    });

    $("#btnActualizarDestinatario").on("click", function () {
        if (validarEnvioEdit()) {
            $editForm.submit();
        }
    });

    $("#confirmDeleteButton").on("click", function () {
        $deleteForm.submit();
    });

    $table.on("click", ".js-edit-destinatario", function () {
        const $row = $(this).closest("tr");
        fillEditForm(extractRowData($row));
    });

    $table.on("click", ".js-delete-destinatario", function () {
        const $row = $(this).closest("tr");
        fillDeleteForm(extractRowData($row));
    });

    attachFieldValidation();
    moveModalsToBody();
});

function attachFieldValidation() {
    $("#nombre, #apellido, #nombrem, #apellidom").on("keypress", function (e) {
        validarkeypress(/^[A-Za-z\u00C0-\u017F\s]$/, e);
    });

    $("#nombre").on("keyup", function () {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#snombre"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#apellido").on("keyup", function () {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#sapellido"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#nombrem").on("keyup", function () {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#snombrem"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#apellidom").on("keyup", function () {
        validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
            $(this), $("#sapellidom"), "Solo letras (incluye acentos) y espacios 4-26");
    });

    $("#telefono, #telefonom").on("keypress", function (e) {
        validarkeypress(/^[0-9\b]*$/, e);
    });

    $("#telefono").on("keyup", function () {
        validarkeyup(/^[0-9]{4,20}$/,
            $(this), $("#stelefono"), "Solo números 4-20");
    });

    $("#telefonom").on("keyup", function () {
        validarkeyup(/^[0-9]{4,20}$/,
            $(this), $("#stelefonom"), "Solo números 4-20");
    });

    $("#descripcion, #descripcionm").on("keypress", function (e) {
        validarkeypress(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]*$/, e);
    });

    $("#descripcion").on("keyup", function () {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcion"), "Letras, números, acentos y .,-/#º* 3-120");
    });

    $("#descripcionm").on("keyup", function () {
        validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
            $(this), $("#sdescripcionm"), "Letras, números, acentos y .,-/#º* 3-120");
    });
}

function extractRowData($row) {
    const dataset = $row.data();
    return {
        id: dataset.id || "",
        nombre: decodeHtml(dataset.nombre || ""),
        apellido: decodeHtml(dataset.apellido || ""),
        telefono: decodeHtml(dataset.telefono || ""),
        descripcion: decodeHtml(dataset.descripcion || "")
    };
}

function decodeHtml(value) {
    const textarea = document.createElement("textarea");
    textarea.innerHTML = value;
    return textarea.value;
}

function fillEditForm(data) {
    $("#destinatarioId").val(data.id || "");
    $("#nombrem").val(data.nombre || "");
    $("#apellidom").val(data.apellido || "");
    $("#telefonom").val(data.telefono || "");
    $("#descripcionm").val(data.descripcion || "");
}

function fillDeleteForm(data) {
    $("#deleteDestinatarioId").val(data.id || "");
    $("#deleteDestinatarioName").val((data.nombre || "") + (data.apellido ? " " + data.apellido : ""));
}

function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
    const isValid = er.test(etiqueta.val());
    if (isValid) {
        etiquetamensaje.text("");
        return 1;
    }
    etiquetamensaje.text(mensaje);
    setTimeout(function () {
        etiquetamensaje.text("");
    }, 5000);
    return 0;
}

function validarkeypress(er, e) {
    const key = e.keyCode;
    const tecla = String.fromCharCode(key);
    if (!er.test(tecla)) {
        e.preventDefault();
    }
}

function validarEnvioCreate() {
    if (!validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#nombre"), $("#snombre"), "Solo letras (incluye acentos) y espacios 4-26")) {
        return false;
    }
    if (!validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#apellido"), $("#sapellido"), "Solo letras (incluye acentos) y espacios 4-26")) {
        return false;
    }
    if (!validarkeyup(/^[0-9]{4,20}$/,
        $("#telefono"), $("#stelefono"), "Solo números 4-20")) {
        return false;
    }
    if (!validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcion"), $("#sdescripcion"), "Letras, números, acentos y .,-/#º* 3-120")) {
        return false;
    }
    return true;
}

function validarEnvioEdit() {
    if (!validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#nombrem"), $("#snombrem"), "Solo letras (incluye acentos) y espacios 4-26")) {
        return false;
    }
    if (!validarkeyup(/^[A-Za-z\u00C0-\u017F\s]{4,26}$/,
        $("#apellidom"), $("#sapellidom"), "Solo letras (incluye acentos) y espacios 4-26")) {
        return false;
    }
    if (!validarkeyup(/^[0-9]{4,20}$/,
        $("#telefonom"), $("#stelefonom"), "Solo números 4-20")) {
        return false;
    }
    if (!validarkeyup(/^[0-9A-Za-z\u00C0-\u017F\s\.,\-\/#º\*]{3,120}$/,
        $("#descripcionm"), $("#sdescripcionm"), "Letras, números, acentos y .,-/#º* 3-120")) {
        return false;
    }
    return true;
}

function moveModalsToBody() {
    try {
        $(".modal").each(function () {
            if (!$(this).parent().is("body")) {
                $(this).appendTo("body");
            }
        });
    } catch (error) {
        console.warn("Could not move modals to body:", error);
    }
}