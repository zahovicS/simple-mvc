$(function () {
  let tablaProductos
  const cargar_categoria = (target = '', edit = '_edit') => {
    axios({
      method: 'get',
      url: base_url + '/categories/categories_for_dropdown',
    }).then(function (response) {
      let template =
        '<option class="is-uppercase" value="" selected>Seleccione la categoría</option>'
      $.each(response.data, function (i, v) {
        template += `<option class="is-uppercase" value="${v.idcategoria}">${v.nombre}</option>`
      })
      $(target + edit).html(template)
    })
  }
  const cargar_unidad = (target = '', edit = '_edit') => {
    axios({
      method: 'get',
      url: base_url + '/unidades/unidades_for_dropdown',
    }).then(function (response) {
      let template =
        '<option class="is-uppercase" value="" selected>Seleccione la unidad de medida</option>'
      $.each(response.data, function (i, v) {
        template += `<option class="is-uppercase" value="${v.idunidad}">${v.nombre} [${v.value}]</option>`
      })
      $(target + edit).html(template)
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
  cargar_categoria('#select-categoria', '')
  cargar_unidad('#select-unidad', '')
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
  $('#btnGenerar_codigo').on('click', function () {
    const target = $(this).data('targetInput')
    // console.log(target)
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
      stock_producto: {
        required: false,
        minlength: 1,
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
      params.append('select_categoria', $('#select-categoria').val())
      params.append('select_unidad', $('#select-unidad').val())
      params.append('stock_producto', $('#stock_producto').val())
      params.append('imagen_producto', $('#imagen_producto')[0].files[0])
      axios({
        method: 'POST',
        url: base_url + '/products/crear',
        data: params,
      }).then(function (response) {
        console.log(response.data)
        if (!response.data.status) {
          return Toast.fire({
            icon: 'warning',
            title: response.data.msg,
          })
        }
        tablaProductos.ajax.reload(null, false)
        hideModal("#añadir-producto");
        resetForm("#frmCrearProducto");
        return Toast.fire({
          icon: 'success',
          title: response.data.msg,
        })
      })
    },
  })
})
