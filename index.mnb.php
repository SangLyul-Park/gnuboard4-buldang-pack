<!-- ����ȭ�� �ֽű� ���� -->

<?
include_once("$g4[path]/lib/latest.lib.php");       // �ֽű�


echo "<table width=100%><tr>";

// $snb_list�� �ֽű��� ���
$snb_list = get_snb_list($snb_arr[$mnb]);
$ja = 0;
if ($snb_list) {
foreach ($snb_list as $bo_id) {

   if ($ja == 2) { // �ٹٲ�
     echo "</tr><tr valign=top>";
     $ja = 0;
    }

    echo "<td width='50%' valign=top>";
    //function latest($skin_dir="", $bo_table, $rows=10, $subject_len=40, $gallery_view=0, $notice=0, $options="")
    $opt = array('fill'=>'1');
    echo db_cache($bo_id, 1, "latest('naver', $bo_id, 12, 40, 0, 0, $opt)");
    $ja++;
    echo "</td>";
}
if ($ja = 2)
    echo "<td></td>";
echo "</tr>";
}
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