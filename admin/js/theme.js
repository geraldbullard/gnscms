$(document).ready(function(){
  // tabs
  $('#currentThemeTab a:first').tab('show');
  $('#currentThemeTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
});
