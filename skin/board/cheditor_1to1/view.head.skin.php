<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($is_admin !== "super") {
    if (!$is_member)
        alert("��ȸ���� ������ �� �����ϴ� ");
    else if ($write[mb_id] !== $member[mb_id])
        // �ַ� �޽����� �߸��ϰ�. ����
        alert("�˼����� ���� �Դϴ�. ��ڿ��� �����ϼ���.", $g4[url]); 
}
?>
