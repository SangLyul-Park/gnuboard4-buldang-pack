<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

// naver layout�� �ƴϸ�, style�� include
if ($g4[layout_skin] !== "naver")
    echo "<link rel='stylesheet' href='<?=$g4[path]?>/style.latest.css' type='text/css'>";
?>

<script type="text/javascript" src="<?=$g4[admin_path]?>/admin.js"></script>
<script language="JavaScript">
var list_delete_php = "whatson_delete_all.php";
</script>

<form name=fsingolist method=post style="margin:0px;">
<input type=hidden name=head  value='<?=$head?>'>
<input type=hidden name=check value='<?=$check?>'>
<input type=hidden name=rows  value='<?=$rows?>'>
<div class="section_ul">
	<h2><em><a href="<?=$g4[bbs_path]?>/whatson.php?check=1&rows=30" <?=$target_link?> ><?=$skin_title?>What's On</a></em></h2>
	<ul>
  <?
  if (count($list) == 0) {
      echo "<li><span class='bu'></span> <a href='#'>�������</a></li>";
  } else {

      for ($i=0; $i<count($list); $i++) {

          echo "<li><span class='bu'>";
          if ($check == 1) {
              echo $row[wo_id];
              echo "<input type=hidden name=wo_id[$i] value='{$list[$i][wo_id]}'>";
              echo "<input type=checkbox name=chk[] value='$i'>";
          }
          echo "</span> ";

          // �̹� ���� ���� �ٷ� ��â, �ƴϸ�, ajax�� ������ mark �� �Ŀ� ��â
          if ($list[$i][wo_status])
              echo "<a href='" . $list[$i][url]  . "' $target_link >";
          else
              echo "<a href='javascript: void(0)' onclick='javascript:whatson_read(\"" . $list[$i][url] . "\", " . $list[$i][wo_id] . ");return false;' >";

          echo "(" . $list[$i][wo_count] . ")";
       //   if ($list[$i][comment_id]) echo "<img src='" . $whatson_skin_path . "/img/icon_comment.gif'>";
    
          // �̹� ���� ���� ȸ������ ǥ��
          if ($list[$i][wo_status])
              echo "<font color='gray'>";
          
          echo " " . $list[$i][subject];

          if ($list[$i][wo_status])
              echo "</font>";
    
          echo "</a>";
          $delete_href = "javascript:del('" . $g4[bbs_path] . "/ajax_whatson.php?w=d&page=$page&rows=$rows&check=$check&wo_id=".$list[$i][wo_id]."');";
          echo " " . "<a href=\"$delete_href\" >" . "x" . "</a> ";
          
          echo "<span class='time'>" . $list[$i][datetime] . "</span>";
          
          echo "</li>";
      }
  }
  ?>
	</ul>
	<? if ($total_count > 0) { ?>
	<a href="<?=$g4[bbs_path]?>/whatson.php?check=1&rows=30" <?=$target_link?> onfocus='this.blur()' class="more"><span></span>������</a>
	<? } ?>
</div>

<? if ($check == 1 && $i>0) { ?>
<input type=checkbox name=chkall id=chkall value='1' onclick='check_all(this.form)'>&nbsp;<label for=chkall>��ü����</label>&nbsp;&nbsp;
<input type=button class='btn1' value='���û���' onclick="btn_check(this.form, 'delete')">
<? } ?>
</form>

<script type="text/javascript">
function whatson_read(url, wo_id) {

	var post_url = "<?=$g4[bbs_path]?>/ajax_whatson.php?w=r&wo_id="+wo_id;
  var data = "";

	$.ajax({
		type:"POST",
		url:post_url,
		data:data,
		async:false,
		error:function() {
			alert('fail');
		},
		success: function(){
		    <? if ($target) { ?>
        parent.<?=$target?>.location.href = url ;
		    <? } else { ?>
        location.href = url;
        <? } ?>
		}
	});
	
	return false;
}
</script>