<?
$sub_menu = "200120";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

check_token();

if ($is_admin != "super")
    alert("ȸ�� ���������� �ְ�����ڸ� �����մϴ�.");
    
$g4[title] = "ȸ����������";
include_once("./admin.head.php");

echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

// �������� ����� �غ� (�ְ� ������ ����� ��� ���)
$sql = " select mb_id from $g4[member_table] where mb_id <> '$config[cf_admin]' ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    // �Խ��� �����ڸ� ���� ��󿡼� �����Ѵ�
    $bo = sql_fetch(" select count(*) as cnt from $g4[board_table] where bo_admin = '$row[mb_id]' ");
    // �׷� �����ڸ� ���� ��󿡼� �����Ѵ�
    $gr = sql_fetch(" select count(*) as cnt from $g4[group_table] where gr_admin = '$row[mb_id]' ");
    if ($bo[cnt] > 0 || $gr[cnt] > 0)
        ;
    else {
        member_level_up($row[mb_id]);
    }
}

echo "<script>document.getElementById('ct').innerHTML += '<a href=\'" . $g4[admin_path] . "/member_level_list.php\'>ȸ������������ �̵��ϱ�</a>'</script>\n";
?>