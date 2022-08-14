const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  },
})

const DEFAULT_ES_DATATABLE = {
  decimal: '',
  emptyTable: `<div class="d-block"></div><div class="d-block"><i class="fas fa-frown fa-lg"></i> No hay información</div>`,
  info: 'Mostrando _START_ a _END_ de _TOTAL_ datos',
  infoEmpty: 'Mostrando 0 a 0 de 0 datos',
  infoFiltered: '(Filtrado de _MAX_ total datos)',
  infoPostFix: '',
  thousands: ',',
  lengthMenu: 'Mostrar _MENU_ datos',
  loadingRecords: `<div class="d-block"><img src="${base_url}/img/loader3.gif" width="40px"/></div><div class="d-block">Recuperando datos...</div>`,
  processing: `<img src="${base_url}/img/loader.gif"/>`,
  search: 'Buscar:',
  zeroRecords: 'Sin resultados encontrados',
  paginate: {
    first: '<i class="fa-solid fa-angles-left"></i>',
    last: '<i class="fa-solid fa-angles-right"></i>',
    next: '<i class="fa-solid fa-angle-right"></i>',
    previous: '<i class="fa-solid fa-chevron-left"></i>',
  },
}
const DEFAULT_DOM_DATATABLE =
  "<t<'container is-fluid p-0'<'columns'<'column is-half'i><'column is-half'p>>>>"

async function get_person_dni(dni) {
  if (!dni) return console.error('no puede buscar sin DNI.')
  await axios({
    method: 'get',
    url: base_url + '/search/dni/' + dni,
  }).then(function (response) {
    console.log(response.data)
  })
}
async function get_company_ruc(ruc) {
  if (!ruc) return console.error('no puede buscar sin RUC.')
  await axios({
    method: 'get',
    url: base_url + '/search/ruc/' + ruc,
  }).then(function (response) {
    console.log(response.data)
  })
}
// get_person_dni('71748161')
// get_company_ruc('20514966631')
