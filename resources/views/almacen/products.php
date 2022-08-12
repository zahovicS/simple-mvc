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
                <div class="level-item">
                    <h1 class="title">
                        Productos
                    </h1>
                </div>
            </div>
            <div class="level-right" style="display: none;">
                <div class="level-item"></div>
            </div>
        </div>
    </div>
</section>
<section class="section is-main-section">
    <div class="container is-fluid p-0">
        <table class="table is-fullwidth is-hoverable is-striped is-fullwidth" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th class="has-text-centered">Stock</th>
                    <th class="has-text-centered">Estado</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>123123123</td>
                    <td>South Cory</td>
                    <td>Carteras</td>
                    <td>
                        <div class="has-text-centered">
                            <span class="tag is-primary is-light">25</span>
                        </div>
                    </td>
                    <td>
                        <div class="has-text-centered">
                            <span class="tag is-primary is-light">Activado</span>
                        </div>
                    </td>
                    <td class="is-actions-cell">
                        <div class="buttons are-small is-centered">
                            <button class="button is-small is-primary pt-0 pb-0 m-0 mb-2 mr-1 ml-1" type="button">
                                <span class="icon"><i class="fa-regular fa-eye fa-lg"></i></span>
                            </button>
                            <button class="button is-small is-primary pt-0 pb-0 m-0 mb-2 mr-1 ml-1" type="button">
                                <span class="icon"><i class="fa-regular fa-eye fa-lg"></i></span>
                            </button>
                            <button class="button is-small is-danger pt-0 pb-0 m-0 mb-2 mr-1 ml-1 jb-modal"
                                data-target="sample-modal" type="button">
                                <span class="icon"><i class="fa-regular fa-trash-can"></i></span>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>123122223</td>
                    <td>South Cory</td>
                    <td>Mochilas</td>
                    <td>
                        <div class="has-text-centered">
                            <span class="tag is-danger is-light">0</span>
                        </div>
                    </td>
                    <td>
                        <div class="has-text-centered">
                            <span class="tag is-danger is-light">Desactivado</span>
                        </div>
                    </td>
                    <td class="is-actions-cell">
                        <div class="buttons are-small is-centered">
                            <button class="button is-small is-primary pt-0 pb-0 m-0 mb-2 mr-1 ml-1" type="button">
                                <span class="icon"><i class="fa-regular fa-eye fa-lg"></i></span>
                            </button>
                            <button class="button is-small is-danger pt-0 pb-0 m-0 mb-2 mr-1 ml-1 jb-modal"
                                data-target="sample-modal" type="button">
                                <span class="icon"><i class="fa-regular fa-trash-can"></i></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<script src="<?= BASE_URL ?>/js/products/products.js"></script>