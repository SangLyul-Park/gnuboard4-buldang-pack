<?
include_once("_common.php");

// post�� ���� ���� ������
$sst        = strip_tags($_POST[sst]);
$sod        = strip_tags($_POST[sod]);
$sfl        = strip_tags($_POST[sfl]);
$stx        = strip_tags($_POST[stx]);
$page       = (int) strip_tags($_POST[page]);
$token      = strip_tags($_POST[token]);
$mb_id      = strip_tags($_POST[mb_id]);
$bo_table   = strip_tags($_POST[bo_table]);
$wr_id      = strip_tags($_POST[wr_id]);
$comment_id = strip_tags($_POST[comment_id]);
$flag       = strip_tags($_POST[flag]);

// comment_id�� �ִ� ���� comment_id�� ����ְ�, wr_option�� mb_id ���� ���� �ɴϴ�.
if ($comment_id) {
    $wr_id = $comment_id;
    $result = sql_fetch(" select wr_option, mb_id from $write_table where wr_id = '$wr_id' ");
    $wr_option = $result[wr_option];
    $write["mb_id"] = $result[mb_id];
    $url = "../board.php?bo_table=$bo_table&wr_id=$wr_id#c_{$comment_id}&page=$page&mnb=$mnb&snb=$snb";
} else {
    $wr_option = $write["wr_option"];
    $url = "../board.php?bo_table=$bo_table&wr_id=$wr_id&page=$page&mnb=$mnb&snb=$snb";
}

if (!$is_admin && $write["mb_id"] != $member["mb_id"])
    alert("���ٱ����� �����ϴ�. - $write[mb_id]", $url);

if ($flag == 'no') 
{
    if (!strstr($wr_option, "secret"))
        alert("��б��� �ƴմϴ�.", $url);

    $wr_option = str_replace("secret", "", $wr_option);

    $msg = "��б� ������ �����Ͽ����ϴ�.";
} 
else 
{
    if (strstr($wr_option, "secret"))
        alert("�̹� ����� �ִ� �Խù��Դϴ�.", $url);

    if ($wr_option) {
        $wr_option = "$wr_option,secret";
    } else {
        $wr_option = "secret";
    }

    $msg = "�Խù��� ��б۷� ��ɽ��ϴ�.";
}

$sql = "update $write_table set wr_option = '$wr_option' where wr_id = '$wr_id'";
sql_query($sql);

alert($msg, $url);
?>
