<?
// �״� ������Ʈ �ҽ����� ���
// ���Ծƺ�, �ƺ��Ҵ�
// http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech&wr_id=20605

$sub_menu = "100200";
include_once("./_common.php");

check_demo();

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "�ҽ����� ���";
include_once("./admin.head.php");

$backup_dir = $g4[path] ."/data/backup";

if (!is_dir($backup_dir)) {
    @mkdir($backup_dir, 0707);
    @chmod($backup_dir, 0707);

    // ���丮�� �ִ� ������ ����� ������ �ʰ� �Ѵ�.
    $file = $backup_dir . "/index.php";
    $f = @fopen($file, "w");
    @fwrite($f, "");
    @fclose($f);
    @chmod($file, 0606);
}

$backup_file = $backup_dir . "/www_".$g4[time_ymd]. ".tar";
$backup_list = $backup_dir . "/www_".$g4[time_ymd]. ".txt";

$no_backup = " --exclude=". $g4[path] . "/data ";
$no_backup .= " --exclude=". $g4[path] . "/dbconfig.php ";

$fb = popen("tar -cvpf " . $backup_file . $no_backup . $g4[path] . " > " . $backup_list, "r");

if ($fb) {
    while ($file_line = fgets($fb, 1024)) {
        printf("%s<br>\n", $file_line);
    }
    pclose($fb);

    // �����̸��� ���� �Ұ����� ������ ���� �մϴ�.
    if ($c_domain)
        $bk_domain = $c_domain . "_";
    else
        $bk_domain = "www_";
    
    // ����� �̿��� ��ҿ� ������ ���Ͻø� �̰����� ���丮 �̸��� �����η� �������ָ� �˴ϴ�.
    // (��) $backup_dir2 = "/home/user2/data/backup";
    $backup_dir2 = $backup_dir;
    $rand_tail = "_". time() . "_" . rand();
    
    $backup_file2 = $backup_dir2 . "/www_".$g4[time_ymd]. $rand_tail . ".tar";
    $backup_list2 = $backup_dir2 . "/www_".$g4[time_ymd]. $rand_tail . ".txt";
    
    @rename($backup_file, $backup_file2);
    @rename($backup_list, $backup_list2);

    echo         "�״� ����Ʈ�� �ҽ����� ����� �Ϸ��߽��ϴ�.";
    echo "<br><br>PC�� �ٿ�ε� �Ͻ��� ��������� ������ �ּ���.";
    echo "<br><br>�ٿ�ε� �Ͻ÷��� <a href='$backup_file2'>[ �� �� ]</a> �� �����ּ���";

} 
else 
{
    echo         "�״� ����Ʈ�� �ҽ����� ����� �� �� �����ϴ�. ���� ��ڿ��� �����ϼ���.";
}

include_once("./admin.tail.php");
?>
