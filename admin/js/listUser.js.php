<script>
  // set user status to enabled
  function enableUser(id) {
    var jsonLink = '<?php echo 'rpc.php?action=enableUser&status=1&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="disableUser(' + id + ');"><span class="label label-success">Enabled</span></a>');
  }    
  // set user status to disabled
  function disableUser(id) {
    var jsonLink = '<?php echo 'rpc.php?action=disableUser&status=0&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="enableUser(' + id + ');"><span class="label label-important">Disabled</span></a>');
  }    
  // delete user
  function deleteUser(id) {
    if (confirm("Are you sure you wish to delete this users profile?")) {
      var jsonLink = '<?php echo 'rpc.php?action=deleteUser&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#listUser_" + id).remove();
      return true;
    } else {
      return false;
    }
  }    
  $(document).ready(function(){
    // tabs
    $('#listUsersTab a:first').tab('show');
    $('#listUsersTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    $('#listAccessTab a:first').tab('show');
    $('#listAccessTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
</script>
