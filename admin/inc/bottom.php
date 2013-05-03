  <!-- jQuery -->
  <script src="js/jquery-1.7.2.min.js"></script>
  <!-- jQuery UI -->
  <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
  <!-- transition / effect library -->
  <script src="js/bootstrap-transition.js"></script>
  <!-- alert enhancer library -->
  <script src="js/bootstrap-alert.js"></script>
  <!-- modal / dialog library -->
  <script src="js/bootstrap-modal.js"></script>
  <!-- custom dropdown library -->
  <script src="js/bootstrap-dropdown.js"></script>
  <!-- scrolspy library -->
  <script src="js/bootstrap-scrollspy.js"></script>
  <!-- library for creating tabs -->
  <script src="js/bootstrap-tab.js"></script>
  <!-- library for advanced tooltip -->
  <script src="js/bootstrap-tooltip.js"></script>
  <!-- popover effect library -->
  <script src="js/bootstrap-popover.js"></script>
  <!-- button enhancer library -->
  <script src="js/bootstrap-button.js"></script>
  <!-- accordion library (optional, not used in demo) -->
  <script src="js/bootstrap-collapse.js"></script>
  <!-- carousel slideshow library (optional, not used in demo) -->
  <script src="js/bootstrap-carousel.js"></script>
  <!-- autocomplete library -->
  <script src="js/bootstrap-typeahead.js"></script>
  <!-- tour library -->
  <script src="js/bootstrap-tour.js"></script>
  <!-- library for cookie management -->
  <script src="js/jquery.cookie.js"></script>
  <!-- calander plugin -->
  <script src='js/fullcalendar.min.js'></script>

  <!-- chart libraries start -->
  <script src="js/excanvas.js"></script>
  <script src="js/jquery.flot.min.js"></script>
  <script src="js/jquery.flot.pie.min.js"></script>
  <script src="js/jquery.flot.stack.js"></script>
  <script src="js/jquery.flot.resize.min.js"></script>
  <!-- chart libraries end -->

  <!-- select or dropdown enhancer -->
  <script src="js/jquery.chosen.min.js"></script>
  <!-- checkbox, radio, and file input styler -->
  <script src="js/jquery.uniform.min.js"></script>
  <?php if ($_GET['action'] == 'theme') { ?>
  <!-- plugin for gallery image view -->
  <script src="js/jquery.colorbox.min.js"></script>
  <?php } ?>
  <!-- rich text editor library
  <script src="js/jquery.cleditor.min.js"></script> -->
  <!-- notification plugin -->
  <script src="js/jquery.noty.js"></script>
  <!-- file manager library -->
  <script src="js/jquery.elfinder.min.js"></script>
  <!-- star rating plugin -->
  <script src="js/jquery.raty.min.js"></script>
  <!-- for iOS style toggle switch -->
  <script src="js/jquery.iphone.toggle.js"></script>
  <!-- autogrowing textarea plugin -->
  <script src="js/jquery.autogrow-textarea.js"></script>
  <!-- multiple file upload plugin -->
  <script src="js/jquery.uploadify-3.1.min.js"></script>
  <!-- history.js for cross-browser state change on ajax -->
  <script src="js/jquery.history.js"></script>
  <!-- application script for Charisma demo -->
  <script src="js/charisma.js"></script>
  <!-- ckeditor script -->
  <script src="ext/ckeditor/ckeditor.js"></script>  

  <script>      
    // set content status to enabled
    function enableContent(id) {
      var jsonLink = '<?php echo 'rpc.php?action=enableContent&status=1&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="disableContent(' + id + ');"><span class="label label-success">Enabled</span></a>');
      $("#view_" + id).show();
    }
    
    // set content status to disabled
    function disableContent(id) {
      var jsonLink = '<?php echo 'rpc.php?action=disableContent&status=0&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="enableContent(' + id + ');"><span class="label label-important">Disabled</span></a>');
      $("#view_" + id).hide();
    }
    
    // delete content
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
    
    // copy content modal
    $('.btn-copy').click(function() {
      var id = this.id.split('_');
      $("#copyModal").modal("show");
      $('[name="contentId"]').remove();
      $("#copy_modal_body").append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
    });
  
    // move content modal
    $('.btn-move').click(function() {
      var id = this.id.split('_');
      $('#moveModal').modal('show');
      $('[name="contentId"]').remove();
      $('#move_modal_body').append('<input type="hidden" name="contentId" value="' + id[2] + '" />');
    });
    
    // ajax search results above 479px
    function search_ajax(){
      $("#search_results").show();
      var search_this = $("#search_query").val();
      $.post("search.php", {searchit : search_this}, function(data){
        $("#display_results").html(data);
      })
    }
    
    // ajax search results below 480px
    function search_ajax_320(){
      $("#search_results_320").show();
      var search_this = $("#search_query_320").val();
      $.post("search.php", {searchit : search_this}, function(data){
        $("#display_results_320").html(data);
      })
    } 
    
    // START Document Ready Function ////////////////////////////////////////////////////////
    $(document).ready(function() {
      
      <?php if ($_GET['action'] == 'theme') { ?> 
      //gallery colorbox
      $('.thumbnail a').colorbox({rel:'thumbnail a', transition:"elastic", maxWidth:"95%", maxHeight:"95%"});
      <?php } ?>
      
      // ajax search input field above 479px
      $("#search_query").keyup(function(event){
        event.preventDefault();
        if ($(this).val()) {
          $("#display_results").show();
          search_ajax();
        } else {
          $("#display_results").hide();
        }
      });
      
      // ajax search input field below 480px
      $("#search_query_320").keyup(function(event){
        event.preventDefault();
        if ($(this).val()) {
          $("#display_results_320").show();
          search_ajax_320();
        } else {
          $("#display_results_320").hide();
        }
      });        
    
      // create the category slug as the title is being entered
      $("#contentTitle").blur(function(){
        $("#contentSlug").val($("#contentTitle").val().toLowerCase().replace(/ /g, '-'));
        $("#menuTitle").val($("#contentTitle").val());
      });
      
      // set the background of the theme gallery thumbnail image to match what is in the css
      var thumbWidth = $(".thumbnail img").width();
      $(".thumbnail a").css("background-size", "150px");
      
      // sortable categories    
      $("#content-list").sortable({
        handle : '.sortHandle',
        update : function () {
          $("#updateSortChanges").show();
          var order = $('#content-list').sortable('serialize');
          $("#info").load("updateSort.php?" + order);
        }
      });
                      
    });
    // END Document Ready Function ////////////////////////////////////////////////////////
  </script>
 
</body>
</html>