<?
$sub_menu = "300555";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

$html_title = "�Ű����";

$sg_id = (int)$sg_id;

if ($w == "") 
{
    $sg['sg_print'] = 1;
    $sg['sg_use'] = 1;
} 
else if ($w == "u") 
{
    $sg = sql_fetch(" select * from $g4[singo_reason_table] where sg_id = '$sg_id' ");
    $html_title .= " ����";
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<form name=fsgreason method=post onsubmit="return fsgreason_check(this);" autocomplete="off" role="form" class="form-inline">
<input type=hidden name=w     value='<?=$w?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>

<input type=hidden name=sg_id value='<?=$sg_id?>'>

<table width=100%  class="table table-condensed table-hover" style="word-wrap:break-word;">
<colgroup width=100px>
<colgroup width="">
<tr class='success'>
    <td colspan=2><?=$html_title?></td>
</tr>
<tr>
    <td>�Ű����</td>
    <td><input class="form-control col-xs-4" type='text' name=sg_reason size=21 maxlength=20 itemname='�Ű����' value='<?=$sg[sg_reason]?>'></td>
</tr>
<tr>
    <td>�Ű�������</td>
    <td>
        <input type=checkbox name=sg_print value='1' <?=$sg[sg_print]?'checked':'';?>>
        <?=help("��뿡 üũ�Ͻø� �Ű�� �Խ��ǿ� �Ű������ ��µ˴ϴ�.")?>
    </td>
</tr>
<tr>
    <td>���</td>
    <td>
        <input type=checkbox name=sg_use value='1' <?=$sg[sg_use]?'checked':'';?>>
    </td>
</tr>
</table>

<p align=center>
    <input type=submit class="btn btn-default" accesskey='s' value='  Ȯ  ��  '>&nbsp;
    <input type=button class="btn btn-default" value='  ��  ��  ' onclick="document.location.href='./singo_reason_list.php?<?=$qstr?>';">
</form>

<script type="text/javascript">
function fsgreason_check(f)
{
    f.action = "./singo_reason_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>