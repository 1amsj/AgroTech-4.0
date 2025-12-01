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
            <div class="agro-detail-item">
              <span class="agro-detail-label">Costo unitario</span>
              <span class="agro-detail-value" id="inventoryProductPrice">--</span>
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
        <form id="inventoryEditForm" method="post">
          <input type="hidden" name="modificar" id="editProductId">
          <div class="agro-form-group">
            <label for="editProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="editProductName" name="nombre"
              placeholder="Escriba el nombre del producto" />
          </div>
          <div class="agro-form-group">
            <label for="editProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="editProductCategory" name="categoriam" placeholder="Escriba la categoría del producto" />
          </div>
          <div class="agro-form-group">
            <label for="editProductDate">Fecha</label>
            <input type="date" class="agro-input" id="editProductDate" name="fecham" placeholder="Escriba la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="editProductStock">Stock Actual</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="editProductStock" name="stockam" placeholder="Escriba el stock actual" />
          </div>
          <div class="agro-form-group">
            <label for="editProductPrice">Costo unitario</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="editProductPrice" name="preciom" placeholder="Ingrese el costo unitario" />
          </div>
          <button type="button" class="agro-btn agro-btn-confirm w-100" id="submitEditInventory">Enviar</button>
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
        <form id="inventoryDeleteForm" method="post">
          <input type="hidden" name="eliminar" id="deleteProductId">
          <div class="agro-form-group">
            <label for="deleteProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="deleteProductName" name="nombre" placeholder="Escriba el nombre del producto" readonly />
          </div>
          <div class="agro-form-group">
            <label for="deleteProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="deleteProductCategory" name="categoria" placeholder="Escriba la categoría del producto" readonly />
          </div>
          <div class="agro-form-group">
            <label for="deleteProductStock">Stock Actual</label>
            <input type="text" class="agro-input" id="deleteProductStock" name="stock" placeholder="Escriba el stock actual" readonly />
          </div>
          <div class="agro-form-group">
            <label for="deleteProductPrice">Costo unitario</label>
            <input type="text" class="agro-input" id="deleteProductPrice" name="precio" placeholder="Costo unitario" readonly />
          </div>
          <button type="button" class="agro-btn agro-btn-danger w-100" id="submitDeleteInventory">Eliminar</button>
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
        <form id="inventoryEnterForm" method="post">
          <input type="hidden" name="entrada" id="enterProductId">
          <div class="agro-form-group">
            <label for="enterProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="enterProductName" name="nombre_entrada" placeholder="Nombre del producto" readonly />
          </div>
          <div class="agro-form-group">
            <label for="enterProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="enterProductCategory" name="categoria_entrada" placeholder="Categoría" readonly />
          </div>
          <div class="agro-form-group">
            <label for="enterProductDate">Fecha</label>
            <input type="date" class="agro-input" id="enterProductDate" name="fecha_entrada" placeholder="Seleccione la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductStock">Cantidad</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="enterProductStock" name="cantidad_entrada" placeholder="Escriba la cantidad" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductUnitCost">Costo unitario</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="enterProductUnitCost" name="costo_unitario_entrada" placeholder="Ingrese el costo unitario" />
          </div>
          <div class="agro-form-group">
            <label for="enterProductTotalCost">Costo total</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="enterProductTotalCost" name="costo_total_entrada" placeholder="Costo total" readonly />
          </div>
          <div class="agro-form-group">
            <label for="enterProductProvider">Proveedor</label>
            <span id="providerError" class="text-danger"></span>
            <select name="proveedor_entrada" id="enterProductProvider" class="form-control input-standar">
              <option value="">Seleccione un proveedor</option>
              <?php if (!empty($proveedoresInventario)) : ?>
                <?php foreach ($proveedoresInventario as $proveedor) : ?>
                  <option value="<?php echo htmlspecialchars($proveedor['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($proveedor['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <button type="button" class="agro-btn agro-btn-confirm w-100" id="submitEnterInventory">Registrar entrada</button>
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
        <form id="inventoryOutForm" method="post">
          <input type="hidden" name="salida" id="outProductId">
          <div class="agro-form-group">
            <label for="outProductName">Nombre del producto</label>
            <input type="text" class="agro-input" id="outProductName" name="nombre_salida" placeholder="Nombre del producto" readonly />
          </div>
          <div class="agro-form-group">
            <label for="outProductCategory">Categoría</label>
            <input type="text" class="agro-input" id="outProductCategory" name="categoria_salida" placeholder="Categoría" readonly />
          </div>
          <div class="agro-form-group">
            <label for="outProductDate">Fecha</label>
            <input type="date" class="agro-input" id="outProductDate" name="fecha_salida" placeholder="Seleccione la fecha" />
          </div>
          <div class="agro-form-group">
            <label for="outProductStock">Cantidad</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="outProductStock" name="cantidad_salida" placeholder="Escriba la cantidad" />
          </div>
          <div class="agro-form-group">
            <label for="outProductUnitCost">Costo unitario</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="outProductUnitCost" name="costo_unitario_salida" placeholder="Ingrese el costo unitario" />
          </div>
          <div class="agro-form-group">
            <label for="outProductTotalCost">Costo total</label>
            <input type="number" min="0" step="0.01" class="agro-input" id="outProductTotalCost" name="costo_total_salida" placeholder="Costo total" readonly />
          </div>
          <div class="agro-form-group">
            <label for="outProductRecipient">Destinatario</label>
            <span id="recipientError" class="text-danger"></span>
            <select name="destinatario_salida" id="outProductRecipient" class="form-control input-standar">
              <option value="">Seleccione un destinatario</option>
              <?php if (!empty($destinatariosInventario)) : ?>
                <?php foreach ($destinatariosInventario as $destinatario) : ?>
                  <option value="<?php echo htmlspecialchars($destinatario['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($destinatario['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <button type="button" class="agro-btn agro-btn-confirm w-100" id="submitOutInventory">Registrar salida</button>
        </form>
      </div>
    </div>
  </div>
</div>