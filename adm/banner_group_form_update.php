<?
$sub_menu = "300910";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

if (!preg_match("/^([A-Za-z0-9_]{1,20})$/", $bg_id))
    alert("�׷� ID�� ������� ������, ����, _ �� ��� �����մϴ�. (20�� �̳�)");

if (!$bg_subject) alert("�׷� ������ �Է��ϼ���.");

check_token();

$bg_subject      = $_POST[bg_subject];
$bg_admin        = $_POST[bg_admin];  
$bg_desc         = $_POST[bg_desc];
$bg_use          = $_POST[bg_use];
$bg_width        = $_POST[bg_width];
$bg_height       = $_POST[bg_height];
$bg_1_subj       = $_POST[bg_1_subj];
$bg_2_subj       = $_POST[bg_2_subj];
$bg_3_subj       = $_POST[bg_3_subj];
$bg_1            = $_POST[bg_1];
$bg_2            = $_POST[bg_2];
$bg_3            = $_POST[bg_3];
                
$sql_common = " bg_subject      = '$bg_subject',
                bg_admin        = '$bg_admin',  
                bg_desc         = '$bg_desc',
                bg_use          = '$bg_use',
                bg_width        = '$bg_width',
                bg_height       = '$bg_height',
                bg_1_subj       = '$bg_1_subj',
                bg_2_subj       = '$bg_2_subj',
                bg_3_subj       = '$bg_3_subj',
                bg_1            = '$bg_1',
                bg_2            = '$bg_2',
                bg_3            = '$bg_3'
                ";

if ($w == "") 
{
    $sql = " select count(*) as cnt from $g4[banner_group_table] where bg_id = '$bg_id' ";
    $row = sql_fetch($sql);
    if ($row['cnt']) 
        alert("�̹� �����ϴ� �׷� ID �Դϴ�.");

    $sql = " insert into $g4[banner_group_table]
                set bg_id = '$bg_id',
                    $sql_common ";
    sql_query($sql);
} 
else if ($w == "u") 
{
    $sql = " update $g4[banner_group_table]
                set $sql_common
              where bg_id = '$bg_id' ";
    sql_query($sql);
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

goto_url("./banner_group_form.php?w=u&bg_id=$bg_id&$qstr");
?>