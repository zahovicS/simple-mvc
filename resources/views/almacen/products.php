<section class="section is-title-bar">
    <div class="level">
        <div class="level-left">
            <div class="level-item">
                <ul>
                    <li>Inicio</li>
                    <li>Productos</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="hero is-hero-bar">
    <div class="hero-body">
        <div class="level">
            <div class="level-left">
                <div class="level-item has-control">
                    <h1 class="title">
                        Productos
                    </h1>
                    <div class="ml-4 control has-icons-right">
                        <input type="search" placeholder="Buscar producto..." class="input"
                            id="search_products_in_table">
                        <span class="icon is-small is-right">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                    </div>

                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <button class="button is-primary jb-modal" data-target="añadir-producto">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Añadir producto
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section is-main-section">
    <div class="container is-fluid p-0">
        <table class="table width-100 is-hoverable is-striped" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th class="has-text-centered">Stock</th>
                    <th class="has-text-centered">Precio</th>
                    <th class="has-text-centered">Estado</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</section>
<div id="añadir-producto" class="modal">
    <div class="modal-background"></div>
    <form action="<?= BASE_URL ?>/products/crear" method="POST" class="modal-card" id="frmCrearProducto"
        enctype="multipart/form-data">
        <header class="modal-card-head">
            <p class="modal-card-title is-uppercase has-text-weight-bold is-size-4">Crear Producto</p>
        </header>
        <section class="modal-card-body">
            <label class="label">Código</label>
            <div class="field has-addons">
                <div class="control width-100">
                    <input class="input" type="text" placeholder="Escriba un codigo en EAN-13" name="codigo_producto"
                        id="codigo_producto" maxlength="11" minlength="3">
                </div>
                <div class="control">
                    <a class="button is-info" id="btnGenerar_codigo" data-target-input="#codigo_producto"
                        maxlength="255">
                        Generar
                    </a>
                </div>
            </div>
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Mascarilla facial JL-100" name="nombre_producto"
                        id="nombre_producto">
                </div>
            </div>
            <div class="field is-grouped pt-2">
                <div class="width-50 pr-1">
                    <label class="label">Categoría</label>
                    <div class="control">
                        <div class="select width-100">
                            <select class="width-100" id="select-categoria" name="select-categoria">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="width-50 pl-1">
                    <label class="label">Precio de venta</label>
                    <div class="control">
                        <input class="input" step="0.01" type="number" placeholder="20.00" name="precio_producto"
                            id="precio_producto">
                    </div>
                </div>
            </div>
            <div class="field is-grouped pt-2">
                <div class="width-50 pr-1">
                    <label class="label">Stock</label>
                    <div class="control">
                        <input class="input" type="number" value="0" placeholder="0" name="stock_producto"
                            id="stock_producto">
                    </div>
                </div>
                <div class="width-50 pl-1">
                    <label class="label">Unidad de medida</label>
                    <div class="control">
                        <div class="select width-100">
                            <select class="width-100" id="select-unidad" name="select-unidad">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="file is-warning width-100 mt-4">
                <label class="file-label width-100 mt-4">
                    <input class="file-input" type="file" name="imagen_producto" id="imagen_producto"
                        accept="image/png, image/jpg, image/jpeg">
                    <span class="file-cta width-100">
                        <span class="file-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </span>
                        <span class="file-label">
                            Subir imagen
                        </span>
                    </span>
                </label>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button type="button" class="button jb-modal-close" id="modal_close_add">Cancelar</button>
            <button type="submit" class="button is-success">Crear</button>
        </footer>
    </form>
</div>
<div id="editar-producto" class="modal">
    <div class="modal-background"></div>
    <form action="<?= BASE_URL ?>/products/editar" method="POST" class="modal-card" id="frmEditarProducto"
        enctype="multipart/form-data">
        <header class="modal-card-head">
            <p class="modal-card-title is-uppercase has-text-weight-bold is-size-4">Editar Producto</p>
        </header>
        <section class="modal-card-body">
            <input type="hidden" id="id_producto_edit" name="id_producto_edit">
            <label class="label">Código</label>
            <div class="field has-addons">
                <div class="control width-100">
                    <input class="input" type="text" placeholder="Escriba un codigo en EAN-13"
                        name="codigo_producto_edit" id="codigo_producto_edit" maxlength="11" minlength="3">
                </div>
                <div class="control">
                    <a class="button is-info" id="btnGenerar_codigo_edit" data-target-input="#codigo_producto_edit"
                        maxlength="255">
                        Generar
                    </a>
                </div>
            </div>
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Mascarilla facial JL-100" name="nombre_producto_edit"
                        id="nombre_producto_edit">
                </div>
            </div>
            <div class="field is-grouped pt-2">
                <div class="width-50 pr-1">
                    <label class="label">Categoría</label>
                    <div class="control">
                        <div class="select width-100">
                            <select class="width-100" id="select-categoria_edit" name="select-categoria_edit">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="width-50 pl-1">
                    <label class="label">Precio de venta</label>
                    <div class="control">
                        <input class="input" step="0.01" type="number" placeholder="20.00" name="precio_producto_edit"
                            id="precio_producto_edit">
                    </div>
                </div>
            </div>
            <div class="field is-grouped pt-2">
                <div class="width-50 pr-1">
                    <label class="label">Stock</label>
                    <div class="control">
                        <input class="input" type="number" value="0" placeholder="0" name="stock_producto_edit"
                            id="stock_producto_edit">
                    </div>
                </div>
                <div class="width-50 pl-1">
                    <label class="label">Unidad de medida</label>
                    <div class="control">
                        <div class="select width-100">
                            <select class="width-100" id="select-unidad_edit" name="select-unidad_edit">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="file is-warning width-100 mt-4">
                <label class="file-label width-100 mt-4">
                    <input class="file-input" type="file" name="imagen_producto_edit" id="imagen_producto_edit"
                        accept="image/png, image/jpg, image/jpeg">
                    <span class="file-cta width-100">
                        <span class="file-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </span>
                        <span class="file-label">
                            Subir imagen
                        </span>
                    </span>
                </label>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button type="button" class="button jb-modal-close" id="modal_close_edit">Cancelar</button>
            <button type="submit" class="button is-info">Editar</button>
        </footer>
    </form>
</div>
<script src="<?= BASE_URL ?>/js/products/products.js"></script>