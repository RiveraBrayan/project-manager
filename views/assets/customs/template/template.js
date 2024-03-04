template = function() {

    return {
        
        deleteRegister: function(id,table,suffix,page){
          Swal.fire({
            title: "Delete?",
            text: 'Do you want to delete this record?',
            icon: 'error',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Yes",
            denyButtonText: `No`
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

              var data = new FormData();
              data.append("action", 'deleteRegister');
              data.append("id", id);
              data.append("table", table);
              data.append("suffix", suffix);
            
              $.ajax({
                url: "controllers/functionsController.php",
                method: 'POST',
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                success: function(response){
                  if(response){
                    Swal.fire({
                      title: 'Success!',
                      text: 'Record Deleted Successfully!',
                      type: 'success'
                      }).then(function() {
                      window.location = page;
                      });
                  }else{
                    Swal.fire({
                      icon: 'error',
                      title: 'Error!',
                      text: 'Error in execution'
                      });
                  }
                }
            
              })
            }
          });



        },

        

        init: function(){}
    };
  
  }();
  
  $(document).ready(function(){
    template.init();
  });

  $(document).on("click",".deleteRegister",function(){
    template.deleteRegister($(this).data("id"),$(this).data("table"),$(this).data("suffix"),$(this).data("page"));
  });
