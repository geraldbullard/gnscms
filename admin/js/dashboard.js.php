<script>
  $(document).ready(function(){
    // tabs
    $('#dashboardTab a:first').tab('show');
    $('#dashboardTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
</script>
