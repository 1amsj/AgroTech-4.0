<link rel="stylesheet" href="assets/css/estilo.css" />

<div class="modal fade agro-modal" id="cardsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content agro-modal-content">
      <div class="modal-header agro-modal-header">
        <h5 class="modal-title">Detalle del producto</h5>
        <button type="button" class="close agro-modal-close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body agro-modal-body">
        <div class="agro-modal-actions">
          <button type="button" class="agro-btn agro-btn-add js-open-add-enter">Registrar entrada de producto</button>
          <button type="button" class="agro-btn agro-btn-view js-open-add-out">Registrar salida de producto</button>
          <button type="button" class="agro-btn agro-btn-delete js-open-delete">Eliminar producto</button>
          <button type="button" class="agro-btn agro-btn-edit js-open-edit">Modificar producto</button>
        </div>

        <div class="agro-detail-card">
          <h6 class="agro-detail-name" id="inventoryProductName">Selecciona un producto</h6>
          <div class="agro-detail-grid">
            <div class="agro-detail-item">
              <span class="agro-detail-label">Categoría</span>
              <span class="agro-detail-value" id="inventoryProductCategory">--</span>
            </div>
            <div class="agro-detail-item">
              <span class="agro-detail-label">Fecha</span>
              <span class="agro-detail-value" id="inventoryProductDate">--</span>
            </div>
            <div class="agro-detail-item">
              <span class="agro-detail-label">Stock disponible</span>
              <span class="agro-detail-value" id="inventoryProductQuantity">--</span>
            </div>
          </div>
        </div>

        <button type="button" class="agro-btn agro-btn-close" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade agro-modal" id="inventoryEditModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content agro-modal-content">
      <div class="modal-header agro-modal-header">
        <h5 class="modal-title">Modificar producto</h5>
        <button type="button" class="close agro-modal-close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body agro-modal-body">
        <form id="inventoryEditForm">
          <div class="agro-form-group">
            <label for="editProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="editProductName" name="nombre" placeholder="Escriba el nombre del producto" />
          </div>
          <div class="agro-form-group">
            <label for="editProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="editProductCategory" name="categoria" placeholder="Escriba la categoría del producto" />
          </div>
          <div class="agro-form-group">
            <label for="editProductDate">Fecha</label>
            <input type="text" class="agro-input" id="editProductDate" name="fecha" placeholder="Escriba la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="editProductStock">Stock Actual</label>
            <input type="text" class="agro-input" id="editProductStock" name="stock" placeholder="Escriba el stock actual" />
          </div>
          <button type="submit" class="agro-btn agro-btn-confirm w-100">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade agro-modal" id="inventoryDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content agro-modal-content">
      <div class="modal-header agro-modal-header">
        <h5 class="modal-title">Eliminar producto</h5>
        <button type="button" class="close agro-modal-close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body agro-modal-body">
        <form id="inventoryDeleteForm">
          <div class="agro-form-group">
            <label for="deleteProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="deleteProductName" name="nombre" placeholder="Escriba el nombre del producto" />
          </div>
          <div class="agro-form-group">
            <label for="deleteProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="deleteProductCategory" name="categoria" placeholder="Escriba la categoría del producto" />
          </div>
          <div class="agro-form-group">
            <label for="deleteProductStock">Stock Actual</label>
            <input type="text" class="agro-input" id="deleteProductStock" name="stock" placeholder="Escriba el stock actual" />
          </div>
          <button type="submit" class="agro-btn agro-btn-danger w-100">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade agro-modal" id="inventoryAddEnterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content agro-modal-content">
      <div class="modal-header agro-modal-header">
        <h5 class="modal-title">Registrar entrada de producto</h5>
        <button type="button" class="close agro-modal-close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body agro-modal-body">
        <form id="inventoryEnterForm">
          <div class="agro-form-group">
            <label for="enterProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="enterProductName" name="nombre" placeholder="Escriba el nombre del producto" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="enterProductCategory" name="categoria" placeholder="Escriba la categoría del producto" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductDate">Fecha</label>
            <input type="text" class="agro-input" id="enterProductDate" name="fecha" placeholder="Escriba la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductStock">Cantidad</label>
            <input type="text" class="agro-input" id="enterProductStock" name="stock" placeholder="Escriba la cantidad" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductProvider">Proveedor</label>
            <span id="providerError" class="text-danger"></span>
            <select name="proveedor" id="enterProductProvider" class="form-control input-standar"></select>
          </div>
          <button type="submit" class="agro-btn agro-btn-confirm w-100">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade agro-modal" id="inventoryAddOutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content agro-modal-content">
      <div class="modal-header agro-modal-header">
        <h5 class="modal-title">Registrar salida de producto</h5>
        <button type="button" class="close agro-modal-close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body agro-modal-body">
        <form id="inventoryOutForm">
          <div class="agro-form-group">
            <label for="outProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="outProductName" name="nombre" placeholder="Escriba el nombre del producto" />
          </div>
          <div class="agro-form-group">
            <label for="outProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="outProductCategory" name="categoria" placeholder="Escriba la categoría del producto" />
          </div>
          <div class="agro-form-group">
            <label for="outProductDate">Fecha</label>
            <input type="text" class="agro-input" id="outProductDate" name="fecha" placeholder="Escriba la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="outProductStock">Cantidad</label>
            <input type="text" class="agro-input" id="outProductStock" name="stock" placeholder="Escriba la cantidad" />
          </div>
          <div class="agro-form-group">
            <label for="outProductRecipient">Destinatario</label>
            <span id="recipientError" class="text-danger"></span>
            <select name="destinatario" id="outProductRecipient" class="form-control input-standar"></select>
          </div>
          <button type="submit" class="agro-btn agro-btn-confirm w-100">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>