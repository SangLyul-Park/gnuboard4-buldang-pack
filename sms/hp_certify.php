<? 
$g4_path = ".."; 
include_once($g4_path."/common.php"); 
include_once("$g4[path]/lib/sms.lib.php"); 

// SMS ������ �迭����
$sms4 = sql_fetch("select * from $g4[sms4_config_table]");

if (!$is_member)
    die("�α��� ���ּ���.");

if (!($token && get_session("ss_token") == $token))
    die("�ùٸ� ������� ����� �ֽʽÿ�.");

if (!trim($hp))
    alert('������ ��ȣ�� �Է����ּ���.');

if (!trim($config[cf_hp_certify_message]))
    alert('�޼����� �Է����ּ���.');

if (!trim($config[cf_hp_certify_return]))
    alert('�޴� ��ȣ�� �Է����ּ���.');
    
// 6�ڸ��� ������ȣ�� ����
$certify_number = rand(100000, 999999); 

// ������ ������ȣ�� ���ǿ� ������ 
// form ���� �Ѿ�� ������ȣ�� ���Ͽ� ������ �۾��� ����� 
set_session("ss_hp_certify_number", $certify_number); 

$mh_hp[][bk_hp] = get_hp($hp,0); // �����ڹ�ȣ - �ݵ�� [bk_hp]�� �־�� �մϴ�.

$mh_reply = str_replace("-", "", $config[cf_hp_certify_return]);
if (!check_string($mh_reply, _G4_NUMERIC_))
    alert("������ ��ȣ�� �ùٸ��� �ʽ��ϴ�.");
        
$hp_message = "**" . str_replace("\$certify_number","$certify_number",$config[cf_hp_certify_message]);
$hp_message = str_replace("\\n", PHP_EOL, $hp_message);

$total = 1;
$booking = '';

$SMS = new SMS4;
$SMS->SMS_con($sms4[cf_ip], $sms4[cf_id], $sms4[cf_pw], $sms4[cf_port]);

$result = $SMS->Add($mh_hp, $mh_reply, '', '', $hp_message, $booking, $total);

$is_success = null;

if ($result) 
{
    $result = $SMS->Send();

    if ($result) //SMS ������ �����߽��ϴ�.
    {
        foreach ($SMS->Result as $result) 
        {
            list($hp, $code) = explode(":", $result);

            if (substr($code,0,5) == "Error")
            {
                $is_success = false;

                switch (substr($code,6,2)) {
                    case '02':	 // "02:���Ŀ���"
                        $mh_log = "������ �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '16':	 // "16:�߼ۼ��� IP ����"
                        $hs_memo = "�߼ۼ��� IP�� �߸��Ǿ� ������ �����Ͽ����ϴ�.";
                        break;
                    case '23':	 // "23:��������,�����Ϳ���,���۳�¥����"
                        $mh_log = "�����͸� �ٽ� Ȯ���� �ֽñ�ٶ��ϴ�.";
                        break;
                    case '97':	 // "97:�ܿ����κ���"
                        $mh_log = "�ܿ������� �����մϴ�.";
                        break;
                    case '98':	 // "98:���Ⱓ����"
                        $mh_log = "���Ⱓ�� ����Ǿ����ϴ�.";
                        break;
                    case '99':	 // "99:��������"
                        $mh_log = "���� ���� ���Ͽ����ϴ�. ������ �ٽ� Ȯ���� �ּ���.";
                        break;
                    default:	 // "�� Ȯ�� ����"
                        $mh_log = "�� �� ���� ������ ������ �����Ͼ����ϴ�.";
                        break;
                }
            } 
            else
            {
                $is_success = true;
                $mh_log = "��������:".get_hp($hp, 1);
            }

            $hp = get_hp($hp, 1);
            $log = array_shift($SMS->Log);
            sql_query("insert into $g4[sms4_member_history_table] set mb_id='$member[mb_id]', mh_reply='$mh_reply', mh_hp='$hp', mh_datetime='$g4[time_ymdhis]', mh_booking='$mh_booking', mh_log='$mh_log', mh_ip='$REMOTE_ADDR'");

            if ($is_admin == 'super')
                $sms4[cf_point] = 0;

            if ($is_success)
                insert_point($member[mb_id], (-1) * $sms4[cf_point], "$mh_log");

            if (!$sms4[cf_point]) { // ����Ʈ ������ ��� ������ ����
                $sql  = " insert into $g4[point_table] set ";
                $sql .= " mb_id = '$member[mb_id]' ";
                $sql .= " ,po_datetime = '$g4[time_ymdhis]' ";
                $sql .= " ,po_content = '".addslashes($mh_log)."' ";
                $sql .= " ,po_point = '$sms4[cf_point]'";
                sql_query($sql);
            }
        }
        $SMS->Init(); // �����ϰ� �ִ� ������� ����ϴ�.
    }
    else alert_close("����: SMS ������ ����� �Ҿ����մϴ�.");
}
else alert_close("����: SMS ������ �Էµ��� ������ �߻��Ͽ����ϴ�.");

alert_close("������ȣ�� �����Ͽ����ϴ�. ������ȣ�� Ȯ�� �� �Է��Ͽ� �ֽʽÿ�.");
?> 
