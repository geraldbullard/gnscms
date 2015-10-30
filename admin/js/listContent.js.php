<script>
  function enableContent(id) {
    var jsonLink = '<?php echo 'rpc.php?action=enableContent&status=1&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="disableContent(' + id + ');"><span class="label label-success">Enabled</span></a>');
    $("#view_" + id).show();
  }    
  function disableContent(id) {
    var jsonLink = '<?php echo 'rpc.php?action=disableContent&status=0&id=ID'; ?>'
    $.getJSON(jsonLink.replace('ID', id));
    $("#status_" + id).html('<a onclick="enableContent(' + id + ');"><span class="label label-important">Disabled</span></a>');
    $("#view_" + id).hide();
  }    
  function deleteContent(id) {
    if (confirm("Are you sure you wish to delete this content?")) {
      var jsonLink = '<?php echo 'rpc.php?action=deleteContent&id=ID'; ?>'
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
    $('[name="contentId"]').remove();
    $("#copy_modal_body").append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
  });  
  $('.btn-move').click(function() {
    var id = this.id.split('_');
    $('#moveModal').modal('show');
    $('[name="contentId"]').remove();
    $('#move_modal_body').append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
  });
  function scrollGo() {
    var x = $(this).offset().top - 100; // 100 provides buffer in viewport
    $('html,body').animate({scrollTop: x}, 500);
  }
  function getLayout(sel) {
    if (sel == 'custom') {
      $('#layout_preview').hide();
      CKEDITOR.instances.content.setData('');
    } else {
      $('#layout_preview').show();
      $('#layout_preview img').attr('src', '../theme/<?php echo siteTheme; ?>/layout/' + sel + '.jpg');
      CKEDITOR.instances.content.setData('');
      $.get('../theme/<?php echo siteTheme; ?>/layout/' + sel + '.tpl', function(data) {
        CKEDITOR.instances.content.insertHtml(data);
      }).done(function() {
        $('#contentTitle').show(scrollGo);
        $('#contentTitle').focus();
      });
    }
  }
  // page template addition
  $('input:radio[name=type]').click(function(){
    if ($('input:radio[name=type]:checked').val() == 1) {
      $("#layout_template").show();
      $("#summaryDiv").show();
      $("#contentDiv").show();
    } else {
      $("#layout_template").hide();
      CKEDITOR.instances.content.setData('');
      $("#summaryDiv").hide();
      $("#contentDiv").hide();
    }
  });
  $(document).ready(function(){
    // create the category slug as the title is being entered
    $("#contentTitle").blur(function(){
      $("#contentSlug").val($("#contentTitle").val().toLowerCase().replace(/ /g, '-').replace(/[^a-z0-9-]/g, ''));
      $("#menuTitle").val($("#contentTitle").val());
    });
    $('#listContentTab a:first').tab('show');
    $('#listContentTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#content-list").sortable({
      handle : '.sortHandle',
      update : function () {
        $("#updateSortChanges").show();
        var order = $('#content-list').sortable('serialize');
        $("#info").load("updateSort.php?" + order);
      }
    });
  });
</script>
