<?
// �� ������ ���ο� ���� ������ �ݵ�� ���ԵǾ�� ��
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$begin_time = get_microtime();

if (!$g4['title'])
    $g4['title'] = $config['cf_title'];

// ������ �޾ҳ�?
if (trim($member['mb_memo_call'])) {
    $mb_memo_nick = check_memo_call();
    if ($mb_memo_nick !== "")
        alert($mb_memo_nick."�����κ��� ������ ���޵Ǿ����ϴ�.", $_SERVER[REQUEST_URI]);
}

// ���� ������
// �Խ��� ���� ' ���ԵǸ� ���� �߻�
$lo_location = addslashes($g4['title']);
if (!$lo_location)
    $lo_location = $_SERVER['REQUEST_URI'];
$lo_url = $_SERVER['REQUEST_URI'];
if (strstr($lo_url, "/$g4[admin]/") || $is_admin == "super") $lo_url = "";

// sms4 ������ ���� ����
if ($is_admin || ($config[cf_sms4_member] && $member[mb_level] >= $config[cf_sms4_level])) {
    $g4_sms4 = "1";
} else
    $g4_sms4 = "";

// �ڹٽ�ũ��Ʈ���� go(-1) �Լ��� ���� ������ ������� �ش� ���� ��ܿ� ����ϸ�
// ĳ���� ������ ������. ���������� �������� ����
header("Content-Type: text/html; charset=$g4[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
/*
// ����� �������� ����Ͻô� ���
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<? if ($config['cf_meta_author']) { ?><meta name="author" content="<?=$config['cf_meta_author']?>"><? } ?>
<?
if ($g4['keyword_seo']) {
    // �״� SEO Ű���� - ����Ʈ�� ���ԵǴ� ž �˻�� Ű����� �и�
    $seo_tag = "";

    // �Խñۿ� �پ� �ִ� žŰ���� 5���� �־��ְ� 
    if ($bo_table && $wr_id) {
        $sql = " select tag_name, count from $g4[seo_tag_table] where bo_table = '$bo_table' and wr_id = '$wr_id' order by count desc limit 0, 5";
        $result_s = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result_s); $i++) {
            $tmp = explode(" ", $row['tag_name']);
            foreach ($tmp as $tstr) {
                if (trim($tstr) && !stristr($seo_tag, trim($tstr)))
                    $seo_tag .= $tstr . " ";
            }
        }
    }

    // ����Ʈ�� �پ� �ִ� Ű���� 5���� �־��ݴϴ�
    $sql = " select tag_name, count from $g4[seo_tag_table] where bo_table = '' and tag_name <> '' order by count desc limit 0, 5";
    $result_s = sql_query($sql);
    for ($i=0; $row = sql_fetch_array($result_s); $i++) {
        if (trim($row['tag_name'])) {
            $tmp = explode(" ", trim($row['tag_name']));
            foreach ($tmp as $tstr) {
                if (!stristr($seo_tag, trim($tstr)))
                    $seo_tag .= $tstr . " ";
            }
        }
    }

    $seo_tag = preg_replace('/\s+/', ' ', $seo_tag);  // �������� ��ĭ�� 1���� ��������
    $seo_tag = trim($seo_tag);
    if ($seo_tag !== "")
        $config['cf_meta_keywords'] = "$bo_table " . $seo_tag;
}
?>
<? if ($config['cf_meta_keywords']) { ?><meta name="keywords" content="<?=$config['cf_meta_keywords']?>"><? } ?>
<? if ($write['wr_content']) {
    $g4_description = save_me($write[wr_content]);                // ����������ȣ
    $g4_description = nl2br($g4_description);                     // �ٹٲ��� <br>��
    $g4_description = preg_replace('/\<br(\s*)?\/?\>/i', " ", $g4_description); // <br>�� ��������
    $g4_description = strip_tags($g4_description);  // ��� tag�� ���� ������
    $g4_description = preg_replace("/<(.*?)\>/"," ", $g4_description);
    $g4_description = preg_replace("/&nbsp;/"," ",$g4_description);   // &nbsp;�� ��������
    $g4_description = str_replace("&amp;", "&", $g4_description); // &amp;�� &��
    $g4_description = str_replace("&lt;", "<", $g4_description);  // &lt;�� <��
    $g4_description = str_replace("&gt;", "<", $g4_description);  // &gt;�� >��
    $g4_description = str_replace("\"", " ", $g4_description);    // "�� ��������
    $g4_description = str_replace("\'", " ", $g4_description);    // "�� ��������
    $g4_description = str_replace("\`", " ", $g4_description);    // `�� ��������
    $g4_description = str_replace(",", " ", $g4_description);     // ,�� ��������
    $g4_description = str_replace(".", " ", $g4_description);     // .�� ��������
    $g4_description = str_replace("=", " ", $g4_description);     // =�� ��������
    $g4_description = str_replace("!", " ", $g4_description);
    $g4_description = str_replace("��", " ", $g4_description);
    $g4_description = str_replace("��", " ", $g4_description);
    $g4_description = str_replace("��", " ", $g4_description);
    $g4_description = str_replace("��", " ", $g4_description);
    $g4_description = str_replace("//##", " ", $g4_description); 
    $g4_description = preg_replace('/\s+/', ' ', $g4_description);  // �������� ��ĭ�� 1���� ��������
    $g4_description = cut_str($g4_description, 250, '');  // 250���ڸ�
    $config['cf_meta_description'] = $g4_description;
}
?>
<? if ($config['cf_meta_description']) { ?><meta name="description" content="<?=$config['cf_meta_description']?>"><? } ?>
<meta http-equiv="Imagetoolbar" content="no">
<? if ($g4['ie_ua']) { ?><meta http-equiv="X-UA-Compatible" content="IE=<?=$g4[ie_ua]?>" /><? } ?>
<title><?=$g4['title']?></title>

<link rel="stylesheet" href="<?=$g4['path']?>/style.css" type="text/css">
<? // canonical link by ����83, http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech&wr_id=20826
if(stristr($_SERVER[PHP_SELF], "/bbs/board.php") == true && $bo_table) {
    if ($wr_id)
        echo "<link rel=\"canonical\" href=\"$_SERVER[PHP_SELF]?bo_table=$bo_table&wr_id=$wr_id\" />";
    else
        echo "<link rel=\"canonical\" href=\"$_SERVER[PHP_SELF]?bo_table=$bo_table\" />";
}
?>
</head>

<script type="text/javascript">
// �ڹٽ�ũ��Ʈ���� ����ϴ� �������� ����
var g4_path      = "<?=$g4['path']?>";
var g4_bbs       = "<?=$g4['bbs']?>";
var g4_bbs_img   = "<?=$g4['bbs_img']?>";
var g4_url       = "<?=$g4['url']?>";
var g4_is_member = "<?=$is_member?>";
var g4_is_admin  = "<?=$is_admin?>";
var g4_bo_table  = "<?=isset($bo_table)?$bo_table:'';?>";
var g4_sca       = "<?=isset($sca)?$sca:'';?>";
var g4_charset   = "<?=$g4['charset']?>";
var g4_cookie_domain = "<?=$g4['cookie_domain']?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf("gecko") != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf("msie") != -1;
var g4_sms4      = "<?=$g4_sms4?>";
var bitly_id     = '<?=$g4[bitly_id]?>';
var bitly_key    = '<?=$g4[bitly_key]?>';
<? if ($is_admin) { echo "var g4_admin = '{$g4['admin']}';"; } ?>
</script>
<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/b4.common.js"></script>
<script type="text/javascript" src="<?=$g4['path']?>/js/jquery.js"></script>

<? if ($is_test || $is_admin || ($member['mb_id'] && $write['mb_id'] && $member['mb_id'] == $write['mb_id'])) {} else { ?>
<script type="text/javascript">
<!-- http://blueb.co.kr/bbs.php?table=JS_15&query=view&uid=10
var clickmessage="�׸����� �����ʸ��콺��ư�� ����� �� �����ϴ�."
function disableclick(e) {
    if (document.all) {
    if (event.button==2||event.button==3) {
    if (event.srcElement.tagName=="IMG"){
        alert(clickmessage);
        return false;
        }
    }
}
    else if (document.layers) {
    if (e.which == 3) {
        alert(clickmessage);
        return false;
    }
}
    else if (document.getElementById){
    if (e.which==3&&e.target.tagName=="IMG"){
        alert(clickmessage)
        return false
        }
    }
}
function associateimages(){
    for(i=0;i<document.images.length;i++)
        document.images[i].onmousedown=disableclick;
}
    if (document.all)
        document.onmousedown=disableclick
    else if (document.getElementById)
        document.onmouseup=disableclick
    else if (document.layers)
        associateimages()
// -->
</script>
<? } ?>

<script type="text/javascript"> 
<!-- F5Ű�� �����ϱ�, http://phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=68565
document.onkeydown = function(e) { 
  var evtK = (e) ? e.which : window.event.keyCode; 
  var isCtrl = ((typeof isCtrl != 'undefined' && isCtrl) || ((e && evtK == 17) || (!e && event.ctrlKey))) ? true : false; 

  if ((isCtrl && evtK == 82) || evtK == 116) { 
    if (e) { evtK = 505; } else { event.keyCode = evtK = 505; } 
  } 
  if (evtK == 505) { 
    return false; 
  } 
}
//-->
</script> 

<?
//sms4 ���뿩�θ� ���� (������ �Ǵ� ȸ���� sms�����Ⱑ ���� ��)
if ($is_admin || ($config[cf_sms4_member] && $member[mb_level] >= $config[cf_sms4_level])) {
    include_once("$g4[path]/lib/sms.lib.php");
}

// �ǽð������� ����Ϸ��� �Ʒ��� �ڸ�Ʈ�� Ǯ���ݴϴ�
//include_once("$g4[bbs_path]/realtime_memo.php");
?>
<body>
<a name="g4_head"></a>
<? if (!$cb_id and !stristr($_SERVER[REQUEST_URI],'club_')) { ?>
<!-- ������ �ڵ� code --->
<? } ?>