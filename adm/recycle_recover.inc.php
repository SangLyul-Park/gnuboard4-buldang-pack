<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ���� �Խ������� �̵� - bbs/delete.php�� �պκа� ����� �ڵ�
$recycle = "";

$rc_no = $_POST[rc_no];
$rc_row = sql_fetch(" select * from $g4[recycle_table] where rc_no = '$rc_no' ");
if ($rc_row) {

    // ������ �Ǵ� �۾��̰� �ƴϸ�, �ȵ˴ϴ�
    if ($is_admin == "super")
        ;
    else if ($member[mb_id] || $member[mb_id] == $rc_row[mb_id])
        ;
    else
        alert("������ �� ���� ���� �Դϴ�.");

    // recycle action���� ����
    $recycle = "recycle";

    // ����/�̵��� ���� log�� ������ �ʰ� ����
    $config[cf_use_copy_log] = 0;

    // ������ ������ �Խ����� ����
    $bo_table = $rc_row[rc_bo_table];
    
    // ������ �ʿ��� �������� ����
    $write_table = $g4[write_prefix] . $rc_row[rc_bo_table];
    $wr_id = $rc_row[rc_wr_id];

    $sql = " select * from $g4[write_prefix]$rc_row[rc_bo_table] where wr_id = '$wr_id' ";
    $write = sql_fetch($sql);

    // �Խñۿ� ���� �������� ������ �ƴϸ�, return
    if ($write[wr_id] !== $write[wr_parent])
        alert("���ۿ� ���ؼ��� ������ �۾� �Դϴ�");

    // ������ �Խ���
    $board['bo_move_bo_table'] = $rc_row[bo_table];
    $new_bo_table = sql_fetch(" select * from $g4[board_table] where bo_table = '$rc_row[bo_table]' ");

    // �Խñ��� ����
    include_once("$g4[bbs_path]/move2_update.php");
    
    // �������� ������ ����
    $sql2 = " delete from $g4[recycle_table] where rc_no = '$rc_no' ";
    sql_query($sql2);

    goto_url("./recycle_list.php?$qstr");
}
