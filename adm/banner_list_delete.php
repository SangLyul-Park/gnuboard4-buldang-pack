<?
$sub_menu = "300900";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("��� ������ �ְ�����ڸ� �����մϴ�.");

auth_check($auth[$sub_menu], "d");

check_token();

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

    $bn_id = trim($_POST['bn_id'][$k]);

    $sql = " delete from $g4[banner_table] where bn_id = '$bn_id' ";
    sql_query($sql);

    $bn = sql_fetch(" select * from $g4[banner_table] where bn_id = '$bn_id' ");

    if ($bn[bn_image]) {
        $banner_path = "$g4[data_path]/banner/$bn[bg_id]";
        @unlink("$banner_path/$bn[bn_image]");
    }
}

goto_url("./banner_list.php?$qstr");
?>
