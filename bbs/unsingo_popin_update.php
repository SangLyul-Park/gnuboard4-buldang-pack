<?
include_once("./_common.php");
include_once("$g4[path]/memo.config.php");

include_once("$g4[path]/head.sub.php");

// ����ڿ����� �Ű������� �Խ����� �ۿ��� �ش� �մϴ�.
// ����, ��Ÿ �Ű��� �ش� ������ �����ϴ�.

// ȸ������ �˻��Ͽ� ȸ���� �ƴ� ��쿡�� �α��� �������� �̵��Ѵ�.
if (!$member[mb_id]) 
    alert_close("ȸ���� �Ű����� �� �� �ֽ��ϴ�.");

// CSRF�� ���� ���ؼ�
$unsg_reason = strip_tags($_POST[unsg_reason]);

// �Խñ� ������ �����´�
$write_table = $g4['write_prefix'].$bo_table;
$sql = " select mb_id from $write_table where wr_id = '$wr_id' ";
$write_tmp = sql_fetch($sql);

// ������ �Ű��� ������, ������ ������ Ȯ��
$sql = " select sg_datetime from $g4[singo_table] 
          where bo_table = '$bo_table' and wr_id = '$wr_id' and wr_parent = '$wr_parent' and sg_mb_id = '$member[mb_id]' ";
$row = sql_fetch($sql);
if ($row[sg_datetime] || $write_tmp[mb_id] == '$member[mb_id]') 
    alert_close("�ڽ��� ���� �Ű����� �� �� �����ϴ�.");

// ��ȸ���� ���� �Ű��� ��� $write[mb_id]�� ���� ���� ������ �ذ��ϱ� ���ؼ�...��..��...
if (!$write[mb_id])
    alert_close("��ȸ���� ���� �Ű����� �� �� �����ϴ�.");

// �Ű����� ���� ���
$sql = " insert into $g4[unsingo_table] 
            set mb_id = '$write[mb_id]',
                bo_table = '$bo_table',
                wr_id = '$wr_id',
                wr_parent = '$wr_parent',
                unsg_mb_id = '$member[mb_id]',
                unsg_reason = '$unsg_reason',
                unsg_datetime = '$g4[time_ymdhis]',
                unsg_ip = '$remote_addr' ";
sql_query($sql);

// �Խñۿ� �Ű� ����
$sql = " update $write_table set wr_singo = wr_singo - 1 where wr_id = '$wr_id' ";
sql_query($sql, false);

// �Ű������� ����� ����Ʈ�� ����
if ($config[cf_singo_point_send])
    insert_point($mb_id, -$config[cf_singo_point_send], "�Ű����� ����Ʈ", '@member', $mb_id, '�Ű�����');

// �Ű�����, �Խ��ǰ�����/�׷������/����Ʈ �����ڿ��� ������ �߼� (�Ҵ��� ����2)
$memo_list = array();

$memo_list[] = $write[mb_id];// �Ű�� �Խñ��� �۾���
$memo_list[] = $config['cf_admin']; // ����Ʈ ������
if ($group['gr_admin'] && !in_array($group['gr_admin'], $memo_list)) // �׷������
    $memo_list[] = $group['gr_admin'];
if ($board['bo_admin'] && !in_array($board['bo_admin'], $memo_list)) // �Խ��ǰ�����
    $memo_list[] = $board['bo_admin'];

foreach($memo_list as $memo_recv_mb_id) {

    $me_send_mb_id = $config['cf_admin']; // ����Ʈ ������ ���Ƿ� ������ �߼�

    // �Ű������� url
    $unsg_url = "$g4[bbs_path]/board.php?bo_table=$bo_table&wr_id=$wr_id";

    // �Ű���������
    $me_memo = "�Ű������� �Խñ� - <a href=\'$unsg_url\' target=new>$write[wr_subject]</a><br>�Խñ��� �Ű��������� - {$unsg_reason}<br><br>�ش� �Խñ��� �Ű����� ���뿡 ���ǰ� �ִ� ��� ��ڿ��� �����Ͻñ� �ٶ��ϴ�."; // �޸𳻿�

    // �Ű�� ����
    $me_subject = "$write[mb_id] ���� �Խñ��� �Ű����� �Ǿ����ϴ�"; // �޸�����

    // ���� INSERT (������) 
    $sql = " insert into $g4[memo_recv_table] 
                    ( me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo, me_subject, memo_type, memo_owner, me_file_local, me_file_server, me_option ) 
             values ('$memo_recv_mb_id', '$me_send_mb_id', '$g4[time_ymdhis]', '$me_memo', '$me_subject', 'recv', '$memo_recv_mb_id', '', '', '$html,$secret,$mail' ) 
          "; 
    sql_query($sql); 
    $me_id = mysql_insert_id(); 

    // �ǽð� ���� �˸� ���
    $sql = " update $g4[member_table]
                set mb_memo_call = concat(mb_memo_call, concat(' ', '$me_send_mb_id'))
              where mb_id = '$memo_recv_mb_id' ";
    sql_query($sql);
}
?>
<SCRIPT LANGUAGE="JavaScript">
alert("�Խù��� �Ű����� �Ͽ����ϴ�.\n\n����� Ȯ�� �� �ش� �Խù��� ���ؼ� ������ġ�� �ϰڽ��ϴ�.\n\n�����մϴ�.");
opener.document.location.href = "<?="board.php?bo_table=$bo_table&wr_id=$wr_id"?>";
window.close();
</SCRIPT>