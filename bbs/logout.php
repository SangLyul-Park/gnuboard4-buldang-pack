<?
include_once("./_common.php");

// 이호경님 제안 코드
session_unset(); // 모든 세션변수를 언레지스터 시켜줌 
session_destroy(); // 세션해제함 

// 자동로그인 해제 --------------------------------
$ck_mb_id = get_cookie("ck_mb_id");
$sql = " delete from $g4[cookie_table] where cookie_name='$ck_mb_id' ";
sql_query($sql);

set_cookie("ck_mb_id", "", 0);

// 자동로그인 해제 end --------------------------------

if ($url) {
    $p = parse_url($url);
    if ($p['scheme'] || $p['host']) {
        alert("url에 도메인을 지정할 수 없습니다.");
    }

    $link = $url;
} else if ($bo_table) {
    $link = "$g4[bbs_path]/board.php?bo_table=$bo_table";
} else {
    $link = $g4[path];
}

goto_url($link);
?>
