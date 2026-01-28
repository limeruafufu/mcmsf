<?php
$mod = 'admin';
$title='成员列表';
include('../Common/Core_brain.php');
if($adminData['adminRank']== 2) {
  echo "您的账号没有权限使用此功能";
  exit;
}
include './head.php';
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        <?php echo $title ?>
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">后台首页</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <?php echo $title ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> 成员管理列表 </h3>
                <div class="block-options">
                    <a class="btn btn-alt-success" href="./tset.php?my=add"><b><i class="fa fa-plus"></i> 新增</b></a>
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div id="listTable" class="block-content block-content-full"></div>
            </div>
        </div>
    </div>
</div>
<?php include 'foot.php'?>
<script>
function listTable(query){
  var url = window.document.location.href.toString();
  var queryString = url.split("?")[1];
  query = query || queryString;
  if(query == 'start' || query == undefined){
    query = '';
    history.replaceState({}, null, './tlist.php');
  }else if(query != undefined){
    history.replaceState({}, null, './tlist.php?'+query);
  }
  layer.closeAll();
  var ii = layer.load(2, {shade:[0.1,'#fff']});
  $.ajax({
    type : 'GET',
    url : 'tlist-table.php?'+query,
    dataType : 'html',
    cache : false,
    success : function(data) {
      layer.close(ii);
      $("#listTable").html(data)
    },
    error:function(data){
      layer.msg('服务器错误');
      return false;
    }
  });
}
function searchTeam(){
  var column=$("select[name='column']").val();
  var value=$("input[name='value']").val();
  if(value==''){
    listTable();
  }else{
    listTable('column='+column+'&value='+value);
  }
  return false;
}
function setStatus(id,status) {
  $.ajax({
    type : 'GET',
    url : 'ajax.php?act=setMember&type=Status&id='+id+'&status='+status,
    dataType : 'json',
    success : function(data) {
      if(data.code == 0){
        listTable();
        layer.msg(data.msg, {icon:1, time:1500});
      }else{
        layer.msg(data.msg, {icon:2, time:1500});
      }
    },
    error:function(data){
      layer.msg('服务器错误');
      return false;
    }
  });
  return false;
}
function setShow(id,num) {
  $.ajax({
    type : 'GET',
    url : 'ajax.php?act=setMember&type=Show&id='+id+'&num='+num,
    dataType : 'json',
    success : function(data) {
      if(data.code == 0){
        listTable();
        layer.msg(data.msg, {icon:1, time:1500});
      }else{
        layer.msg(data.msg, {icon:2, time:1500});
      }
    },
    error:function(data){
      layer.msg('服务器错误');
      return false;
    }
  });
  return false;
}
function delMember(id){
  layer.confirm('您确定要删除吗？', {
    btn: ['确定','取消'] //按钮
  }, function(){
    var ii = layer.load(2, {shade:[0.1,'#fff']});
    $.ajax({
      type : 'POST',
      url : 'ajax.php?act=setMember&type=Del',
      data: {id:id},
      dataType : 'json',
      success : function(data) {
        layer.close(ii);
        if(data.code == 0){
            layer.alert(data.msg, {icon: 1,closeBtn: false}, function(){window.location.reload()});
        }else{
          layer.alert(data.msg, {icon: 2})
        }
      },
      error:function(data){
        layer.msg('服务器错误');
        return false;
      }
    });
  }, function() {});
  return false;
}
$(document).ready(function(){
  listTable();
})
</script>
</body>
</html>