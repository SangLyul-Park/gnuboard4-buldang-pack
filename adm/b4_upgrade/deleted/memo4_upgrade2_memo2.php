<?
$sub_menu = "100600";
include_once("./_common.php");
include_once("$g4[path]/memo.config.php");

check_demo();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "����4 - ���׷��̵�(2)";
include_once("./admin.head.php");

// memo2 ÷������ ���丮�� ����
$dir_name = $g4[path] . "/data/memo2";
if(!is_dir($dir_name)){
    @mkdir("$dir_name", 0707);
    @chmod("$dir_name", 0707);
}

// ����2�� ����ϴ� ���
$html = "html1";

$sql = " update $g4[memo_recv_table] set me_option = '$html,$secret,$mail' ";
sql_query($sql, false);

$sql = " update $g4[memo_send_table] set me_option = '$html,$secret,$mail' ";
sql_query($sql, false);

$sql = " update $g4[memo_save_table] set me_option = '$html,$secret,$mail' ";
sql_query($sql, false);

echo "UPGRADE �Ϸ�.";

include_once("./admin.tail.php");
?>
