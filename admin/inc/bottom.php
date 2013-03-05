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
  <!-- plugin for gallery image view -->
  <script src="js/jquery.colorbox.min.js"></script>
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
    $(document).ready(function() {
    
      // create the slug as the title is being entered
      $("#title").keyup(function(){
        $("#slug").val($("#title").val().toLowerCase().replace(/ /g, '-'));
      });
      
      // set the background of the theme gallery thumbnail image to match what is in the css
      var thumbWidth = $(".thumbnail img").width();
      $(".thumbnail a").css("background-size", "150px");
      
      // sortable pages    
      $("#page-list").sortable({
        handle : '.pageSortHandle',
        update : function () {
          var order = $('#page-list').sortable('serialize');
          $("#info").load("updatePageSort.php?"+order);
        }
      });
                      
    });
      
    // set page status to enabled
    function enablePage(id) {
      var jsonLink = '<?php echo 'rpc.php?action=enablePage&status=1&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="disablePage(' + id + ');"><span class="label label-success">Enabled</span></a>');
      $("#view_" + id).show();
    }
    
    // set page status to disabled
    function disablePage(id) {
      var jsonLink = '<?php echo 'rpc.php?action=disablePage&status=0&id=ID'; ?>'
      $.getJSON(jsonLink.replace('ID', id));
      $("#status_" + id).html('<a onclick="enablePage(' + id + ');"><span class="label label-important">Disabled</span></a>');
      $("#view_" + id).hide();
    }
    
    // delete a page
    function deletePage(id) {
      if (confirm("Are you sure you wish to delete this page?")) {
        var jsonLink = '<?php echo 'rpc.php?action=deletePage&id=ID'; ?>'
        $.getJSON(jsonLink.replace('ID', id));
        $("#listItem_" + id).remove();
        return true;
      } else {
        return false;
      }
    }
  </script>
 
</body>
</html>