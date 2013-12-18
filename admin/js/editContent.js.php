<script>
  $(document).ready(function(){
    $('#editContentTab a:first').tab('show');
    $('#editContentTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $("#leftBlockList").sortable({
      handle : '.leftSortHandle',
      update : function () {
        var order = $('#leftBlockList').sortable('serialize');
        $("#info").load("blocks.php?sort&" + order);
      }
    });
    $("#rightBlockList").sortable({
      handle : '.rightSortHandle',
      update : function () {
        var order = $('#rightBlockList').sortable('serialize');
        $("#info").load("blocks.php?sort&" + order);
      }
    });    
    $("#leftBlockSelect").change(function() {
      var right = this.value;
      var name = this.value.replace("_", " ");
      $("#leftBlockList").append("<li id='" + this.value + "' value='" + this.value + "' class=\"pad-5\" style=\"white-space:nowrap;text-transform:capitalize;\"><i class=\"icon-move leftSortHandle\" title=\"Drag to Sort\" data-rel=\"tooltip\"><i class=\"icon-trash\" style=\"cursor:pointer;margin-left:20px;\" onclick=\"removeLeftBlock('" + this.value + "');\" title=\"Remove Block\" data-rel=\"tooltip\"></i> &nbsp;" + name + "</li>");
      $("#leftBlockSelect option[value='" + this.value + "']").remove();
      $("#rightBlockSelect option[value='" + right + "']").remove();
      $("#info").load("blocks.php?leftadd=" + right);
    });    
    $("#rightBlockSelect").change(function() {
      var left = this.value;
      var name = this.value.replace("_", " ");
      $("#rightBlockList").append("<li id='" + this.value + "' value='" + this.value + "' class=\"pad-5\" style=\"white-space:nowrap;text-transform:capitalize;\"><i class=\"icon-move rightSortHandle\" title=\"Drag to Sort\" data-rel=\"tooltip\"><i class=\"icon-trash\" style=\"cursor:pointer;margin-left:20px;\" onclick=\"removeRightBlock('" + this.value + "');\" title=\"Remove Block\" data-rel=\"tooltip\"></i> &nbsp;" + name + "</li>");
      $("#rightBlockSelect option[value='" + this.value + "']").remove();
      $("#leftBlockSelect option[value='" + left + "']").remove();
      $("#info").load("blocks.php?rightadd=" + left);
    });
  });
  function removeLeftBlock(val) {
    $("#" + val).remove();
    var newVal = val.replace("_", " ");
    $("#leftBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#rightBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
  }
  function removeRightBlock(val) {
    $("#" + val).remove();
    var newVal = val.replace("_", " ");
    $("#leftBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#rightBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
  }
</script>
