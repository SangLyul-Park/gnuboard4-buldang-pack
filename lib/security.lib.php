<?
// proxy �������� Ȯ���ϱ�
function check_proxy($ip_addr) 
{
    global $g4;

    // ip �ּҰ� ������ return
    $ip_addr = trim($ip_addr);
    if (!$ip_addr)
        return true;
    
    // ip �ּ� ������ �ٸ��� ������ retnrn
    if (!ip2long($ip_addr))
        return true;

    $sql = " select count(*) as cnt from $g4[proxy_table] where proxy_ip = '$ip_addr' ";
    $result = sql_fetch($sql);
    
    if ($result[cnt] > 0)
        return true;    // proxy ����
    else
        return false;   // proxy ������ �ƴ�
} 
?>
