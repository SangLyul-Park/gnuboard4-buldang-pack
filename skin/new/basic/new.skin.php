<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<? if ($is_admin) { ?>
<script type="text/javascript">
function all_checked(sw) {  //ssh
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function select_new_batch(sw){////ssh06-04-12
    var f = document.fboardlist;
    str = "����";
    f.sw.value = sw;
    //f.target = "hiddenframe";

    if (!confirm("������ �Խù��� ���� "+str+" �Ͻðڽ��ϱ�?\n\n�ѹ� "+str+"�� �ڷ�� ������ �� �����ϴ�"))
        return;

    f.action = "<?=$g4[admin_path]?>/ssh_delete_spam.php";
    f.submit();
}
</script>
<? } ?>

<!-- �з� ���� -->
<form name=fnew method=get role="form" class="form-inline" style="margin-bottom:5px;">
<a class="btn btn-default" href="<?=$g4[bbs_path]?>/new.php">ó������</a>
<div class="pull-right">
    <?=$group_select?>
    <select class="form-control" id=view_type name=view_type onchange="select_change()">
        <option value=''>���۸�
        <option value='c'>�ڸ�Ʈ��
        <option value='a'>��ü�Խù�
    </select>

    <div class="form-group">
        <input class="form-control" type="text" id="mb_id" name="mb_id" value="<?=$mb_id?>" placeholder="ȸ�� ���̵�">
    </div>
    <input class="btn btn-default" type=submit value='�˻�'>
</div>

<script type="text/javascript">
function select_change() {
    var f = document.fnew;

    f.action = "<?=$g4[bbs_path]?>/new.php";
    f.submit();
}

document.getElementById("gr_id").value = "<?=$gr_id?>";
document.getElementById("view_type").value = "<?=$view_type?>";
</script>
</form>
<!-- �з� �� -->

<form name="fboardlist" method="post" style="margin:0px;">
<input type="hidden" name="sw"   value="">	
<input type="hidden" name="gr_id"   value="<?=$gr_id?>">	
<input type="hidden" name="view"   value="<?=$view_type?>">	
<input type="hidden" name="mb_id"   value="<?=$mb_id?>">	

<!-- ���� ���� -->
<table width="100%" class="table table-hover">
<tr class="success" align=center> 
    <td class="col-sm-1">�׷�</td>
    <td class="col-sm-2">�Խ���</td>
    <td width="" align=left>
        <?  if ($is_admin == "super") { ?>
            <INPUT onclick="if (this.checked) all_checked(true); else all_checked(false);" type=checkbox>&nbsp;&nbsp;
        <? } ?>
        ����
    </td>
    <td align=center class="col-sm-1 hidden-xs">�۾���</td>
    <td align=center class="col-sm-1 hidden-xs">��¥</td>
</tr>

<?
for ($i=0; $i<count($list); $i++) 
{
    $gr_subject = cut_str($list[$i][gr_subject], 10);
    $bo_subject = cut_str($list[$i][bo_subject], 10);
    $wr_subject = get_text(cut_str($list[$i][wr_subject], 40));

    echo <<<HEREDOC
<tr> 
    <td align="center" height="30"><a href='./new.php?gr_id={$list[$i][gr_id]}'>{$gr_subject}</a></td>
    <td align="center"><a href='./new.php?bo_table_search={$list[$i][bo_table]}&mb_id=$mb_id&gr_id=$gr_id'>{$bo_subject}</a></td>
    <td width="">
HEREDOC;

    if ($is_admin) {
      if ($list[$i][comment])
          echo "<input type=checkbox name=chk_wr_id[] value='{$list[$i][comment_id]}|{$list[$i][bo_table]}'>";
      else
          echo "<input type=checkbox name=chk_wr_id[] value='{$list[$i][wr_id]}|{$list[$i][bo_table]}'>";
    }

    // �ڸ�Ʈ ������ ���
    $comment_cnt = "";
    if (!$list[$i][comment] && $list[$i][wr_comment] > 0)
        $comment_cnt = " <span style='font-family:Tahoma;font-size:10px;color:#EE5A00;'>({$list[$i][wr_comment]})</span>";

    echo <<<HEREDOC2
    &nbsp;<a href='{$list[$i][href]}'>{$list[$i][comment]}{$wr_subject}</a> {$comment_cnt}
    <div class="visible-xs">{$list[$i][name]} <small>{$list[$i][datetime2]}</small>
    </div>
    </td>
    <td align=center class="hidden-xs">{$list[$i][name]}</td>
    <td align=center class="hidden-xs">{$list[$i][datetime2]}</td>
</tr>
HEREDOC2;
}
?>

<? if ($i == 0) { ?>
<tr><td colspan="5" height=50 align=center>�Խù��� �����ϴ�.</td></tr>
<? } ?>
</table>

<? if ($is_admin == "super") { ?>
    <a class="btn btn-default pull-right" href="javascript:select_new_batch('d');">���û���</a>
<? } ?>

<div class="center-block">
    <ul class="pagination">
    <? if ($prev_part_href) { echo "<li><a href='$prev_part_href'>�����˻�</a></li>"; } ?>
    <?
    // �⺻���� �Ѿ���� �������� �Ʒ��� ���� ��ȯ�Ͽ� �پ��ϰ� ����� �� �ֽ��ϴ�.
    $write_pages = str_replace("����", "<i class='fa fa-angle-left'></i>", $write_pages);
    $write_pages = str_replace("����", "<i class='fa fa-angle-right'></i>", $write_pages);
    $write_pages = str_replace("ó��", "<i class='fa fa-angle-double-left'></i>", $write_pages);
    $write_pages = str_replace("�ǳ�", "<i class='fa fa-angle-double-right'></i>", $write_pages);
    ?>
    <?=$write_pages?>
    <? if ($next_part_href) { echo "<li><a href='$next_part_href'>���İ˻�</a></li>"; } ?>
    </ul>
</div>
</form>
