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

// �̸����� ������ return
if (trim($email) == "")
    alert("�̸��������� �����ϴ�.", "./index.php");
$email = mysql_real_escape_string($email);

// �̹� �߼۵� �̸����� ��쿡�� ��߼��� ����
$sql = " select count(*) as cnt from $g4[member_suggest_table] 
            where mb_id = '$member[mb_id]' and join_hp = '$email' ";
$result = sql_fetch($sql);
if ($result[cnt] > 0) alert("�̹� ������ȣ�� �߼� �Ͽ����ϴ�", "./index.php");

// ������ ������ȣ �߽��ϴ� ���� ����
if ($email == $member[email]) alert("�����Դ� ������ȣ�� �߼��� �� �����ϴ�", "./index.php");


// Email �߼� BEGIN   -------------------------------------------------------- 
include_once("$g4[path]/lib/mailer.lib.php");

$mb_name = $member[mb_nick];
$subject = $g4['member_suggest_email_subject'];

// �ӽ� ������ȣ ����. ��ũ Ȯ�ν� ���� ������ȣ �߻�
$mb_md5 = md5($mb_id.$mb_email.$member[mb_datetime]);
$certify_href = "$g4[url]/plugin/recommend/email_certify.php?mb_md5=$mb_md5";
        
ob_start();
include_once ("./email_certify_mail3.php");
$content = ob_get_contents();
ob_end_clean();
        
mailer($member[mb_nick], $member[mb_email], $email, $subject, $content, 1);
// SMS END   -------------------------------------------------------- 

// ��õȸ�� ������ DB�� insert
$sql = " insert 
            into $g4[member_suggest_table]
            set mb_id = '$member[mb_id]',
                mb_hp = '$member[mb_hp]',
                mb_email = '$member[mb_email]',
                suggest_datetime = '$g4[time_ymdhis]',
                join_hp = '$email',
                join_code = '$mb_md5',
                email_certify = '$mb_md5'
                ";
sql_query($sql);

// ��õ�� �� ������ ����Ʈ�� ����
insert_point($member[mb_id], -1 * $config[cf_recommend_point], "ȸ��������õ", '@member', $member[mb_id], "{$receive_number} ��õ");

alert("�ű�ȸ�� ��õ������ �����Ͽ����ϴ�.", "./index.php"); 
?> 