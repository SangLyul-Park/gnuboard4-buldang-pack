<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

$subject_len = 60;
?>




<style type="text/css">
.trs { height:30px; background:#dddddd; text-align:center;}
.status_form_title { background:#eeeeee; width:13%; text-align:center;  }
.status_form_content { text-align:left; padding-left:5px; width:20%; background:#ffffff;  }
.n_title1 { font-family:����; font-size:9pt; color:#FFFFFF; }
.n_title2 { font-family:����; font-size:9pt; color:#5E5E5E; }
</style>
<table width="100%" height="40" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td >

		

		<table bgcolor="#dddddd" width='100%' cellpadding='1' cellspacing='1' border='0'>
		<tr class="trs">
		    <td class="status_form_title">�г���</td>
			<td class="status_form_content"><?=$member[mb_name]?></td>
			<td class="status_form_title">���̵�</td>
			<td class="status_form_content"><?=$member[mb_id]?></td>
			<td class="status_form_title">��������</td>
			<td class="status_form_content"><a href="<?=$g4['path']?>/bbs/member_confirm.php?url=register_form.php">�����ϱ�</a></td>
		</tr>

		<tr class="trs">
		    <td class="status_form_title">����Ʈ</td>
			<td class="status_form_content"><a href="javascript:win_point();"><?=$member[mb_point]?> point</a></td>
			<td class="status_form_title">����</td>
			<td class="status_form_content"><a href="javascript:win_memo('', '<?=$member[mb_id]?>', '<?=$_SERVER[SERVER_NAME]?>');"  onfocus="this.blur()"> (<?=$member['mb_memo_unread']?>)</a></td>
			<td class="status_form_title">��ũ��</td>
			<td class="status_form_content"><a href="javascript:win_scrap();"  onfocus="this.blur()">���� ��ũ��</a></td>
		</tr>

		
		</table>

		
<div style="background-color:rgb(247,247,247); border-width:5px; border-color:white; border-style:solid;"></div>

<table width='100%' >
<tr>
<td>
<? include("$myon_skin_path/tab.html"); ?>
</td>
</tr>
</table>

