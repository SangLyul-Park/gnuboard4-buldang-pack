<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

if ($is_admin !== "super") {
    if (!$member[mb_id])
        alert("���� ������ �����ϴ�.\\n\\nȸ���̽ö�� �α��� �� �̿��� ���ʽÿ�.", "login.php?$qstr&url=".urlencode("$_SERVER[PHP_SELF]?bo_table=$bo_table"));
    else {
        $sfl = "mb_id";
        $stx = "$member[mb_id]";
    }
}
?>
