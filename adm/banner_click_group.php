<?
$sub_menu = "300320";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "��ʱ׷��� ���Ŭ����Ȳ";
include_once("./admin.head.php");
include_once("./banner.sub.php");

$colspan = 5;
?>

<table width=100% cellpadding=0 cellspacing=1 border=0>
<colgroup width=100>
<colgroup width=200>
<colgroup width=100>
<colgroup width=100>
<colgroup width=''>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>����</td>
    <td>��ʱ׷�</td>
    <td>Ŭ����</td>
    <td>����(%)</td>
    <td>�׷���</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
$max = 0;
$sum_count = 0;
$sql = " select * from $g4[banner_click_table]
          where bc_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {
    $s = $row[bg_id];

    $arr[$s]++;

    if ($arr[$s] > $max) $max = $arr[$s];

    $sum_count++;
}

$i = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
if (count($arr)) {
    arsort($arr);
    foreach ($arr as $key=>$value) {
        $count = $arr[$key];
        if ($save_count != $count) {
            $i++;
            $no = $i;
            $save_count = $count;
        } else {
            $no = "";
        }

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $bar = (int)($count / $max * 100);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$bar%' height='18'>";

        $list = ($k++%2);
        echo "
        <tr class='list$list ht center'>
            <td>$no</td>
            <td><a href='./banner_click_list.php?bg_id=$key'>$key</a></td>
            <td>$count</td>
            <td>$s_rate</td>
            <td align=left>$graph</td>
        </tr>";
    }

    echo "
    <tr><td colspan='$colspan' class='line2'></td></tr>
    <tr class='bgcol2 bold col1 ht center'>
        <td colspan=2>�հ�</td>
        <td>$sum_count</td>
        <td colspan=2>&nbsp;</td>
    </tr>";
} else {
    echo "<tr><td colspan='$colspan' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>";
}
?>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>

<?
include_once("./admin.tail.php");
?>