<?
include_once("_common.php");

if (trim($mb_id)=='') {
    echo "110"; // �Է��� �����ϴ�.
} else {
    $mb = get_member($mb_id);
    if ($row[mb_id] == "") {
        echo "130"; // ���� ���̵�
    } else {
        // ������� return
    }
}
?>
