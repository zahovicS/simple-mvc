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
  $('#frmCrearProducto').on('submit', function (e) {
    e.preventDefault()
    // const validador = $(this).validate({
    //   errorClass: 'is-danger',
    //   validClass: 'is-success',
    //   rules: {
    //     codigo_producto: {
    //       required: true,
    //       minlength: 'El código debe ser de maximo 11 carácteres',
    //     },
    //     nombre_producto: {
    //       required: true,
    //     },
    //   },
    //   highlight: function (element, errorClass, validClass) {
    //     $(element)
    //       .closest('.validate')
    //       .addClass(errorClass)
    //       .removeClass(validClass)
    //   },
    //   unhighlight: function (element, errorClass, validClass) {
    //     $(element)
    //       .closest('.validate')
    //       .addClass(validClass)
    //       .removeClass(errorClass)
    //   },
    // })
    // console.log(validador)
    // return
    let params = new FormData()
    // const params = new URLSearchParams()
    params.append('codigo_producto', $('#codigo_producto').val())
    params.append('nombre_producto', $('#nombre_producto').val())
    params.append('select-categoria', $('#select-categoria').val())
    params.append('stock_producto', $('#stock_producto').val())
    params.append('imagen_producto', $('#imagen_producto')[0].files[0])
    axios({
      method: 'POST',
      url: $(this).attr("action"),
      data: params,
    }).then(function (response) {
      console.log(response.data)
    })
  })
})
