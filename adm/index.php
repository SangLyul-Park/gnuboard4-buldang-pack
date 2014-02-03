<?
include_once("./_common.php");

$g4['title'] = "�����ڸ���";
include_once ("./admin.head.php");

$new_member_rows = 5;
$new_point_rows = 5;
$new_write_rows = 5;

$sql_common = " from $g4[member_table] ";
$sql_search = " where (1) ";

//if ($is_admin == 'group') $sql_search .= " and mb_level = '$member[mb_level]' ";
if ($is_admin != 'super') 
    $sql_search .= " and mb_level <= '$member[mb_level]' ";

if (!isset($sst)) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

// ��üȸ����
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// Ż��ȸ����
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_leave_date <> ''
         ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// ����ȸ����
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_intercept_date <> ''
         ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

// �ű԰��� ȸ�����
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $new_member_rows ";
$result = sql_query($sql);
?>

<div class="row-fluid row">
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="./member_list.php">�ű԰���ȸ�� <?=$new_member_rows?>��</a>
            <span class="pull-right">��ȸ���� : <?=number_format($total_count)?>, ���� : <?=number_format($intercept_count)?>, Ż�� : <?=number_format($leave_count)?></span>
        </div>
    </div>
    <table width=100% class="table table-hover" style="word-wrap:break-word;">
    <tr class="success">
        <td>ȸ�����̵�</td>
        <td>�̸�</td>
        <td>����</td>
        <td>����</td>
        <td>����Ʈ</td>
        <td>��������</td>
    </tr>
    <?
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $mb_nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);
    
        $mb_id = $row['mb_id'];
        echo "
        <tr>
            <td title='$row[mb_id]'>$mb_id</td>
            <td>$row[mb_name]</td>
            <td>$mb_nick</td>
            <td>$row[mb_level]</td>
            <td align=right><a href='./point_list.php?sfl=mb_id&stx=$row[mb_id]'>".number_format($row['mb_point'])."</a></td>
            <td>".substr($row['mb_today_login'],2,8)."</td>
                 
        </tr>";
    }
    
    if ($i == 0)
        echo "<tr><td colspan='6' align=center height=100>�ڷᰡ �����ϴ�.</td></tr>";
    ?>
    </table>
</div>

<?
// �ֱ� �Խù� $new_write_rows ���� ���մϴ�
$sql_common = " from $g4[board_new_table] ";
$sql_common .= " where wr_is_comment = '0' ";

$sql_order = " order by bn_id desc ";
$colspan = 5;
?>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href='<?=$g4[bbs_path]?>/new.php' target="_blank">�ֱٰԽù�</a>
        </div>
    </div>

<table width=100% class="table table-hover" style="word-wrap:break-word;">
<colgroup width=100>
<colgroup width=''>
<colgroup width=80>
<colgroup width=80>
<tr class='success'>
    <td>�Խ���</td>
    <td>����</td>
    <td>�̸�</td>
    <td>�Ͻ�</td>
</tr>
<?
$sql = " select *
          $sql_common
          $sql_order
          limit $new_write_rows ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $tmp_write_table = $g4['write_prefix'] . $row['bo_table'];

    $row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '$row[wr_id]' ");
    if (!$row2)
        continue;

    $name = get_sideview($row2['mb_id'], cut_str($row2['wr_name'], $config['cf_cut_name']), $row2['wr_email'], $row2['wr_homepage']);
    $datetime = get_datetime($row2['wr_datetime']);
    $bo = get_board($row[bo_table], "bo_subject");
    $bo_subject = cut_str($bo[bo_subject], 20);
    $gr = get_group($row[gr_id], "gr_subject");
    $gr_subject = cut_str($gr['gr_subject'],10);

    echo "
    <tr>
        <td><a href='$g4[bbs_path]/board.php?bo_table=$row[bo_table]'>".$bo_subject."</a></td>
        <td ><a href='$g4[bbs_path]/board.php?bo_table=$row[bo_table]&wr_id=$row2[wr_id]'>".conv_subject($row2['wr_subject'], 40)."</a></td>
        <td>$name</td>
        <td>$datetime</td>
    </tr> ";  
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";
?>

</div>




<?
$sql_common = " from $g4[point_table] ";
$sql_search = " where (1) ";
$sql_order = " order by po_id desc ";


/* �Ҵ��� - ���� ���ϴµ�, �� ������ �ϳ�? ��.��..
�׸��� ����Ʈ ������ ù ȭ�鿡�� �� �˾ƾ� �ұ�???
$sql = " select count(*) as cnt
         $sql_common
         $sql_search 
         $sql_order ";
*/
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $new_point_rows ";
$result = sql_query($sql);

$colspan = 7;
?>

<br><br>
<?=subtitle("�ֱ�����Ʈ {$new_point_rows}��", "./point_list.php");?>

<!--
<table width=100%>
<tr>
    <td width=50% align=left>
        <?//=$listall?> (�Ǽ� : <?=number_format($total_count)?>)
        <? 
        //$row2 = sql_fetch(" select sum(po_point) as sum_point from $g4[point_table] ");
        //echo "&nbsp;(��ü ����Ʈ �հ� : " . number_format($row2[sum_point]) . "��)";
        ?>
        
    </td>
    <td width=50% align=right></td>
</tr>
</table>
-->

<table width=100% cellpadding=0 cellspacing=1>
<input type=hidden name=sst  value='<?=$sst?>'>
<input type=hidden name=sod  value='<?=$sod?>'>
<input type=hidden name=sfl  value='<?=$sfl?>'>
<input type=hidden name=stx  value='<?=$stx?>'>
<input type=hidden name=page value='<?=$page?>'>
<colgroup width=100>
<colgroup width=80>
<colgroup width=80>
<colgroup width=140>
<colgroup width=''>
<colgroup width=50>
<colgroup width=80>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>ȸ�����̵�</td>
    <td>�̸�</td>
    <td>����</td>
    <td>�Ͻ�</td>
    <td>����Ʈ ����</td>
    <td>����Ʈ</td>
    <td>����Ʈ��</td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
<?
$row2['mb_id'] = '';
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    if ($row2['mb_id'] != $row['mb_id'])
    {
        $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from $g4[member_table] where mb_id = '$row[mb_id]' ";
        $row2 = sql_fetch($sql2);
    }

    $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

    $link1 = $link2 = "";
    if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table'])
    {
        $link1 = "<a href='$g4[bbs_path]/board.php?bo_table=$row[po_rel_table]&wr_id=$row[po_rel_id]' target=_blank>";
        $link2 = "</a>";
    }

    $list = $i%2;
    echo "
    <input type=hidden name=po_id[$i] value='$row[po_id]'>
    <input type=hidden name=mb_id[$i] value='$row[mb_id]'>
    <tr class='list$list col1 ht center'>
        <td><a href='./point_list.php?sfl=mb_id&stx=$row[mb_id]'>$row[mb_id]</a></td>
        <td>$row2[mb_name]</td>
        <td>$mb_nick</td>
        <td>$row[po_datetime]</td>
        <td align=left>&nbsp;{$link1}$row[po_content]{$link2}</td>
        <td align=right>".number_format($row['po_point'])."&nbsp;</td>
        <td align=right>".number_format($row2['mb_point'])."&nbsp;</td>
    </tr> ";
} 

if ($i == 0)
    echo "<tr><td colspan='$colspan' align=center height=100 bgcolor=#ffffff>�ڷᰡ �����ϴ�.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";
?>



<?
include_once ("./admin.tail.php");
?>
