
$(function () {

     var profp = $('#wrapper').html();
    
     var basic; 
     var selector;
     var htmn;
     var loop;
     var uri;
     var selector;
     $('#teeckles > img').hide();
     var picpage = '<script src="/js_files/pictures.js" type="text/javascript"></script><div style="margin-top:40px;" id="display_pics"></div>';
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

     var d;
     var n;
     var this_year;
     var i = 0;
     var src;
     
        function pp () {
           $.post("/php_files/userprofileinfo.php",visited,function (data) {
               $.each(data,function (obj,data) {
                           
               $('.user_info').each(function () {
               uri = $(this);
               if (data[i] == '') {
                         uri.text('...');
                    }                         
                    
                    else {
                         uri.html(data[i]);
                    }
                    i ++;
               });
               });
               },'json').error(function () {
                   
               });

               var src;
     
     var pic_space = $('#profile_pic');
     pic_space.livequery ( function () {
     $.post('/php_files/get_pic.php',visited,function (data) {
          if (data == '' || data == null) {
               src = "/images/Profile-Icons.png";
               pic_space.attr("src",src);
          }
          else {
               
                    
                    $('#profile_pic').attr("src",data);
                                   
          }                         
          });
     });
               }
               
         var today = new Date();
         today = today.getFullYear();
         this_year = today - 18;
         
		$( "#datepick" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "1912:" + this_year
		});
		
		$('#username').text(page);
		$("info_box2").hide();
          visited = {'visited':page};
          var src;
		if (curruser != page) {

		 pp();
     
     
     
     
	}
	
	
       function update_mess () {
          loop = true;
          uri = $('#display_mess');
          selector = $('[name="visited"]');
          selector = selector.val();
          uri = uri.find('div');
          uri = uri.last();
          uri = uri.attr('id');
          
          $.post('/php_files/org_mess.php',{'convo':selector,'newer':uri},function (data) {
               
               $.each(data,function (user,conv) {
               if (loop == true) {
               loop = false;
               if (conv.messid > uri) {
                htmn = '<div id="' + conv.messid + '" style="min-width: 700px;padding: 5px;overflow:auto;">'
                  + '<a href="/profile/' + conv.fromuser + '.php">' + 
                  '<img src="' 
                  if (conv.thumbnail != null) {
                   html += conv.thumbnail;
                   }
                   else {
                   html += img.src;
                   }
                   htmn += '" class="mess_pic" style="height: 40px;width: 40px;float:left;" />' 
                  + 
               '</a><table name="' + conv.fromuser + '" class="mess_enter_body" style="display: inline-table;float:left;';
               if (conv.fromuser != curruser) {
                    htmn += 'width:700px;text-align:left;background-color:rgba(178, 214, 242,0.4);';
                    
               }
               else {
                    htmn += 'width:700px;text-align:left;background-color:rgba(228, 228, 228, 0.4);';
               }
               htmn +=
    'height: 50px;border-radius: 5px;"><th>' + conv.fromuser + '</th><tr>' +
    '<td style="width: 500px;">' + conv.message + '</td><td style="text-align:right;">' 
    + conv.datesent + '</td></tr></table></a></div>';
               $('#display_mess').append(htmn);
               }
               
               }
               });
               
              
                    },"json").error(function (data) {
                         
                    });
          
          }
     function num_mess () {
               $.post('/php_files/num_mess.php',function (data) {

                              if (data > 0) {
                              
                              var html = "( <span style='color:#2774b8;'>" + data + "</span> )";
                              $('#nums').html(html);
                              }
                              else {
                              $('#nums').html('')
                              }

                    });     
                    }

     function num_teek () {
               $.post('/php_files/num_teek.php',function (data) {

                              if (data > 0) {
                              $('#teeckles').show();
                              var html = "( <span style='color:#2774b8;'>" + data + "</span> )";
                              $('#teeks').html(html);
                              }
                              else {
                              $('#teeks').html('')
                              }

                    });     
                    }

     function num_req () {
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

     window.setInterval(function () {num_mess()},2000);
     window.setInterval(function () {num_teek()},2000);
     window.setInterval(function () {num_req()},2000);
     
                    
     selector = $("#messbox");
     selector.hide();
     $('#addbox').hide();
     $('#messme').livequery("click",function () {
          selector.show();
     });
     $('#profile_pic').livequery("click",function () {
          $('#wrapper').html(picpage);
     });
     $('#cancelmess').livequery("click",function () {
               $('.messbox').hide();
     });
     
     $('#sendmess').livequery("click",function () {
          basic = $('#send_message').serialize();
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
          basic += "&date=" + encodeURIComponent(n);
          $.post('/php_files/message_process.php',basic,function (data) {
               selector = $('#messbox');
               basic = selector.html();
               $('#messbody').html("<tr style='color:#225f99;'><td>" + data + "</td></tr>");
               selector.delay(2000).fadeOut(500, function () {
                    $(this).html(basic);
                    $(this).unbind('fadeOut');
               });     
          });     
     });

     $('#addme').livequery("click",function () {
          basic = $('#add_contact').serialize();
          $.post('/php_files/add_contact.php',basic,function (data) {
          
               selector = $('#addbox');
               selector.show();
               basic = selector.html();
               $('#addbody').html('<tr style="color:#255f99;"><td>' + data + "</td></tr>");
               selector.delay(2000).fadeOut(500, function () {
                    $(this).html(basic);
                    $(this).unbind('fadeOut');
               });     
          });
     });

     $('#teeckleme').livequery("click",function () {
          $.post('/php_files/send_teek.php',visited,function (data) {
               selector = $('#messbox');
               basic = selector.html();
               selector.show();
               $('#messbody').html("<tr style='color:#225f99;'><td>" + data + "</td></tr>");
               selector.delay(2000).fadeOut(500, function () {
                    $(this).html(basic);
                    $(this).unbind('fadeOut');
               });     
          });     
     });
     
     $('#profile').livequery ("click",function () {
     selector = $('#contacts').find('img');
     selector.attr({src:img5.src});
     selector = $('#messages').find('img');
     selector.attr({src:img3.src});
     selector = $('#profile').find('img');
     selector.attr({src:img2.src});
          $('#wrapper').html(profp);
          
          $('#change').attr({href:'/cssfiles/ProfilePage.css'});
          $('#profile').css({'color':'#6666CC'});
          $(".user_nav").not('[id="profile"]').css({'color':'#A8A8A8'}); 
          $('#mystatsedit').hide();
          $('.messbox').hide();
          pp();
     
     });
     
      $('#messages').livequery ("click",function () {
      selector = $('#messages').find('img');
          selector.attr({src:img4.src});
          
          selector = $('#profile').find('img');
          selector.attr({src:img.src});
          selector = $('#contacts').find('img');
          selector.attr({src:img5.src});
          $('#wrapper').load('/messages.html #wrapper', function () {
          $('#change').attr({href:'/cssfiles/messagesPage.css'});
          $('#messages').css({'color':'#6666CC'});
          $(".user_nav").not('[id="messages"]').css({'color':'#A8A8A8'});$.post('/php_files/show_messages.php',function (data) {
          selector = $('#display_mess');
          selector.empty();
               $.each(data,function(user,content) {
               
               if (curruser == content.fromuser) {
                    otherp = content.touser;
               }
               else {
                    otherp = content.fromuser;
               }
               html = '<div class="mess_enter" style="min-width: 700px;overflow:auto;padding-left:10px;padding: 5px;">'
                  + '<a href="/profile/' + otherp + '.php">' + 
                  '<img src="';
                  if (content.thumbnail != null) {
                   html += content.thumbnail;
                   }
                   else {
                   html += img.src;
                   }
                   html += '" class="mess_pic" style="height: 40px;width: 40px;float:left;" />' 
                  + 
               '</a><table class="show_content" name="' + otherp + '" class="mess_enter_body" style="float:left;' + 
               'width:700px;text-align:left;background-color:rgba(178, 214, 242,0.4);'  +
    'height: 50px;border-radius: 5px;"><th>' + otherp + '</th><tr>' + 
    '<td style="width: 500px;">';
    if (content.message.length > 61) {
         html += content.message.substr(0,61)
         + '...';
    }
    else {
         html += content.message.substr(0,61);
    } 
    html += '</td><td style="text-align:right;">' 
    + content.datesent + '</td></tr></table></a></div>';
               
               selector.append(html);
               
               
               });
          },"json").error(function (data) {
          $(this).html('hi');
          
          });
          });
          
     });
     
     
     $('.show_content').livequery("click",function (event) {
          selector = $('#display_mess');
          selector.css({
          'height': '400px',
     'overflow': 'auto',
     'width': '800px'
          });
          var id = $(this).attr('name');
          $.post('/php_files/org_mess.php',{'convo':id},function (data) {
          
           $('#display_mess').empty();
               $.each(data,function (user,conv) {
                html = '<div id="' + conv.messid + '" style="min-width: 700px;padding: 5px;overflow:auto;">'
                  + '<a href="/profile/' + conv.fromuser + '.php">' + 
                  '<img src="';
                  if (conv.thumbnail != null) {
                   html += conv.thumbnail;
                   }
                   else {
                   html += img.src;
                   } 
                   html += '" class="mess_pic" style="height: 40px;float:left;width: 40px;" />' 
                  + 
               '</a><table name="' + conv.fromuser + '" class="mess_enter_body" style="float:left;';
               if (conv.fromuser != curruser) {
                    html += 'width:700px;text-align:left;background-color:rgba(178, 214, 242,0.4);';
                    
               }
               else {
                    html += 'width:700px;text-align:left;background-color:rgba(228, 228, 228, 0.4);';
               }
               html +=
    'height: 50px;border-radius: 5px;"><th>' + conv.fromuser + '</th><tr>' +
    '<td style="width: 500px;">' + conv.message + '</td><td style="text-align:right;">' 
    + conv.datesent + '</td></tr></table></a></div>';
                    $('#display_mess').append(html);
               });
               $('#display_mess').parent().append('<form id="mess_ta"><textarea id="mess_tx" name="message" cols="50" rows="6" maxlength="2000"></textarea>' +
               '<input type="hidden" name="visited" value="' + id +'"/><button type="button" id="mess_i">send</button></form>');
               upd = window.setInterval(function () {update_mess()},2000);
          },"json").error(function () {
               selector.text("error");
          });
          event.stopPropagation();  
     });


     $('#mess_i').livequery(function () {
          
          $('#mess_i').click(function (event) {
          if ($('#mess_tx').val() != '') {
          uri = $('#mess_ta').serialize();
          
               $.post('/php_files/message_process.php',uri,function () {
               $('#mess_tx').val('');
                           
               });
               }
               event.stopPropagation();
          });
          });
     $('#message').livequery(function () {
          if ($(this).attr('src') != img4.src && typeof upd != 'undefined') {
               clearInterval(upd);
          }     
          });
     
      $('#contacts').livequery ("click",function () {
      selector = $('#messages').find('img');
          selector.attr({src:img3.src});

          
          selector = $('#profile').find('img');
          selector.attr({src:img.src});
          selector = $('#contacts').find('img');
          selector.attr({src:img6.src});     
          $('#wrapper').load('/Contacts.html #wrapper', function () {
          $('#change').attr({href:'/cssfiles/messagesPage.css'});
          $('#contacts').css({'color':'#6666CC'});
          $(".user_nav").not('[id="contacts"]').css({'color':'#A8A8A8'});
          });
     });  
});
