$(function () {
var than;
var than1;
var than2;
var html;
var groups = '<br /><p class="criteria"><span id="sizel"> less than 100 members </span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>' +
          '<input name="size" id="sizzle" type="hidden" value="less" />' +
          '</p><table style="position: absolute;display: none;z-index:10;" class="input_box">' +
        '<tbody><tr><td><a class="size" id="less"> less than 100 members</a></td></tr>' +
        '<tr><td><a class="size" id="hundreds"> hundreds of members</a></td></tr>' +
        '<tr><td><a class="size" id="thousands"> thousands of members </a></td></tr>' +
        '</tbody></table><br>' +
        '<p class="criteria"><span id="catspan"> academic</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>' +
        '<input name="cat" type="hidden" value="academic" /></p>' +
        '<table name="employment" style="position: absolute;display: none;' +
          '" class="input_box">' +
        '<tbody><tr><td><a class="categ" value="academic">academic</a></td></tr>' +
        '<tr><td><a  class="categ" value="social awareness">social awareness</a></td></tr>' +
        '<tr><td><a class="categ"  value="cultural">cultural</a></td></tr>' +
        '<tr><td><a class="categ"  value="religious">religious</a></td></tr>' +
        '<tr><td><a class="categ"  value="food">food</a></td></tr>' +
        '<tr><td><a class="categ"  value="comedy">comedy</a></td></tr>' +
        '</tbody></table><br>' +
        '<p class="criteria"><span id="have">have a photo</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>' +
        '<input name="photo" type="hidden" id="picval" value="have a photo" /></p>' +
        '<table name="feet" style="position: absolute;display: none;" class="input_box">' +
        '<tbody><tr><td><a class="picornot">have a photo</a></td></tr>' +
        '<tr><td><a class="picornot">doesn\'t matter</a></td></tr>' +
        '</tbody></table>' +
        '<p class="criteria"><span id="mill">2</span> miles away from <span id="fromz">me</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>' +
        '<input name="zip" type="hidden" value=' + zippy + ' /></p>' +
        '<table style="position: absolute;display: none;" class="input_box">' +
        '<tbody><tr><td><a><input type="text" style="width: 50px;' +
        '" value="' + zippy +'" /></a></td></tr>' +
        '<tr><td><a><select name="dist" id="milesaway">' +
        '<option value="2" name="2" class="distance">2</option>' +
        '<option value="5" name="5" class="distance">5</option>' +
        '<option value="15" name="15" class="distance">15</option>' +
        '<option value="50" name="50" class="distance">50</option>' +
        '<option value="250" name="250" class="distance">250</option>' +
        '</select></a></td></tr></tbody></table><br>';
     $('#age1').livequery('focusout',function () {
          than1 = $('#age1').val();
          $('#start').text(than1);
     });
     $('#age2').livequery('focusout',function () {
          than2 = $('#age2').val();
          $('#end').text(than2);
     });
     
     $('#group').livequery('click',function () {
          $('#type').text($(this).text());
          $('#search_type').html(groups);
          $('.input_box').hide();
     });
$(".dis").attr('disabled','disabled');

     $('.criteria').livequery(function () {
     $(this).toggle(function () {
     $('.input_box').hide();
     $(this).next('table').show();
     },function () {
          $(this).next().hide();
     });
     });

     $('.looking').livequery('click',function () {
      than = $(this).text();
          $('#lookin').text(than);
          $('#pref').val(than);
          $('.input_box').hide();
     });
      $('.relstat').livequery('click',function () {
      than = $(this).text();
          $('#catspan').text(than);
          $('status').val(than);
          $('.input_box').hide();
     });
     $('.size').livequery('click',function () {
      than = $(this).text();
          $('#sizel').text(than);
          $('#sizzle').val($(this).attr('id'));
          $('.input_box').hide();
     });
      $('.categ').livequery('click',function () {
      than = $(this).text();
          $('#catspan').text(than);
          $('[name="cat"]').val(than);
          $('.input_box').hide();
     });
     /////// user search /////
     $('#searchp').click(function () {
     if ($('#type').text() == 'groups') {
          var dat = $('#search_matches').serialize();
          $.post('/php_files/search_groups.php',dat,function (data) {
          alert(data);
               
               html = "";
               var i = 0;
               var pages;
               $.each(data,function (inc,user) {
                    i ++;
               });
               if (i <= 7) {
                    $.each(data,function (inc,user) {
               html += '<div style="background-color:white;overflow: auto;width:630px;border: 2px solid #2774b8;padding: 10px;"><div style="overflow: auto;">' +
'<a href="https://teeckle.me/groups/' + user.groupid + '.php"><img style="width: 80px;height: 80px;background-color: black;float:' +
'left;border-radius: 15px;" src="' + user.thumbnail + '"></a><table style="float: left;' +
'display: inline;margin-left: 10px;font-size:14px;"><tbody><tr><td style="font-size: 22px;padding: 0px;">' +
user.groupname + '</td></tr><tr><td>' + user.num + '/' + user.privacy + '/' + user.category + '/</td></tr><tr><td>' + user.city + ',' + user.state + '</td></tr>' +
'<tr><td></td></tr></tbody></table></div>' +
'<p style="display: block;border-top: 1px solid grey;">';
if (user.descript!= '') { 
     html += user.descript;
}
else {
     html += '...';
} 
html += '</p></div>';

               
               });
               }
               else {
                    pages = (i/7);
               }
               $('#matches').html(html);
          },'json').error(function (data) {
                    alert(data + " ");
          });
     
     }
     ////////// groups search /////////////////
     else {
          var dat = $('#search_matches').serialize();
          $.post('/php_files/matches.php',dat,function (data) {
               html = "";
               var i = 0;
               var pages;
               $.each(data,function (inc,user) {
                    i ++;
               });
               if (i <= 7) {
                    $.each(data,function (inc,user) {
               html += '<div style="background-color:white;overflow: auto;width:630px;border: 2px solid #2774b8;padding: 10px;"><div style="overflow: auto;">' +
'<a href="https://teeckle.me/profile/' + user.usern + '.php"><img style="width: 80px;height: 80px;background-color: black;float:' +
'left;border-radius: 15px;" src="' + user.thumbnail + '"></a><table style="float: left;' +
'display: inline;margin-left: 10px;font-size:14px;"><tbody><tr><td style="font-size: 22px;padding: 0px;">' +
user.usern + '</td></tr><tr><td>' + user.dob + '/' + user.gender + '/' + user.lookingfor + '/' + 
user.relstatus + '</td></tr><tr><td>' + user.city + ',' + user.state + '</td></tr>' +
'<tr><td>' + user.opento + '</td></tr></tbody></table></div>' +
'<p style="display: block;border-top: 1px solid grey;">';
if (user.imow != '') { 
     html += user.imow;
}
else {
     html += '...';
} 
html += '</p></div>';

               
               });
               }
               else {
                    pages = (i/7);
               }
               $('#matches').html(html);
          },'json');
     }
     });
     
     $('#milesaway').on('change',function () {
          var mill = $(this).val();
          $('#mill').text(mill);
          $('.input_box').hide();
     });
     $('.picornot').livequery('click',function () {
          than1 = $(this).text();
          $('#have').text(than1);
          $('#picval').val(than1);
          $('.input_box').hide();
     });
     $('.advanced').click(function () {
          $('.input_box').hide();
          if ($(this).text() == 'ethnicity') {
          $('#advanced').show();
          $('#eth').removeAttr('disabled');
          }
          else if ($(this).text() == 'body type') {
          $('#advanced').show();
          $('#bodt').removeAttr('disabled');
          }
          else if ($(this).text() == 'employment') {
          $('#advanced').show();
          $('#emp').removeAttr('disabled');
          }
          else if ($(this).text() == 'height') {
          $('#advanced').show();
          $('.hei').removeAttr('disabled');
          }
          else if ($(this).text() == 'alcohol') {
          $('#advanced').show();
          $('#alc').removeAttr('disabled');
          }
          else if ($(this).text() == 'languages') {
          $('#advanced').show();
          $('#lan').removeAttr('disabled');
          }
     });

     
});
