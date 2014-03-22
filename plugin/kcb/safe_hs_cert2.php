<?php
/**************************************************************************
 * ���ϸ� : safe_hs_cert2.php
 *
 * ������� ���� Ȯ�μ��� ���� ���� �Է� ȭ��
 *    (�� �������� KCB�˾�â���� �Է¿�)
 *
 * ������
 * 	���� ��ÿ��� 
 * 	response.write�� ����Ͽ� ȭ�鿡 �������� �����͸� 
 * 	�����Ͽ� �ֽñ� �ٶ��ϴ�. �湮�ڿ��� ����Ʈ�����Ͱ� ����� �� �ֽ��ϴ�.
**************************************************************************/
 
include_once("./_common.php");

// ��ȸ�� ���ӺҰ�
if ($member['mb_id'] == "")
    die;

$g4[title] = "KCB(�ڸ���ũ�������) - okname ����Ȯ��";

include_once("./nc.config.php");

// ���ȣ���ɾ�
$cmd = array($svcTxSeqno, $name, $birthday, $gender, $ntvFrnrTpCd, $mblTelCmmCd, $mbphnNo, $rsv1, $rsv2, $rsv3, $returnMsg, $returnUrl, $inTpBit, $hsCertMsrCd, $hsCertRqstCausCd, $memid, $qryIP, $qryDomain, $EndPointURL, $logPath, $option2);

if ($kcb_test) {
    echo $cmd."<br>";
    //exit;
}

//cmd ����
$output = NULL;
$ret = okname($cmd, $output);

if ($kcb_test)
    echo "ret=".$ret."<br>";

/**************************************************************************
 okname ���� ����
**************************************************************************/
$retcode = "";			// ����ڵ�
$retmsg = "";				// ����޽���
$e_rqstData = "";		// ��ȣȭ�ȿ�û������
	
if ($ret == 0) {//������ ��� ������ ������� ����
    $out = explode("\n", $output);
		$retcode = $out[0];
		$retmsg  = $out[1];
		$e_rqstData = $out[2];
} else {
		if($ret <=200)
			$retcode=sprintf("B%03d", $ret);
		else
			$retcode=sprintf("S%03d", $ret);
}
	
/**************************************************************************
 * safe_hs_cert3.php ���� ����
 **************************************************************************/
$targetId = "";				// Ÿ��ID (�˾����� ��ũ��Ʈ�� window.name �� �����ϰ� ����

// ########################################################################
// # ���ȯ�� ���� �ʿ�
// ########################################################################
if ($kcb_test)
    $commonSvlUrl = "https://tsafe.ok-name.co.kr:2443/CommonSvl";	// �׽�Ʈ URL
else
    $commonSvlUrl = "https://safe.ok-name.co.kr/CommonSvl";	      // � URL
?>
<html>
	<head>
	<title>KCB ������� ���� Ȯ�μ��� ����</title>
	<script>
		function request(){
		window.name = "<?=$targetId?>";

		document.form1.action = "<?=$commonSvlUrl?>";
		document.form1.method = "post";

		document.form1.submit();
	}
	</script>
	</head>

 <body>
	<form name="form1">
	<!-- ���� ��û ���� -->
	<!--// �ʼ� �׸� -->
	<input type="hidden" name="tc" value="kcb.oknm.online.safehscert.popup.cmd.P901_CertChoiceCmd">				<!-- ����Ұ�-->
	<input type="hidden" name="rqst_data"				value="<?=$e_rqstData?>">		<!-- ��û������ -->
	<input type="hidden" name="target_id"				value="<?=$targetId?>">			<!-- Ÿ��ID --> 
	<!-- �ʼ� �׸� //-->	
	</form>
  <form name="kcbResultForm" method="post" >
        <input type="hidden" name="idcf_mbr_com_cd" 		value="" 	/>
        <input type="hidden" name="hs_cert_svc_tx_seqno" 	value=""	/>
        <input type="hidden" name="hs_cert_msr_cd" 			value="" 	/>
        <input type="hidden" name="hs_cert_rqst_caus_cd" 	value="" 	/>
        <input type="hidden" name="result_cd" 				value="" 	/>
        <input type="hidden" name="result_msg" 				value="" 	/>
  </form>  
<?php
 	if ($retcode == "B000") {
		//������û
		echo ("<script>request();</script>");
	} else {
		//��û ���� �������� ����
		echo ("<script>alert(\"$retcode\"); self.close();</script>");
	}
?>
 </body>
</html>