<?
$sub_menu = "300300";
include_once("./_common.php");

if ($is_admin != "super") 
    alert("�ְ�����ڸ� ���� �����մϴ�.");

//print_r2($_POST);

// �����ڸ��� ������ �� �����Ƿ�, ������ ����� ip, mb_id�� �����ϸ� �ȵ˴ϴ�.
if ($ip=="$remote_addr")
    alert("���� �α��� ���� ������ IP ( $remote_addr ) �� ���� ���� �� �� �����ϴ�.");

if ($mb_id) {
    if ($mb_id==$member[mb_id])
        alert("���� �α��� ���� ������ ( $member[mb_id] ) �� ���� ���� �� �� �����ϴ�.");

    $sql = " update $g4[member_table] 
                set mb_memo = concat('$g4[time_ymdhis] : �Խù� �Ű�� ���� ���� ����\n', mb_memo),
                    mb_intercept_date = '".date("Ymd", $g4[server_time])."'
              where mb_id = '$mb_id' ";
    sql_query($sql);
}

// �������� IP
$pattern = explode("\n", trim($config['cf_intercept_ip']));
if (!in_array($ip, $pattern)) {
    if (empty($pattern[0])) // ip ���ܸ���� ��� ���� ��
        $cf_intercept_ip = $ip;
    else
        $cf_intercept_ip = trim($config['cf_intercept_ip'])."\n{$ip}";
    $sql = " update {$g4['config_table']} set cf_intercept_ip = '$cf_intercept_ip' ";
    sql_query($sql);   
}

$url = $_SERVER[HTTP_REFERER] . "?page=$page";
goto_url($url);
?>
