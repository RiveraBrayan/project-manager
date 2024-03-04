roles = function() {

    return {

      tableRoles: function(){

        let action = 'tableRoles';
        let status = $('#txtStatusRol').val();
        
        var url = `controllers/rolesController.php?action=${action}&status=${status}`;
        
        var columns = [
          { data: 'counter' },
          { data: 'name_rol' },
          { data: 'status_rol' },
          { data: 'actions' }
        ];
        
        table = `tableRoles`;
        
        console.log(execDatatable(table, url, columns));
      },

      infoRoles: function(){

        var data = new FormData();
        data.append("action", 'infoRoles');
        data.append("id", $('#txtId').val());
  
        $.ajax({
          url: 'controllers/rolesController.php',
          method: 'POST',
          processData: false,
          contentType: false,
          data: data,
          dataType: 'json',
          success: function (response) {
            if(response.status == 202){
              let data = response.JsonData;
  
              $('#txtRol').val(data.name_rol);
  
              if(data.status_rol == 1){
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

      showInputs: function(){
        if($('#txtId').val() != ''){
          document.getElementById('inputCheckbox').style = 'display:block'
        }
      },

      saveInfo: function(){

        let action = 'saveRolesInfo';
        let id = $('#txtId').val();
        let txtRol = $('#txtRol').val();
        let checkboxActive = document.getElementById('checkboxActive').checked ? 1 : 0;
  
        var data = new FormData();
        data.append("action", action);
        data.append("id", id);
        data.append("txtRol", txtRol);
        data.append("checkboxActive", checkboxActive);
  
        $.ajax({
          url: 'controllers/rolesController.php',
          method: 'POST',
          processData: false,
          contentType: false,
          data: data,
          dataType: 'json',
          success: function (response) {
            if(response.status == 202){
              Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message,
                type: 'success'
                }).then(function() {
                  window.location = 'roles';
                })
            }else{
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                text:  response.message,
                });
            }
          },
          error: function (error) {
            console.error('Errors');
          }
        });
      },
        

      init: function(){}
    };
  
}();
  
$(document).ready(function(){
  roles.init();
});

  
if($("#tableRoles").length > 0){
  roles.tableRoles();
}

$('.searchInfo').on( 'click', function (){
  roles.tableRoles();
});

if($("#txtId").length > 0){
  roles.infoRoles();
  roles.showInputs();
}

$('.saveSubmit').on( 'click', function (){
  roles.saveInfo();
});