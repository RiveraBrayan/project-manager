pages = function() {

    return {

      tablePages: function(){

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

      infoPages: function(){

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
            if(response.status == 202){
              let data = response.JsonData;
  
              $('#txtName').val(data.name_page);
              $('#txtUrl').val(data.urlpage_page);
              $('#txtIcon').val(data.clase_page);
  
              if(data.status_page == 1){
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
                  window.location = 'pages';
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
  pages.init();
});

  
if($("#tablePages").length > 0){
  pages.tablePages();
}

$('.searchInfo').on( 'click', function (){
  pages.tablePages();
});

if($("#txtId").length > 0){
  pages.infoPages();
  pages.showInputs();
}

$('.saveSubmit').on( 'click', function (){
  pages.saveInfo();
});