<?
// ȸ������ ��õ ���̺�
$g4['member_suggest_table'] = $g4['table_prefix'] . "member_suggest";

$g4['member_suggest_join_days']  = 30;      // ��õ+�������� ������ ��, ��õ �ڵ��� ��ȿ�Ⱓ (�⺻ 30��. �ð��� �ƴ϶� ��¥��.)

$g4['member_suggest_days']   = 120;         // ȸ������ ��õ ����Ŭ (��ĥ ������ ��õ ����)
$g4['member_suggest_count']  = 2;           // ȸ������ ��õ�Ǽ�
$g4['member_suggest_level']  = 3;           // ��õ ���� ����

$g4['member_suggest_phone']  = 1;           // �ڵ��� ��õ���Ա�� ����
$g4['member_suggest_email']  = 1;           // �̸��� ��õ���Ա�� ����

$g4['member_suggest_singo']  = 1;           // �Ű� �ִ� ��� ��������

$g4['member_suggest_msg1']  = "";
if ($g4['member_suggest_phone'])
    $g4['member_suggest_msg1'] = "SMS";
if ($g4['member_suggest_email'])
    if ($g4['member_suggest_msg1'])
        $g4['member_suggest_msg1'] .= ",�̸���";
    else
        $g4['member_suggest_msg1'] .= "�̸���";


// �����ʱ� ȭ�鿡 ��� �Ǵ� ����
$g4['member_suggest_intro'] = "
      $g4[member_suggest_msg1] ������ ���� Level $g4[member_suggest_level] ȸ���� ������õ�� ���ؼ��� ȸ�� ������ ���� �մϴ�.<br>
      $g4[member_suggest_msg1] ������ ���� Level $g4[member_suggest_level] ȸ���� ��õ�Ϻ��� $g4[member_suggest_days]�� �̳��� $g4[member_suggest_count]���� ȸ���� ������õ�� �� �ֽ��ϴ�.<br>
      ��õ�� 30 ����Ʈ�� ���� �մϴ�.<br>
      ��õ�ڵ�� ��õ�Ϻ��� $g4[member_suggest_join_days]�ϰ� ��ȿ�ϸ�, �Ⱓ�� ������ ���� ���� ��� <b>��õ�ϰ���</b> ��ư�� ������ ��õ���� ����� �� �� �ֽ��ϴ�.
      <ul>
      <li>Level $g4[member_suggest_level] ȸ���� ������õ $g4[member_suggest_msg1]�� �߼� (1���� �߼� = 1���� ��õ)</li>
      <li>������ $g4[member_suggest_level]�� ��õ�� id, �����ڵ带 ȸ������ ȭ�鿡�� �Է� �մϴ�.</li>
      <li>ȸ������ ȭ�鿡�� ȸ������������ ���� �մϴ�.</li>
      </ul>
      ";

// ������ȣ ����
$certify_number = rand(100000, 999999); 

// sms���� (icord)
$default['de_icode_server_ip'] = "211.172.232.124"; 
$default['de_icode_id'] = ""; 
$default['de_icode_pw'] = ""; 
$default['de_icode_server_port'] = "7295"; 
$default['de_sms_hp'] = "$member[mb_hp]";

$sms_contents = "$config[cf_title]\n\n"; 
$sms_contents .= "��õ�ξ��̵�.\n"; 
$sms_contents .= $member[mb_id]; 
$sms_contents .= "\n����������ȣ.\n"; 
$sms_contents .= $certify_number; 

// �̸��� ����
$g4['member_suggest_email_subject'] = "ȸ�������� ���� �����ڵ� Ȯ�θ����Դϴ�.";
?>
<link rel="stylesheet" href="<?=$g4['path']?>/plugin/recommend/style.css" type="text/css">