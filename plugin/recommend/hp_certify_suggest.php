<? 
include_once("./_common.php"); 

// ���ǿ� ����� ��ū�� �������� �Ѿ�� ��ū�� �� 
$ss_token = get_session("ss_token");
if ($_GET["token"] && $ss_token == $_GET["token"]) { 
    set_session("ss_token", ""); // ������ ������ ���� �ٽ� �Է����� ���ؼ� �������� �Ѵ�.
} else {
    alert_close("������ȣ �߼۽� ������ �߻��Ͽ����ϴ�."); 
    exit; 
} 

$receive_number = preg_replace("/[^0-9]/", "", $hp); // �����ڹ�ȣ 
$send_number = preg_replace("/[^0-9]/", "", $default['de_sms_hp']); // �߽��ڹ�ȣ 

// �̹� �߼۵� �ڵ����� ��쿡�� ��߼��� ����
$sql = " select count(*) as cnt from $g4[member_suggest_table] 
            where mb_id = '$member[mb_id]' and join_hp = '$receive_number' ";
$result = sql_fetch($sql);
if ($result[cnt] > 0) alert_close("�̹� ������ȣ�� �߼� �Ͽ����ϴ�", "./index.php");

// ������ ������ȣ �߽��ϴ� ���� ����
if ($receive_number == $send_number) alert("�����Դ� ������ȣ�� �߼��� �� �����ϴ�", "./index.php");

// SMS BEGIN -------------------------------------------------------- 

// ������ ������ȣ�� ���ǿ� ������ 
// form ���� �Ѿ�� ������ȣ�� ���Ͽ� ������ �۾��� �����, skin/member/basic/register_update.skin.php
set_session("ss_hp_certify_number", $certify_number); 

if ($receive_number) { 
    include_once("$g4[path]/lib/icode.sms.lib.php"); 
    $SMS = new SMS; // SMS ���� 
    $SMS->SMS_con($default['de_icode_server_ip'], $default['de_icode_id'], $default['de_icode_pw'], $default['de_icode_server_port']); 
    $SMS->Add($receive_number, $send_number, $default['de_icode_id'], stripslashes($sms_contents), ""); 
    $SMS->Send(); 
} 
// SMS END   -------------------------------------------------------- 

// ��õȸ�� ������ DB�� insert
$sql = " insert 
            into $g4[member_suggest_table]
            set mb_id = '$member[mb_id]',
                mb_hp = '$member[mb_hp]',
                suggest_datetime = '$g4[time_ymdhis]',
                join_hp = '$receive_number',
                join_code = '$certify_number'
                ";
sql_query($sql);

// ��õ�� �� ������ ����Ʈ�� ����
insert_point($member[mb_id], -1 * $config[cf_recommend_point], "ȸ��������õ", '@member', $member[mb_id], "{$receive_number} ��õ");

alert_close("�ű�ȸ�� ��õ������ �����Ͽ����ϴ�."); 
?> 