<?
$sub_menu = "200150";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

check_token();

for ($i=0; $i<count($chk); $i++)
{
    // ���� ��ȣ�� �ѱ�
    $k = $_POST['chk'][$i];
    $nick_no = $_POST[nick_no][$k];

    $sql = " select count(*) as cnt from $g4[mb_nick_table] where nick_no = '$nick_no' and end_datetime ='0000-00-00 00:00:00' ";
    $result = sql_fetch($sql);

    // �г����� ������� ��쿡�� ���� �� �����ϴ�
    if ($result[cnt]) {
      alert("nick_no : $nick_no : �г����� ������̹Ƿ� ������ �� �����ϴ�", "./nickname_list.php?$qstr");
    }
    
    $sql = " delete from $g4[mb_nick_table] where nick_no = '$nick_no' ";
    sql_query($sql);
}

goto_url("./nickname_list.php?$qstr");
?>
