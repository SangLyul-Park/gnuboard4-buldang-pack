<!-- ����ȭ�� �ֽű� ���� -->

<?
include_once("$g4[path]/lib/popular.lib.php");      // �α��
include_once("$g4[path]/lib/latest.lib.php");       // �ֽű�
include_once("$g4[path]/lib/latest.group.lib.php"); // �׷� �ֽű�
include_once("$g4[path]/lib/latest.my.lib.php"); // �׷� �ֽű�
include_once("$g4[path]/lib/latest.club.lib.php");  // Ŭ�� �ֽű�


echo "<table width=100%><tr>";

// �Ѱ��� �Խñ��� ���
echo "<tr valign=top>";
echo "<td width='50%' valign=top>";
include_once("$g4[path]/lib/latest.my.lib.php");
echo latest_scrap("scrap", "", "echo4me", 9, 40);
echo "</td>";
echo "<td width='50%' valign=top>";
echo db_cache('main_notice2', 1, "latest_one('one', 'gnu4_pack_skin, 118, 0, 430)");
echo "</td>";
echo "</tr>";

// ��ü �ֱٱ� ���
// function latest_group($skin_dir="", $gr_id="", $rows=10, $subject_len=40, $content_len="", $skin_title="", $skin_title_link="")
echo "<td width='50%' valign=top>";
echo db_cache('all_latest', 1, "latest_group(naver, , 12, 40, , ��ü�ֱٱ�, '$g4[bbs_path]/new.php')");
$ja++;
echo "</td>";

// �ֱٿ� ����̳� �ڸ�Ʈ�� �޸� ��
// function latest_group($skin_dir="", $gr_id="", $rows=10, $subject_len=40, $content_len="", $skin_title="", $skin_title_link="")
echo "<td width='50%' valign=top>";
$db_key = $member[mb_id] . "_all_my_latest";
echo db_cache("$db_key", 1, "latest_group(naver, , 12, 40, , ��ü�����ǹ���, '$g4[bbs_path]/new.php','my_datetime')");
echo "</td></tr>";

// ��α� �ֽű��� ���
echo "<tr valign=top>";
echo "<td width='50%' valign=top>";
include_once("$g4[path]/lib/latest.gblog.lib.php");
echo latest_gblog('naver','',12,40);
$ja=1;
echo "</td>";

// Ŭ�� �ֽű��� ���
echo "<td width='50%' valign=top>";
include_once("$g4[path]/lib/latest.club.lib.php");
echo cb_latest_main('naver',12,40);
$ja++;
echo "</td>";

// �׷� �ֽű��� ���
$sql = " select * from $g4[group_table] where gr_use_search = 1";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {

   if ($ja == 2) { // �ٹٲ�
     echo "</tr><tr valign=top>";
     $ja = 0;
    }

    echo "<td width='50%' valign=top>";
    $gr_key = $row[gr_id] . "_key";
    echo db_cache($gr_key, 1, "latest_group('naver', $row[gr_id], 12, 40)");
    $ja++;
    echo "</td>";
}
echo "</tr>";

// �ֱٱ� - ���� �׳� ����ϰ� ������ ������ ��,
echo "<tr valign=top>";
echo "<td>" . db_cache('gr_trash', 1, "latest(naver, gnu4_pack)") . "</td>";
echo "<td>" . db_cache('gr_turning', 1, "latest(naver, gnu4_turning)") . "</td>";
echo "</td>";

// sitemap�� ���
echo "<tr valign=top>";
echo "<td width='100%' valign=top colspan=2>";
include_once("$g4[path]/lib/sitemap.lib.php");
echo sitemap("naver");
echo "</td>";
echo "</tr>";

echo "</table>";
?>
<!-- ����ȭ�� �ֽű� �� -->