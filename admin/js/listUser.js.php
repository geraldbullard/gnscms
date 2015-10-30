<script>
  // set user status to enabled
  function enableUser(id) {
    var jsonLink = '<?php echo 'rpc.php?action=enableUser&status=1&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#statusUser_" + id).html('<a onclick="disableUser(' + id + ');"><span class="label label-success">Enabled</span></a>');
  }    
  // set user status to disabled
  function disableUser(id) {
    var jsonLink = '<?php echo 'rpc.php?action=disableUser&status=0&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#statusUser_" + id).html('<a onclick="enableUser(' + id + ');"><span class="label label-important">Disabled</span></a>');
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
  // set group status to enabled
  function enableGroup(id) {
    var jsonLink = '<?php echo 'rpc.php?action=enableGroup&status=1&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#statusGroup_" + id).html('<a onclick="disableGroup(' + id + ');"><span class="label label-success">Enabled</span></a>');
  }    
  // set group status to disabled
  function disableGroup(id) {
    var jsonLink = '<?php echo 'rpc.php?action=disableGroup&status=0&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#statusGroup_" + id).html('<a onclick="enableGroup(' + id + ');"><span class="label label-important">Disabled</span></a>');
  }    
  // delete group
  function deleteGroup(id) {
    if (confirm("Are you sure you wish to delete this group?")) {
      var jsonLink = '<?php echo 'rpc.php?action=deleteGroup&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#listGroup_" + id).remove();
      return true;
    } else {
      return false;
    }
  }
  // access sliders
  var allowedAccessValues = {
    0: true,
    1: true,
    2: true,
    3: true,
    4: true
  };    
  $(document).ready(function(){
    // tabs
    $('#listUsersTab a:first').tab('show');
    $('#listUsersTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
    $('#listGroupsTab a:first').tab('show');
    $('#listGroupsTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
</script>
<?php
  $results['group'] = Group::getById( 1 );
  foreach ($results['group'] as $group => $val) {
    if ($group != 'id' && $group != 'title' && $group != 'status' && $group != 'dashboard') {
?>
<script>   
  $(document).ready(function() {
    $("#accessSlider<?php echo ucfirst($group); ?>").slider({
      range: true,
      max: 4,
      slide: function(event, ui) {
        if (!allowedAccessValues[ui.value]) return false;
      },
      change: function(event, ui){
        $("#<?php echo $group; ?>").val(ui.value);
      }
    });    
    $("#accessSlider<?php echo ucfirst($group); ?> a:first").remove();
  });
</script>
<?php
    }        
  }
?>
