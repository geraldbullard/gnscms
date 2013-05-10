$(document).ready(function(){
  // tabs
  $('#listContentTab a:first').tab('show');
  $('#listContentTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
});
