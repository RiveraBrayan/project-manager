pages = function () {

  return {

    /**********************************************
    * Pages Functions
    **********************************************/
    tablePages: function () {

      let action = 'tablePages';

      var url = `controllers/pagesController.php?action=${action}`;

      var columns = [
        { data: 'counter' },
        { data: 'name_page' },
        { data: 'clase_page' },
        { data: 'actions' }
      ];

      table = `tablePages`;

      execDatatable(table, url, columns);
    },

    infoPages: function () {

      var data = new FormData();
      data.append("action", 'infoPages');
      data.append("id", $('#txtId').val());

      $.ajax({
        url: 'controllers/pagesController.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        success: function (response) {
          if (response.status == 202) {
            let data = response.JsonData;

            $('#txtName').val(data.name_page);
            $('#txtUrl').val(data.urlpage_page);
            $('#txtIcon').val(data.clase_page);

            if (data.status_page == 1) {
              var miCheckbox = document.getElementById('checkboxActive');
              miCheckbox.checked = true;
            }
          }
        },
        error: function (error) {
          console.error('Errors');
        }
      });
    },

    saveInfo: function () {

      let action = 'savePagesInfo';
      let txtId = $('#txtId').val();
      let txtName = $('#txtName').val();
      let txtUrl = $('#txtUrl').val();
      let txtIcon = $('#txtIcon').val();
      let checkboxActive = document.getElementById('checkboxActive').checked ? 1 : 0;

      var data = new FormData();
      data.append("action", action);
      data.append("txtId", txtId);
      data.append("txtName", txtName);
      data.append("txtUrl", txtUrl);
      data.append("txtIcon", txtIcon);
      data.append("checkboxActive", checkboxActive);

      $.ajax({
        url: 'controllers/pagesController.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        success: function (response) {
          status = response.status;
          message = response.message;

          if (status == 202) {
            fncSweetAlert('success', message, 'reload');
          } else {
            fncSweetAlert('error', message, 'text');
          }
        },
        error: function (error) {
          console.error('Errors');
        }
      });
    },


    /**********************************************
    * Roles Pages Functions
    **********************************************/
    tableRoles: function () {

      let action = 'tableRoles';
      let id_page = $('#id_page').val();

      var url = `controllers/pagesController.php?action=${action}&id_page=${id_page}`;

      var columns = [
        { data: 'counter' },
        { data: 'name_rol' },
        { data: 'actions' },
      ];

      table = `tableRoles`;

      execDatatable(table, url, columns);

    },

    generateSelectRoles: function () {
      var data = new FormData();
      data.append("action", 'consultarSelect');
      data.append("table", 'roles');
      data.append("select", 'id_rol as id, id_rol as value, name_rol as name');
      data.append("where", 'status_rol');
      data.append("whereTo", 1);


      $.ajax({
        url: 'controllers/functionsController.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        success: function (response) {
          let status = response.status;
          let JsonData = response.JsonData;

          if (status == 202) {
            var selectElement = document.getElementById("txtRoles");
            selectElement.innerHTML = JsonData;
          } else {
            var selectElement = document.getElementById("txtRoles");
            selectElement.innerHTML = JsonData;
          }
        }
      });
    },

    saveRolesinfo: function () {

      let id_rol = $('#txtRoles').val();
      let id_page = $('#id_page').val();

      if (id_rol != '') {
        var data = new FormData();
        data.append("action", 'saveRolesinfo');
        data.append("id_page", id_page);
        data.append("id_rol", id_rol);

        $.ajax({
          url: 'controllers/pagesController.php',
          method: 'POST',
          processData: false,
          contentType: false,
          data: data,
          dataType: 'json',
          success: function (response) {
            status = response.status;
            message = response.message;

            if (status == 202) {
              fncSweetAlert('success', message, 'reload');
            } else {
              fncSweetAlert('error', message, 'text');
            }
          }
        });
      }
    },

    /**********************************************
    * Extra Functions
    **********************************************/

    showInputs: function () {
      if ($('#txtId').val() != '') {
        document.getElementById('inputCheckbox').style = 'display:block'
      }
    },


    init: function () { }
  };

}();

$(document).ready(function () {
  pages.init();
});


if ($("#tablePages").length > 0) {
  pages.tablePages();
}

$('.searchInfo').on('click', function () {
  pages.tablePages();
});

$('.saveSubmit').on('click', function () {
  pages.saveInfo();
});

if ($("#tableRoles").length > 0) {
  pages.tableRoles();
}

$('.saveRol').on('click', function () {
  pages.saveRolesinfo();
});

if ($("#txtRoles").length > 0) {
  pages.generateSelectRoles();
}


if ($("#txtId").length > 0) {
  pages.infoPages();
  pages.showInputs();
}