<?
$sub_menu = "300900";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("��� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

check_token();

$bn = sql_fetch(" select * from $g4[banner_table] where bn_id = '$bn_id' ");

$sql = " delete from $g4[banner_table] where bn_id = '$bn_id' ";
sql_query($sql);

if ($bn[bn_image]) {
    $banner_path = "$g4[data_path]/banner/$bn[bg_id]";
    @unlink("$banner_path/$bn[bn_image]");
}

goto_url("./banner_list.php?$qstr");
?>
