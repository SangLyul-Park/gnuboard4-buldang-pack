<?
$sub_menu = "200110";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

$token = get_token();

$html_title = "����ڱ׷�";
if ($w == "") 
{
    $gr_id_attr = "required";
    $gr[gr_use_access] = 0;
    $html_title .= " ����";
} 
else if ($w == "u") 
{
    $gr_id_attr = "readonly style='background-color:#dddddd'";
    $gr = sql_fetch(" select * from $g4[user_group_table] where ug_id = '$gr_id' ");
    $html_title .= " ����";
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<form name=fboardgroup method=post action="javascript:fboardgroup_check(document.fboardgroup);" autocomplete="off">
<input type=hidden name=w    value='<?=$w?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=token value="<?=$token?>">

<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<colgroup width=20%>
<colgroup width=30%>
<colgroup width=20%>
<colgroup width=30%>
<tr>
    <td colspan=4><?=$html_title?></td>
</tr>
<tr>
    <td>�׷� ID</td>
    <td colspan=3><input type='text' class=ed name=gr_id size=11 maxlength=10 <?=$gr_id_attr?> alphanumericunderline itemname='�׷� ���̵�' value='<?=$gr[ug_id]?>'> ������, ����, _ �� ���� (�������)</td>
</tr>
<tr>
    <td>�׷� ����</td>
    <td colspan=3>
        <input type='text' class=ed name=gr_subject size=40 required itemname='�׷� ����' value='<?=get_text($gr[ug_subject])?>'>
        <? 
        if ($w == 'u')
            echo "<input type=button class='btn1' value='�׷�ȸ�����' onclick=\"location.href='./member_list.php?sfl=ug_id&stx=$gr[ug_id]';\">";
        ?>
    </td>
</tr>
<tr>
    <td>�׷� ������</td>
    <td colspan=3>
        <?
        if ($is_admin == "super")
            //echo get_member_id_select("gr_admin", 9, $row[gr_admin]);
            echo "<input type='text' class=ed name='gr_admin' value='$gr[ug_admin]' maxlength=20>";
        else
            echo "<input type=hidden name='gr_admin' value='$gr[ug_admin]' size=40>$gr[ug_admin]";
        ?></td>
</tr>

<? for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr>
    <td><input type=text class=ed name='gr_<?=$i?>_subj' value='<?=get_text($gr["ug_{$i}_subj"])?>' title='�����ʵ� <?=$i?> ����' style='text-align:right;font-weight:bold;' size=15></td>
    <td><input type='text' class=ed style='width:99%;' name=gr_<?=$i?> value='<?=$gr["ug_$i"]?>' title='�����ʵ� <?=$i?> ������'></td>
    <td><input type=text class=ed name='gr_<?=$k?>_subj' value='<?=get_text($gr["ug_{$k}_subj"])?>' title='�����ʵ� <?=$k?> ����' style='text-align:right;font-weight:bold;' size=15></td>
    <td><input type='text' class=ed style='width:99%;' name=gr_<?=$k?> value='<?=$gr["ug_$k"]?>' title='�����ʵ� <?=$k?> ������'></td>
</tr>
<? } ?>

</table>

<p align=center>
    <input type=submit class="btn btn-default" accesskey='s' value='  Ȯ  ��  '>&nbsp;
    <input type=button class="btn btn-default" value='  ��  ��  ' onclick="document.location.href='./ug_list.php?<?=$qstr?>';">
</form>

<script language='JavaScript'>
if (document.fboardgroup.w.value == '')
    document.fboardgroup.gr_id.focus();
else
    document.fboardgroup.gr_subject.focus();

function fboardgroup_check(f)
{
    f.action = "./ug_form_update.php";
    f.submit();
}
</script>

<?
include_once ("./admin.tail.php");
?>
