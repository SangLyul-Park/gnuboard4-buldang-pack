<?
$sub_menu = "300910";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

$html_title = "��ʱ׷�";
if ($w == "") 
{
    $bg_id_attr = "required";
    $gr[bg_use] = 1;
    $html_title .= " ����";
} 
else if ($w == "u") 
{
    $bg_id_attr = "readonly style='background-color:#dddddd'";
    $bg = sql_fetch(" select * from $g4[banner_group_table] where bg_id = '$bg_id' ");
    $html_title .= " ����";
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<form name=fboardgroup method=post onsubmit="return fboardgroup_check(this);" autocomplete="off">
<input type=hidden name=w     value='<?=$w?>'>
<input type=hidden name=sfl   value='<?=$sfl?>'>
<input type=hidden name=stx   value='<?=$stx?>'>
<input type=hidden name=sst   value='<?=$sst?>'>
<input type=hidden name=sod   value='<?=$sod?>'>
<input type=hidden name=page  value='<?=$page?>'>
<input type=hidden name=token value='<?=$token?>'>
<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<colgroup width=20% class='col1 pad1 bold right'>
<colgroup width=30% class='col2 pad2'>
<tr class='ht'>
    <td colspan=4 class=title align=left><img src='<?=$g4[admin_path]?>/img/icon_title.gif'> <?=$html_title?></td>
</tr>
<tr><td colspan=4 class='line1'></td></tr>
<tr class='ht'>
    <td>�׷� ID</td>
    <td colspan=3><input type='text' class=ed name=bg_id size=21 maxlength=20 <?=$bg_id_attr?> alphanumericunderline itemname='�׷� ���̵�' value='<?=$group[gr_id]?>'> ������, ����, _ �� ���� (�������)</td>
</tr>
<tr class='ht'>
    <td>�׷�����</td>
    <td colspan=3>
        <input type='text' class=ed name=bg_subject size=40 required itemname='�׷� ����' value='<?=get_text($group[bg_subject])?>'>
        <? 
        if ($w == 'u')
            echo "<input type=button class='btn1' value='�Խ��ǻ���' onclick=\"location.href='./banner_form.php?bg_id=$bg_id';\">";
        ?>
    </td>
</tr>
<tr class='ht'>
    <td>�׷�޸�</td>
    <td colspan=3>
        <textarea class=ed name=bg_desc rows=5 style='width:80%;'><?=$bg[bg_desc] ?></textarea></td>
    </td
</tr>
<tr class='ht'>
    <td>��ʱ׷� ���</td>
    <td colspan=3>
        <input type=checkbox name=bg_use value='1' <?=$gr[bg_use]?'checked':'';?>>���
    </td>
</tr>
<tr class='ht'>
    <td>��ʻ����</td>
    <td colspan=3>
        <input type=text class=ed name=bg_type size=5 value='<?=$gr[bg_type]?>'> (1. 2. 3.)
    </td>
</tr>
<tr class='ht'>
    <td>��� ũ��(px)</td>
    <td colspan=3>
        ���� <input type='text' class=ed name=bg_width size=8 required itemname='��ʳ���' value='<?=$group[bg_width]?>'> px <BR>
        ���� <input type='text' class=ed name=bg_height size=8 required itemname='��ʳ���' value='<?=$group[bg_height]?>'> px
    </td>
</tr>

<tr><td colspan=4 class='line2'></td></tr>
</table>

<p align=center>
    <input type=submit class=btn1 accesskey='s' value='  Ȯ  ��  '>&nbsp;
    <input type=button class=btn1 value='  ��  ��  ' onclick="document.location.href='./banner_group_list.php?<?=$qstr?>';">
</form>

<script language='JavaScript'>
if (document.fboardgroup.w.value == '')
    document.fboardgroup.gr_id.focus();
else
    document.fboardgroup.gr_subject.focus();

function fboardgroup_check(f)
{
    f.action = "./boardgroup_form_update.php";
    return true;
}
</script>

<?
include_once ("./admin.tail.php");
?>
