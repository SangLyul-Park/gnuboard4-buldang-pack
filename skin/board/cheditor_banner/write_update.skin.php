<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// �ڽŸ��� �ڵ带 �־��ּ���.

// �Խñ� ��Ͻ� ������� ����Ʈ�� ����
if ($board[bo_4]) {
    // �Խù��� �ѹ��� �����ϵ��� ����
    insert_point($member[mb_id], -1 * $board[bo_4], "$board[bo_subject] $wr_id ��ʵ��", $bo_table, $wr_id, "��ʵ��");
}
?>
