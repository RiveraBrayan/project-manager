users = function () {

  return {

    /**********************************************
    * User Functions
    **********************************************/
    tableUsers: function () {

      let action = 'tableUsers';
      let txtNameFilter = $('#txtNameFilter').val();
      let txtUsernameFilter = $('#txtUsernameFilter').val();
      let txtEmailFilter = $('#txtEmailFilter').val();
      let txtStatusUser = $('#txtStatusUser').val();
      
      var url = `controllers/usersController.php?action=${action}&txtNameFilter=${txtNameFilter}&txtUsernameFilter=${txtUsernameFilter}&txtEmailFilter=${txtEmailFilter}&txtStatusUser=${txtStatusUser}`;
      
      var columns = [
        { data: 'counter' },
        { data: 'name_user' },
        { data: 'username_user' },
        { data: 'email_user' },
        { data: 'deparment_user' },
        { data: 'position_user' },
        { data: 'actions' },
      ];
      
      table = `tableUsers`;
      
      execDatatable(table, url, columns);
      
    },

    infoUsers: function(){

      var data = new FormData();
      data.append("action", 'infoUsers');
      data.append("id_user", $('#txtId').val());

      $.ajax({
        url: 'controllers/usersController.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        success: function (data) {
          if(data.status == 202){
            let dataUsers = data.JsonData;

            $('#txtUsername').val(dataUsers.username_user);
            $('#txtFullname').val(dataUsers.name_user);
            $('#txtEmail').val(dataUsers.email_user);
            $('#txtPhone').val(dataUsers.phone_user);
            $('#txtDeparment').val(dataUsers.deparment_user);
            $('#txtPosition').val(dataUsers.position_user);

            if(dataUsers.active_user == 1){
              var miCheckbox = document.getElementById('checkboxActive');
              miCheckbox.checked = true;
            }

            if(dataUsers.su_user == 1){
              var miCheckboxSu = document.getElementById('checkboxSuperSu');
              miCheckboxSu.checked = true;
            }
          }
        },
        error: function (error) {
          console.error('Errors');
        }
      });
    },

    saveUsersInfo: function(){

      let action = 'saveUsersInfo';
      let txtId = $('#txtId').val();
      let txtUsername = $('#txtUsername').val();
      let txtPassword = $('#txtPassword').val();
      let txtFullname = $('#txtFullname').val();
      let txtEmail = $('#txtEmail').val();
      let txtPhone = $('#txtPhone').val();
      let txtDeparment = $('#txtDeparment').val();
      let txtPosition = $('#txtPosition').val();
      let checkboxSuperSu = document.getElementById('checkboxSuperSu').checked ? 1 : 0;
      let checkboxActive = document.getElementById('checkboxActive').checked ? 1 : 0;

      var data = new FormData();
      data.append("action", action);
      data.append("txtId", txtId);
      data.append("txtUsername", txtUsername);
      data.append("txtPassword", txtPassword);
      data.append("txtFullname", txtFullname);
      data.append("txtEmail", txtEmail);
      data.append("txtPhone", txtPhone);
      data.append("txtDeparment", txtDeparment);
      data.append("txtPosition", txtPosition);
      data.append("checkboxSuperSu", checkboxSuperSu);
      data.append("checkboxActive", checkboxActive);

      $.ajax({
        url: 'controllers/usersController.php',
        method: 'POST',
        processData: false,
        contentType: false,
        data: data,
        dataType: 'json',
        success: function (response) {
            status = response.status;
            message = response.message;

            if (status == 202) {
              fncSweetAlert('success', message, 'users');
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
    * Roles User Functions
    **********************************************/
    tableRoles: function () {

      let action = 'tableRoles';
      let id_user = $('#id_user').val();
      
      var url = `controllers/usersController.php?action=${action}&id_user=${id_user}`;
      
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
          
          if(status == 202){
            var selectElement = document.getElementById("txtRoles");
            selectElement.innerHTML = JsonData;
          }else{
            var selectElement = document.getElementById("txtRoles");
            selectElement.innerHTML = JsonData;
          }
        }
      });
    },

    saveRolesinfo: function(){
      
      let id_rol = $('#txtRoles').val();
      let id_user = $('#id_user').val();

      if(id_rol != ''){
        var data = new FormData();
        data.append("action", 'saveRolesinfo');
        data.append("id_user", id_user);
        data.append("id_rol", id_rol);
  
        $.ajax({
          url: 'controllers/usersController.php',
          method: 'POST',
          processData: false,
          contentType: false,
          data: data,
          dataType: 'json',
          success: function (response) {
            status  = response.status;
            message = response.message;

           if(status == 202){
            fncSweetAlert('success', message, 'reload');
           }else{
            fncSweetAlert('error', message, 'text');
           }
          }
        });
      }
    },

    /**********************************************
    * Extra Functions
    **********************************************/
    showInputs: function(){
      if($('#txtId').val() == ''){
        document.getElementById('inputPassword').style = 'display:block'
      }

      if($('#txtId').val() != ''){
        document.getElementById('inputCheckbox').style = 'display:block'
      }
    },

    init: function () {

    }
  };

}();

$(document).ready(function () {
  users.init();
});

if($("#tableUsers").length > 0){
  users.tableUsers();
}

$('.searchInfo').on( 'click', function (){
  users.tableUsers();
});

if($("#tableRoles").length > 0){
  users.tableRoles();
}

$('.saveRol').on( 'click', function (){
  users.saveRolesinfo();
});

if($("#txtRoles").length > 0){
  users.generateSelectRoles();
}

$('.userSubmit').on( 'click', function (){
  users.saveUsersInfo();
});

if($("#txtId").length > 0){
  users.infoUsers();
  users.showInputs();
}