<?
if (!defined("_GNUBOARD_")) exit;

include_once("$g4[path]/lib/visit.lib.php");

if (empty($fr_date)) $fr_date = $g4[time_ymd];
if (empty($to_date)) $to_date = $g4[time_ymd];

$qstr = "fr_date=$fr_date&to_date=$to_date";

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
?>

<table width=100% cellpadding=3 cellspacing=1>
<form name=fvisit method=get>
<tr>
    <td>
        �Ⱓ : 
        <input type='text' name='fr_date' id='fr_date' size=11 maxlength=10 value='<?=$fr_date?>' class=ed><a href="javascript:win_calendar('fr_date', document.getElementById('fr_date').value, '-');"><img src='<?=$member_skin_path?>/img/calendar.gif' border=0 align=absmiddle title='�޷� - ��¥�� �����ϼ���'></a>
        -
        <input type='text' name='to_date' id='to_date' size=11 maxlength=10 value='<?=$to_date?>' class=ed><a href="javascript:win_calendar('to_date', document.getElementById('to_date').value, '-');"><img src='<?=$member_skin_path?>/img/calendar.gif' border=0 align=absmiddle title='�޷� - ��¥�� �����ϼ���'></a>
        &nbsp;
        <input type=button class=btn1 value=' ������ '   onclick="fvisit_submit('visit_list.php');">
        <input type=button class=btn1 value=' ������ '   onclick="fvisit_submit('visit_domain.php');">
        <input type=button class=btn1 value=' i p '   onclick="fvisit_submit('visit_ip.php');">
        <input type=button class=btn1 value=' ������ ' onclick="fvisit_submit('visit_browser.php');">
        <input type=button class=btn1 value=' OS '       onclick="fvisit_submit('visit_os.php');">
        <input type=button class=btn1 value=' �ð� '     onclick="fvisit_submit('visit_hour.php');">
        <input type=button class=btn1 value=' ���� '     onclick="fvisit_submit('visit_week.php');">
        <input type=button class=btn1 value=' �� '       onclick="fvisit_submit('visit_date.php');">
        <input type=button class=btn1 value=' �� '       onclick="fvisit_submit('visit_month.php');">
        <input type=button class=btn1 value=' �� '       onclick="fvisit_submit('visit_year.php');">
    </td>
</tr>
</form>
</table>

<script language='javascript'>
function fvisit_submit(act) 
{
    var f = document.fvisit;
    f.action = act;
    f.submit();
}
</script>
