<?
$sub_menu = "200300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[mail_table] ";

// ���̺��� ��ü ���ڵ���� ����
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$page = 1;

$sql = "select * $sql_common order by ma_id desc ";
$result = sql_query($sql);

$g4[title] = "ȸ�����Ϲ߼�";
include_once("./admin.head.php");
?>

<div class="btn-group">
    �Ǽ� : <? echo $total_count ?>&nbsp;
</div>

<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<tr class='success'>
    <td width=40>ID</td>
    <td width=''>����</td>
    <td width=120>�ۼ��Ͻ�</td>
    <td width=50>�׽�Ʈ</td>
    <td width=50>������</td>
    <td width=80><a href='./mail_form.php'><i class='fa fa-plus-square fa-2x' title='����'></i></a></td>
</tr>
<?
for ($i=0; $row=mysql_fetch_array($result); $i++) {
    $s_mod = "<a href=\"./mail_form.php?w=u&ma_id=$row[ma_id]\"><i class='fa fa-pencil' title='����'></i></a>";
    $s_del = "<a href=\"javascript:post_delete('mail_update.php', '$row[ma_id]');\"><i class='fa fa-trash-o' title='����'></i></a>";
    $s_vie = "<a href=\"./mail_preview.php?ma_id=$row[ma_id]\" target=_blank><i class='fa fa-external-link' title='����'></i></a>";

    $num = number_format($total_count - ($page - 1) * $config[cf_page_rows] - $i);

    $list = $i%2;
    echo "
    <tr>
        <td>$num</td>
        <td>$row[ma_subject]</td>
        <td>" . get_datetime($row[ma_time]) . "</td>
        <td><a href='./mail_test.php?ma_id=$row[ma_id]'>�׽�Ʈ</a></td>
        <td><a href='./mail_select_form.php?ma_id=$row[ma_id]'>������</a></td>
        <td>$s_mod&nbsp;&nbsp;$s_del&nbsp;&nbsp;$s_vie</td>
    </tr>";
}

if (!$i)
    echo "<tr><td colspan='6' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>";
?>
</table>

<script type="text/javascript">
// POST ������� ����
function post_delete(action_url, val)
{
	var f = document.fpost;

	if(confirm("�ѹ� ������ �ڷ�� ������ ����� �����ϴ�.\n\n���� �����Ͻðڽ��ϱ�?")) {
        f.ma_id.value = val;
		f.action      = action_url;
		f.submit();
	}
}
</script>

<form name='fpost' method='post'>
<input type='hidden' name='sst'  value='<?=$sst?>'>
<input type='hidden' name='sod'  value='<?=$sod?>'>
<input type='hidden' name='sfl'  value='<?=$sfl?>'>
<input type='hidden' name='stx'  value='<?=$stx?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='w'    value='d'>
<input type='hidden' name='ma_id'>
</form>

<?
include_once ("./admin.tail.php");
?>
