$(function () {
var selectr;
var img = new Image();
img.src = '/images/Profile-Icons.png';
var loop;
var topid;
var show;
var upd;
var init = $('#wrapper').html();

function load_group() {
     $('#delete').livequery(function () {
          $(this).click(function () {
               if (admin == curruser) {
                    $.post('/php_files/del_group.php',{'group':page},function (data) {
                         if (data != "fail") {
                              window.location = data;
                         }
                         
                    });
               }
          });
     });
     
     $.post('/php_files/get_pic.php',function () {
     
     });
     
     $('.navy').click(function () {
          $('#topicform').hide();
     });
     if (member != 0) {
          $('.join_butt').hide();     
     }
     if (member == 0 || curruser == admin) {
          
          $('#leave').hide();
     }
     if (admin == curruser) {
     $('#delete').livequery(function () {
     $(this).css({
          'display':'block'
     });

     });
}
     var i = 0;
    
     
     
      $.post("/php_files/groupinfo.php",{'group':page},function (oj) {
               
               $.each(oj,function (obj,data) {
                           
               $('.groupinfo').each(function () {
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
               },'json');
               }
               load_group();
     $('#desc_head').livequery(function () {
          $(this).hover(function () {
                    $('#edit_descript').show();
               }, function () {
                    $('#edit_descript').hide();
               },function() {
                         $(this).unbind('mouseover').unbind('mouseout');
                         });    
     });
     
$('#send_message').attr('disabled');
var disk;
var dat;
var picstuff = '<link rel="stylesheet" href="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />' +
     '<script src="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.js" type="text/javascript"></script>' +
     '<script type="text/javascript" src="/js_files/jquery_crop/scripts/jquery.imgareaselect.pack.js"></script>' +
     '<script src="/js_files/picturegroup.js" type="text/javascript"></script>' + 
     '<div id="contain_crop" style="background-color:white;display:none;">' +
     '<img class="crop_box" id="crop" src="" style="float:left;" /><p style="' +
    'text-align: center;font-size: 22px;color: rgb(119, 119, 119);">Please select your thumbnail' +
    '<br><button id="finish">Finish</button> <button>go back</button></p></div>' +
    '<a id="picture_upload_tool" >Upload a picture:</a>' +
    '<form  style="position:absolute; border: 0px auto 0px auto; z-index: 5px;" name="upload_pic" id="upload_form">' +
    '<input type="hidden" name="MAX_FILE_SIZE" value="5242880">' +
    '<input type="file" id="user_pic" name="user_pic" accept="image/gif|image/jpeg|image/png"/>' +
    '<input name="group" type="hidden" value="' + page +'">' +
    '<button type="submit" id="upload_button">upload</button></form><div style="margin-top:40px;" id="display_pics">' +
    '</div>';


     function update_post () {

          if ($('#topic_post').length === 0) {
               clearInterval(upd);
          }   
          // show topic id //
          var uri = $('#display_disc');
          uri = uri.find('.mess_last');
          if (uri.length !== 0) {
          uri = uri.last();
          uri = uri.attr('id');
          $.post('/php_files/showdisc.php',{'group':page,'topic':show,'later':uri},function (data) {
          disk = '';
          loop = true;
          
          $.each(data,function (inc,top) {
          if (loop == true) {
          loop = false;
               if ($('#display_disc').text() == 'no discussions on this topic') {
                    $('#display_disc').empty();
               }
               disk += "<div id=\"" + top.postid  + "\" class=\"mess_last\" style=\"min-width: 700px; \
                    overflow:auto;padding-left:10px;padding: 5px;\"><a href=\"profile\"><img src=\"";
                  if (top.thumbnail != null) {
                   disk += top.thumbnail;
                   }
                   else {
                   disk += img.src;
                   }
                   disk += "\" class=\"mess_pic\" style=\"height: 40px;width: 40px;float:left;\"> \
               </a><table class=\"show_comm\" name=\"p\" style=\"float:left; width:700px;text-align:left; \
               background-color:rgba(178, 214, 242,0.4);height: 50px;border-radius: 5px;cellpadding: 5px;\"> \
               <tbody><tr><td style=\"max-width: 150px;color: #2a9bc7;padding: 5px; \
               \">" + top.post_body + "</td><td class=\"pip\" style=\"text-align: center;\" \
               >last reply</td> \
               <td class=\"pip\" style=\"text-align: center;\">replies</td><td class=\"pip\" style=\" \
               text-align: center;\">" + top.date + "</td></tr></tbody></table></div>";
          }
          });
       
          $('#display_disc').append(disk);
     },'json');  

     }     
     }
     
     
     
$('#disc').livequery(function () {
          $(this).click(function () {
          if ((privacy == 'public' || member == 1) || curruser == admin) {
          
          disk = "<div id=\"display_box\"> \
                   DISCUSSION \
                   <button type=\"button\" id=\"createt\">\
                   create a topic</button> \
                  <div id=\"display_disc\"></div> \
                  </div>";
          $('#wrapper').html(disk);
          $.post('/php_files/showtopics.php',{'page':page},function (data) {
          disk = '';
               $.each(data,function (top,sec) {
               if (loop != sec.topicid) {
                    loop = sec.topicid;
                    disk += "<div id=\"" + sec.topicid  + "\" class=\"mess_enter\" style=\"min-width: 700px; \
                    overflow:auto;padding-left:10px;padding: 5px;\"><a href=\"profile\"><img src=\"";
                  if (sec.thumbnail != null) {
                   disk += sec.thumbnail;
                   }
                   else {
                   disk += img.src;
                   }
                   disk += "\" class=\"mess_pic\" style=\"height: 40px;width: 40px;float:left;\"> \
               </a><table class=\"show_content\" name=\"p\" style=\"float:left; width:700px;text-align:left; \
               background-color:rgba(178, 214, 242,0.4);height: 50px;border-radius: 5px;cellpadding: 5px;\"> \
               <tbody><tr><td style=\"max-width: 150px;color: #2a9bc7;padding: 5px; \
               \">" + sec.subject + "</td><td class=\"pip\" style=\"text-align: center;\" \
               >last reply</td> \
               <td class=\"pip\" style=\"text-align: center;\">replies</td><td class=\"pip\" style=\" \
               text-align: center;\">" + sec.date + "</td></tr></tbody></table></div>";
               }
               });
               $('#display_disc').append(disk);
          },'json');
     }
     else {
          alert(curruser + " " + admin);
          $('#wrapper').html('you must be a group member to see this group\'s discussions');
     }
     });     
     });
     $('.navy').click(function () {
          $(this).css({
               "background-color":"#B2D6F2"
          });
          $('.navy').not(this).css({
               "background-color":"transparent"
          });
     });
     $('#createt').livequery("click",function () {
          $('#topicform').show();
     });
     $('#topicz').livequery("click",function () {
         dat =  $('#topicreation').serialize();
          $.post('/php_files/createtopic.php',dat,function (data) {
          dat = $('#topicform').html();
               $('#replace').html(data);
               $('#topicform').delay(2000).fadeOut(500, function () {
                         $(this).html(date);
                         $(this).unbind("fadeOut");
                    });   
          });
     });

     $('#pic').click(function () {
          if (privacy == 'public' || member == 1 || curruser == admin) {
               $('#wrapper').html(picstuff);
          }
          else {
               $('#wrapper').html('to view this groups pictures you must be a member');
          }

          $('.navy').click(function () {
               if ($(this).attr('id') != 'pic') {
                    $( "[id*='fancybox']" ).remove();
               }
          });
     });
     $('#main').click(function () {
          $('#wrapper').html(init);
          load_group();
     });
     $('#mem').click(function () {
          $.post('/php_files/get_members.php',{'group':page},function (data) {
               html = '';
               loop = false;
               $.each(data,function (inc,mem) {
               loop = true;
                    html +=  " " + mem.memid + ":" + mem.member + " ";
               });
               if (loop != false) {
                    $("#wrapper").html(html);
               }
               else {
                    $('#wrapper').html('no members');
               }
          },'json');
     });
     
     $('.join_butt').click(function () {
          if (member != 1) {
          $.post('/php_files/insert_member.php',{"page":page},function (data) {
               alert(data);
          });
          }
     });
     $('.show_content').livequery("click",function () {
    
     selectr = $('#display_disc');
     selectr.empty();
     loop = 0;
          show = $(this).parent().attr('id');
          $.post('/php_files/showdisc.php',{'group':page,'topic':show},function (data) {
          
          disk = '';
          
          $.each(data,function (inc,top) {
               loop = 1;
               disk += "<div id=\"" + top.postid  + "\" class=\"mess_last\" style=\"min-width: 700px; \
                    overflow:auto;padding-left:10px;padding: 5px;\"><a href=\"profile\"><img src=\"";
                  if (top.thumbnail != null) {
                   disk += top.thumbnail;
                   }
                   else {
                   disk += img.src;
                   }
                   disk += "\" class=\"mess_pic\" style=\"height: 40px;width: 40px;float:left;\"> \
               </a><table class=\"show_comm\" name=\"p\" style=\"float:left; width:700px;text-align:left; \
               background-color:rgba(178, 214, 242,0.4);height: 50px;border-radius: 5px;cellpadding: 5px;\"> \
               <tbody><tr><td style=\"max-width: 150px;color: #2a9bc7;padding: 5px; \
               \"></td><td class=\"pip\" style=\"text-align: center;\" \
               >" + top.post_body + "</td> \
               <td class=\"pip\" style=\"text-align: center;\">replies</td><td class=\"pip\" style=\" \
               text-align: center;\">" + top.date + "</td></tr></tbody></table></div>";
          });
          if (loop == 1) {
               selectr.html(disk);
          }
          else {
               selectr.html('no discussions on this topic');
          }
     upd = window.setInterval(function () {update_post()},2000);
     },'json');

     $('#wrapper').append('<p><textarea id="topic_post"></textarea><button id="post">post</button></p>');
     
     
});
$('#leave').livequery(function () {
     
     $(this).click(function () {
     if (curruser != admin) {
          $.post('/php_files/leave_group.php',{'group':page},function (data) {
               if (data != "false") {
                    document.location.reload(true);
               }
          });
          }
     });
});

if (curruser == admin) {
$('#edit_descript').livequery(function () {
     $(this).click(function () {
          $('#descedit').show();
     });
});
$('#cancelimow').livequery('click',function () {
          $('#descedit').hide();
});
$('#sendimow').livequery('click',function () {
     dat = $('#descform').serialize();
     $.post('/php_files/edit_descript.php',dat,function (data) {
          dat = $('#descedit').html();
               $('#descedit').html(data);
               $('#descedit').delay(2000).fadeOut(500, function () {
                         $(this).html(data);
                         $(this).unbind("fadeOut");
                    });  
                    load_group(); 
          });
});
}
     $('#post').livequery("click",function () {
          
               var post = $('#topic_post').val();
               $('#topic_post').val('');
               $.post('/php_files/createpost.php',{'post':post,'topic':show,'page':page},function (data) {
               });
         
     });
     
});
