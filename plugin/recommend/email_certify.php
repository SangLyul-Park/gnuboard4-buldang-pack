<?
include_once("./_common.php");

$mb_md5 = mysql_real_escape_string($mb_md5);
if ($mb_md5) 
{
    $sql = " select mb_id, count(*) as cnt from $g4[member_suggest_table] where email_certify = '$mb_md5' and join_mb_id='' ";
    $result = sql_fetch($sql);
    if ($result['cnt'] == 1) {
        // $mb_md5�� ������ �Ӵϴ�.
        sql_query(" update $g4[member_suggest_table] set join_code = '$certify_number' where join_code = '$mb_md5' ");
        
        echo "ȸ�����Կ� �ʿ��� ��õ�� ���̵�� $result[mb_id], ������ȣ�� $certify_number �Դϴ�.<br>";
        echo "�̸����� ������ȣ Ȯ�� ��ũ�� Ŭ���� ������ ������ȣ�� ���� �˴ϴ�.<br><br>";
        echo "ȸ������ ��õ�ڵ��� ��ȿ�Ⱓ�� ��õ�Ϻ��� $g4[member_suggest_join_days]�� �Դϴ�.<br>";
        echo "ȸ������ ��õ�ڵ��� ��ȿ�Ⱓ�� ����ϴ� ��� ��õ�ο��� ��õ�ϰ����� ��û �ϼž� �մϴ�.<br>";
        exit;
    }
}

alert("����� �� ���� �Ѿ���� �ʾҽ��ϴ�.", $g4[path]);
?>
