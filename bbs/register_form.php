<?
include_once("./_common.php");

// �ҹ������� ������ ��ū����
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

if ($w == "") {
    // ȸ�� �α����� �� ��� ȸ������ �� �� ����
    // ���â�� �ߴ°��� �������� �Ʒ��� �ڵ�� ��ü
    // alert("�̹� �α������̹Ƿ� ȸ�� ���� �Ͻ� �� �����ϴ�.", "./");
    if ($member[mb_id])
        goto_url($g4[path]);

    // ���۷� üũ
    referer_check();

    // �Ҵ��� - ���� ip ���
    if (file_exists("./spam_ip.db")) {
        $spam_ip_file = file("./spam_ip.db");
        $myip = $_SERVER[REMOTE_ADDR];
        while($spam_ip = each($spam_ip_file))
        {
            $spam_ip_addr = trim( substr($spam_ip[1], 0, 12) );
            if($spam_ip_addr !== "" && preg_match("/$spam_ip_addr/", $myip))
            {
                alert("DB Error. Please call admin. Error Code : Reg 9021");
            }
        }
    }

    // ��õ�� ���ؼ��� ȸ�� ������ �����ϰ� ���� - ��õ�ڵ��� ��ȿ�Ⱓ�� �߰�
    if ($g4['member_suggest_join']) {

        $sql = " select count(*) as cnt 
                  from $g4[member_suggest_table] 
                  where mb_id = '$_POST[mb_recommend]' and join_code = '$_POST[join_code]' and join_mb_id = '' and $g4[member_suggest_join_days] >= (to_days(now())-to_days(suggest_datetime))";
        $result = sql_fetch($sql);

        if ($result['cnt'] == 0)
            alert("�߸��� ��õ�ξ��̵�/����������ȣ�̰ų� �̹� ����ϰų� ��ȿ�Ⱓ�� ���� �����ڵ� �Դϴ�.", "./register.php");
    }

    if (!$_POST[agree])
        alert("ȸ�����Ծ���� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.", "./register.php");

    if (!$_POST[agree2])
        alert("����������޹�ħ�� ���뿡 �����ϼž� ȸ������ �Ͻ� �� �ֽ��ϴ�.", "./register.php");

    // �ֹε�Ϲ�ȣ�� ����Ѵٸ� �ߺ��˻縦 �մϴ�.
    /*
    if ($config[cf_use_jumin]) {
        $jumin = sql_password($mb_jumin);
        $row = sql_fetch(" select mb_name from $g4[member_table] where mb_jumin = '$jumin' ");
        if ($row[mb_name]) {
            if ($row[mb_name] == $mb_name)
                alert("�̹� ���ԵǾ� �ֽ��ϴ�.");
            else
                alert("�ٸ� �̸����� ���� �ֹε�Ϲ�ȣ�� �̹� ���ԵǾ� �ֽ��ϴ�.\\n\\n�����ڿ��� ������ �ֽʽÿ�.");
        }

        // �ֹε�Ϲ�ȣ�� 7��° ���ڸ� ����
        $y = substr($mb_jumin, 6, 1);

        // ������ F, M ���� ������.
        // �ֹε�Ϲ�ȣ�� 7��° �ڸ��� Ȧ���̸� ����(Male), ¦���̸� ����(Female)
        $sex = $y % 2 == 0 ? "F" : "M";

        // ������ 8�ڸ��� ����� (���߿� �˻��� ���ϰ� �ϱ� ����)
        // �ֹε�Ϲ�ȣ ���ڸ��� �׳� ���Ϸ� ����� �Ф�
        // �ֹε�Ϲ�ȣ 7��° �ڸ��� ������...
        $birth = substr($mb_jumin, 0, 6);
        if ($y == 9 || $y == 0) // 1800���� (��÷���?)
            $birth = "18" . $birth;
        else if ($y == 1 || $y == 2) // 1900����
            $birth = "19" . $birth;
        else if ($y == 3 || $y == 4) // 2000����
            $birth = "20" . $birth;
        else // ����
            $birth = "xx" . $birth;
    }
    */

    // �Ҵ��� - ȸ���׷��� �ִ� ��� ȸ���׷��� ��ȿ�� �˻�
    if ($ug_id) {
        $ug = sql_fetch(" select * from $g4[user_group_table] where ug_id = '$ug_id' ");
        if (!ug)
            alert("����� �׷��� �ٸ��� �ʽ��ϴ�. �����ڿ��� �����Ͻñ� �ٶ��ϴ�");
    }
    
    $member[mb_birth] = $birth;
    $member[mb_sex] = $sex;
    $member[mb_name] = $mb_name;

    $g4[title] = "ȸ�� ����";
} 
else if ($w == "u") 
{
    if ($is_admin) 
        alert("�������� ȸ�������� ������ ȭ�鿡�� ������ �ֽʽÿ�.", $g4[path]);

    if (!$member[mb_id])
        alert("�α��� �� �̿��Ͽ� �ֽʽÿ�.", $g4[path]);

    if ($member[mb_id] != $mb_id)
        alert("�α��ε� ȸ���� �Ѿ�� ������ ���� �ٸ��ϴ�.");

    //if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]))
    /*
    if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]) && !($member[mb_password] == sql_old_password($_POST[mb_password]) && $_POST[mb_password])) 
        alert("�н����尡 Ʋ���ϴ�.");

    // ���� �� �ٽ� �� ������ ���ƿ��� ���� �ӽ÷� ������ ����
    set_session("ss_tmp_password", $_POST[mb_password]);
    */

    if ($_POST['mb_password']) {
        // ������ ������ ������Ʈ�� �ǵ��� �°��̶�� �н����尡 ��ȣȭ ��ä�� �Ѿ�°���
        if ($_POST['is_update'])
            $tmp_password = $_POST['mb_password'];
        else {
            $tmp_password = sql_password($_POST['mb_password']);
            $tmp_password_old = sql_old_password($_POST['mb_password']);
        }

        //if (!($member[mb_password] == sql_password($_POST[mb_password]) && $_POST[mb_password]) && !($member[mb_password] == sql_old_password($_POST[mb_password]) && $_POST[mb_password])) 
        if ($_POST['is_update']) {
            if ($member['mb_password'] != $tmp_password)
                alert("�н����尡 Ʋ���ϴ�.");
        } else {
            if (!($member['mb_password'] == $tmp_password) && !($member['mb_password'] == $tmp_old_password))
                alert("�н����尡 Ʋ���ϴ�.");
        }
    }

    $g4[title] = "ȸ�� ���� ����";

    $member[mb_email]       = get_text($member[mb_email]);
    $member[mb_homepage]    = get_text($member[mb_homepage]);
    $member[mb_birth]       = get_text($member[mb_birth]);
    $member[mb_tel]         = get_text($member[mb_tel]);
    $member[mb_hp]          = get_text($member[mb_hp]);
    $member[mb_addr1]       = get_text($member[mb_addr1]);
    $member[mb_addr2]       = get_text($member[mb_addr2]);
    $member[mb_signature]   = get_text($member[mb_signature]);
    $member[mb_recommend]   = get_text($member[mb_recommend]);
    $member[mb_profile]     = get_text($member[mb_profile]);
    $member[mb_1]           = get_text($member[mb_1]);
    $member[mb_2]           = get_text($member[mb_2]);
    $member[mb_3]           = get_text($member[mb_3]);
    $member[mb_4]           = get_text($member[mb_4]);
    $member[mb_5]           = get_text($member[mb_5]);
    $member[mb_6]           = get_text($member[mb_6]);
    $member[mb_7]           = get_text($member[mb_7]);
    $member[mb_8]           = get_text($member[mb_8]);
    $member[mb_9]           = get_text($member[mb_9]);
    $member[mb_10]          = get_text($member[mb_10]);
} else
    alert("w ���� ����� �Ѿ���� �ʾҽ��ϴ�.");

// ȸ�������� ���
$mb_icon = "$g4[data_path]/member/".substr($member[mb_id],0,2)."/$member[mb_id].gif";
$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

include_once("./_head.php");
include_once("$member_skin_path/register_form.skin.php");
include_once("./_tail.php");
?>