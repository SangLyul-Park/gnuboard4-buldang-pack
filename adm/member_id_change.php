<?
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

// ������ id
$mb_id = "test3";
// ����� id (�ߺ� id�� �������� �����ڰ� ���� Ȯ���ؾ� �մϴ�)
$to_id = "test30";  

// ���� ��
//
// 1. Ȯ�� �ʵ忡 mb_id�� ����� ��쿡�� phpMyAdmin���� �����ؾ� �մϴ�
// 2. ��ǥ���̺��� mb_id�� ������Ʈ ���մϴ� (��ï�Ƽ� ���α׷� ���߾��)
// 3. �α��� ���̺� ������Ʈ ���մϴ�. ������ ������ �����ϱ��.
// 4. ������ ���̵�, ����� ���̵� ������ ��~~~ �Է��ϼ���.

//
echo "ȸ�� ���̵� $mb_id�� $to_id�� �����մϴ�<BR>";

// �Ҵ���
if (file_exists("$g4[path]/memo.config.php"))
    include_once("$g4[path]/memo.config.php");

$sql = " select count(*) as cnt from $g4[member_table] where mb_id = '$mb_id' ";
$result = sql_fetch($sql);

if (!$result[cnt])
    alert ("������ ���̵� $mb_id�� �����ϴ�. Ȯ���� �ٽ� ������ �ּ���");

$sql = " select count(*) as cnt from $g4[member_table] where mb_id = '$to_id' ";
$result = sql_fetch($sql);

if ($result[cnt]) 
    alert ("����� ���̵� $to_id�� �̹� �����մϴ�. Ȯ���� �ٽ� ������ �ּ���");

// �״����� db ���� ���� ---------------------------------------------------------------

// auth ���̺�
$sql = " update $g4[auth_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Խ��� ���̺� - bo_admin�� �������� ���̵� ���� ��쿡�� ����� �� �����ϴ�.
$sql = " update $g4[board_table] set bo_admin = '$to_id' where bo_admin = '$mb_id' ";
sql_query($sql, FALSE);

// ÷������ �ٿ�ε� ���̺�
$sql = " update $g4[board_file_table]_download set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Խ��� ��õ ���̺�
$sql = " update $g4[board_good_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �ֱٱ� ���̺�
$sql = " update $g4[board_new_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - �ֱٱ� ���̺�
$sql = " update $g4[board_new_table] set parent_mb_id = '$to_id' where parent_mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - ģ�� ���̺�
if ($g4[friend_table]) {
$sql = " update $g4[friend_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �׷����̺� - gr_admin�� �������� ���̵� ���� ��쿡�� ����� �� �����ϴ�.
$sql = " update $g4[group_table] set gr_admin = '$to_id' where gr_admin = '$mb_id' ";
sql_query($sql, FALSE);

// �׷�ȸ�� ���̺�
$sql = " update $g4[group_member_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - hidden_comment
if ($g4[hidden_comment_table]) {
$sql = " update $g4[hidden_comment_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - �α��� �������� ���̺�
if ($g4[login_fail_log_table]) {
$sql = " update $g4[login_fail_log_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ȸ���� ���̺�
if ($g4[mb_nick_table]) {
$sql = " update $g4[mb_nick_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// ȸ������ ���̺�
$sql = " update $g4[member_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - ȸ�������� ���� ���̺�
if ($g4[member_level_history_table]) {
$sql = " update $g4[member_level_history_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ����4 �׷�
if ($g4[memo_group_table]) {
$sql = " update $g4[memo_group_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ����4 �׷�ȸ�� ���̺�
if ($g4[memo_group_member_table]) {
$sql = " update $g4[memo_group_member_table] set gr_mb_id = '$to_id' where gr_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ����4 ���̺�
if ($g4[memo_recv_table]) {

$sql = " update $g4[memo_notice_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_notice_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_notice_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_recv_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_recv_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_recv_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_send_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_send_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_send_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_save_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_save_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_save_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_temp_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_temp_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_temp_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_spam_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_spam_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_spam_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

$sql = " update $g4[memo_trash_table] set recv_mb_id = '$to_id' where recv_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_trash_table] set send_mb_id = '$to_id' where send_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[memo_trash_table] set memo_owner = '$to_id' where memo_owner = '$mb_id' ";
sql_query($sql, FALSE);

//����4 - ÷������ ���丮 �̸�����
// ȸ�� ������ ���� ����
$mb_memo = "$g4[data_path]/memo2/$mb_id/";
$to_memo = "$g4[data_path]/memo2/$to_id/";
if (file_exists($mb_memo)) {
    rename($mb_icon, $to_memo);
}
}

// �Ҵ��� - ���� �湮�� ���̺�
if ($g4[my_board_table]) {
$sql = " update $g4[my_board_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ���̸޴� ���̺�
if ($g4[my_menu_table]) {
$sql = " update $g4[my_menu_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// ����Ʈ ���̺�
$sql = " update $g4[point_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// ��ǥ���̺��� mb_ids �ʵ�� �����ؼ� ��..��...

// ��ǥ - ��Ÿ�ǰ� ���̺�
$sql = " update $g4[poll_etc_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - �α�˻��� ���̺� Ȯ��
$sql = " update $g4[popular_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// ��ũ�� ���̺�
$sql = " update $g4[scrap_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - ��ũ�� ���̺� Ȯ��
$sql = " update $g4[scrap_table] set wr_mb_id = '$to_id' where wr_mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// �Ҵ��� - �Ű����̺�
if ($g4[singo_table]) {
$sql = " update $g4[singo_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);
$sql = " update $g4[singo_table] set sg_mb_id = '$to_id' where sg_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Ҵ��� - ����ڱ׷� ���̺� - ug_admin�� �������� ���̵� ���� ��쿡�� ����� �� �����ϴ�.
if ($g4[user_group_table]) {
$sql = " update $g4[user_group_table] set ug_mb_id = '$to_id' where ug_mb_id = '$mb_id' ";
sql_query($sql, FALSE);
}

// �Խ��� ���̺�
$sql = " select bo_table from $g4[board_table] ";
$result = sql_query($sql);

while ($row=sql_fetch_array($result)) {
    $sql = " update $g4[write_prefix]$row[bo_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
    sql_query($sql, FALSE);
}

// ����Ʈ��� ���̺� ����
$g4[point_tender_table] = $g4[table_prefix] . "auction_tender";     // ����Ʈ���
$sql = " update $g4[point_tender_table] set mb_id = '$to_id' where mb_id = '$mb_id' ";
sql_query($sql, FALSE);

// ȸ�� ������ ���� ����
$mb_icon = "$g4[data_path]/member/" . substr($mb_id ,0,2) . "/" . $mb_id;
$to_icon = "$g4[data_path]/member/" . substr($to_id ,0,2) . "/" . $to_id;
if (file_exists($mb_icon)) {
    rename($mb_icon, $to_icon);
}

echo "ȸ�� ���̵� ������ �Ϸ� �Ǿ����ϴ�<BR>";
?>
