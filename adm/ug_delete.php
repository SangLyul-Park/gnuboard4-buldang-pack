<?
$sub_menu = "200110";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if ($is_admin != "super")
    alert("����ڱ׷� ������ �ְ�����ڸ� �����մϴ�.");
    
check_token();

// ����� �׷� ����
sql_query(" delete from $g4[user_group_table] where ug_id = '$gr_id' ");

// ����� �׷� ȸ�� ���� �ʱ�ȭ 
sql_query(" update $g4[member_table] set ug_id = '' where ug_id = '$gr_id' ");

goto_url("ug_list.php?$qstr");
?>
