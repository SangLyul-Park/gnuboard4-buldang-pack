<?
$sub_menu = "100700";
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "���� ����";
include_once("./admin.head.php");
echo "'�Ϸ�' �޼����� ������ ���� ���α׷��� ������ �������� ���ʽÿ�.<br><br>";
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

$session_path = "$g4[data_path]/session";  // ����������� ���丮 
if (!$dir=@opendir($session_path)) { 
  echo "���� ���丮�� �������߽��ϴ�."; 
} 

$cnt=0;
while($file=readdir($dir)) { 
	
    if (!strstr($file,'sess_')) { 
	    continue; 
	} 

    if (strpos($file,'sess_')!=0) { 
	    continue; 
	} 

	if (!$atime=@fileatime("$session_path/$file")) { 
	    continue; 
	} 
	if (time() > $atime + (3600 * 48)) {  // �����ð��� �ʷ� ����ؼ� �����ֽø� �˴ϴ�. default : 6�ð���
        $cnt++;
	    $return = unlink("$session_path/$file");
	    /*
	    echo "<script>document.getElementById('ct').innerHTML += '$session_path/$file<br/>';</script>\n";

        flush();

        if ($cnt%10==0)
            echo "<script>document.getElementById('ct').innerHTML = '';</script>\n";
      */
	} 
} 

$session_time = $g4[server_time] - 180 * 60; // ����ĳ�� �����Ⱓ 180�� (common.php���� ����)
$sql = " delete from $g4[session_table] where ss_datetime < '" . date("Y-m-d H:i:s", $session_time) . "' ";
@sql_query($sql);

$cnt2 = mysql_affected_rows();
$cnt = $cnt + $cnt2;

echo "<script>document.getElementById('ct').innerHTML += '<br><br>���ǵ����� {$cnt}�� ���� �Ϸ�.<br><br>���α׷��� ������ ����ġ�ŵ� �����ϴ�.';</script>\n";
?>
