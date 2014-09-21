function getmonth (monthnum) {

     var monthstr;

     if (monthnum == 1)
          return monthstr = 'Jan';
     else if (monthnum == 2)
          return monthstr = 'Feb';
     else if (monthnum == 3)
          return monthstr = 'Mar';
     else if (monthnum == 4)
          return monthstr = 'Apr';
     else if (monthnum == 5)
          return monthstr = 'May';
     else if (monthnum == 6)
          return monthstr = 'Jun';
     else if (monthnum == 7)
          return monthstr = 'Jul';
     else if (monthnum == 8)
          return monthstr = 'Aug';
     else if (monthnum == 9)
          return monthstr = 'Sep';
     else if (monthnum == 10)
          return monthstr = 'Oct';
     else if (monthnum == 11)
          return monthstr = 'Nov';
     else if (monthnum == 12)
          return monthstr = 'Dec'; 
}

$( function () {

     for (var i = 1; i <= 12; i ++) {
          $('#birth_month')
          .append('<option name=\"birth_month\" value=\"' + i + '\">' + getmonth(i) + '</option>');
     }
     for (var i = 1; i <= 31; i ++) {
          $('#birth_day')
          .append('<option name=\"birth_day\" value=\"' + i + '\">' + i + '</option>');
     }
     for (var i = 1912; i <= 2012; i ++) {
         
          if (i == 2012) {
          $('#birth_year')
          .append('<option name=\"birth_year\" selected=\"selected\" value=\"' + i + '\">' + i + '</option>');
          }
          else {
          $('#birth_year')
          .append('<option name=\"birth_year\" value=\"' + i + '\">' + i + '</option>');
          }     
     }
});