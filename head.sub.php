<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!isset($g4['title'])) {
    $g4['title'] = $config['cf_title'];
    $g4_head_title = $g4['title'];
}
else {
    $g4_head_title = $g4['title']; // 상태바에 표시될 제목
    $g4_head_title .= " | ".$config['cf_title'];
}

// 쪽지를 받았나?
if (trim($member['mb_memo_call'])) {
    $memo_call = explode(' ' ,trim($member[mb_memo_call]));
    $memo_sql = "";
    for ($i=0; $i < count($memo_call); $i++) {
        if ($i == 0)
            $memo_sql .= " mb_id = '$memo_call[$i]' ";
        else
            $memo_sql .= " or mb_id = '$memo_call[$i]' ";
    }
    // 이름으로 사용되는 시스템의 경우
    if ($config['cf_memo_mb_name'])
        $sql = " select mb_name as mb_nick from $g4[member_table] where $memo_sql group by mb_nick ";
    else
        $sql = " select mb_nick from $g4[member_table] where $memo_sql group by mb_nick ";
    $result_m = sql_query($sql);

    $mb_memo_nick = "";
    while ($row = sql_fetch_array($result_m))
        $mb_memo_nick .= $row['mb_nick'] . "/";

    sql_query(" update {$g4[member_table]} set mb_memo_call = '' where mb_id = '$member[mb_id]' ");

    alert($mb_memo_nick."님으로부터 쪽지가 전달되었습니다.", $_SERVER[REQUEST_URI]);
}

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g4['lo_location'] = addslashes($g4['title']);
if (!$g4['lo_location'])
    $g4['lo_location'] = $_SERVER['REQUEST_URI'];
$g4['lo_url'] = $_SERVER['REQUEST_URI'];
if (strstr($g4['lo_url'], '/'.$g4[adm_path].'/') || $is_admin == 'super') $g4['lo_url'] = '';

// sms4 적용을 위한 설정
if ($is_admin || ($config[cf_sms4_member] && $member[mb_level] >= $config[cf_sms4_level])) {
    $g4_sms4 = "1";
} else
    $g4_sms4 = "";
?>
<!doctype html>
<html lang="ko">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<? if ($config['cf_meta_author']) { ?><meta name="author" content="<?=$config['cf_meta_author']?>"><? } ?>
<?
if ($g4['keyword_seo']) {
    // 그누 SEO 키워드 - 사이트에 유입되는 탑 검색어를 키워드로 분리
    $seo_tag = "";

    // 게시글에 붙어 있는 탑키워드 5개를 넣어주고 
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

    // 사이트에 붙어 있는 키워드 5개를 넣어줍니다
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

    $seo_tag = preg_replace('/\s+/', ' ', $seo_tag);  // 여러개의 빈칸은 1개의 공백으로
    $seo_tag = trim($seo_tag);
    if ($seo_tag !== "")
        $config['cf_meta_keywords'] = "$bo_table " . $seo_tag;
}
?>
<? if ($config['cf_meta_keywords']) { ?><meta name="keywords" content="<?=$config['cf_meta_keywords']?>"><? } ?>
<? if ($write['wr_content']) {
    $g4_description = save_me($write[wr_content]);                // 개인정보보호
    $g4_description = nl2br($g4_description);                     // 줄바꿈을 <br>로
    $g4_description = preg_replace('/\<br(\s*)?\/?\>/i', " ", $g4_description); // <br>을 여백으로
    $g4_description = strip_tags($g4_description);  // 모든 tag를 지워 버리고
    $g4_description = preg_replace("/<(.*?)\>/"," ", $g4_description);
    $g4_description = preg_replace("/&nbsp;/"," ",$g4_description);   // &nbsp;는 공백으로
    $g4_description = str_replace("&amp;", "&", $g4_description); // &amp;는 &로
    $g4_description = str_replace("&lt;", "<", $g4_description);  // &lt;는 <로
    $g4_description = str_replace("&gt;", "<", $g4_description);  // &gt;는 >로
    $g4_description = str_replace("\"", " ", $g4_description);    // "는 공백으로
    $g4_description = str_replace("\'", " ", $g4_description);    // "는 공백으로
    $g4_description = str_replace("\`", " ", $g4_description);    // `는 공백으로
    $g4_description = str_replace(",", " ", $g4_description);     // ,는 공백으로
    $g4_description = str_replace(".", " ", $g4_description);     // .는 공백으로
    $g4_description = str_replace("=", " ", $g4_description);     // =는 공백으로
    $g4_description = str_replace("!", " ", $g4_description);
    $g4_description = str_replace("ㅜ", " ", $g4_description);
    $g4_description = str_replace("ㅠ", " ", $g4_description);
    $g4_description = str_replace("ㅎ", " ", $g4_description);
    $g4_description = str_replace("ㅋ", " ", $g4_description);
    $g4_description = str_replace("//##", " ", $g4_description); 
    $g4_description = preg_replace('/\s+/', ' ', $g4_description);  // 여러개의 빈칸은 1개의 공백으로
    $g4_description = cut_str($g4_description, 250, '');  // 250글자만
    $config['cf_meta_description'] = $g4_description;
}
?>
<? if ($config['cf_meta_description']) { ?><meta name="description" content="<?=$config['cf_meta_description']?>"><? } ?>
<meta http-equiv="Imagetoolbar" content="no">
<? if ($g4['ie_ua']) { ?><meta http-equiv="X-UA-Compatible" content="IE=<?=$g4[ie_ua]?>" /><? } ?>
<title><?=$g4['title']?></title>

<link rel="stylesheet" href="<?=$g4['path']?>/style.css" type="text/css">
<? // canonical link by 말러83, http://sir.co.kr/bbs/board.php?bo_table=g4_tiptech&wr_id=20826
if(stristr($_SERVER[PHP_SELF], "/bbs/board.php") == true && $bo_table) {
    if ($wr_id)
        echo "<link rel=\"canonical\" href=\"$_SERVER[PHP_SELF]?bo_table=$bo_table&wr_id=$wr_id\" />";
    else
        echo "<link rel=\"canonical\" href=\"$_SERVER[PHP_SELF]?bo_table=$bo_table\" />";
}
?>
<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
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
var clickmessage="그림에는 오른쪽마우스버튼을 사용할 수 없습니다."
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
<!-- F5키를 금지하기, http://phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=68565
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
<?php
//sms4 적용여부를 설정 (관리자 또는 회원간 sms보내기가 허용될 때)
if ($is_admin || ($config[cf_sms4_member] && $member[mb_level] >= $config[cf_sms4_level])) {
    include_once("$g4[path]/lib/sms.lib.php");
}
?>
</head>
<body>
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.$member['mb_nick'].'님 로그인 중 ';
    echo '<a href="'.G4_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>
<a name="g4_head"></a>
<?php if (!$cb_id and !stristr($_SERVER[REQUEST_URI],'club_')) { ?>
<!-- 디자인 코드 code --->
<? } ?>