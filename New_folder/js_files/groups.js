$(function () {
var formd;
var html;
     $.post('/php_files/mygroups.php',function (data) {
          html = '';
          $.each(data,function (dat,group) {
               html += '<a href="https://teeckle.me/groups/' + group.groupid + '.php"><img src="';
               if (group.thumbnail != null) {
                    html += group.thumbnail;
               } 
               else {
                    html += img.src;
               }
               html += '" width="75px" height="75px" /></a>';
          });
          $('#urgroups').html(html);
     },'json');
     $.post('/php_files/newgroups.php',function (data) {
          html = '';
          $.each(data,function (dat,group) {
               html += '<a href="https://teeckle.me/groups/' + group.groupid + '.php"><img src="';
               if (group.thumbnail != null) {
                    html += group.thumbnail;
               } 
               else {
                    html += img.src;
               }
               html += '" width="75px" height="75px" /></a>';
          });
          $('#newgroups').html(html);
     },'json');
     $.post('/php_files/popgroups.php',function (data) {
          html = '';
          $.each(data,function (dat,group) {
               html += '<a href="https://teeckle.me/groups/' + group.mgroupid + '.php"><img src="';
               if (group.thumbnail != null) {
                    html += group.thumbnail;
               } 
               else {
                    html += img.src;
               }
               html += '" width="75px" height="75px" /></a>';
          });
          $('#popgroups').html(html);
     },'json');

     $.post('/php_files/group_name.php',function (data) {
          html = '';
          $.each(data,function (inc,names) {
               html += '<option value="' + names.groupid  + '">' +
               names.groupname + '</option>';
          });
          $('#group_sel').html(html);
     },'json');
     $('#crgo').livequery("click",function () {
          $('#creategroup').show();
     });
     $('#crg').click(function () {
          formd = $('#createGroupForm').serialize();
          
          $.post('/php_files/creategroup.php',formd,function (data) {
               if (data != 'fail') {
                    window.location = data;
               }
               else {
                    alert(data);
               }
          });
     });
     $('#cancel').click(function () {
          $('#creategroup').hide();
     });

     $('#invite_it').click(function () {
          var serial = $('#invite_form').serialize();
          $.post('/php_files/invite_group.php',serial,function () {
               
          });
     });
     $('#invb').click(function () {
          $('#invite').show();
     });
     $('#add_cat').click(function () {
          $('#group_crit').append('<tr><td><select name="cat[]"> \
<option value="academic">academic</option>\
<option value="social awareness">social awareness</option>\
<option value="cultural">cultural</option>\
<option value="religious">religious</option>\
<option value="food">food</option>\
<option value="comedy">comedy</option>\
<option value=""></option></td></tr>');
     });
});
