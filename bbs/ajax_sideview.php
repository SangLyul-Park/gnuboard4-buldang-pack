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
        $res = "<div>";
        $res .= "<ul class='list-unstyled'>";
        $res .= "<li>����������</li>";
        $res .= "<li>���Ϻ�����</li>";
        $res .= "<li>�ڱ�Ұ�</li>";
        $res .= "<li>���̵�ΰ˻�</li>";
        $res .= "<li>����Ʈ����</li>";
        $res .= "<li>��ü�Խù�</li>";
        $res .= "</ul>";
        $res .= "</div>";

        echo iconv($g4['charset'], "UTF-8", $res);

    }
}
?>
