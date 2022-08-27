$(function () {
  let tablaProductos
  const cargar_categoria = (target = []) => {
    axios({
      method: 'get',
      url: base_url + '/categories/categories_for_dropdown',
    }).then(function (response) {
      let template =
        '<option class="is-uppercase" value="" selected>Seleccione la categoría</option>'
      $.each(response.data, function (i, v) {
        template += `<option class="is-uppercase" value="${v.idcategoria}">${v.nombre}</option>`
      })
      $.each(target, function (index, value) {
        $(value).html(template)
      })
    })
  }
  const cargar_unidad = (target = []) => {
    axios({
      method: 'get',
      url: base_url + '/unidades/unidades_for_dropdown',
    }).then(function (response) {
      let template =
        '<option class="is-uppercase" value="" selected>Seleccione la unidad de medida</option>'
      $.each(response.data, function (i, v) {
        template += `<option class="is-uppercase" value="${v.idunidad}">${v.nombre} [${v.value}]</option>`
      })
      $.each(target, function (index, value) {
        $(value).html(template)
      })
    })
  }
  const activar_producto = (id) => {
    if (!id) return console.error('sin ID de producto')
    Swal.fire({
      title: '¿Desea activar el producto?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#CCFEEC',
      cancelButtonColor: '#FED9D9',
      customClass: {
        confirmButton: 'swalBtnTextBlack',
        cancelButton: 'swalBtnTextBlack',
        title: 'has-text-weight-bold',
      },
      confirmButtonText: 'Activar',
      cancelButtonText: 'Cancelar',
      focusCancel: true,
    }).then((result) => {
      if (result.isConfirmed) {
        axios({
          method: 'GET',
          url: base_url + '/products/activar_producto?id=' + id,
        }).then(function (response) {
          // console.log(response.data)
          if (!response.data.status) {
            Toast.fire({
              icon: 'warning',
              title: response.data.msg,
            })
          }
          Toast.fire({
            icon: 'success',
            title: response.data.msg,
          })
          tablaProductos.ajax.reload(null, false)
        })
      }
    })
  }
  const desactivar_producto = (id) => {
    if (!id) return console.error('sin ID de producto')
    Swal.fire({
      title: '¿Desea desactivar el producto?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#CCFEEC',
      cancelButtonColor: '#FED9D9',
      customClass: {
        confirmButton: 'swalBtnTextBlack',
        cancelButton: 'swalBtnTextBlack',
        title: 'has-text-weight-bold',
      },
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar',
      focusCancel: true,
    }).then((result) => {
      if (result.isConfirmed) {
        axios({
          method: 'GET',
          url: base_url + '/products/desactivar_producto?id=' + id,
        }).then(function (response) {
          // console.log(response.data)
          if (!response.data.status) {
            Toast.fire({
              icon: 'warning',
              title: response.data.msg,
            })
          }
          Toast.fire({
            icon: 'success',
            title: response.data.msg,
          })
          tablaProductos.ajax.reload(null, false)
        })
      }
    })
  }
  const generar_codigo = (target) => {
    $(target).val(Math.floor(Math.random() * 99999999999 + 1))
  }
  const editar_producto = async (id) => {
    return await axios({
      method: 'GET',
      url: base_url + '/products/getProductById?id=' + id,
    }).then(function (response) {
      $('#id_producto_edit').val(id)
      $('#codigo_producto_edit').val(response.data.codigo)
      $('#nombre_producto_edit').val(response.data.nombre)
      $('#precio_producto_edit').val(response.data.price_out)
      $('#select-categoria_edit')
        .val(response.data.idcategoria)
        .trigger('change')
      $('#stock_producto_edit').val(response.data.idarticulo)
      $('#select-unidad_edit').val(response.data.idunidad).trigger('change')
      // return
    })
  }
  cargar_categoria(['#select-categoria', '#select-categoria_edit'])
  cargar_unidad(['#select-unidad', '#select-unidad_edit'])
  tablaProductos = $('#example').DataTable({
    dom: DEFAULT_DOM_DATATABLE,
    language: DEFAULT_ES_DATATABLE,
    responsive: true,
    autoWidth: true,
    ajax: {
      type: 'GET',
      url: base_url + '/products/cargar_tabla',
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText)
        console.log(thrownError)
      },
    },
  })
  $(document).on('click', '.activateProduct', function () {
    const idProducto = $(this).data('id')
    activar_producto(idProducto)
  })
  $(document).on('click', '.desactivateProduct', function () {
    const idProducto = $(this).data('id')
    desactivar_producto(idProducto)
  })
  $(document).on('click', '.editarProduct', async function () {
    const id = $(this).data('id')
    const modal = $(this).data('target')
    await editar_producto(id)
    openModal(modal)
  })
  $('#btnGenerar_codigo,#btnGenerar_codigo_edit').on('click', function () {
    const target = $(this).data('targetInput')
    generar_codigo(target)
  })
  $('#frmCrearProducto').validate({
    errorClass: 'is-danger',
    validClass: 'is-success',
    rules: {
      codigo_producto: {
        required: true,
        minlength: 11,
        maxlength: 11,
      },
      nombre_producto: {
        required: true,
        minlength: 4,
      },
      precio_producto: {
        required: true,
        minlength: 1,
        number: true,
      },
      stock_producto: {
        required: false,
        minlength: 1,
        number: true,
      },
      'select-categoria': {
        required: true,
      },
      'select-unidad': {
        required: true,
      },
    },
    submitHandler: function (form) {
      let params = new FormData()
      params.append('codigo_producto', $('#codigo_producto').val())
      params.append('nombre_producto', $('#nombre_producto').val())
      params.append('precio_producto', $('#precio_producto').val())
      params.append('select_categoria', $('#select-categoria').val())
      params.append('select_unidad', $('#select-unidad').val())
      params.append('stock_producto', $('#stock_producto').val())
      params.append('imagen_producto', $('#imagen_producto')[0].files[0])
      axios({
        method: 'POST',
        url: base_url + '/products/crear',
        data: params,
      }).then(function (response) {
        // return console.log(response.data)
        if (!response.data.status) {
          return Toast.fire({
            icon: 'warning',
            title: response.data.msg,
          })
        }
        tablaProductos.ajax.reload(null, false)
        hideModal('#añadir-producto')
        resetForm('#frmCrearProducto')
        return Toast.fire({
          icon: 'success',
          title: response.data.msg,
        })
      })
    },
  })
  $('#frmEditarProducto').validate({
    errorClass: 'is-danger',
    validClass: 'is-success',
    rules: {
      codigo_producto_edit: {
        required: true,
        minlength: 11,
        maxlength: 11,
      },
      nombre_producto_edit: {
        required: true,
        minlength: 4,
      },
      precio_producto_edit: {
        required: true,
        minlength: 1,
        number: true,
      },
      stock_producto_edit: {
        required: false,
        minlength: 1,
        number: true,
      },
      'select-categoria_edit': {
        required: true,
      },
      'select-unidad_edit': {
        required: true,
      },
    },
    submitHandler: function (form) {
      let params = new FormData()
      params.append('id_producto_edit', $('#id_producto_edit').val())
      params.append('codigo_producto_edit', $('#codigo_producto_edit').val())
      params.append('nombre_producto_edit', $('#nombre_producto_edit').val())
      params.append('precio_producto_edit', $('#precio_producto_edit').val())
      params.append('select_categoria_edit', $('#select-categoria_edit').val())
      params.append('select_unidad_edit', $('#select-unidad_edit').val())
      params.append('stock_producto_edit', $('#stock_producto_edit').val())
      params.append(
        'imagen_producto_edit',
        $('#imagen_producto_edit')[0].files[0]
      )
      axios({
        method: 'POST',
        url: base_url + '/products/editar',
        data: params,
      }).then(function (response) {
        // return console.log(response.data)
        if (!response.data.status) {
          return Toast.fire({
            icon: 'warning',
            title: response.data.msg,
          })
        }
        tablaProductos.ajax.reload(null, false)
        hideModal('#editar-producto')
        resetForm('#frmEditarProducto')
        return Toast.fire({
          icon: 'success',
          title: response.data.msg,
        })
      })
    },
  })
  $('#search_products_in_table').on('keyup', function () {
    const search = $(this).val()
    if (search.length > 2) {
      return tablaProductos.search(search).draw()
    }
    if (search.length == 0) {
      return tablaProductos.search('').draw()
    }
  })
  //Resetear formulario cuando haga click en cerrar modal de añadir
  $('#modal_close_add').on('click', function () {
    resetForm('#frmCrearProducto')
  })
  //Resetear formulario cuando haga click en cerrar modal de editar
  $('#modal_close_edit').on('click', function () {
    resetForm('#frmEditarProducto')
  })
})
