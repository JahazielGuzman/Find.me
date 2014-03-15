$(function () {
     
     var path;
     var stop = false;
     var ej = "Upload a picture";
     var crop;
     var cc = $('#contain_crop');
     var pb;
     var x,y,width,height;
     var $thisn;
     var $fin = $('#finish');
     var href;
     var defordel;
     var cntmp;
     var bill = 0;

     
     $('#contain_crop').hide();
     $('#upload_form').hide();
     $('#picture_upload_tool').click(function () {
          $('#upload_form').toggle();
     });
     var img = new Image();
     var str = '';
     
     if (typeof page != 'undefined') {
          $.post('/php_files/show_pics.php',{'visited':page},function (data) {
          str = ''
          $.each(data,function (pic,showpic) {
               // showpic.date_added
               // showpic.default_pic
               str += '<a class="fancyboxed" href="' + showpic.piclocation + '"rel="pics"><img name="'+ showpic.defaultpic +'" class="shown" src="' + 
               showpic.thumbnail + '" &#47;></a> ';
               $('#display_pics').append(str);
               $('.fancyboxed').fancybox({
                    autoScale: false,
		          overlayColor: 'black',
		          overlayOpacity: .7,
		          transitionIn: 'none',
		          transitionOut: 'none',
		          titlePosition: 'outside' ,		
		          cyclic: true,
		          type: "image",
		          titleShow: true,
		          titlePosition: 'inside',
		          onComplete: function(){
       $('#fancybox-bg-s').html('<p style="background-color:white;"><textarea id="insert_comment"></textarea><button type="button" id="sendcom">post</button><p id="showcomments"></p></p>');
       var src = $('#fancybox-img').attr('src');
       $.post('/php_files/getcomments.php',{'path':src,'visited':page},function (data) {
       str = '';
            $.each(data,function (inc,comm) {
                 str += '<table id="pic_' + comm.numcomm + '" style="overflow: auto;"><tbody><tr><td><img style="' +
                    'height: 25px;width: 25px;" src="' + comm.thumbnail +  '"></td><td>' +
                    '<table style="display: inline-table;font-size: 12px;"><tbody><tr>' +
                    '<td>' + comm.fromuser + '</td></tr><tr><td>' + comm.usercomment +
                    '</td></tr></tbody></table></td></tr></tbody></table>';     
            });
            $('#showcomments').html(str);
       },'json');
       $('#sendcom').click(function () {
       
       var com = $('#insert_comment').val();
       if (com != '') {
            $.post('/php_files/picomment.php',{'comment':com,'path':src,'visited':page},function (data) {
                 $('#insert_comment').val('');

                 
            }); 
            $.post('/php_files/getcomments.php',{'path':src,'visited':curruser,'later':1},function (data) {
               str = '';
               $.each(data,function (inc,comm) {
                 str += '<table id="pic_' + comm.numcomm + '" style="overflow: auto;"><tbody><tr><td><img style="' +
                    'height: 25px;width: 25px;" src="' + comm.thumbnail +  '"></td><td>' +
                    '<table style="display: inline-table;font-size: 12px;"><tbody><tr>' +
                    '<td>' + comm.fromuser + '</td></tr><tr><td>' + comm.usercomment +
                    '</td></tr></tbody></table></td></tr></tbody></table>';     
            });
            $('#showcomments').append(str);
       },'json');
       }
       
       });
    },
	          });
	          $('.pic_button').hide();
               });
               
     },'json');
     
     }
     else {
     if (stop == false) {
     stop = true;
     $.getJSON('/php_files/show_pics.php',function (data) {
          $.each(data,function (pic,showpic) {
               img.src = showpic.piclocation;
               // showpic.date_added
               // showpic.default_pic
               str = '<div class="picture_box" style="display: inline-block;"><button type="button" class="pic_button"' +
               'style="position: absolute;float:left;margin-left: 133px;">profile</button>' + 
               '<button type="button" class="pic_button" style="position: absolute;float: left;margin-left: 180px;">' +
               'delete</button>' + '<a class="fancyboxed" href="' + img.src + '"rel="pics" name="' + 
               showpic.defaultpic + 
               '" type="image/jpg"><img class="shown" src="' + showpic.thumbnail + '" &#47;></a></div>';
               $('#display_pics').append(str);
               $('.fancyboxed').fancybox({
                    autoScale: false,
		          overlayColor: 'black',
		          overlayOpacity: .7,
		          transitionIn: 'none',
		          transitionOut: 'none',
		          titlePosition: 'outside' ,		
		          cyclic: true,
		          type: "image",
		          titleShow: true,
		          titlePosition: 'inside',
		          onComplete: function(){
       $('#fancybox-bg-s').html('<p style="background-color:white;"><textarea id="insert_comment"></textarea><button type="button" id="sendcom">post</button> \
       <p style="background-color:white" id="showcomments"></p></p>');
       var src = $('#fancybox-img').attr('src');
       $.post('/php_files/getcomments.php',{'path':src,'visited':curruser},function (data) {
       str = '';
       
            $.each(data,function (inc,comm) {
                 str += '<table id="pic_' + comm.numcomm + '" style="overflow: auto;"><tbody><tr><td><img style="' +
                    'height: 25px;width: 25px;" src="' + comm.thumbnail +  '"></td><td>' +
                    '<table style="display: inline-table;font-size: 12px;"><tbody><tr>' +
                    '<td>' + comm.fromuser + '</td></tr><tr><td>' + comm.usercomment +
                    '</td></tr></tbody></table></td></tr></tbody></table>';     
            });
            $('#showcomments').html(str);
       },'json');
       $('#sendcom').click(function () {
       
       var com = $('#insert_comment').val();
       if (com != '') {
            $.post('/php_files/picomment.php',{'comment':com,'path':src,'visited':curruser},function (data) {
                 $('#insert_comment').val('');
                 
                 $.post('/php_files/getcomments.php',{'path':src,'visited':curruser,'later':1},function (data) {
               str = '';
               $.each(data,function (inc,comm) {
                 str += '<table id="pic_' + comm.numcomm + '" style="overflow: auto;"><tbody><tr><td><img style="' +
                    'height: 25px;width: 25px;" src="' + comm.thumbnail +  '"></td><td>' +
                    '<table style="display: inline-table;font-size: 12px;"><tbody><tr>' +
                    '<td>' + comm.fromuser + '</td></tr><tr><td>' + comm.usercomment +
                    '</td></tr></tbody></table></td></tr></tbody></table>';     
            });
            $('#showcomments').append(str);
       },'json');
            });
            
            
       }
       
       });
    },
	          });
	          $('.pic_button').hide();
               });
               $('.picture_box').livequery(function () {
               $thisn = $(this);
           $thisn.hover(function () {
           $thisn = $(this);
           $thisn.find('.pic_button').show();
          },function () {
           $thisn.find('.pic_button').hide();
          },function () {
               $thisn.unbind('mouseover').unbind('mouseout');
          });
          });

          $('.pic_button').livequery(function () {
               $thisn = $(this);
               $thisn.click(function () {
               $thisn = $(this);
               href = $thisn.parent().find('.fancyboxed').attr("href");
               defordel = $thisn.text();
               $.post('/php_files/change_thumb.php',{'href':href,'pic_button':defordel},function (data) {
               $( "[id*='fancybox']" ).remove(); 
                         $('#wrapper').html('<link rel="stylesheet" href="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />' +
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
    '</div>');
     
               });
               });
          });
               
               
     }).error(function () {
     $('#display_pics').html('dude');
     });
     }
     }

     
                
     $("#upload_button").livequery(function () {
     $(this).click(function () {
           
            var iframe = $('<iframe name="postiframe" id="postiframe" style="display: none"' + '&#47;' + '>');
            $("body").append(iframe);

            var form = $('#upload_form');
            form.attr("action", "/pics/process_pics.php");
            form.attr("method", "post");
            form.attr("enctype", "multipart/form-data");
            form.attr("encoding", "multipart/form-data");
            form.attr("target", "postiframe");
            form.attr("file", $('#user_pic').val());
            form.submit();

            $("#postiframe").load(function () {
                iframeContents = $("#postiframe")[0].contentWindow.document.body.innerHTML;

                crop = $('#crop');
                cntmp = cc.html();
                if (iframeContents.search('pics') != -1) {
                img.src = iframeContents;
                crop.attr('src',iframeContents);
                
                iframe.remove();
                cc.show();
                
                crop = crop.imgAreaSelect({
                instance: true,
                onSelectEnd: function (img, selection) {
                $('#picture_upload_tool').text(img.src + " " + img.width + " " + img.height);
                if (typeof(selection.x1) != 'undefined') {
                     x = selection.x1;
                     y = selection.y1;
                     width = selection.width;
                     height = selection.height;
                     bill = 1;
                     }
                     else {
                           x = 0;
                           y = 0;
                           width = img.width;
                           height = img.height;
                     }
                     }
                });

               
        
        crop.update();
        crop.setOptions({
        handles: true,
        aspectRatio: '1:1',
        show: true,
        minHeight: '100',
        minWidth: '100',
        resizable: true,
        persistent: false
    });
    
    }
    });

   
   

     $fin.livequery(function () {
                $fin.click(function () {
                     path = $fin.parents();
                     path = path.find('#crop');
                     path = path.attr('src');
                     $.post('/pics/thumbnail.php',{'x':x,'y':y,'width':width,'height':height,'path': path,'bill':bill},
                     function (data) {
                          $fin.html(data);
                          crop.cancelSelection();
                          $( "[id*='fancybox']" ).remove();  
                          $('#wrapper').html('<link rel="stylesheet" href="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" />'+
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
    '</div>');
                          
                     });
                });
                });
                
                });
                });
                
});
