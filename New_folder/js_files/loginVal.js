$( function () {
var sub;
var bool;
     $('#logger').validate ({
          rules: {
               email: {
                    required: true,
                    email: true
               },
               userpwd: {
                    required: true,
                    minlength: 8
               }
          },
          messages: {
               email: {
                    required: "<br />Please enter your email",
                    email: "<br />Please enter a valid email"
               },
               userpwd: {
                    required: "<br />Please enter your password",
                    minlength: "<br />Password must be at least 8 characters long"
               }
          }       
     });
     $('#regger').validate({
          
          rules: {
               registersex: {
                    required: true
               },
               registeruser: {
                    required: true,
                    minlength: 4,
                    maxlength: 14
               },
               registeremail: {
                    required: true,
                    email: true,
                    maxlength:40
               },
               registerpassword: {
                    required: true,
                    minlength: 8,
                    maxlength: 12
               },
               confpassword: {
                    required: true,
                 
                    maxlength: 12
               },
               birth_data: {
                    required: true,
                    date: true
               }
          },
          messages: {
               registersex: {
                    required: "<tr><td>You must enter your sex</td></tr>"
               },
               registeruser: {
                    required: "You must enter your username",
                    minlength: "Username must be at least 4 characters",
                    maxlength: "max username length is 14 characters"
               },
               registeremail: {
                    required: "You must enter your email",
                    email: "You must enter a valid email",
                    maxlength: "Your email is too long, max is 40"
               },
               registerpassword: {
                    required: "You must enter a password",
                    minlength: "Password must be 8 characters long",
                    maxlength: "max password length is 12 characters"
               },
               confpassword: {
                    required: "You must confirm your password"
                    
               },
               birth_data: {
                    required: "Date of Birth is required",
                    date: "This is not a valid date"
                   
               }
          },
          errorPlacement: function (error,element) {
               if (element.is(":radio") || element.is(":checkbox")) {
                    error.appendTo(element.parent());
               }
               else {
                    error.insertAfter(element);
               }
          }
     });
     $('#morereginfo').validate ({
          rules: {
               Country: {
                    required: true
               },
               zip_code: {
                    required: true,
                    minlength: 5,
                    maxlength: 5,
                    number: true
               },
               status: {
                    required: true
               },
               orientation: {
                    required: true
               },
               opento: {
                    required: true
               }
          },
          messages: {
               Country: {
                    required: "<br />Country is required"
               },
               zip_code: {
                    required: "<br />zip code is required",
                    minlength: "<br />must be 5 numbers long",
                    maxlength: "<br />must be 5 numbers long",
                    number: "<br />must be all numbers"
               },
               status: {
                    required: "<br /> status is required"
               },
               orientation: {
                    required: "<br /> orientation is required"
               },
               opento: {
                    required: "<br />open to field is required"
               }     
          }
     });

$('#regis').click(function () {
     bool = true;
     sub = $('[name="registersex"]');
     if (!sub.is(':checked')) {
     sub.parent().append('<tr><td>You must enter your sex</td></tr>');
          bool = false;
     }
     if ($('[name="registerpassword"]') != $('[name="confpassword"]') ) {
          bool = false;
     }
     sub = $('[name="registeremail"]').val();
     $.post('/php_files/checkem.php',{'email':sub},function (data) {
          if (data == 1 && bool == true) {
               $('#regger').attr('action',"/php_files/TeeckleRegg.php");
               $('#regger').submit();
          }
 
     });
     
});
});
