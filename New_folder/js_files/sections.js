$(function () {

     var pic = $('#profile_pic');
     var picstuff = '<link rel="stylesheet" href="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />' +
     '<script src="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.js" type="text/javascript"></script>' +
     '<script type="text/javascript" src="/js_files/jquery_crop/scripts/jquery.imgareaselect.pack.js"></script>' +
     '<script src="/js_files/pictures.js" type="text/javascript"></script>' + 
     '<div id="contain_crop" style="background-color:white;display:none;">' +
     '<img class="crop_box" id="crop" src="" style="float:left;" /><p style="' +
    'text-align: center;font-size: 22px;color: rgb(119, 119, 119);">Please select your thumbnail' +
    '<br><button id="finish">Finish</button> <button>go back</button></p></div>' +
    '<a id="picture_upload_tool" >Upload a picture:</a>' +
    '<form  style="position:absolute; border: 0px auto 0px auto; z-index: 5px;" name="upload_pic" id="upload_form">' +
    '<input type="hidden" name="MAX_FILE_SIZE" value="5242880">' +
    '<input type="file" id="user_pic" name="user_pic" accept="image/gif|image/jpeg|image/png"/>' +
    '<button type="submit" id="upload_button">upload</button></form><div style="margin-top:40px;" id="display_pics">' +
    '</div>';
     $('#teeckles').hide();
     $('.edit_button').hide();
     $('#mystatsedit').hide(); 
     $('#editimow').hide();
     $('#editstats').hide();
     $('#edit_main').hide();
     $('#editmainbutt').hide();
     $('#imowedit').hide();

      function load_user() {
      
     var i = 0;
    
     
     
      $.getJSON("/php_files/userprofileinfo.php",function (oj) {
               
               $.each(oj,function (obj,data) {
                           
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
               });
               }
      
     $('#userinfo').livequery (function () {load_user();});

     $('#cancelimow').livequery(function () {
          $(this).click(function () {
          $('#imowedit').hide();
          });
     });

     $('#sendimow').livequery(function () {
          $(this).click(function () {
          var dat = $('#imowform').serialize();
          basic = $('#imowedit').html();
          $.post('/php_files/editimow.php',dat,function (data) {
               $('#imowedit').text(data).fadeOut(500,function () {
                         $(this).html(basic);
                         $(this).unbind("fadeOut");
                         load_user();
                    });       
                    });    
          });
          });
      
      
     $("#editstats").livequery("click",function() {
          $('#mystatsedit').show();
     });
     var post_data;
     $('#submit_edit_main').livequery("click",function () {
          selector = $('#edit_main');
          post_data = selector.serialize();
          $.post('/php_files/changedata.php',post_data,function (data) {
                    basic = selector.html();
                    selector.html(data);
                    selector.delay(2000).fadeOut(500, function () {
                         $(this).html(basic);
                         $(this).unbind("fadeOut");
                         load_user();
                    });       
          });
     });
     
     $("#editimow").livequery("click",function() {
            $('#imowedit').show();
        }); 
     $('#userinfo').livequery(function () {
                    $(this).hover(function () {
                    $(this).css({'background-color':'#F8F8F8'});
                    $('#editmainbutt').show();
               }, function () {
                    $(this).css({'background-color':'white'});
                    $('#editmainbutt').hide();
               },function() {
                         $(this).unbind('mouseover').unbind('mouseout');
                         });
               });
               
     $('#imowhead').livequery(function () {
           $(this).hover(function () {
               $('#editimow').css({display:'inline'});
           }, function () {
               $('#editimow').hide();
          },function () {
               $(this).unbind('mouseover').unbind('mouseout');
          });
          });
     
     $('#statshead').livequery(function () {
           $(this).hover(function () {
           $('#editstats').css({'display':'inline'});



          },function () {
           $('#editstats').hide();
          },function () {
               $(this).unbind('mouseover').unbind('mouseout');
          });
          });
           
     $('#editmainbutt').livequery("click",function () {
            $("#edit_main").show();
          });
          $("#close_edit_main").livequery("click",function () {
            $("#edit_main").hide();
          });

          
     $('#changestats').livequery(function () {
          $(this).click(function () {
          selector = $('#mystatsedit');
          cereal = selector.serialize();
          $.post('/php_files/changestats.php',cereal,function (data) {
          basic = selector.html();
               selector.html(data).delay(2000).fadeOut(500,function () {
               selector = $(this);
                         selector.html(basic);
                         selector.unbind("fadeOut");
                         load_user();
                    });
          });
     });
     });
     $('#closestats').livequery (function () {
          $(this).click(function () {
          $('#mystatsedit').hide();
          });
     });
            
               
        
     $('#profile_pic').livequery (function () {
          $(this).click(function () {
          
          $('#wrapper').html(picstuff);
          
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
});
