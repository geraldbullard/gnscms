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
