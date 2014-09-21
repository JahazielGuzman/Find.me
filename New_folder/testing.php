<html>
<head>
<title>
test
</title>
<script src="/js_files/jquery.js" type="text/javascript">
    </script>
<script>
$(function(){

     $('#butt').click(function () {
          var thing = $('#form').html();
          $('#form').prepend(thing);
     });
}); 
</script>
</head>
<body>
<form id="form" action="test.php" method="post">
<select name="languages[]" class="lan">
<option value="english">english</option>
<option value="spanish">spanish</option>
<option value="french">french</option>
<option value="portuguese">portuguese</option>
<option value="chinese">chinese</option>
<option value="japanese">japanese</option>
<option value="russian">russian</option>
<option value="arabic">arabic</option>
</select>
<input type="submit" value="sub">
</form>
<button id="butt">
+
</button>
</body>
</html>
