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
      $("#leftBlockList").append("<li id='" + this.value + "' value='" + this.value + "' class=\"pad-5\" style=\"white-space:nowrap;text-transform:capitalize;\">" +
                                 "<i class=\"icon-move leftSortHandle\" title=\"Drag to Sort\"></i>" +
                                 "<i class=\"icon-trash\" style=\"cursor:pointer;margin:0 10px 0 6px;\" onclick=\"removeLeftBlock('" + this.value + "');\" title=\"Remove Block\"></i>" +
                                 name + "</li>");
      $("#leftBlockSelect option[value='" + this.value + "']").remove();
      $("#rightBlockSelect option[value='" + right + "']").remove();
      $("#info").load("blocks.php?leftadd=" + right + "&cId=<?php echo $_GET['editId']; ?>");
      var order = $('#leftBlockList').sortable('serialize');
      $("#info").load("blocks.php?sort&" + order);
    });    
    $("#rightBlockSelect").change(function() {
      var left = this.value;
      var name = this.value.replace("_", " ");
      $("#rightBlockList").append("<li id='" + this.value + "' value='" + this.value + "' class=\"pad-5\" style=\"white-space:nowrap;text-transform:capitalize;\">" +
                                  "<i class=\"icon-move rightSortHandle\" title=\"Drag to Sort\"></i>" +
                                  "<i class=\"icon-trash\" style=\"cursor:pointer;margin:0 10px 0 6px;\" onclick=\"removeRightBlock('" + this.value + "');\" title=\"Remove Block\"></i>" +
                                  name + "</li>");
      $("#rightBlockSelect option[value='" + this.value + "']").remove();
      $("#leftBlockSelect option[value='" + left + "']").remove();
      $("#info").load("blocks.php?rightadd=" + left + "&cId=<?php echo $_GET['editId']; ?>");
      var order = $('#rightBlockList').sortable('serialize');
      $("#info").load("blocks.php?sort&" + order);
    });
  });
  function removeLeftBlock(val) {
    $("#" + val).remove();
    var newVal = val.replace("_", " ");
    $("#leftBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#rightBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#info").load("blocks.php?remove=" + val);
  }
  function removeRightBlock(val) {
    $("#" + val).remove();
    var newVal = val.replace("_", " ");
    $("#leftBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#rightBlockSelect").append("<option value='" + val + "'>" + newVal + "</option>");
    $("#info").load("blocks.php?remove=" + val);
  }
</script>
