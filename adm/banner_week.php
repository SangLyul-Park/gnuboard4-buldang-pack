<?
$sub_menu = "300320";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "���Ϻ� ���Ŭ����Ȳ";
include_once("./admin.head.php");
include_once("./banner.sub.php");
?>

<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<colgroup width=100>
<colgroup width=100>
<colgroup width=100>
<colgroup width=''>
<tr class="success">
    <td>����</td>
    <td>Ŭ����</td>
    <td>����(%)</td>
    <td>�׷���</td>
</tr>
<?
$weekday = array ('��', 'ȭ', '��', '��', '��', '��', '��');

$sum_count = 0;
$sql = " select WEEKDAY(bc_date) as weekday_date, SUM(bc_count) as cnt 
           from $g4[banner_click_sum_table]
          where bc_date between '$fr_date' and '$to_date'
          group by weekday_date
          order by weekday_date ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row[weekday_date]] = $row[cnt];

    $sum_count += $row[cnt];
}

$k = 0;
if ($i) {
    for ($i=0; $i<7; $i++) {
        $count = (int)$arr[$i];

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$rate%' height='18'>";

        echo "
        <tr class='list$list ht center'>
            <td>$weekday[$i]</td>
            <td>$count</td>
            <td>$s_rate</td>
            <td align=left>$graph</td>
        </tr>";
    }

    echo "
    <tr>
        <td>�հ�</td>
        <td>$sum_count</td>
        <td colspan=2>&nbsp;</td>
    </tr>";
} else {
    echo "<tr><td colspan='4' height=100 align=center>�ڷᰡ �����ϴ�.</td></tr>";
}
?>
</table>

<?
include_once("./admin.tail.php");
?>