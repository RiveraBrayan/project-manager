users = function () {

  return {

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
              var miCheckbox = document.getElementById('checkbocActive');
              miCheckbox.checked = true;
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
      let checkbocActive = document.getElementById('checkbocActive').checked ? 1 : 0;

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
      data.append("checkbocActive", checkbocActive);

      $.ajax({
        url: 'controllers/usersController.php',
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
                window.location = 'users';
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

if($("#txtId").length > 0){
  users.infoUsers();
  users.showInputs();
}

$('.userSubmit').on( 'click', function (){
  users.saveUsersInfo();
});
