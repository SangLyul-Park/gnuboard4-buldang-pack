<?
include_once("_common.php");

$mb_nick = trim($_POST['$mb_nick']);    // sideview의 대상
$mb_nick2 = trim($_POST['$mb_nick2']);  // sideview를 클릭한 사람

$mb = get_member_nick($mb_nick);
$mb2 = get_member_nick($mb_nick2);

$mb_id = $mb['mb_id'];

if ($mb_id =='undefined' || $mb_id == "") {
    echo "Error: 110"; // 입력이 없습니다.
} else {
    $mb = get_member($mb_id);
    if ($mb[mb_id] == "") {
        echo "Error: 130"; // 없는 아이디
    } else {
        // 결과값을 return
        $res = "<div>";
        $res .= "<ul class='list-unstyled'>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">쪽지보내기</a></li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">메일보내기</a></li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">자기소개</a></li>";
        $res .= "<li>아이디로검색</li>";
        $res .= "<li><a href=\"javascript:;\" onClick=\"win_profile('$mb_id');;\">포인트내역</a></li>";
        $res .= "<li>전체게시물</li>";
        $res .= "</ul>";
        $res .= "</div>";

        echo iconv($g4['charset'], "UTF-8", $res);

    }
}
?>
