<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 
?>

<style type="text/css">
<!--
.m_title    { BACKGROUND-COLOR: #F7F7F7; PADDING-LEFT: 15px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
.m_padding  { PADDING-LEFT: 15px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px; }
.m_padding2 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 0px; }
.m_padding3 { PADDING-LEFT: 0px; PADDING-top: 5px; PADDING-BOTTOM: 5px; }
.m_text     { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff; }
.m_text2    { BORDER: #D3D3D3 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: #dddddd; }
.m_textarea { BORDER: #D3D3D3 1px solid; BACKGROUND-COLOR: #ffffff; WIDTH: 100%; WORD-BREAK: break-all; }
.w_message  { font-family:����; font-size:9pt; color:#4B4B4B; }
.w_norobot  { font-family:����; font-size:9pt; color:#BB4681; }
.w_hand     { cursor:pointer; }
-->
</style>

<script>
var member_skin_path = "<?=$member_skin_path?>";
</script>

<script type="text/javascript" src="<?=$member_skin_path?>/jquery.ajax_register_form.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?=$g4[path]?>/js/sideview.js"></script>

<form name=fregisterform id=fregisterform method=post onsubmit="return fregisterform_submit(this);" enctype="multipart/form-data" autocomplete="off">
<input type=hidden name=w                id=w                   value="<?=$w?>">
<input type=hidden name=url              id=url                 value="<?=$urlencode?>">
<input type=hidden name=mb_jumin         id=mb_jumin            value="<?=$jumin?>">
<input type=hidden name=mb_id_enabled    id="mb_id_enabled"     value="" >
<input type=hidden name=mb_nick_enabled  id="mb_nick_enabled"   value="" >
<input type=hidden name=mb_email_enabled id="mb_email_enabled"  value="" >
<input type=hidden name=mb_name_enabled  id="mb_name_enabled"   value="" >
<input type=hidden name=ug_id            id="ug_id"             value="<?=$ug_id?>" >
<input type=hidden name=join_code        id="join_code"         value="<?=$join_code?>" >

<table width=600 cellspacing=0 align=center>
<tr>
    <td><img src="<?=$member_skin_path?>/img/join_form_title.gif" width="624" height="72">

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#CCCCCC">
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>���̵�</TD>
            <TD class=m_padding>
                <input class=m_text maxlength=20 size=20 id='mb_id' name="mb_id" required style="ime-mode:disabled" value="<?=$member[mb_id]?>" <? if ($w=='u') { echo "readonly style='background-color:#dddddd;'"; } ?>
                    <? if ($w=='') { echo "onblur='reg_mb_id_check()'"; } ?>>
                <? if ($w=='') { ?>
                <span id='msg_mb_id'></span>
                <table height=25 cellspacing=0 cellpadding=0 border=0>
                <tr><td><font color="#66a2c8">�� ������, ����, _ �� �Է� ����. �ּ� 4���̻� �Է��ϼ���.</font></td></tr>
                </table>
                <? } ?>
            </TD>
        </TR>
        
        <style type="text/css">
            /* �н����� ���� http://www.codeassembly.com/How-to-make-a-password-strength-meter-for-your-register-form */ 
            #barplus {position: relative; width: 300px;  display:block;} 
            #barplus #passwordStrength {position: absolute; top: 1px; left: 125px;} 
            #passwordStrength {position: relative; font-size: 1px; height:18px;} 
            .strength0,
            .strength1,
            .strength2,
            .strength3,
            .strength4,
            .strength5 {font-size:1px;position:absolute;top:0px;left:-120px;width:178px;height:16px;}
            .strength0 {background-image:url('<?=$member_skin_path?>/img/m1.gif');} /*�ſ����*/ 
            .strength1 {background-image:url('<?=$member_skin_path?>/img/m2.gif');} /*���ݺ���*/ 
            .strength2 {background-image:url('<?=$member_skin_path?>/img/m3.gif');} /*�������*/
            .strength3 {background-image:url('<?=$member_skin_path?>/img/m4.gif');} /*��ȣ����*/
            .strength4 {background-image:url('<?=$member_skin_path?>/img/m5.gif');} /*�����ϴ�*/
            .strength5 {background-image:url('<?=$member_skin_path?>/img/m6.gif');} /*�ſ�����*/
            .strength0t,
            .strength1t,
            .strength2t,
            .strength3t,
            .strength4t,
            .strength5t {font-weight:bold;letter-spacing:-2px;font-size:8pt;display:none;}

            .strength0t,
            .strength1t {color:#ff0066;}
            .strength2t,
            .strength3t {color:#77a80f;}
            .strength4t,
            .strength5t {color:#4ab3d6;}

            #passwordDescription {padding-left: 5px; display:block; } 
        </style>

        <script language="javascript">
        <!--
        function passwordStrength(password) { //�̹����� ��ü�ؼ� ���ڴ� ������ �ʽ��ϴ�.
                    var desc = new Array();
                    desc[0] = "<label class=\"strength0t\">�ſ����</label>"; // �ſ����
                    desc[1] = "<label class=\"strength1t\">���ݺ���</label>"; // ���ݺ���
                    desc[2] = "<label class=\"strength2t\">�������</label>"; // �������
                    desc[3] = "<label class=\"strength3t\">��ȣ����</label>"; // ��ȣ����
                    desc[4] = "<label class=\"strength4t\">�����ϴ�</label>"; // �����ϴ�
                    desc[5] = "<label class=\"strength5t\">�ſ�����</label>"; // �ſ�����
                    var score = 0;
                    
                    //if password length == 0, do nothing
                    if (password.length == 0) return;
                    //if password bigger than 6 give 1 point
                    if (password.length > 6) score++;
                    //if password has both lower and uppercase characters give 1 point 
                    if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;
                    //if password has at least one number give 1 point 
                    if (password.match(/\d+/)) score++; 
                    //if password has at least one special caracther give 1 point 
                    if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;
                    //if password bigger than 12 give another 1 point 
                    if (password.length > 12) score++; 
                    
                    //document.getElementById("passwordDescription").innerHTML = desc[score]; 
                    document.getElementById("passwordStrength").className = "strength" + score;
                }
        -->
        </script>

        <TR bgcolor="#FFFFFF">
           <TD class=m_title>�н�����</TD>
           <TD class=m_padding>
           <div id="barplus"><INPUT class=m_text type=password name="mb_password" id="mb_password" style="ime-mode:disabled" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="�н�����" onblur="passwordStrength(this.value)" ><div id="passwordStrength">&nbsp;</div></div>    
           </TD>
        </TR>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>�н����� Ȯ��</TD>
            <TD class=m_padding><INPUT class=m_text type=password name="mb_password_re" style="ime-mode:disabled" size=20 maxlength=20 <?=($w=="")?"required":"";?> itemname="�н����� Ȯ��"></TD>
        </TR>
        </TABLE>
    </td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td height="1" bgcolor="#ffffff"></td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#CCCCCC">
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>�̸�</TD>
            <TD class=m_padding>
                <input name=mb_name id=mb_name required itemname="�̸�" value="<?=$member[mb_name]?>" <?=$member[mb_name]?"readonly class=m_text2":"class=m_text";?>
                <? if ($w=='') { echo "onblur='reg_mb_name_check()'"; } ?>>

                <? if ($w=='') { ?>
                <span id='msg_mb_name'></span>
                <table height=25 cellspacing=0 cellpadding=0 border=0>
                <tr><td><font color="#66a2c8">�� ������� �ѱ� �Ǵ� ������ �Է� �����մϴ�.</font></td></tr>
                </table>
                <? } ?>
            </TD>
        </TR>

        <? if ($member[mb_nick_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_nick_modify] * 86400))) { // ����������� �����ٸ� �������� ?>
        <input type=hidden name=mb_nick_default value='<?=$member[mb_nick]?>'>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>����</TD>
            <TD class='m_padding lh'>
                <input class=m_text type=text id='mb_nick' name='mb_nick' required hangulalphanumeric maxlength=20 value='<?=$member[mb_nick]?>'
                    onblur="reg_mb_nick_check();">
                <span id='msg_mb_nick'></span>
                <br>������� �ѱ�,����,���ڸ� �Է� ���� (�ѱ�2��, ����4�� �̻�)
                <br>������ �ٲٽø� ������ <?=(int)$config[cf_nick_modify]?>�� �̳����� ���� �� �� �����ϴ�.
            </TD>
        </TR>
        <? } else { ?>
        <input type=hidden name="mb_nick_default" value='<?=$member[mb_nick]?>'>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>����</TD>
            <?
            $d_times = (int)(($config[cf_nick_modify] * 86400 - ( $g4[server_time] - strtotime($member[mb_nick_date]))) / 86400) + 1;
            ?>
            <TD class='m_padding lh'><input name="mb_nick" value="<?=$member[mb_nick]?>" readonly> �� <?=$d_times?>�� �� ������ ���� �մϴ�.
            </TD>
        </TR>
        <? } ?>

        <input type=hidden name='old_email' value='<?=$member[mb_email]?>'>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>E-mail</TD>
            <TD class='m_padding lh'>
                <input class=m_text type=text id='mb_email' name='mb_email' required style="ime-mode:disabled" size=38 maxlength=100 value='<?=$member[mb_email]?>'
                    onblur="reg_mb_email_check()">
                <span id='msg_mb_email'></span> 
                <? if ($member[mb_email_certify]) echo "<br>" . cut_str($member[mb_email_certify],10,"") . "�� �����Ǿ����ϴ�." ?>
                <? if ($config[cf_use_email_certify]) { ?>
                    <? if ($w=='') { echo "<br>e-mail �� �߼۵� ������ Ȯ���� �� �����ϼž� ȸ�������� �Ϸ�˴ϴ�."; } ?>
                    <? if ($w=='u') { echo "<br>e-mail �ּҸ� �����Ͻø� �ٽ� �����ϼž� �մϴ�."; } ?>
                <? } ?>
                <? if ($w=='u')
                    if ($g4['email_certify_point'] || $config['cf_use_email_certify'])
                        echo "<br><a href='$g4[bbs_path]/email_re_certify.php' target=new>�̸��������Ϸ� ����</a>�� �����ø� ����â�� �����ϴ�.";
                ?>
                <br>���̵�, ��й�ȣ �н� �� ����Ȯ�ο����� ���ǹǷ�
                <br>��ȿ�� �̸��� �������� �Է��Ͻñ� �ٶ��ϴ�.
            </TD>
        </TR>

        <? if ($w=="") { ?>
            <? if ($config[cf_use_birthdate]) { ?>
            <TR bgcolor="#FFFFFF">
                <TD class=m_title>�������</TD>
                <TD class=m_padding><input class=m_text type=text id=mb_birth name='mb_birth' size=8 maxlength=8 minlength=8 required numeric itemname='�������' value='<?=$member[mb_birth]?>' readonly title='���� �޷� �������� Ŭ���Ͽ� ��¥�� �Է��ϼ���.'>
                    <a href="javascript:win_calendar('mb_birth', document.getElementById('mb_birth').value, '');"><img src='<?=$member_skin_path?>/img/calendar.gif' border=0 align=absmiddle title='�޷� - ��¥�� �����ϼ���'></a></TD>
            </TR>
            <? } ?>
        <? } ?>

        <? if ($member[mb_sex]) { ?>
            <input type=hidden name=mb_sex value='<?=$member[mb_sex]?>'>
            <TR bgcolor="#FFFFFF">
                <TD class=m_title>����</TD>
                <TD class=m_padding>
                    <? 
                    switch ($member[mb_sex]) {
                      case 'F' : echo "����"; break;
                      case 'M' : echo "����"; break;
                    }
                    ?>
                </td>
            </TR>
        <? } else { ?>
            <? if ($config[cf_use_sex]) { ?>
            <TR bgcolor="#FFFFFF">
                <TD class=m_title>����</TD>
                <TD class=m_padding>
                    <select id=mb_sex name=mb_sex required itemname='����'>
                    <option value=''>�����ϼ���
                    <option value='F'>����
                    <option value='M'>����
                    </select>
                    <script language="JavaScript">//document.getElementById('mb_sex').value='<?=$member[mb_sex]?>';</script>
                    </td>
            </TR>
            <? } ?>
        <? } ?>

        <? if ($config[cf_use_homepage]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>Ȩ������</TD>
            <TD class=m_padding><input class=m_text type=text name='mb_homepage' size=38 maxlength=255 <?=$config[cf_req_homepage]?'required':'';?> itemname='Ȩ������' value='<?=$member[mb_homepage]?>'></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_tel]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>��ȭ��ȣ</TD>
            <TD class=m_padding><input class=m_text type=text name='mb_tel' size=21 maxlength=20 <?=$config[cf_req_tel]?'required':'';?> itemname='��ȭ��ȣ' value='<?=$member[mb_tel]?>'></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_hp]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>�ڵ�����ȣ</TD>
            <? if ($config[cf_hp_certify] && $w=='u') { ?>
            <TD class='m_padding lh'> 
            <? 
            if ($member[mb_hp_certify_datetime] != '0000-00-00 00:00:00') { 
                echo "<span class='small' style='color:#ff3300;'>$member[mb_hp_certify_datetime] �� �����Ͽ����ϴ�.</span><br>"; 
                echo "<input type='hidden' name='mb_hp_old' value='$member[mb_hp]'>"; 
            } 
            ?> 
            <input class=m_text type=text name='mb_hp' size=21 maxlength=20 <?=$config[cf_req_hp]?'required':'';?> itemname='�ڵ�����ȣ' value='<?=$member[mb_hp]?>'>  
            <input type=button value='������ȣ ����' class='small' onclick="hp_certify(this.form);">  
              ������ȣ : <input class=m_text type=text name='mb_hp_certify' size=6 maxlength=6> 6�ڸ� ����<br> 
            <span class=small style='color:blue;'> 
                �ڵ������� ���۵� ������ȣ�� �Է� �� ȸ�������� ����(Ȯ�� ��ư)�Ͻñ� �ٶ��ϴ�.<br> 
            </span> 
            <script> 
            function hp_certify(f) { 
                var pattern = /^01[0-9][-]{0,1}[0-9]{3,4}[-]{0,1}[0-9]{4}$/; 
                if(!pattern.test(f.mb_hp.value)){  
                    alert("�ڵ��� ��ȣ�� �Էµ��� �ʾҰų� ��ȣ�� Ʋ���ϴ�.\n\n�ڵ��� ��ȣ�� 010-123-4567 �Ǵ� 01012345678 �� ���� �Է��� �ֽʽÿ�."); 
                    f.mb_hp.select(); 
                    f.mb_hp.focus(); 
                    return; 
                } 

                win_open("<?=$g4[sms_path]?>/hp_certify.php?hp="+f.mb_hp.value+"&token=<?=$token?>", "hiddenframe"); 
            } 
            </script> 
            </TD> 
            <? } else { ?>
            <TD class=m_padding><input class=m_text type=text name='mb_hp' size=21 maxlength=20 <?=$config[cf_req_hp]?'required':'';?> itemname='�ڵ�����ȣ' value='<?=$member[mb_hp]?>'></TD>
            <? } ?>    
        </TR>
        <? } ?>

        <? if ($config[cf_use_addr]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD class=m_title>�ּ�</TD>
            <TD valign="middle" class=m_padding>
                <table width="330" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td height="25"><input class=m_text type=text name='mb_zip1' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='�����ȣ ���ڸ�' value='<?=$member[mb_zip1]?>'>
                         - 
                        <input class=m_text type=text name='mb_zip2' size=4 maxlength=3 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='�����ȣ ���ڸ�' value='<?=$member[mb_zip2]?>'>
                        &nbsp;<a href="javascript:;" onclick="win_zip('fregisterform', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2');"><img width="91" height="20" src="<?=$member_skin_path?>/img/post_search_btn.gif" border=0 align=absmiddle></a></td>
                </tr>
                <tr>
                    <td height="25" colspan="2"><input class=m_text type=text name='mb_addr1' size=60 readonly <?=$config[cf_req_addr]?'required':'';?> itemname='�ּ�' value='<?=$member[mb_addr1]?>'></td>
                </tr>
                <tr>
                    <td height="25" colspan="2"><input class=m_text type=text name='mb_addr2' size=60 <?=$config[cf_req_addr]?'required':'';?> itemname='���ּ�' value='<?=$member[mb_addr2]?>'></td>
                </tr>
                </table>
            </TD>
        </TR>
        <? } ?>

        </TABLE>
    </td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="1" bgcolor="#ffffff"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#CCCCCC">
        <TABLE cellSpacing=1 cellPadding=0 width=100%>

        <? if ($config[cf_use_signature]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>����</TD>
            <TD class=m_padding><textarea name=mb_signature class=m_textarea rows=3 style='width:95%;' <?=$config[cf_req_signature]?'required':'';?> itemname='����'><?=$member[mb_signature]?></textarea></TD>
        </TR>
        <? } ?>

        <? if ($config[cf_use_profile]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>�ڱ�Ұ�</TD>
            <TD class=m_padding><textarea name=mb_profile class=m_textarea rows=3 style='width:95%;' <?=$config[cf_req_profile]?'required':'';?> itemname='�ڱ� �Ұ�'><?=$member[mb_profile]?></textarea></TD>
        </TR>
        <? } ?>

        <? if ($member[mb_level] >= $config[cf_icon_level]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>ȸ��������</TD>
            <TD class=m_padding><INPUT class=m_text type=file name='mb_icon' size=30>
                <table width="350" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class=m_padding3>* �̹��� ũ��� ����(<?=$config[cf_member_icon_width]?>�ȼ�)x����(<?=$config[cf_member_icon_height]?>�ȼ�) ���Ϸ� ���ּ���.<br>&nbsp;&nbsp;(gif/jpg/bmp/png�� ���� / �뷮:<?=number_format($config[cf_member_icon_size]/1000)?>k ����Ʈ ���ϸ� ��ϵ˴ϴ�.)
                            <? if ($w == "u" && file_exists($mb_icon)) { ?>
                                <br><img src='<?=$mb_icon?>' align=absmiddle> <input type=checkbox name='del_mb_icon' value='1'>����
                            <? } ?>
                        </td>
                    </tr>
                </table></TD>
        </TR>
        <? } ?>

        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>���ϸ�����</TD>
            <TD class=m_padding><input type=checkbox name=mb_mailling value='1' <?=($w=='' || $member[mb_mailling])?'checked':'';?>>���� ������ �ްڽ��ϴ�.</TD>
        </TR>
        <? if ($config[cf_use_hp]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>SMS ���ſ���</TD>
            <TD class=m_padding><input type=checkbox name=mb_sms value='1' <?=($w=='' || $member[mb_sms])?'checked':'';?>>�ڵ��� ���ڸ޼����� �ްڽ��ϴ�.</TD>
        </TR>
        <? } ?>

        <? if ($config[cf_memo_realtime]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>�ǽð�����</TD>
            <TD class=m_padding>
            <input type=checkbox name=mb_realmemo value='1' <?=($w=='' || $member[mb_realmemo])?'checked':'';?>>�ǽð����� ���
            <input type=checkbox name=mb_realmemo_sound value='1' <?=($w=='' || $member[mb_realmemo_sound])?'checked':'';?>>�����˸����(�ǽð����� ���ÿ��� ������)
            </TD>
        </TR>
        <? } ?>
        
        <? if ($member[mb_open_date] <= date("Y-m-d", $g4[server_time] - ($config[cf_open_modify] * 86400)) || !$member['mb_open']) { // �������� �������� �����ٸ� �������� ?>
        <input type=hidden name=mb_open_default value='<?=$member[mb_open]?>'>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>��������</TD>
            <TD class=m_padding><input type=checkbox name=mb_open value='1' <?=($w=='' || $member[mb_open])?'checked':'';?>>�ٸ��е��� ���� ������ �� �� �ֵ��� �մϴ�.
                <? if ($config[cf_open_modify]) { ?>
                <br>&nbsp;&nbsp;&nbsp;&nbsp; ���������� �ٲٽø� ������ <?=(int)$config[cf_open_modify]?>�� �̳����� ������ �ȵ˴ϴ�.</td>
                <? } ?>
        </TR>
        <? } else { ?>
        <input type=hidden name="mb_open" value="<?=$member[mb_open]?>">
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>��������</TD>
            <?
            $d_times = (int)(($config[cf_open_modify] * 86400 - ( $g4[server_time] - strtotime($member[mb_open_date]))) / 86400) + 1;
            if ($member[mb_open]) $msg="��������"; else $msg = "���������";
            ?>
            <TD class='m_padding lh'>
                ���� <?=$msg?> �����̸�, <?=$member[mb_open_date]?>�� ������ �����߽��ϴ�.<br>
                ���������� ������ <?=(int)$config[cf_open_modify]?>�� �̳�, <?=date("Y�� m�� j��", strtotime("$member[mb_open_date] 00:00:00") + ($config[cf_open_modify] * 86400))?> ������ ������ �ȵ˴ϴ�.<br> 
                �̷��� �ϴ� ������ ���� �������� �������� ���Ͽ� ������ ���� �� ���� �ʴ� ��츦 ���� ���ؼ� �Դϴ�. 
            </td>
        </TR>
        <? } ?>

        <? if ($w == "" && $config[cf_use_recommend]) { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>��õ�ξ��̵�</TD>
            <TD class=m_padding>
            <? if ($mb_recommend) { ?>
            <input type=hidden name=mb_recommend         id=mb_recommend            value="<?=$mb_recommend?>">
            <?=$mb_recommend?>
            <? } else { ?>
            <input type=text name=mb_recommend maxlength=20 size=20 <?=$config[cf_req_recommend]?'required':'';?> itemname='��õ�ξ��̵�' class=m_text>
            <? } ?>
            <? if ($config[cf_recommend_point]) { ?>
                *��õ ȸ������ <?=$config[cf_recommend_point]?> ����Ʈ�� �����մϴ�.
            <? } ?>
            </TD>
        </TR>
        <? } else if ( $config[cf_use_recommend] && $member[mb_recommend]) {?>
        <TR bgcolor="#FFFFFF">
            <script type='text/javascript' src='<?=$g4[path]?>/js/sideview.js'></script>
            <? $mb=get_member($member['mb_recommend'], "mb_id, mb_nick")?>
            <TD width="160" class=m_title>��õ�ξ��̵�</TD>
            <TD class=m_padding><?=get_sideview($mb['mb_id'], $mb['mb_nick'])?></TD>
        </TR>
        <? } ?>

        <? if ($w == "u") { ?>
        <TR bgcolor="#FFFFFF">
            <TD width="160" class=m_title>������</TD>
            <TD class=m_padding><?=$member[mb_datetime]?></TD>
        </TR>
        <? } ?>

        </TABLE>
    </td>
</tr>
</table>

<? if ($config[cf_use_norobot]) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="1" bgcolor="#ffffff"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td bgcolor="#CCCCCC">
        <TABLE cellSpacing=1 cellPadding=0 width=100%>
        <TR bgcolor="#FFFFFF">
            <td width="160" height="28" class=m_title>
                <script type="text/javascript" src="<?="$g4[path]/zmSpamFree/zmspamfree.js"?>"></script>
                <img id="zsfImg">
            </td>
            <td class=m_padding>
                <input class='ed' type=input size=10 name=wr_key id=wr_key itemname="�ڵ���Ϲ���" required >&nbsp;&nbsp;������ ���ڸ� �Է��ϼ���.
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>
<? } ?>

<p align=center> 
    <INPUT type=image width="66" height="20" src="<?=$member_skin_path?>/img/join_ok_btn.gif" border=0 accesskey='s'> 
    <? if ($is_member) { ?> 
    <a href="javascript:member_leave();"><img src="<?=$member_skin_path?>/img/leave_btn.gif" border=0 align=right></a> 
    <? } ?> 
</td></tr> 
</table> 

</form> 

<script type="text/javascript">
$(document).ready(function(){
    if ($('#w').val() == '')
        $('#mb_id').focus();
    else {
        $('#mb_password').focus();
    }
});

// submit ���� ��üũ
function fregisterform_submit(f) 
{
    // ȸ�����̵� �˻�
    if (f.w.value == "") {

        reg_mb_id_check();

        if (f.mb_id_enabled.value != '000') {
            alert('ȸ�����̵� �Է����� �ʾҰų� �Է¿� ������ �ֽ��ϴ�.');
            f.mb_id.focus();
            return false;
        }
    }

    if (f.w.value == '') {
        if ($.trim(f.mb_password.value).length < 3) {
            alert('�н����带 3���� �̻� �Է��Ͻʽÿ�.');
            f.mb_password.focus();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert('�н����尡 ���� �ʽ��ϴ�.');
        f.mb_password_re.focus();
        return false;
    }

    if ($.trim(f.mb_password.value).length > 0) {
        if ($.trim(f.mb_password_re.value).length < 3) {
            alert('�н����带 3���� �̻� �Է��Ͻʽÿ�.');
            f.mb_password_re.focus();
            return false;
        }
    }

    // �̸� �˻�
    if (f.w.value == "") {

        reg_mb_name_check();

        if (f.mb_name_enabled.value != '000') {
            alert('�̸��� �Է����� �ʾҰų� �Է¿� ������ �ֽ��ϴ�.');
            f.mb_name.focus();
            return false;
        }
    }

    // ���� �˻�
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {

        reg_mb_nick_check();

        if (f.mb_nick_enabled.value != '000') {
            alert('������ �Է����� �ʾҰų� �Է¿� ������ �ֽ��ϴ�.');
            f.mb_nick.focus();
            return false;
        }
    }

    // E-mail �˻�
    if ((f.w.value == "") ||
        (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {

        reg_mb_email_check();

        if (f.mb_email_enabled.value != '000') {
            alert('E-mail�� �Է����� �ʾҰų� �Է¿� ������ �ֽ��ϴ�.');
            f.mb_email.focus();
            return false;
        }
    }

    if (typeof(f.mb_birth) != 'undefined') {
        if ($.trim(f.mb_birth.value).length < 1) {
            alert('�޷� ��ư�� Ŭ���Ͽ� ������ �Է��Ͽ� �ֽʽÿ�.');
            //f.mb_birth.focus();
            return false;
        }

        var todays = <?=date("Ymd", $g4['server_time']);?>;
        // ���ó�¥���� ������ ���� �ű⼭ 140000 �� ����.
        // ����� 0 �̻��� ����̸� �� 14���� ��������
        var n = todays - parseInt(f.mb_birth.value) - 140000;
        if (n < 0) {
            alert("�� 14���� ������ ���� ��̴� ������Ÿ� �̿����� �� ������ȣ � ���� ����\n\n�� 31�� 1���� ������ ���Ͽ� �����븮���� ���Ǹ� ���� �ϹǷ�\n\n�����븮���� �̸��� ����ó�� '�ڱ�Ұ�'���� ������ �Է��Ͻñ� �ٶ��ϴ�.");
            return false;
        }
    }

    if (typeof(f.mb_sex) != 'undefined') {
        if (f.mb_sex.value == '') {
            alert('������ �����Ͽ� �ֽʽÿ�.');
            f.mb_sex.focus();
            return false;
        }
    }

    if (typeof f.mb_icon != 'undefined') {
        if (f.mb_icon.value) {
            if (!f.mb_icon.value.toLowerCase().match(/.(gif|bmp|jpg|png)$/i)) {
                alert('ȸ���������� gif|jpg|bmp|png ������ �ƴմϴ�.');
                f.mb_icon.focus();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != 'undefined') {
        if (f.mb_id.value == f.mb_recommend.value) {
            alert('������ ��õ�� �� �����ϴ�.');
            f.mb_recommend.focus();
            return false;
        }
    }

    if (typeof(f.wr_key) != 'undefined') {
        if (!checkFrm()) {
            alert ("���Թ����ڵ�(Captcha Code)�� Ʋ�Ƚ��ϴ�. �ٽ� �Է��� �ּ���.");
            return false;
        }
    }

    <?
    if ($g4[https_url])
        echo "f.action = '$g4[https_url]/$g4[bbs]/register_form_update.php';";
    else
        echo "f.action = './register_form_update.php';";
    ?>

    // ������������ �ڵ�� �ݵ�� ���ԵǾ�� �մϴ�.
    set_cookie("<?=md5($token)?>", "<?=base64_encode($token)?>", 1, "<?=$g4['cookie_domain']?>");

    return true;
}

// ȸ�� Ż�� 
function member_leave() 
{ 
    if (confirm("���� ȸ������ Ż�� �Ͻðڽ��ϱ�?")) 
            location.href = "<?=$g4[bbs_path]?>/mb_leave.php"; 
}
</script>
