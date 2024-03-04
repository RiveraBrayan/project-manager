home = function() {

    return {
        
        userCard: function(){
            var data = new FormData();
            data.append("action", 'userCard');
        
            $.ajax({
              url: "controllers/homeController.php",
              method: 'POST',
              processData: false,
              contentType: false,
              data: data,
              dataType: 'json',
              success: function(response){
                JsonData = response.JsonData;
                document.getElementById('totalUsers').textContent = JsonData.total_user;
              }
        
            })
             
        },

        init: function(){
            home.userCard();
        }
    };
  
  }();
  
  $(document).ready(function(){
    home.init();
  });
