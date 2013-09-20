<script>
  $(document).ready(function(){
    // tabs
    $('#listGalleryTab a:first').tab('show');
    $('#listGalleryTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    });
  });
</script>
