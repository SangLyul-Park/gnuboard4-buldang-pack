<?
$sub_menu = "300555";
include_once("./_common.php");

if ($w == 'u')
    check_demo();

auth_check($auth[$sub_menu], "w");

if ($w == "")
{
    $sql = " select count(*) as cnt from $g4[singo_reason_table] where sg_reason = '$sg_reason' ";	
    $sg = sql_fetch($sql);
    if ($sg['cnt'] >= 1)
        alert("�̹� �����ϴ� ���� �Դϴ�"); 

    $sql = " insert into $g4[singo_reason_table]
                set sg_reason = '$sg_reason',
                    sg_print = '$sg_print',
                    sg_use = '$sg_use',
                    sg_datetime = '$g4[time_ymdhis]'
                    ";
    sql_query($sql);
}

else if ($w == "u") 
{
    if ($is_admin != "super")
        alert("�����ڸ��� �����ϽǼ� �ֽ��ϴ�..");

    $sql = " update $g4[singo_reason_table]
                set sg_reason = '$sg_reason',
                    sg_print = '$sg_print',
                    sg_use = '$sg_use' 
              where sg_id = '$sg_id' ";	
    sql_query($sql);
} 
else
    alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.");

goto_url("./singo_reason_list.php");
?>
