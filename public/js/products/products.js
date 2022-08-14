$(function () {
  let tablaProductos
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
          method: 'get',
          url: base_url + '/products/activar_producto/' + id,
        }).then(function (response) {
          console.log(response.data)
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
          method: 'get',
          url: base_url + '/products/desactivar_producto/' + id,
        }).then(function (response) {
          console.log(response.data)
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
  tablaProductos = $('#example').DataTable({
    dom: DEFAULT_DOM_DATATABLE,
    language: DEFAULT_ES_DATATABLE,
    responsive: true,
    autoWidth: true,
    ajax: {
      type: 'get',
      url: base_url + '/products/tableProducts',
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
})
