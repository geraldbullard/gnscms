<script>
  $(document).ready(function(){
    $('#editEventTab a:first').tab('show');
    $('#editEventTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $(".datepicker").each(function() {    
      $(this).datepicker('setDate', $(this).val());
    });
  });
</script>
