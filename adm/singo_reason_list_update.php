<?
$sub_menu = "300555";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "w");

check_token();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.");

for ($i=0; $i<count($chk); $i++) 
{
    // ���� ��ȣ�� �ѱ�
    $k = $chk[$i];

    $sql = " update $g4[singo_reason_table]
                set sg_reason = '{$_POST['sg_reason'][$k]}',
                    sg_print  = '{$_POST['sg_print'][$k]}',
                    sg_use    = '{$_POST['sg_use'][$k]}'
              where sg_id = '{$_POST['chk_sg_id'][$k]}' ";
    sql_query($sql);
}

goto_url("./singo_reason_list.php?$qstr");
?>