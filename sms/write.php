<?
include_once("./_common.php");

// SMS ������ �迭����
$sms4 = sql_fetch("select * from $g4[sms4_config_table] ");

$err = null;

if (!$sms4[cf_member])
    $err = "���������� ������ �ʾҽ��ϴ�.\\n\\n����Ʈ �����ڿ��� �����Ͽ� �ֽʽÿ�.";

if (!$err and !$is_member)
    $err = "�α��� ���ּ���.";

if (!$err and $member[mb_level] < $sms4[cf_level])
    $err = "ȸ�� $sms4[cf_level] ���� �̻� ���������� �����մϴ�.";

// ���� ���ڸ� ���� �� �Ǽ�
$row = sql_fetch(" select count(*) as cnt from $g4[sms4_member_history_table] where mb_id='$member[mb_id]' and date_format(mh_datetime, '%Y-%m-%d') = '$g4[time_ymd]' ");
$total = $row[cnt];

// �Ǽ� ����
if (!$err and $sms4[cf_day_count] > 0 && $is_admin != 'super') {
    if ($total >= $sms4[cf_day_count]) {
        $err = "�Ϸ翡 ������ �ִ� ���ڰ���(".number_format($sms4[cf_day_count])." ��)�� �ʰ��Ͽ����ϴ�.";
    }
}

// ����Ʈ �˻�
if (!$err and $sms4[cf_point] > 0 && $is_admin != 'super') {
    if ($sms4[cf_point] > $member[mb_point])
        $err = "�����Ͻ� ����Ʈ(".number_format($member[mb_point])." ����Ʈ)�� ���ų� ���ڶ�\\n\\n��������(".number_format($sms4[cf_point])." ����Ʈ)�� �Ұ��մϴ�.\\n\\n����Ʈ�� �����Ͻ� �� �ٽ� �õ� �� �ֽʽÿ�.";
}

// Ư��ȸ������ ���� ����
if ($mb_id) {
    $mb = get_member($mb_id);
    if (!$mb[mb_sms] || !$mb[mb_open]) {
        alert("������ �������� �ʾҽ��ϴ�.");
    }
    $hp = $mb[mb_hp];
}

$g4[title] = "��������";

$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

include_once("$g4[path]/head.sub.php");

$sms_skin_path = $g4[sms_path] . "/skin/basic";

include_once("$sms_skin_path/write.skin.php");
?>

<script language="JavaScript">
function sms_error(obj, err) {
    alert(err);
    obj.value = '';
}

function smssend_submit(f)
{
    <? if ($err) { ?>
    alert("<?=$err?>");
    return false;
    <? } ?>

    if (!f.mh_message.value)
    {
        alert('������ ���ڸ� �Է��Ͻʽÿ�.');
        f.mh_message.focus();
        return false;
    }

    if (!f.mh_reply.value)
    {
        alert('�߽� ��ȣ�� �Է��Ͻʽÿ�.\n\n�߽� ��ȣ�� ȸ�������� �ڵ�����ȣ�Դϴ�.');
        return false;
    }
    var flag = false;
    var tmp = '';
    for (i=0; i<f.numbers.length; i++) {
        if (f.numbers[i].value.length > 0) {
            flag = true;
            tmp += f.numbers[i].value + ',';
        }
    }
    if (!flag) {
        alert('���� ��ȣ�� �ϳ� �̻� �Է��Ͻʽÿ�.');
        return false;
    }

    f.mh_hp.value = tmp;

    return true;
    //f.submit();    
    //win.focus();
}

function booking_show()
{
    if (document.getElementById('booking_flag').checked) {
        document.getElementById('mh_by').disabled   = false;
        document.getElementById('mh_bm').disabled   = false;
        document.getElementById('mh_bd').disabled   = false;
        document.getElementById('mh_bh').disabled   = false;
        document.getElementById('mh_bi').disabled   = false;
    } else {
        document.getElementById('mh_by').disabled   = true;
        document.getElementById('mh_bm').disabled   = true;
        document.getElementById('mh_bd').disabled   = true;
        document.getElementById('mh_bh').disabled   = true;
        document.getElementById('mh_bi').disabled   = true;
    }
}

function byte_check(mh_message, sms_bytes)
{
    var conts = document.getElementById(mh_message);
    var bytes = document.getElementById(sms_bytes);

    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<conts.value.length; i++) 
    {
        ch = conts.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    bytes.innerHTML = cnt;

    if (cnt > 80) 
    {
        exceed = cnt - 80;
        alert('�޽��� ������ 80����Ʈ�� ������ �����ϴ�.\n\n�ۼ��Ͻ� �޼��� ������ '+ exceed +'byte�� �ʰ��Ǿ����ϴ�.\n\n�ʰ��� �κ��� �ڵ����� �����˴ϴ�.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = conts.value;
        for (i=0; i<tmp.length; i++) 
        {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 80) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        conts.value = tmp;
        bytes.innerHTML = xcnt;
        return;
    }
}

byte_check('mh_message', 'sms_bytes');

<? 
if ($hp) { 
    echo "document.getElementsByName('numbers')[0].value = '$hp'";
} 
?>
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>