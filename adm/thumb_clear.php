<?
$sub_menu = "300820";
include_once("./_common.php");

if ($is_admin != "super")
    alert("�ְ�����ڸ� ���� �����մϴ�.", $g4[path]);

$g4[title] = "����� ����";

// ����������� ������ ���ϴ°�
$days = (int) $days;
if ($days <=0)
    $days = 90;

include_once("./admin.head.php");
echo "'�Ϸ�' �޼����� ������ ���� ���α׷��� ������ �������� ���ʽÿ�.<br><br>";
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

// ī���͸� �ʱ�ȭ
$cnt=0;
$dnt=0;

// ÷������������� ���丮, �� ���丮 ���� ���丮�� ������, �� ���� thumb ���丮���� ���� ����ϴ�.
// �Ҵ��ѿ� ������ ���ѰŶ� �ٸ� ���� ������ �˾Ƽ� �ڵ带 �����ؾ� �Ұ���.
// $tdir - �߰����丮 - thumb - �������� ������ ������ �˴ϴ�.
// �Ҵ��ѿ����� file�� ��� file - �Խ����̸� - yymm�� ������ �����Ƿ� $tdir�� file/�Խ����̸��� �������ݴϴ�.
$tdir = array();
$path0 = "$g4[data_path]/file"; 
if (!$dir=@opendir($path0)) { 
    echo "$path0 ���丮�� �������߽��ϴ�."; 
}
// ���� ���丮 ����� ���� �¸��� �̾ƾ� �մϴ�.
while($file=readdir($dir)) {
    if ($file == "." || $file == "..")
        ;
    else
        $tdir[] = "file/$file";
}
closedir($dir);

// �������� ���丮�� �߰�
$tdir[] = 'cheditor4';

foreach ($tdir as $tfile) {

    $path1 = "$g4[data_path]/$tfile"; 
    if (!$dir=@opendir($path1)) { 
      echo "$path1 ���丮�� �������߽��ϴ�."; 
    } 

    // ���� ���丮 ����� ���� �¸��� �̾ƾ� �մϴ�.
    while($file=readdir($dir)) {
        if ($file == "." || $file == ".." || $file == "index.php")
            ;
        else {
            $sub_path = $path1 . "/" . $file;
            $sub_thumb_path = $sub_path . "/thumb";
    
            // �� �ؿ� thumb ���丮�� ������ ��� �۾� �մϴ�.
            if (@filetype($sub_thumb_path) == "dir") {

                // ���丮�� ����, �ƴϸ� �о�~
                if (!$thumbdir=@opendir($sub_thumb_path)) {
                    echo "$sub_thumb_path ���丮�� �������߽��ϴ�."; 
                    contine;
                }
    	          echo "<script>document.getElementById('ct').innerHTML += '{$sub_path}<br/>';</script>\n";

                while($sub_thumbdir=readdir($thumbdir)) {
                    if ($sub_thumbdir == "." || $sub_thumbdir == "..")
                        ;
                    else {

                        $fpath = $sub_thumb_path . "/" . $sub_thumbdir;
                        if (@filetype($fpath) == "dir") {
                            if (!$thumbdir2=@opendir($fpath)) {
                                echo "$fpath ���丮�� �������߽��ϴ�."; 
                                contine;
                            }

                            // thumb ���丮 �ؿ��� ȭ���� ũ�⺰�� ���е� �� ���丮�� ����. �װ� ��������.
                            while($thumb=readdir($thumbdir2)) {
                                if ($thumb == "." || $thumb == "..")
                                    ;
                                else {
                                    $rm_file = $fpath . "/" . $thumb;
                                    
                                  	if (!$atime=@fileatime("$rm_$file")) {
                                  	    continue; 
                                    }
                                  	if (time() > $atime + (3600 * 24 * $days)) {  // �����ð��� �ʷ� ����ؼ� �����ֽø� �˴ϴ�. default : 6�ð���
                                        //unlink($rm_file);
                            	          echo "<script>document.getElementById('ct').innerHTML += '$rm_file<br/>';</script>\n";
                                        $cnt++;
                                    }
                                }
                            }
                            closedir($thumbdir2);
                            @rmdir($fpath);
                        }
    	              }
    	          }
    	          closedir($thumbdir);
                $dnt++;
            }
        }
    }
    closedir($dir);
}

echo "<script>document.getElementById('ct').innerHTML += '<br><br>���丮�˻� {$dnt}��, ������ {$cnt}�� ���� �Ϸ�.<br><br>���α׷��� ������ ����ġ�ŵ� �����ϴ�.';</script>\n";
?>
