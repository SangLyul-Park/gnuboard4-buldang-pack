<?
include_once("./_common.php");

$po_id = (int) $_POST[po_id];
$mb_id = $member[mb_id];

if ($w == "add") 
{
    if (!$mb_id)
        alert("ȸ���� �������� �մϴ�. �α��� �Ͻñ� �ٶ��ϴ�");

    // �̺�Ʈ���� �ѹ��� ���� ����
    $sql = " select count(*) as cnt from $g4[promotion_sign_table] where po_id = '$po_id' and mb_id = '$mb_id' ";
    $my = sql_fetch($sql);
    if ($my[cnt] > 1)
        alert("�̺�Ʈ ���� Ƚ���� �ʰ� �߽��ϴ�. �̺�Ʈ ���� ����� Ȯ���� �ּ���.", "./promotion.php");

    // ��й�ȣ ����
    $po_password = rand(1000, 9999); 

    // url�� ����
    $po_url = time() . "_" . sql_password($po_password);

    // promotion ��û ������ insert
    $sql = " insert $g4[promotion_sign_table] set 
                    po_id = '$po_id',
                    mb_id = '$mb_id',
                    po_datetime = '$g4[time_ymdhis]',
                    po_password = '$po_password',
                    po_url = '$po_url'
            ";
    sql_query($sql);

    goto_url("./promotion.php?");
} if ($w == "check") {
  
    $sql = " select * from $g4[promotion_sign_table] where po_url = '$po_url' and po_password = '$po_password' ";
    $my = sql_fetch($sql);

    if ($my[po_id]) {
        $mb = get_member($my[mb_id] , "mb_nick");
        $po = sql_fetch(" select * from $g4[promotion_table] where po_id = '$my[po_id]'");
        echo "$mb[mb_nick] ���� $po[po_name] �� ���� �߽��ϴ�.";
    } else {
        alert("��ȿ���� ���� ���θ�� ���� �Դϴ�");
    }
}
?>
