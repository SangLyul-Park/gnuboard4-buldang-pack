<?
$sub_menu = "300700";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if ($is_admin != "super")
    alert("������������ �ְ�����ڸ� �����մϴ�.");

$g4[title] = "������ ����";

include_once("./admin.head.php");
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

echo "<script>document.getElementById('ct').innerHTML += '<p>������ ������...';</script>\n";
flush();

// ȸ�� ���� �Լ� ��Ŭ���.
include_once("$g4[admin_path]/admin.lib.php");

$rc_datetime = $config[cf_recycle_days]; // �����뿡 ������ ������ �������� ���������� ����
$today_login_time = date("Y-m-d H:i:s", $g4['server_time'] - ($rc_datetime * 86400));

$sql = " update $g4[recycle_table] set rc_delete='1' where rc_datetime < '$today_login_time'";
sql_query($sql);

$j = mysql_modified_rows();

// �Խñ��� ������ ����
if ($ok == 1) {

}
?>
</table>

<br><br>

<?
echo "<script>document.getElementById('ct').innerHTML += '<p>�� ".$j."���� �������� ���� �Ǿ����ϴ�.';</script>\n";
?>

