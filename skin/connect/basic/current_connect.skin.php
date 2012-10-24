<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<style type="text/css">
/*
������ ���̺� 5 
http://html.nhndesign.com/uio_factory/ui_pattern/table/5
*/
.tbl_type,.tbl_type th,.tbl_type td{border:0}
.tbl_type{width:100%;border-bottom:2px solid #dcdcdc;font-family:Tahoma;font-size:11px;text-align:center}
.tbl_type caption{display:none}
.tbl_type th{padding:12px 0 8px;border-top:2px solid #dcdcdc;background-color:#f5f7f9;color:#666;font-family:'����',dotum;font-size:12px;font-weight:bold}
.tbl_type td{padding:10px 0 8px;border-top:1px solid #e5e5e5;color:#4c4c4c;}
</style>

<!--ui object -->
<table class="tbl_type" border="1" cellspacing="0" summary="<=$g4[title]?>">
<caption><=$g4[title]?></caption>
<colgroup>
<col width="60px">
<col width="120px">
<col>
</colgroup>
<thead>
    <tr>
    <th scope="col" style='text-align:center'>�� ȣ</th>
    <th scope="col" style='text-align:center'>�� ��</th>
    <th scope="col" style='text-align:left'>�� ũ</th>
    </tr>
</thead>
<tbody>
<?
for ($i=0; $i<count($list); $i++) {

    echo "<tr>";

    echo "<td>{$list[$i][num]}</td>";
    echo "<td>{$list[$i][name]}</td>";

    $location = $list[$i][lo_location];

    // bot�� ���� �մϴ�.
    $bot = "";
    if (preg_match('/Googlebot/', $list[$i][lo_agent]))
        $bot = "Google-bot";
    else if (preg_match('/bingbot/', $list[$i][lo_agent]))
        $bot = "bingbot";
    else if (preg_match('/Yeti/', $list[$i][lo_agent]))
        $bot = "Naver-bot";
    else if (preg_match('/Daumoa/', $list[$i][lo_agent]))
        $bot = "Daum-bot";

    // �ְ�����ڿ��Ը� ���
    // �� ���ǹ��� ������ �������� ���ʽÿ�.
    if ($bot)
        echo "<td style='text-align:left'>&nbsp;{$bot}</td>";
    else if ($is_admin == "super" && $list[$i][lo_url])
            echo "<td style='text-align:left'>&nbsp;<a href='{$list[$i][lo_url]}'>{$location}</a></td>";
    else
        echo "<td  style='text-align:left'>&nbsp;{$location}</td>";

    echo "</tr>";

}

if ($i == 0)
    echo "<tr><td colspan=3 height=50 align=center>���� �����ڰ� �����ϴ�.</td></tr>";
if ($write_pages)
    echo "<tr><td colspan=3 height=30 align=center>$write_pages</td></tr>";
?>
</tbody>
</table>
