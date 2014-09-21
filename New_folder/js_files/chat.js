     $(function () {

    
               
     var img = new Image();
     var img2 = new Image();
     var img3 = new Image();
     var img4 = new Image();
     var img5 = new Image();
     var img6 = new Image();
     var img7 = new Image();
     img.src = '/images/Profile-Icons.png';
     img2.src = '/images/Profile-Icons-Blue.png';
     img3.src = '/images/Message-Icons.png';
     img4.src = '/images/Message-Icons-Blue.png';
     img5.src = '/images/book_grey2_icon.png';
     img6.src = '/images/book_blue_icon.png';

     
     
     var month=new Array();
     month[1]="January";
     month[2]="February";
     month[3]="March";
     month[4]="April";
     month[5]="May";
     month[6]="June";
     month[7]="July";
     month[8]="August";
     month[9]="September";
     month[10]="October";
     month[11]="November";
     month[12]="December";

     var cont;
     var contact;
     var d;
     var n;
     var datedisp;
     $('.profnav').click(function () {
          $( "[id*='fancybox']" ).remove();
     });
     
     var profp = $('#wrapper').html();
     var messp = "<table id=\"messer\"><tr><td>Inbox</td></tr></table><div id=\"display_box\"><div id=\"display_mess\"></div></div>";
     var otherp;
     var loop;
     
     var logg;
     
     
     var selector;
     var apprv;
     var uri;
     var cereal;
     var delprf;
     var htmn;
     var upd;
     var intup = window.setInterval(function () {intupd()},1000);
     
     $('#teeckles').hide();

   
      function intupd () {
               $.post('/php_files/num_mess.php',function (data) {

                              if (data > 0) {
                              
                              var html = "( <span style='color:#2774b8;'>" + data + "</span> )";
                              $('#nums').html(html);
                              }
                              else {
                              $('#nums').html('')
                              }

                    });     
                    

               
               $.post('/php_files/num_teek.php',function (data) {

                              if (data > 0) {
                              $('#teeckles').show();
                              var html = "( <span style='color:#2774b8;'>" + data + "</span> )";
                              $('#teeks').html(html);
                              }
                              else {
                              $('#teeks').html('')
                              $('#teeckles').hide();
                              }

                    });     
                    

               
               $.post('/php_files/num_req.php',function (data) {

                              if (data > 0) {
                              var html = "( <span style='color:#2774b8;'>" + data + "</span> )";
                              $('#conts').html(html);
                              
                              }
                              else {
                              $('#conts').html('')
                              
                              }

                    });
                    } 
     
     function update_mess () {

     
     
          loop = true;
          uri = $('#display_mess');
          selector = $('[name="visited"]');
          selector = selector.val();
          uri = uri.find('li.message');
          uri = uri.last();
          uri = uri.attr('id');
          $.post('/php_files/org_mess.php',{'convo':selector,'newer':uri},function (data) {
               html = '';
               $.each(data,function (user,conv) {
               if (loop == true) {
               loop = false;
               if (datedisp != conv.datesent) {
                    datedisp = conv.datesent;
                    html += '<li class="date_display">' +  datedisp.replace(datedisp.substr(0,1),month[datedisp.substr(0,1)]) + '</li>';
               }
                    html += '<li class="message" id="' + conv.messid + '"><ul class="message-content">' +
                '<li class="mess_head">' + conv.fromuser + ':<span style="float: right;">' +  conv.time 
               + '</span></li><li class="mess_bod">' + 
               conv.message + '</li></ul></li>';
                     

               }
               });
               var oj = $('#display_mess')
               if (oj.scrollTop() + oj.innerHeight() >= oj[0].scrollHeight && loop == false) {
                    
                    var bizzle = true;
               }
               oj.append(html);
               if (bizzle == true ) {
                    oj.animate({scrollTop: oj[0].scrollHeight});
               }
                    },"json").error(function () {
                    });
          
          
          }
      function update_log () {
           $.post('/php_files/update_mess_sess.php',function (data) {
                    $.each(data,function (user,content) {
                         if (curruser == content.fromuser) {
                    otherp = content.touser;
               }
               else {
                    otherp = content.fromuser;
               }
                         selector = $('#friend_list').find('li[name=' + otherp + ']').find('.status');
                         if (content.online == null) {
                              selector.attr('class','status off_status');
                         }
                         else {
                              selector.attr('class','status on_status');
                         }
                     
                    });
           },'json');
      }
     

               
     $('#profile').livequery (function () {
     
     $(this).click(function ()  {
     $('#change').attr({href:'/cssfiles/ProfilePage.css'});
     selector = $('#contacts').find('img');
     selector.attr({src:img5.src});
     selector = $('#messages').find('img');
     selector.attr({src:img3.src});
     selector = $('#profile').find('img');
     selector.attr({src:img2.src});
     
     $('#wrapper').html(profp);
      load_user(); 
      
      
      $('.edit_button').hide();

      $('#mystatsedit').hide(); 
      $('#editmyownbutt').hide();
      $('#editmystatsbutt').hide();
      $('#edit_main').hide();
      $('#editmainbutt').hide();
      $('#imowedit').hide();
      $('#profile').css({'color':'#2774b8'});
      $("a").not('[id="profile"]').css({'color':'#A8A8A8'});  
        
     });
     });
     
     
     $('#messages').livequery (function () {
     $(this).click(function () {
     $('.chat').show();
     $('head').prepend(
     "<style id=\"dyn\"type=\"text/css\"> \
      .mess_is { \
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff; \
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff; \
	box-shadow:inset 0px 1px 0px 0px #ffffff; \
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) ); \
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% ); \
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf'); \
	background-color:#ededed; \
	-moz-border-radius:6px; \
	-webkit-border-radius:6px; \
	border-radius:6px; \
	border:1px solid #dcdcdc; \
	display:inline-block; \
	color:#777777; \
	font-family:arial; \
	font-size:15px; \
	font-weight:bold; \
	padding:6px 24px; \
	text-decoration:none; \
	text-shadow:1px 1px 0px #ffffff; margin-top: 72px;position: absolute; \
}.mess_is:hover { \
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) ); \
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% ); \
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed'); \
	background-color:#dfdfdf; \
}.mess_is:active { \
	position:relative; \
	top:1px; \
} \
/* This imageless css button was generated by CSSButtonGenerator.com */ \
form.mess_tas { \
     background-color: rgb(247, 247, 247) !important; \
     border-radius: 0px 0px 5px 5px !important; \
} \
</style>");
     
     
          selector = $('#messages').find('img');
          selector.attr({src:img4.src});
          
          selector = $('#profile').find('img');
          selector.attr({src:img.src});
          selector = $('#contacts').find('img');
          selector.attr({src:img5.src});
          
              
          $('#messages').css({'color':'#2774b8'});
          $(".profnav").not('[id="messages"]').css({'color':'#A8A8A8'});    

          $.post('/php_files/show_messages.php',function (data) {
                selector = $('#friend_list');
          html = '';
               $.each(data,function(user,content) {
               
               if (curruser == content.fromuser) {
                    otherp = content.touser;
               }
               else {
                    otherp = content.fromuser;
               }
               html += '<li class="show_content" name="' + otherp + 
               '"><a href="/profile/' + otherp + '.php"><img src="';
                  if (content.thumbnail != null) {
                   html += content.thumbnail;
                   }
                   else {
                   html += img.src;
                   }
                   html += '" style="height: 40px;width: 40px;float:left;"></a>' 
                  + 
                otherp + '<img class="status ';
                if (content.online == null) {
                     html += 'off_status';
                }
                else {
                     html += 'on_status';
                }
                html += '" /></li><br>';
               }); 
               selector.html(html);
               logg = window.setInterval(function () {update_log()},2000);
          },"json").error(function (data) {
          $(this).html('hi');
          
          });
          
         
     });
     



     });
     
     
     $('.show_content').livequery("click",function () {
          
          
          var id = $(this).attr('name');
          $.post('/php_files/org_mess.php',{'convo':id},function (data) {
          datedisp = null;
           if (typeof upd != 'undefined') {
               clearInterval(upd);
          }
          $('#chat_name').html(id);
           $('#display_mess').empty();
           html = '';
           var thumb; 
     
     
     loop = true;
     $.each(data,function (user,conv) {           
                if (datedisp != conv.datesent) {
                    datedisp = conv.datesent;
                    html += '<li class="date_display">' + datedisp.replace(datedisp.substr(0,1),month[datedisp.substr(0,1)]) + '</li>';
               }
                html += '<li class="message" id="' + conv.messid + '"><ul class="message-content">' +
                '<li class="mess_head">';
               if (conv.fromuser != curruser) {
               thumb = conv.thumbnail;
                    $('li#' + conv.messid ).find('mess_head').css({
                         'color' : '#2774b8'
                    });
               }
               html += conv.fromuser + ':<span style="float: right;">' +  conv.time 
               + '</span></li><li class="mess_bod">' + 
               conv.message + '</li></ul></li>';
               
               });
               $('#chat_pic').attr({ 'src': thumb});
               $('#display_mess').html(html);        
               $('#display_mess')
               $('#mess_text').html('<form class="mess_tas" id="mess_ta"><textarea id="mess_tx" name="message" cols="30" rows="3" maxlength="2000"></textarea>' +
               '<input type="hidden" name="visited" value="' + id + '"/></form>');     
               upd = window.setInterval(function () {update_mess()},2000);
               $('#display_mess').scrollTop($('#display_mess').get(0).scrollHeight);
               },'json');
               
               
              
     });
     $('#close').livequery('click',function () {
     $('.chat').hide();
                    if (typeof upd != 'undefined') {
               clearInterval(upd);
               clearInterval(logg);
          }     
          
     });

     $('#mess_tx').livequery(function () {
          
          $("#mess_tx").keypress(function(e) {
    if(e.which == 13) {
        

        if ($('#mess_tx').val() != '') {
        
          uri = $('#mess_ta').serialize();
          d = new Date();
          n = (d.getMonth() + 1) + " " + d.getDate()  + ", " + d.getFullYear() + " ";
          if (d.getHours() > 12) {
               n += (d.getHours() % 12) + ":" + d.getMinutes();
               
          }
          else {
               n += d.getHours() + ":" + d.getMinutes();
               
          }
          if (d.getHours() >= 12) {
               n += " A";
               
          }
          else {
               n += " P";
               
          }
          uri += "&date=" + encodeURIComponent(n);
               $.post('/php_files/message_process.php',uri,function () {
               $('#mess_tx').val('');
               
               });
               }
    }
          
              
          });
          });
          
     $('#message').livequery(function () {
          if ($(this).attr('src') != img4.src && typeof upd != 'undefined') {
               clearInterval(upd);
          }     
          });
          
     $('#contacts').livequery("click",function () {
          
          selector = $('#messages').find('img');
          selector.attr({src:img3.src});

          
          selector = $('#profile').find('img');
          selector.attr({src:img.src});
          selector = $('#contacts').find('img');
          selector.attr({src:img6.src});     
          $('#wrapper').load('Contacts.html #wrapper', function () {

          cont =  $('#contact_content');

          
          $('#change').attr({href:'/cssfiles/messagesPage.css'});
          
          $('#contacts').css({'color':'#2774b8'});
          $(".profnav").not('[id="contacts"]').css({'color':'#A8A8A8'});  

          
 
          $('.nav').removeClass('selected');
               $(this).addClass('selected');
               $.post('/php_files/get_contacts.php',function (data) {
                         cont.empty();
                         $.each(data,function (count,content) {
                         
                         if (content.reqfrom == curruser) {
                              contact = content.reqto;
                         }
                         else {
                              contact = content.reqfrom;
                         }
                         if (contact == '') {
                              cont.html('<tr><td>no contacts</td></tr>');
                         }
                         else {
                              html = '<div style="display:inline-table;width: 300px;margin-right: 5px;background-color: white;border-radius: 5px;' +
                              'overflow: auto;border: 1px solid black;"><a href="/profile/' + contact +'.php"><img src="' + content.thumbnail +'" style="height: 80px;width:80px;background-color: black;" /></a>'
                              + '<table style="margin-top: -60px;display: inline-table;width: 210px;">' + 
                              '<tbody><tr><td>' + contact + '</td></tr><tr><td style="width:130px;">hello</td><td>' +
                              '</td><td id="uncontact" name="' + contact +'">x</td></tr></tbody></table></div>';
                              
                         }
                         });
                         cont.append(html);
               },"json").error(function () {
                    cont.html("err");
               });

          $('#rcontacts').livequery('click',function () {
               $('.nav').removeClass('selected');
               $(this).addClass('selected');
               $.post('/php_files/get_contacts.php',function (data) {
                         cont.empty();
                         $.each(data,function (count,content) {
                         
                         if (content.reqfrom == curruser) {
                              contact = content.reqto;
                         }
                         else {
                              contact = content.reqfrom;
                         }
                         if (contact == '') {
                              cont.html('<tr><td>no contacts</td></tr>');
                         }
                         else {
                              html = '<div style="display:inline-table;width: 300px;margin-right: 5px;background-color: white;border-radius: 5px;' +
                              'overflow: auto;border: 1px solid black;"><a href="/profile/' + contact +'.php"><img src="' + content.thumbnail +'" style="height: 80px;width:80px;background-color: black;" /></a>'
                              + '<table style="margin-top: -60px;display: inline-table;width: 210px;">' + 
                              '<tbody><tr><td>' + contact + '</td></tr><tr><td style="width:130px;">hello</td><td>' +
                              '</td><td id="uncontact" name="' + contact +'">x</td></tr></tbody></table></div>';
                              
                         }
                         });
                         cont.append(html);
               });
          });
          
          $('#accept').livequery( function () {
          $(this).click(function () {
                    var approved = $(this).attr('name');
                    $.post ('/php_files/add_contact.php',{'approved':approved},function (data) {
                         cont.html(data);
                    });
          });
          });
          $('#requests').livequery(function () {
          $(this).click(function () {
          $('.nav').removeClass('selected');
               $(this).addClass('selected');
               $.post('/php_files/get_requests.php',function (data) {
                    cont.empty();
                    $.each(data,function (count,request) {
                              if (request.reqfrom == '')  {
                                   cont.html('no requests');
                              }
                              else {
                              html = '<tr><td><div name="' + request.reqfrom + '" style="width: 400px;background-color: #B2D6F2;padding:2px;">' +
                              '<a><img src="' + request.thumbnail + '"style="height: 75px;width: 75px;background-color: black;">' + 
                              '</a><table style="display: inline-table;margin: -55px 0px 0px 5px;">' + 
                              '<tbody><tr><th>' + request.reqfrom + '</th></tr><tr><td><button type="button" id="accept" name="' + request.reqfrom +'">' + 
                              'accept</button></td><td><button type="button" class="deny" name="' + request.reqfrom  +'">deny</button></td></tr>' + 
                              '</tbody></table></div></td></tr>';
                              cont.append(html);
                              }
                         });
               },"json").error(function () {
                    cont.html("err");
               });
               
          });
          $('.deny').livequery(function () {
          $('.deny').click(function () {
               uri = $(this);
               delprf = uri.attr('name');
               
               $.post('/php_files/delprof.php',{'denied':delprf},function (data) { /////////5 parents/////////
                         uri.parent().parent().parent().parent().parent().remove();
                    });
                    });
               });
          });
          selector = $('.approve');
          selector.livequery(function () {
          $(this).click(function () {
               apprv = $(this).attr('id');
               $.post('/php_files/add_contact.php',{'approved':apprv},function (data) {
                    uri.parent().parent().parent().parent().parent().remove();
               });
          });
          });
     });         
});
$('#teeckles').livequery("click",function () {
     $.post('/php_files/show_teek.php',function (data) {
          $('#wrapper').html('');
          $.each(data,function (inc,teek) {
               html = '<div class="teek_enter" style="width: 760px;overflow:auto;padding-left:10px;padding: 5px;">' +
                  '<a class="ex" style="position: absolute;margin-left: 700px;padding: 10px;font-size: 25px;">' +
                  'x</a><a href="/profile/' + teek.teeckler + '.php">' + 
                  '<img src="';
                   if (teek.thumbnail != null) {
                   html += teek.thumbnail;
                   }
                   else {
                   html += img.src;
                   }
                   html += '" class="teek_pic" style="height: 40px;width: 40px;float:left;" />' 
                  + 
               '</a><table class="teek_cont" name="' + teek.teeckler + '" class="teek_enter_body" style="float:left;' + 
               'width:700px;text-align:left;background-color:rgba(178, 214, 242,0.4);'  +
    'height: 50px;border-radius: 5px;"><th>' + teek.teeckler + '</th><tr>' + 
    '<td style="width: 500px;"></td><td style="text-align:right;"></td></tr></table></a></div>';
     $('#wrapper').append(html);
          });
     },"json");
     $('.ex').livequery("click",function () {
     var th = $(this);
     var thc = th.parent().find('th').text();
          $.post('/php_files/del_teek.php',{'teeckler':thc},function () {
               th.parent().remove();
          });
     });
});

$('#uncontact').livequery("click",function () {
     uri = $(this);
               delprf = uri.attr('name');
               
               $.post('/php_files/uncontact.php',{'deleted':delprf},function (data) { /////////4 parents/////////
                    
                         uri.parent().parent().parent().parent().remove();
                    });
});


});
