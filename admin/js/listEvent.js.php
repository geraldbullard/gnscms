<script>
  function enableEvent(id) {
    var jsonLink = '<?php echo 'rpc.php?action=enableEvent&status=1&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="disableEvent(' + id + ');"><span class="label label-success">Enabled</span></a>');
    $("#view_" + id).show();
  }    
  function disableEvent(id) {
    var jsonLink = '<?php echo 'rpc.php?action=disableEvent&status=0&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="enableEvent(' + id + ');"><span class="label label-important">Disabled</span></a>');
    $("#view_" + id).hide();
  }    
  function deleteEvent(id) {
    if (confirm("Are you sure you wish to delete this event?")) {
      var jsonLink = '<?php echo 'rpc.php?action=deleteEvent&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#listItem_" + id).remove();
      return true;
    } else {
      return false;
    }
  }     
  $('.btn-copy').click(function() {
    var id = this.id.split('_');
    $("#copyModal").modal("show");
    $('[name="eventId"]').remove();
    $("#copy_modal_body").append('<input type="hidden" name="eventId" value="' + id[2] + '" />');
  });
  function scrollGo() {
    var x = $(this).offset().top - 100; // 100 provides buffer in viewport
    $('html,body').animate({scrollTop: x}, 500);
  }
  $(document).ready(function(){
    $('#listEventsTab a:first').tab('show');
    $('#listEventsTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#event-list").sortable({
      handle : '.sortHandle',
      update : function () {
        $("#updateSortChanges").show();
        var order = $('#event-list').sortable('serialize');
        $("#info").load("updateSort.php?" + order);
      }
    });
    $('.datepicker').datepicker();
  });
</script>
