<?php
// ---------------------------------------------------------------------------
//                              CHXImage
//
// �� �ڵ�� ���� ���ؼ� �����˴ϴ�.
// ȯ�濡 �°� ���� �Ǵ� �����Ͽ� ����� �ֽʽÿ�.
//
// ---------------------------------------------------------------------------

require_once("config.php");

//----------------------------------------------------------------------------
//
//
$tempfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];

//if (preg_match("/\.(php|htm|inc)/i", $filename)) die("-ERR: File Format");

// demo.html ���Ͽ��� ������ SESSID ���Դϴ�.
//$sessid   = $_POST['sessid'];

// ���� ���� �̸�
// $savefile = SAVE_DIR . '/' . $_FILES['file']['name'];

$pos = strrpos($filename, '.');
$ext = strtolower(substr($filename, $pos, strlen($filename)));

switch ($ext) {
case '.gif' :
case '.png' :
case '.jpg' :
case '.jpeg' :
	break;
default :
	die("-ERR: File Format!");
}

$ym = date("ym", time());
$ymd = date("ymd", time());
$pos = strrpos($filename, '.');
$ext = substr($filename, $pos, strlen($filename));
//$random_name = random_generator() . $ext;
$random_name = $ymd . "_" .  md5($_SERVER['REMOTE_ADDR']) . '_' . random_generator() . $ext;
$savefile = SAVE_DIR . '/' . $random_name;
move_uploaded_file($tempfile, $savefile);
$imgsize = getimagesize($savefile);
$filesize = filesize($savefile);

if (!$imgsize) {
	$filesize = 0;
	$random_name = '-ERR';
	unlink($savefile);
} else {
  // image type�� 1���� �۰ų� 16 ���� ũ�� ������
  if ($imgsize[2] < 1 || $imgsize[2] > 16)
  {
    die("-ERR: File Format!");
  }

  // �ö� ������ �۹̼��� �����մϴ�.
  chmod($savefile, 0606);
}

$rdata = sprintf( "{ fileUrl: '%s/%s', filePath: '%s/%s', origName: '%s', fileName: '%s', fileSize: '%d' }",
	SAVE_URL,
	$random_name,
	SAVE_DIR,
	$random_name,
	$filename,
	$random_name,
	$filesize );

echo $rdata;

// �Ҵ��� - �ö󰡴� ��� image ������ üũ, �Խ��ǿ� �ö󰡴°Ÿ� ó��.
if ($bo_table !== "") {
    $bc_url = SAVE_URL . "/" . $random_name;
    $sql = " insert into $g4[board_cheditor_table]
            SET
                mb_id = '$member[mb_id]',
                bc_dir = '" . SAVE_DIR . "',
                bc_file = '$random_name',
                bc_url = '$bc_url',
                bc_filesize = '" . filesize2bytes($filesize)/1024 . "',
                bc_source = '" . mysql_real_escape_string($filename) . "',
                bc_ip = '$remote_addr',
                bc_datetime = '$g4[time_ymdhis]',
                bo_table = '$bo_table'
        ";
    sql_query($sql);
}

function random_generator ($min=8, $max=32, $special=NULL, $chararray=NULL) {
// ---------------------------------------------------------------------------
//
//
    $random_chars = array();
    
    if ($chararray == NULL) {
        $str = "abcdefghijklmnopqrstuvwxyz";
        $str .= strtoupper($str);
        $str .= "1234567890";

        if ($special) {
            $str .= "!@#$%";
        }
    }
    else {
        $str = $charray;
    }

    for ($i=0; $i<strlen($str)-1; $i++) {
        $random_chars[$i] = $str[$i];
    }

    srand((float)microtime()*1000000);
    shuffle($random_chars);

    $length = rand($min, $max);
    $rdata = '';
    
    for ($i=0; $i<$length; $i++) {
        $char = rand(0, count($random_chars) - 1);
        $rdata .= $random_chars[$char];
    }
    return $rdata;
}

?>
