<?
include_once("./_common.php");

// �ҹ������� ������ ��ū����
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);

$g4[title] = "�̸��� ����";
include_once("$g4[path]/_head.php");

if ($is_member) {
    $mb_id = $member[mb_id];
} else {
    $mb_id = $_SESSION['email_mb_id'];
    // �α����Ŀ� �̵��� ���̸�
    if ($mb_id) {
        ;
    } else {
        set_session('email_mb_id', "");
        alert("�̸��� ������ ���� �α��� �Ͻñ� �ٶ��ϴ�.", "./login.php?$qstr&url=".urlencode("$_SERVER[PHP_SELF]"));
    }
}
$member = get_member($mb_id);

// �����ڴ� �̸��� �������� ���ϰ� �մϴ�.
if ($is_admin)
    die;

$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
?>

<style type="text/css">
/* http://html.nhndesign.com/uio_factory/ui_pattern/box/1 */
.section1{position:relative;border:1px solid #e9e9e9;background:#fff;font-size:12px;line-height:normal;*zoom:1}
.section1 .hx{margin:0;padding:10px 0 7px 9px;border:1px solid #fff;background:#f7f7f7 url(img/br_section_title.gif) repeat-x left bottom;font-size:12px;line-height:normal;color:#333}
.section1 .tx{padding:10px;border-top:1px solid #e9e9e9;color:#666}
.section1 .section_more{position:absolute;top:9px;right:10px;font:11px Dotum, ����, Tahoma;color:#656565;text-decoration:none !important}
.section1 .section_more span{font:14px/1 Tahoma;color:#6e89aa}

/* http://html.nhndesign.com/uio_factory/ui_pattern/table/3 */
.tbl_type3,.tbl_type3 th,.tbl_type3 td{border:0}
.tbl_type3{width:100%;border-bottom:2px solid #dcdcdc;font-family:Tahoma;font-size:11px;text-align:center}
.tbl_type3 caption{display:none}
.tbl_type3 th{padding:7px 0 4px;border-top:2px solid #dcdcdc;background-color:#f5f7f9;color:#666;font-family:'����',dotum;font-size:12px;font-weight:bold}
.tbl_type3 td{padding:6px 0 4px;border-top:1px solid #e5e5e5;color:#4c4c4c}
</style>

<script type="text/javascript">
var member_skin_path = "<?=$member_skin_path?>";
</script>

<script type="text/javascript" src="<?="$g4[path]/js/jquery.js"?>"></script>
<script type="text/javascript" src="<?=$member_skin_path?>/jquery.ajax_register_form.js"></script>

<div class="section1">
  	<h2 class="hx">�̸��� ����</h2>
	  <div class="tx">
  	�������� �̸����ּҸ� �Է��Ͻʽÿ�.
  	<? if ($g4['email_certify_point']) { ?><br>�̸����� �����ϸ� <?=$g4['email_certify_point']?>����Ʈ�� ������ �帳�ϴ� (1ȸ�� ���� �˴ϴ�).<? }?>
    <? 
    // �̸��������� ����ϴ� ��쿡�� �߰� �޽����� ����� �ݴϴ�.
    if ($config['cf_use_email_certify']) { ?>
    �߼۵� ���������� �ݵ�� Ȯ���ؾ� �α����� �����մϴ�.
    <? } ?>
	  </div>
</div>

<br>
<form name="fwrite" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=token value='<?=$token?>'>
<input type=hidden name=mb_id id='mb_id' value='<?=$member[mb_id]?>'>
<input type=hidden name=mb_email_enabled id="mb_email_enabled" value="" >

<table class="tbl_type3" border="1" cellspacing="0" summary="�̸�������">
<caption>�̸�������</caption>
<colgroup>
<col width="120px">
<col>
</colgroup>
<tbody>
<tr>
    <td class="ranking" scope="row">��ϵ� �̸���</td>
    <td align=left>
    <?=$member['mb_email']?>
    <? if (!preg_match("/[1-9]/", $member[mb_email_certify])) echo "(�������� ����)"; else echo "(��������: " . cut_str($member[mb_email_certify],10,"") . ")"; ?>
    </td>
</tr>
    <tr>
    <td class="ranking" scope="row">������ �̸���</td>
    <td align=left>
    <input class=m_text type=text id='mb_email' name='mb_email' required style="ime-mode:disabled" size=38 maxlength=100 value='<?=$member[mb_email]?>' onkeyup='reg_mb_email_check()'>
    &nbsp;<span id='msg_mb_email'></span>
    </td>
</tr>
</tbody>
</table>

<div style="margin-left:120px; margin-top:10px;"> 
    <input type=image id="btn_submit" src="<?=$g4[bbs_path]?>/img/btn_mail_send.gif" border=0 accesskey='s' title="���Ϲ߼ۿ� ���ʰ� �ɸ��Ƿ� ��ٷ� �ּ���." alt="submit">
    <!-- �̸��� ������ �ϰ� �߰�, ȸ������������ �������� ��� Ż�� ����� ���� �մϴ� -->
    <?// if ($config[cf_use_email_certify] && !preg_match("/[1-9]/", $member[mb_email_certify])) { ?>
        &nbsp;&nbsp;&nbsp;<a href="javascript:member_leave();"><img src="<?=$member_skin_path?>/img/leave_btn.gif" border=0 title="�̸����� �������� �ʾƵ� ȸ��Ż�� �� �� �ֽ��ϴ�." alt="ȸ��Ż��"></a> 
    <?// } ?>
</div>

</form>

<script type="text/javascript">
function fwrite_submit(f) {

    // E-mail �˻�
    reg_mb_email_check();

    if (f.mb_email_enabled.value != '000') {
        alert('E-mail�� �Է����� �ʾҰų� �Է¿� ������ �ֽ��ϴ�.');
        f.mb_email.focus();
        return false;
    }

    f.action = './email_re_certify_update.php';

    return true;
}

function member_leave() 
{ 
   if (confirm("���� ȸ������ Ż�� �Ͻðڽ��ϱ�?")) 
            location.href = "<?=$g4[bbs_path]?>/mb_leave.php"; 
}
</script>

<?
include_once("$g4[path]/_tail.php");
?>
