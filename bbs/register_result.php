<?
include_once("./_common.php");

$mb = get_member($_SESSION[ss_mb_reg]);
// ȸ�������� ���ٸ� �ʱ� �������� �̵�
if (!$mb[mb_id]) 
    goto_url($g4[path]);

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

$g4[title] = "ȸ�����԰��";
include_once("./_head.php");

// �Ҵ��� - ȸ���Բ� ���� �߼�, ȸ�����Խ� register_form_update.php���� mb_memo_call�� �������� �ʰ� �̰����� ����
if ($config[cf_memo_mb_member]) 
{
    $me_recv_mb_id = $mb[mb_id];
    $me_send_mb_id = $config[cf_admin];
    
    $sql = " update $g4[member_table]
                set mb_memo_call = concat(mb_memo_call, concat(' ', '$me_send_mb_id'))
              where mb_id = '$me_recv_mb_id' ";
    sql_query($sql);
}

include_once("$member_skin_path/register_result.skin.php");
include_once("./_tail.php");

?>
