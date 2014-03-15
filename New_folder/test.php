<html>
<head>
<script>
$.post('/php_files/org_mess.php',{'convo':id},function (data) {
           html = '';
           var thumb; 
     var year = 0;
        daym="0"+daym
     var month=new Array();
     month[00]="January";
     month[01]="February";
     month[02]="March";
     month[03]="April";
     month[04]="May";
     month[05]="June";
     month[06]="July";
     month[07]="August";
     month[08]="September";
     month[09]="October";
     month[10]="November";
     month[11]="December";
     n = month[mydate.getMonth()];
    var string = n+" "+daym+" "+year;
    loop = true;
               $.each(data,function (user,conv) {
                if (year != )
                var year = conv.year;
                
                
               
               });
               },'json');
</script>
</head>
<body>
</body>
</html>
