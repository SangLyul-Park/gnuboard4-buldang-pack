<?
$sub_menu = "200110";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super" && $w == "") alert("�ְ�����ڸ� ���� �����մϴ�.");

check_token();

if (!preg_match("/^([A-Za-z0-9_]{1,10})$/i", $gr_id))
    alert("�׷� ID�� ������� ������, ����, _ �� ��� �����մϴ�. (10�� �̳�)");

if (!$gr_subject) alert("�׷� ������ �Է��ϼ���.");

$ug_subject      = $_POST[gr_subject];
$ug_admin        = $_POST[gr_admin];  
$ug_1_subj       = $_POST[gr_1_subj];
$ug_2_subj       = $_POST[gr_2_subj];
$ug_3_subj       = $_POST[gr_3_subj];
$ug_4_subj       = $_POST[gr_4_subj];
$ug_5_subj       = $_POST[gr_5_subj];
$ug_1            = $_POST[gr_1];
$ug_2            = $_POST[gr_2];
$ug_3            = $_POST[gr_3];
$ug_4            = $_POST[gr_4];
$ug_5            = $_POST[gr_5];
                
$sql_common = " ug_subject      = '$gr_subject',
                ug_admin        = '$gr_admin',  
                ug_1_subj       = '$gr_1_subj',
                ug_2_subj       = '$gr_2_subj',
                ug_3_subj       = '$gr_3_subj',
                ug_4_subj       = '$gr_4_subj',
                ug_5_subj       = '$gr_5_subj',
                ug_1            = '$gr_1',
                ug_2            = '$gr_2',
                ug_3            = '$gr_3',
                ug_4            = '$gr_4',
                ug_5            = '$gr_5'
                ";

if ($w == "") 
{
    $sql = " select count(*) as cnt from $g4[user_group_table] where ug_id = '$gr_id' ";
    $row = sql_fetch($sql);
    if ($row[cnt]) 
        alert("�̹� �����ϴ� �׷� ID �Դϴ�.");

    $sql = " insert into $g4[user_group_table]
                set ug_id = '$gr_id',
                    $sql_common ";
    sql_query($sql);
} 
else if ($w == "u") 
{
    $sql = " update $g4[user_group_table]
                set $sql_common
              where ug_id = '$gr_id' ";
    sql_query($sql);
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

goto_url("./ug_form.php?w=u&gr_id=$gr_id&$qstr");
?>
