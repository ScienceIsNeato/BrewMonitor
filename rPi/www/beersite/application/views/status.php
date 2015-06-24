
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>status page</title>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
   <div class="temperature">loading</div>   
   <div class="pressure">loading</div>   

</body>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
   $(document).ready(function() {
      
      var printError = function( req, status, err ) {
        console.log( 'something went wrong', status, err );
      }; 

      var get_tp = function(){
      $.ajax({
        url: "/ajax/getdata",
        method: "GET",
        data: {request:"tp"},
        success: function(resp){
          var tmp = jQuery.parseJSON(resp);

          $('div.temperature').replaceWith( "<div class = \"temperature\"> temperature = "+tmp.temperature+"</div>");
          $('div.pressure').replaceWith(  "<div class = \"pressure\"> pressure  = "+tmp.pressure+"</div>");
        },
        error: printError
      });
    };
   var time=setInterval(get_tp, 10000);
      
   });
</script>
</html>

