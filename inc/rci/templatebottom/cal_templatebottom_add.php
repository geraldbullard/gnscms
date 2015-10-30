<!-- use the following for the events calendar page in the cms (bootstrap3 theme)
<div class="container">
  <div class="row">  
    <div class="col-lg-12">
      <h1 class="page-header">Events Calendar</h1>
      <ol class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Events Calendar</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="calendar" data-color="blue" opn="demo" style="height:28em;"> </div>
    </div>
    <div class="col-lg-12">
      <p class="pull-right small text-muted">Original Calendar by: <a href="http://www.jqueryscript.net/demo/Easy-jQuery-Based-Flat-Calendar-Widget-Flat-Calendar/" target="_blank">Eric Wennerberg</a></p>
    </div>
  </div>
</div>
-->
<?php
  if (strpos($_SERVER['REQUEST_URI'], 'event') > 0) {
    include_once('admin/inc/class/Event.class.php'); 
    $data = Event::getAll();
?>
  <script src="inc/js/calendar.js"></script>
  <script>
    $(document).ready(function() {
      var hasCalendar = $(".calendar").is(":visible");
      if (hasCalendar) set_calendar_events(); 
    });
    function set_calendar_events() {
      <?php 
        foreach ($data['results'] as $event) { 
        $description = preg_replace('/^\s+|\n|\r|\s+$/m', '', str_replace("'", "\'", str_replace('"', '\"', $event->description)));  
      ?>
      $(".calendar")
        .find("[strtime='<?php echo str_replace('-', '', $event->eventDate); ?>']")
        .append('<div style="margin:23px 30px 0 5px;"><?php echo $event->title; ?></div>')
        .addClass("have-events")
        .attr('onclick', 'load_date_specific_data("<?php echo str_replace("'", "\'", $event->title); ?>", "<?php echo $description; ?>", "<?php echo $event->startTime; ?>", "<?php echo $event->endTime; ?>", "<?php echo str_replace("'", "\'", $event->location); ?>", "<?php echo $event->map; ?>");')
        .find(".event-n-holder")
        .append('<div class="event-n"></div>'+
                '<div data-role="day" data-day="<?php echo date("Y-m-d", $event->eventDate); ?>">'+
                '  <div data-role="event" data-name="<?php echo str_replace("'", "\'", $event->title); ?>" data-start="<?php echo $event->startTime; ?>" data-end="<?php echo $event->endTime; ?>" data-location="<?php echo str_replace("'", "\'", $event->location); ?>"></div>'+
                '</div>');
      <?php 
        } 
      ?>
    }
    function load_date_specific_data(title, desc, start, end, loc, map) {
      $(".specific-day").prepend('<i class="fa fa-chevron-left calendar-day-back"></i>');
      $(".s-scheme").append('<div class="s-event">'+
                            '  <h1>' + title + '</h1>'+
                            '  <p data-role="desc">' + desc + '</p>'+
                            '  <p>&nbsp;</p>'+
                            '  <p data-role="dur">Showtime: ' + start + ' - ' + end + '</p>'+
                            '  <p data-role="loc">Location: ' + loc + '</p>'+
                            '  <p data-role="map" class="calendar-map"><a href="' + map + '" target="_blank" class="calendar-map-link">Google Map <i class="fa fa-external-link calendar-map-icon"></i></a></p>'+
                            '</div>');
    }
  </script>
<?php
  }
?>
