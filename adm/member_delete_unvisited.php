<?
$sub_menu = "200100";
include_once("./_common.php");

check_demo();

auth_check($auth[$sub_menu], "d");

if ($is_admin != "super")
    alert("ȸ�������� �ְ�����ڸ� �����մϴ�.");

$g4[title] = "��������ȸ�� ����";

include_once("./admin.head.php");
echo "<span id='ct'></span>";
include_once("./admin.tail.php");
flush();

echo "<script>document.getElementById('ct').innerHTML += '<p>��������ȸ�� ������...';</script>\n";
flush();

// ȸ�� ���� �Լ� ��Ŭ���.
include_once("$g4[admin_path]/admin.lib.php");

// ���� ����
if ($w == 'd' && $mb_id) {

    // ������
    $mb = get_member($mb_id);

    // üũ
    if (!$mb['mb_id']) {

        alert("ȸ�� �����Ͱ� �������� �ʽ��ϴ�.");

    }

    // ȸ������
    member_delete($mb_id);

    // �̵�
    goto_url("./member_delete.php");

}

$login_time = "365"; //���� ���� ���� �������� ���� ȸ���� ���������� ����?
$today_login_time = date("Y-m-d H:i:s", $g4['server_time'] - ($login_time * 86400));

// $login_time�� ������ �α����� ȸ�� ���. �� �ֱ� $login_time�Ͼȿ� �α����� ����� ���ٴ� ���̴�.
$sql = " select * from $g4[member_table] where mb_today_login < '$today_login_time' and mb_level > '1' order by mb_today_login desc ";
$result = sql_query($sql);

$j = 0;
for ($i=0; $row=sql_fetch_array($result); $i++) { 

    // �Խù� üũ. �ڸ�Ʈ �� ���� ����
    $sql2 = " select count(*) as cnt from $g4[board_new_table] where mb_id = '$row[mb_id]' ";
    $new = sql_fetch($sql2); 

    // ������ ���ٸ� �ʾҴٸ�? �������� �ʽ��ϴ�. Ȥ�� �𸣴ϱ��.
    if (!$new['cnt']) {

        // �г���
        $nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);

        // �ϴ� ������ ���̵�� ���� �α��� ���
        //echo "<tr height='25'>";
        //echo "<td align='center'>{$nick}</td>";
        //echo "<td align='right'>". number_format($row['mb_point']) . "</td>";
        //echo "<td></td>";
        //echo "<td align='center'>{$row['mb_today_login']}</td>";
        //echo "<td align='center'><a href='?w=d&mb_id={$row['mb_id']}'>����</a></td>";
        //echo "</tr>";
        //echo "<tr><td height='1' bgcolor='#f3f3f3' colspan='6'></td></tr>";

        $j++;
        // ȸ������
        member_delete($row['mb_id']);

    } // end if

} // end for
?>
</table>

<br><br>

<?
echo "<script>document.getElementById('ct').innerHTML += '<p>�� ".$j."���� ȸ���� ���� �Ǿ����ϴ�.';</script>\n";
?>

