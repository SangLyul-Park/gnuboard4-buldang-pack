<?
// �� ����� ���ǵ��� ������ ������ ���� �������� ������ ����� �� ����
define("_GNUBOARD_", TRUE);

// $qstr�� ���� ��Ȳ���� �ʿ��� ���� �ѱ�� ���ؼ� ��� (�޴� ���� ��...)
$mstr = "";
if (isset($mnb))  { // �Ҵ���� �⺻�޴�
    $mnb = mysql_real_escape_string($mnb);
    $mstr .= '&mnb=' . urlencode($mnb);
}

if (isset($snb))  { // �Ҵ���� ����޴�
    $snb = mysql_real_escape_string($snb);
    $mstr .= '&snb=' . urlencode($snb);
}
if ($sfl == "wr_good" || $sfl == "wr_nogood" || $sfl == "wr_nogood_down" || $sfl == "wr_7" || $sfl == "wr_hit")  {
    $mstr .= '&sfl=' . urlencode($sfl);
    $mstr .= '&stx=' . urlencode($stx);
}

// �޴� ���ڿ��� ���� �ݴϴ�.
$qstr .= $mstr;

// ���̹� API
$g4['naver_api'] = "";

// bbs/write.php���� �׳� ������ ������� ������ ����, ������ �� ��� �ʿ����� ���� ���� write.head.skin.php���� false�� �ϸ� ��
$g4['write_escape'] = true;

//------------------------------------------------------------------------------
// SMS ���� ���� ����
//------------------------------------------------------------------------------
// SMS ���丮
$g4['sms']            = "sms";
$g4['sms_path']       = "$g4[path]/$g4[sms]";
$g4['sms_url']        = "$g4[url]/$g4[sms]";

$g4['sms_admin']      = "sms_admin";
$g4['sms_admin_path'] = "$g4[path]/$g4[admin]/$g4[sms_admin]";
$g4['sms_admin_url']  = "$g4[url]/$g4[admin]/$g4[sms_admin]";

// SMS ���̺��
$g4['sms4_prefix']            = "sms4_";
$g4['sms4_config_table']      = $g4['sms4_prefix'] . "config";
$g4['sms4_write_table']       = $g4['sms4_prefix'] . "write";
$g4['sms4_history_table']     = $g4['sms4_prefix'] . "history";
$g4['sms4_book_table']        = $g4['sms4_prefix'] . "book";
$g4['sms4_book_group_table']  = $g4['sms4_prefix'] . "book_group";
$g4['sms4_form_table']        = $g4['sms4_prefix'] . "form";
$g4['sms4_form_group_table']  = $g4['sms4_prefix'] . "form_group";

$g4['sms4_member_history_table']  = $g4['sms4_prefix'] . "member_history";

// SMS4 Demo ����
if (file_exists("$g4[path]/DEMO"))
{
    // �޴� ��ȣ�� 010-000-0000 ���� ����ϴ�.
    $g4['sms4_demo'] = true;

    // ������ ������ �ʰ� ����(Random)���� ���۰���� �����մϴ�.
    $g4['sms4_demo_send'] = true;
}
?>