<?
$sub_menu = "300910";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�Խ��Ǳ׷� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

check_token();

$bg_id = mysql_real_escape_string(trim($_POST['bg_id']));
$row = sql_fetch(" select count(*) as cnt from $g4[banner_table] where bg_id = '$bg_id' ");
if ($row[cnt])
    alert("�� �׷쿡 ���� ��ʰ� �����Ͽ� ��� �׷��� ������ �� �����ϴ�.\\n\\n�� �׷쿡 ���� ��ʸ� ���� �����Ͽ� �ֽʽÿ�.", "./banner_list.php?sfl=bg_id&stx=$bg_id");


// �׷� ����
sql_query(" delete from $g4[banner_group_table] where bg_id = '$bg_id' ");

goto_url("banner_group_list.php?$qstr");
?>
