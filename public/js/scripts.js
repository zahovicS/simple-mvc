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
