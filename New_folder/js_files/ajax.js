$(function () {
         $('#regger').submit (function () {
              var register = $(this).serialize ();
              $.post ('/php_files/TeeckleRegg',register,function (data) {
                   var newregHTML = '<p>' + data.username + '</p>';
                   $('#wrapper').html (newregHTML);
              }, "json");
              return false;
              });
         $('#logger').submit (function () {
              var login = $(this).serialize();
              $.post ('/php_files/login.php', login, function (data) {
                   var newlogHTML = '<p>' + data.logged + '</p>';
                   $('#wrapper').html(newlogHTML);  
                   }
              , 'json').error(function () {
                   var errorHTML = '<p>THERE WAS AN ERROR!</p>'
                   $('wrapper').html(errorHTML);      
              });
              return false;  
         });
         });
