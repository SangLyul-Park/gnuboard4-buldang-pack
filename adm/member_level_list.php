<?
$sub_menu = "200500";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$g4[title] = "ȸ���������";
include_once("./admin.head.php");

$sql = " select * from $g4[member_level_table] where member_level >= 2 order by member_level asc";
$result = sql_query($sql);

$colspan = 11;
if ($g4['singo_table'])
    $colspan = $colspan + 1;
?>

<script language="JavaScript">
var list_update_php = "member_level_update.php";
</script>

<table width=100%>
<tr>
    <td align=left><?=$listall?>&nbsp;&nbsp;ȸ�� ������ ������ �����մϴ�.</td>
    <td><a href="./member_level_execute.php">����������</a></td>
</tr>
</table>

<form name=fmember_list method=post>
<input type=hidden name=token value='<?=$token?>'>
<table width=100% cellpadding=0 cellspacing=0>
<colgroup width=30>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width=60>
<colgroup width="">
	<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
	<tr class='bgcol1 bold col1 ht center'>
    <td rowspan=2><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
    <td rowspan=2>ȸ������</td>
    <td>������</td>
		<td>�ּ��ϼ�</td>
		<td>�� �� Ʈ</td>
		<td>�Խñۼ�</td>
		<td>��ü�ۼ�</td>
		<td>�����ϼ�</td>
		<td>�� õ ��</td>
		<td></td>
    <? if ($g4['singo_table']) { ?>
		<td></td>
		<? } ?>
		<td rowspan=2><a href='./member_level_history.php'>HISTORY</a></td>
	</tr>
	<tr class='bgcol1 bold col1 ht center'>
    <td>�����ٿ�</td>
    <td></td>
		<td>�� �� Ʈ</td>
		<td>�Խñۼ�</td>
		<td>��ü�ۼ�</td>
		<td>�����ϼ�</td>
		<td></td>
		<td>����õ��</td>
    <? if ($g4['singo_table']) { ?>
		<td>�Ű�Ǽ�</td>
		<? } ?>
	</tr>
	<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list = $i%2;
?>    
    <input type=hidden name="member_level[<?=$i?>]" value='<?=$row[member_level]?>'>
    <tr class='list<?=$list?> col1 ht center'>
        <td rowspan=2><input type="checkbox" name="chk[]" value='<?=$i?>'></td>
        <td>&nbsp;<?=$row[member_level]?>��<?=$row[member_level]+1?></td>
        <td><input type="checkbox" name="use_levelup[<?=$i?>]" value='1' <?=$row[use_levelup]?'checked':'';?>></td>
        <td><input type=text class=ed name="up_days[<?=$i?>]" size=8 itemname='������ �ּ��ϼ�' value='<?=$row[up_days]?>'></td>
        <td><input type=text class=ed name="up_point[<?=$i?>]" size=8 itemname='������ ����Ʈ' value='<?=$row[up_point]?>'></td>
        <td><input type=text class=ed name="up_post[<?=$i?>]" size=8 itemname='������ �Խñۼ�' value='<?=$row[up_post]?>'></td>
        <td><input type=text class=ed name="up_post_all[<?=$i?>]" size=8 itemname='������ ��ü�ۼ�' value='<?=$row[up_post_all]?>'></td>
        <td><input type=text class=ed name="up_audit_days[<?=$i?>]" size=8 itemname='������ �����Ⱓ(��õ)' value='<?=$row[up_audit_days]?>'></td>
        <td><input type=text class=ed name="good[<?=$i?>]" size=8 itemname='������ ��õ��' value='<?=$row[good]?>'></td>
        <td></td>
        <? if ($g4['singo_table']) { ?>
        <td></td>
        <? } ?>
        <td><a href='./member_level_history.php?sst=id&sod=desc&sfl=from_level&stx=<?=$row[member_level]?>'>������</a></td>
    </tr>
    <tr class='list<?=$list?> col1 ht center'>
        <td>&nbsp;<?=$row[member_level]?>��<?=$row[member_level]-1?></td>
        <td><input type="checkbox" name="use_leveldown[<?=$i?>]" value='1' <?=$row[use_leveldown]?'checked':'';?>></td>
        <td></td>
        <td><input type=text class=ed name="down_point[<?=$i?>]" size=8 itemname='�����ٿ� ����Ʈ' value='<?=$row[down_point]?>'></td>
        <td><input type=text class=ed name="down_post[<?=$i?>]" size=8 itemname='�����ٿ� �Խñۼ�' value='<?=$row[down_post]?>'></td>
        <td><input type=text class=ed name="down_post_all[<?=$i?>]" size=8 itemname='�����ٿ� ��ü�ۼ�' value='<?=$row[down_post_all]?>'></td>
        <td><input type=text class=ed name="down_audit_days[<?=$i?>]" size=8 itemname='������ �����Ⱓ(����õ.�Ű�)' value='<?=$row[down_audit_days]?>'></td>
        <td></td>
        <td><input type=text class=ed name="nogood[<?=$i?>]" size=8 itemname='�����ٿ� ����õ��' value='<?=$row[nogood]?>'></td>
        <? if ($g4['singo_table']) { ?>
        <td><input type=text class=ed name="singo[<?=$i?>]" size=8 itemname='�����ٿ� �Ű�Ǽ�' value='<?=$row[singo]?>'></td>
        <? } ?>
        <td><a href='./member_level_history.php?sst=id&sod=desc&sfl=to_level&stx=<?=($row[member_level]-1)?>'>�����ٿ�</a></td>
    </tr>
  	<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
}
?>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>

<table width=100% cellpadding=3 cellspacing=1>
	<tr>
		<td width=50%><input type=button class='btn1' value='���ü���' onclick="btn_check(this.form, 'update')"></td>
		<td width=50% align=right></td>
	</tr>
</table>

<table width=100% cellpadding=0 cellspacing=0>
	<tr class='bgcol1 col1 ht left'>
		<td width=60px>������</td>
		<td>
		�ּ��ϼ� : ȸ�������� �ٷ� �������� �õ��ϴ� ����� �����ϱ� ����, �ּ� ���� �ð��� ����� ������ �����ϰ� ��<br>
		�����ϼ� : �Խñ�, ��ü���� ���ڸ� ������ �� ����ϴ� �Ⱓ (��ü �Ⱓ���� �Խñ�, ��ü�ۼ��� üũ �ϴ°� ��...<br>
    ��õ���� : �ּ��ϼ� 1�� (������ �ٷ� ������ �õ��ϴ� ���� ���и�...) + ����Ʈ 5500(���� Ȱ��)
		</td>
	</tr>
	<tr class='bgcol1 col1 ht left'>
		<td width=60px>�����ٿ�</td>
		<td>
    �����ٿ��� �ý������� �ϴ� ���� ������ ������ ������ �����Ƿ� ��õ���� �ʽ��ϴ�.<br>
    ��õ���� : �Ű�Ǽ� 5���̻� (�̰��� ���и� ���� �����ϱ� ���� ���ε�, �Ⱦ��°� �����ϴ�)
		</td>
	</tr>
</table>

</form>

<?
include_once ("./admin.tail.php");
?>
