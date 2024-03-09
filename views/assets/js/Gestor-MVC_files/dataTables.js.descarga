function execDatatable(table, url, columns) {
  var dataTable = $(`#${table}`).DataTable({
    "destroy": true,
    "ajax": {
      "url": `${url}`,
      "dataType": 'json',
      "contentType": false,
      "processData": false,
      "dataSrc": ""
    },
    "columns": columns,
  });
}
