<?
include_once("_common.php");

header("Content-Type: text/html; charset=utf-8");

//$mb_nick = trim($_POST[$mb_nick]);    // sideview�� ���
$mb_nick2 = trim($_POST[$mb_nick2]);  // sideview�� Ŭ���� ���
echo $mb_nick;
print_r($_POST);

if (strtolower($g4[charset]) == 'euc-kr') 
{
    $mb_nick = js_unescape($mb_nick);
    $mb_nick2 = js_unescape($mb_nick2);
}

// ��ȸ���� sideview�� �׳� return
if ($mb_nick == "[��ȸ��]") {
    $res = "<div>";
    $res .= "<ul class='list-unstyled'>";
    $res .= "<li>��ȸ���Դϴ�</li>";
    $res .= "</ul>";
    $res .= "</div>";
    echo iconv($g4['charset'], "UTF-8", $res);
    exit;
}

$mb = get_member_nick($mb_nick);
$mb2 = get_member_nick($mb_nick2);

$mb_id = $mb['mb_id'];

if ($mb_id =='undefined' || $mb_id == "") {
    echo "Error: 110"; // �Է��� �����ϴ�.
} else {
    $mb = get_member($mb_id);
    if ($mb[mb_id] == "") {
        echo "Error: 130"; // ���� ���̵�
    } else {
        // ������� return
        $res = "<div>";
        $res .= "<ul class='list-unstyled'>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">����������</a></li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">���Ϻ�����</a></li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">�ڱ�Ұ�</a></li>";
        $res .= "<li>���̵�ΰ˻�</li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">����Ʈ����</a></li>";
        $res .= "<li>��ü�Խù�</li>";
        $res .= "</ul>";
        $res .= "</div>";

        echo iconv($g4['charset'], "UTF-8", $res);

    }
}
?>
