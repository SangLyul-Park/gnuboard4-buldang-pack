<?
include_once("./_common.php");

//print_r2($GLOBALS);


if ($write[wr_2]) {
    echo "<script language='javascript'>alert('�̹� ä�� �Ǿ����ϴ�.');window.close();</script>";
    exit;
}

$sql = " select * from $write_table 
          where wr_parent = '$wr_id'
            and wr_id = '$comment_id' ";
$comment = sql_fetch($sql);
//print_r2($comment); exit;
//echo $sql; exit;

// �Խù���ȣ�� ���� �ڽ��� �Խù��� ���� ȸ�����̵���
// �ڸ�Ʈ ���̵� �����ϴ°��̶��
if ($write[wr_id] && $write[wr_id] == $wr_id && 
    $member[mb_id] && $member[mb_id] == $write[mb_id] &&
    $comment[wr_id] && $comment[wr_id] == $comment_id) {
    // ä�õ� ȸ������ bo_3�� ������ ����Ʈ ������ŭ�� �����Ѵ�
    insert_point($comment[mb_id], (int)($write[wr_1] * $board[bo_3]), "$board[bo_subject] $wr_id �亯ä��", $bo_table, $wr_id, '�亯ä��');
    //insert_point($comment[mb_id], (int)($write[wr_1] * 0.9), "$board[bo_subject] $wr_id �亯ä��", $bo_table, $wr_id, '�亯ä��');

    $sql = " update $write_table 
                set wr_2 = '$comment_id',
                    wr_3 = '$comment[mb_id]'
              where wr_id = '$wr_id' ";
    sql_query($sql);

//    echo "<script language='javascript'>alert('�亯�� ä���� ����Ʈ�� �ο��Ͽ����ϴ�.');window.close();</script>";
    echo "<script language='javascript'>top.location.reload();alert('�亯�� ä�� �Ͽ����ϴ�.');</script>";
    exit;
} else {
    echo "<script language='javascript'>alert('����');window.close();</script>";
    exit;
}    
?>
