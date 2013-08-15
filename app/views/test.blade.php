<!DOCTYPE html>
<html>
<head>
  <title>Aliman lesson planning</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" type="text/css" href="css/calendar.css" />
  <link rel="stylesheet" type="text/css" href="css/custom_2.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <script src="js/modernizr.custom.63321.js"></script>
</head>
<body>
  <div id="curtain"><div><i class="icon-spinner icon-spin icon-large"></i> Loading...</div></div>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">

      <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="navbar-brand" href="#">Aliman</a>
      <!-- Place everything within .navbar-collapse to hide it until above 768px -->
      <div class="nav-collapse collapse navbar-responsive-collapse">
       <ul class="nav navbar-nav">
        <li class="active"><a href="#"><i class='icon-plus'></i> &nbsp;Create new</a></li>
        <li><a href="#"><i class="icon-calendar"></i> &nbsp;Calendar</a></li>
        <li><a href="#"><i class="icon-list-ul"></i> &nbsp;View All</a></li>
      </ul>
      <button type="button" class="btn pull-right btn-danger navbar-btn"><i class="icon-signout"></i> Back to system</button>
      <p class="navbar-text pull-right">Welcome <a href="#" class="navbar-link">Mounir Younes</a>&nbsp;&nbsp;</p>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->
<div class="container-fluid">
  <section class="main">
    <div class="custom-calendar-wrap">
      <div id="custom-inner" class="custom-inner">
        <div class="custom-header clearfix">
          <nav>
            <span id="custom-prev" class="custom-prev"></span>
            <span id="custom-next" class="custom-next"></span>
          </nav>
          <h2 id="custom-month" class="custom-month"></h2>
          <h3 id="custom-year" class="custom-year"></h3>
        </div>
        <div id="calendar" class="fc-calendar-container"></div>
      </div>
    </div>
  </section>
</div>

<!-- JavaScript plugins (requires jQuery) -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.calendario.js"></script>
<script type="text/javascript" src="js/data.js"></script>
<script type="text/javascript"> 
$(function() {




  var transEndEventNames = {
    'WebkitTransition' : 'webkitTransitionEnd',
    'MozTransition' : 'transitionend',
    'OTransition' : 'oTransitionEnd',
    'msTransition' : 'MSTransitionEnd',
    'transition' : 'transitionend'
  },
  transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
  $wrapper = $( '#custom-inner' ),
  $calendar = $( '#calendar' ),
  cal = $calendar.calendario( {
    onDayClick : function( $el, $contentEl, dateProperties ) {
      if( $contentEl.length > 0 ) {
        showEvents( $contentEl, dateProperties );
      }

    },
    caldata : codropsEvents,
    displayWeekAbbr : true
  } ),
  $month = $( '#custom-month' ).html( cal.getMonthName() ),
  $year = $( '#custom-year' ).html( cal.getYear() );

  $( '#custom-next' ).on( 'click', function() {
    cal.gotoNextMonth( updateMonthYear );
  } );
  $( '#custom-prev' ).on( 'click', function() {
    cal.gotoPreviousMonth( updateMonthYear );
  } );

  function updateMonthYear() {        
    $month.html( cal.getMonthName() );
    $year.html( cal.getYear() );
  }

        // just an example..
        function showEvents( $contentEl, dateProperties ) {

          hideEvents();
          
          var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Lesson plans for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
          $close = $( '<span class="custom-content-close"><i class="icon-remove"></i></span>' ).on( 'click', hideEvents );
          console.log($contentEl.html());
          $events.append("<table class='table table-striped'><thead><tr><th>Instructor</th><th>Subject</th><th>Batch</th><th>Lesson</th><th>Action</th></tr></thead><tbody><tr><td>"+$contentEl.html().replaceAll("|","</tr><tr><td>").replaceAll("$%$", "</td><td>").replaceAll("&lt;$","<td><a class='btn btn-warning btn-sm ajaxmit' href='accept/").replaceAll("$&gt;","'><i class='icon-check'></i> Accept</a> &nbsp;").replaceAll("&lt;#","<a class='ajaxmit btn btn-warning' href='reject/").replaceAll("#&gt;","'><i class='icon-remove'></i> Reject</a>")+"</td></tr></tbody></table>" , $close ).insertAfter( $wrapper );
          
          setTimeout( function() {
            $events.css( 'top', '0%' );
          }, 25 );

        }
        function hideEvents() {

          var $events = $( '#custom-content-reveal' );
          if( $events.length > 0 ) {

            $events.css( 'top', '100%' );
            Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();

          }

        }

        $(document).on("click", "a.ajaxmit", function(){

var element = $(this);
          $("#curtain").show();
         $.post("{{URL::to('return')}}", { name: "John", time: "2pm" })
         .done(function(data) {
          console.log("Data Loaded: " + data);
          element.parent().parent().addClass('success');
          $("#curtain").hide();
          
        });

         return false;
       }); 



      });


String.prototype.replaceAll = function(str1, str2, ignore) 
{
  return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
};
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!-- Optionally enable responsive features in IE8 -->
<script src="js/respond.js"></script>
</body>
</html>