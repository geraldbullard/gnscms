$(document).ready(function(){
  // tabs
  $('#listSettingsTab a:first').tab('show');
  $('#listSettingsTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
});
