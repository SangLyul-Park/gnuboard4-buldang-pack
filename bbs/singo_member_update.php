<?
include_once("./_common.php");
include_once("$g4[path]/memo.config.php");

include_once("$g4[path]/head.sub.php");

// ȸ������ �˻��Ͽ� ȸ���� �ƴ� ��쿡�� �α��� �������� �̵��Ѵ�.
if (!$member[mb_id]) 
    alert("ȸ���� �Ű� �� �� �ֽ��ϴ�.");

$bo_table = $_POST['bo_table'];
$sg_reason = $_POST['sg_reason'];
$singo_mb_id = $_POST['singo_mb_id'];

if ($bo_table != "@user") {
    alert("�Խù�/���� ���� �Ű�� ��������� ����ϼ���.");
}
$write_table = $g4['write_prefix'].$bo_table;
    
// �Ű� ���� ���
$sql = " insert into $g4[singo_table] 
            set mb_id = '$singo_mb_id',
                bo_table = '$bo_table',
                wr_id = '$singo_mb_id',
                wr_parent = '',
                sg_mb_id = '$member[mb_id]',
                sg_reason = '$sg_reason',
                sg_datetime = '$g4[time_ymdhis]',
                sg_ip = '$remote_addr' ";
sql_query($sql);

// �Ű�����, �Խ��ǰ�����/�׷������/����Ʈ �����ڿ��� ������ �߼� (�Ҵ��� ����2)
$memo_list = array();

$memo_list[] = $singo_mb_id;// �Ű�� �Խñ��� �۾���
$memo_list[] = $config['cf_admin']; // ����Ʈ ������

foreach($memo_list as $memo_recv_mb_id) {
        $me_send_mb_id = $config['cf_admin']; // ����Ʈ ������ ���Ƿ� ������ �߼�
        $me_memo = "�Ű�� ȸ�� - $singo_mb_id<br>�Ű����� - $sg_reason<br><br>�ش� �Ű��뿡 ���ǰ� �ִ� ��� ��ڿ��� �����Ͻñ� �ٶ��ϴ�."; // �޸𳻿�
        $me_subject = "$singo_mb_id ���� �Ű�Ǿ����ϴ�"; // �޸�����

        // ���� INSERT (������) 
        $sql = " insert into $g4[memo_recv_table] 
                        ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_subject, memo_type, memo_owner, me_file_local, me_file_server ) 
                values ('$memo_recv_mb_id', '$me_send_mb_id', '$g4[time_ymdhis]', '$me_memo', '$me_subject', 'recv', '$memo_recv_mb_id', '', '' ) "; 
        sql_query($sql); 
        $me_id = mysql_insert_id(); 

        // �ǽð� ���� �˸� ��� 
        $sql = " update $g4[member_table] 
                    set mb_memo_call = '$me_send_mb_id' 
                  where mb_id = '$memo_recv_mb_id' "; 
        sql_query($sql); 
}

// ȸ���Ű��Ŀ��� �׻� ù �������� �̵�
goto_url("$g4[path]");
?>
