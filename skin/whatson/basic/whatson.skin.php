<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

$whatson_url = "$g4[bbs_path]/whatson.php?check=1&rows=30";
?>

<script type="text/javascript" src="<?=$g4[admin_path]?>/admin.js"></script>
<script language="JavaScript">
var list_delete_php = "whatson_delete_all.php";
</script>

<form role="form" class="form-inline" name=fsingolist method=post>
<input type=hidden name=head  value='<?=$head?>'>
<input type=hidden name=check value='<?=$check?>'>
<input type=hidden name=rows  value='<?=$rows?>'>
<div class="panel panel-default">
    <div class="panel-heading"><a href="<?=$whatson_url?>">What's On</a>
    <? if ($total_count > 0) { ?>(<?=$total_count?>)<?}?>
    <span class="pull-right">
    <a href="<?=$whatson_url?>"><small>more</small></a>
    </span>
    </div>
    <div class="panel-body">
        <ul class="list-unstyled">
        <?
        if (count($list) == 0) {
            echo "<li><a href='#'>�������</a></li>";
        } else {

            for ($i=0; $i<count($list); $i++) {

                echo "<li>";
                if ($check == 1) {
                    echo $row[wo_id];
                    echo "<input type=hidden name=wo_id[$i] value='{$list[$i][wo_id]}'>";
                    echo "<div class='checkbox'><input type=checkbox name=chk[] value='$i'></div>&nbsp;";
                }

                // �̹� ���� ���� �ٷ� ��â, �ƴϸ�, ajax�� ������ mark �� �Ŀ� ��â
                if ($list[$i][wo_status])
                    echo "<a href='" . $list[$i][url]  . "' $target_link >";
                else
                    echo "<a href='javascript: void(0)' onclick='javascript:whatson_read(\"" . $list[$i][url] . "\", " . $list[$i][wo_id] . ");return false;'>";

                echo "(" . $list[$i][wo_count] . ")";

                // �̹� ���� ���� ȸ������ ǥ��
                if ($list[$i][wo_status])
                    echo "<font color='gray'>";
                echo " " . $list[$i][subject];
                if ($list[$i][wo_status])
                    echo "</font>";
                echo "</a>";

                if ($check == 1) {
                echo "&nbsp;<small>" . $list[$i][datetime] . "</small>&nbsp;";

                $delete_href = "javascript:del('" . $g4[bbs_path] . "/ajax_whatson.php?w=d&page=$page&rows=$rows&check=$check&wo_id=".$list[$i][wo_id]."');";
                echo " " . "<a href=\"$delete_href\" ><i class=\"fa fa-trash-o\"></i></a> ";
                }
                echo "</li>";
        }
    }
    ?>
  	</ul>

    <? if ($check == 1 && $i>0) { ?>
        <label for=chkall><input type="checkbox" name=chkall id=chkall value='1' onclick='check_all(this.form)'>&nbsp;��ü����</label>&nbsp;&nbsp;
        <input type="button" class="btn btn-default" value='���û���' onclick="btn_check(this.form, 'delete')">
    <? } ?>

    </div>
</div>

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