<?
$sub_menu = "300320";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g4[title] = "������ ���Ŭ����Ȳ";
include_once("./admin.head.php");
include_once("./banner.sub.php");
?>

<table width=100% class="table table-condensed table-hover table-responsive" style="word-wrap:break-word;">
<colgroup width=100>
<colgroup width=100>
<colgroup width=100>
<colgroup width=''>
<tr class="success">
    <td>��</td>
    <td>Ŭ����</td>
    <td>����(%)</td>
    <td>�׷���</td>
</tr>
<?
$max = 0;
$sum_count = 0;
$sql = " select SUBSTRING(bc_date,1,4) as bc_year, SUM(bc_count) as cnt 
           from $g4[banner_click_sum_table]
          where bc_date between '$fr_date' and '$to_date'
          group by bc_year
          order by bc_year desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row[bc_year]] = $row[cnt];

    if ($row[cnt] > $max) $max = $row[cnt];

    $sum_count += $row[cnt];
}

$i = 0;
$k = 0;
$save_count = -1;
$tot_count = 0;
if (count($arr)) {
    foreach ($arr as $key=>$value) {
        $count = $value;

        $rate = ($count / $sum_count * 100);
        $s_rate = number_format($rate, 1);

        $bar = (int)($count / $max * 100);
        $graph = "<img src='{$g4[admin_path]}/img/graph.gif' width='$bar%' height='18'>";

        echo "
        <tr>
            <td><a href='./banner_month.php?fr_date=$key-01-01&to_date=$key-12-31' class=tt>$key</a></td>
            <td>".number_format($value)."</td>
            <td>$s_rate</td>
            <td>$graph</td>
        </tr>";
    }

    echo "
    <tr>
        <td>�հ�</td>
        <td>".number_format($sum_count)."</td>
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