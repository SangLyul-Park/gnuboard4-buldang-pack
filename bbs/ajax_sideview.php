<?
include_once("_common.php");

if (trim($mb_id)=='undefined') {
    echo "Error: 110"; // �Է��� �����ϴ�.
} else {
    $mb = get_member($mb_id);
    if ($mb[mb_id] == "") {
        echo "Error: 130"; // ���� ���̵�
    } else {
        // ������� return
        $res = "����������";
        echo iconv($g4['charset'], "UTF-8", $res);

    }
}
?>
