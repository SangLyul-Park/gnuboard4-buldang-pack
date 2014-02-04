<?php
/**************************************************************************
	���ϸ� : safe_hs_cert3.php
	
	������� ���� Ȯ�μ��� ��� ȭ��(return url)
**************************************************************************/

include_once("./_common.php");

// ��ȸ�� ���ӺҰ�
if ($member['mb_id'] == "")
    die;

$g4[title] = "KCB(�ڸ���ũ�������) - okname ����Ȯ��";

include_once("./nc.config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="content-type" content="text/html; charset=<?=$g4['charset']?>">
<html xmlns="http://www.w3.org/1999/xhtml">
<?
/* ���� ���� �׸� */
$idcfMbrComCd			=	$_POST["idcf_mbr_com_cd"];		  // �����ڵ�
$hsCertSvcTxSeqno	=	$_POST["hs_cert_svc_tx_seqno"];	// �ŷ���ȣ
$rqstSiteNm				=	$_POST["rqst_site_nm"];			    // ���ӵ�����	
$hsCertRqstCausCd	=	$_POST["hs_cert_rqst_caus_cd"];	// ������û�����ڵ� 2byte  (00:ȸ������, 01:��������, 02:ȸ����������, 03:��й�ȣã��, 04:��ǰ����, 99:��Ÿ)

$resultCd				=	$_POST["result_cd"];			// ����ڵ�
$resultMsg			=	$_POST["result_msg"];			// ����޼���
$certDtTm				=	$_POST["cert_dt_tm"];			// �����Ͻ�

/**************************************************************************
 * ��� ȣ��	; ������� ���� Ȯ�μ��� ��� �����͸� ��ȣȭ�Ѵ�.
 **************************************************************************/
$encInfo = $_POST["encInfo"];

//KCB���� ����Ű
$WEBPUBKEY = trim($_POST["WEBPUBKEY"]);
//KCB���� ����
$WEBSIGNATURE = trim($_POST["WEBSIGNATURE"]);

// ����Ȯ�� - ��ȣȭŰ ���� ���� (������) - ������ �־��� ���ϸ����� �ڵ� ���� ��
if ($kcb_test)
    $keypath = "$kcblog/tsafecert_$idcfMbrComCd.key";
else
    $keypath = "$kcblog/safecert_$idcfMbrComCd.key";

$cpubkey = $WEBPUBKEY;    //server publickey
$csig = $WEBSIGNATURE;    //server signature

// ��ɾ�
$cmd = "$exe $keypath $idcfMbrComCd $EndPointURL $WEBPUBKEY $WEBSIGNATURE $encInfo $logPath $option3";
if ($kcb_test) {
    echo "$cmd<br>";
}

// ����
exec($cmd, $out, $ret);
if ($kcb_test) {
    echo "ret=$ret<br/>";
}

if($ret == 0) {
		echo "��ȣȭ ��û ȣ�� ����.<br/>";		 
		// ������ο��� ���� ����
		foreach($out as $a => $b) {
			if($a < 17) {
				$field[$a] = $b;
			}
		}
		$resultCd = $field[0];
} else {
		echo "��ȣȭ ��û ȣ�� ����. ���ϰ� : ".$ret."<br/>";		 
		if($ret <=200)
			$resultCd=sprintf("B%03d", $ret);
		else
			$resultCd=sprintf("S%03d", $ret);
}

// *** �� �� ���� $_POST �� �� ��� ���.
$resultCd = $field[0];
$resultMsg = $field[1];
$hsCertSvcTxSeqno = $field[2];

// *** �׽�Ʈ�Ҷ� Ǯ���ּ���.
//$kcb_test = 1;
if ($kcb_test) {
    echo "ó������ڵ�		:$resultCd	<br/>";
    echo "ó������޽���	:$field[1]	<br/>";
    echo "�ŷ��Ϸù�ȣ		:$field[2]	<br/>";
    echo "�����Ͻ�			  :$field[3]	<br/>";
    echo "DI				      :$field[4]	<br/>";
    echo "CI				      :$field[5]	<br/>";
    echo "����				    :$field[7]	<br/>";
    echo "�������			  :$field[8]	<br/>";
    echo "����				    :$field[9]	<br/>";
    echo "���ܱ��α���		:$field[10]	<br/>";
    echo "��Ż��ڵ�		  :$field[11]	<br/>";
    echo "�޴�����ȣ		  :$field[12]	<br/>";
    echo "���ϸ޽���		  :$field[16]	<br/>";
}
// *** �׽�Ʈ�� �� Ǯ���ּ���.
//print_r($field);die;

// ���ó�� ===
switch ($resultCd) {
    case "B000" : // ����ó��
        $sql = " update $g4[member_table] set mb_name = '$name', mb_realcheck = '$g4[time_ymdhis]', mb_hp = '$field[12]' where mb_id = '$member[mb_id]' ";
        sql_query($sql);

        // ����� Ȯ������
        @include("./realcheck.skin.php");

        break;
    default :     // ������ �ƴ� ���
        ;
        break;
}

// ������ �α׸� �����
$sql = " insert into $g4[realcheck_table] set mb_id = '$member[mb_id]', cb_authtype = '$hsCertRqstCausCd', cb_ip = '$_SERVER[REMOTE_ADDR]', cb_datetime = '$g4[time_ymdhis]', cb_errorcode = '$resultCd' ";
sql_query($sql);
?>
<head>
	<title>KCB ������� ���� Ȯ�μ��� ����</title>
  <script language="javascript" type="text/javascript" >
	function fncOpenerSubmit() {
		opener.document.kcbResultForm.idcf_mbr_com_cd.value = "<?=$idcfMbrComCd?>";
		opener.document.kcbResultForm.hs_cert_svc_tx_seqno.value = "<?=$hsCertSvcTxSeqno?>";
		opener.document.kcbResultForm.idcf_mbr_com_cd.value = "<?=$idcfMbrComCd?>";
		opener.document.kcbResultForm.hs_cert_rqst_caus_cd.value = "<?=$hsCertRqstCausCd?>";
		opener.document.kcbResultForm.result_cd.value = "<?=$resultCd?>";
		opener.document.kcbResultForm.result_msg.value = "<?=$field[1]?>";
		opener.document.kcbResultForm.hs_cert_svc_tx_seqno.value = "<?=$field[2]?>";
		opener.document.kcbResultForm.cert_dt_tm.value = "<?=$field[3]?>";
		opener.document.kcbResultForm.di.value = "<?=$field[4]?>";
		opener.document.kcbResultForm.ci.value = "<?=$field[5]?>";
		opener.document.kcbResultForm.name.value = "<?=$field[7]?>";
		opener.document.kcbResultForm.birthday.value = "<?=$field[8]?>";
		opener.document.kcbResultForm.gender.value = "<?=$field[9]?>";
		opener.document.kcbResultForm.nation.value = "<?=$field[10]?>";
		opener.document.kcbResultForm.tel_com_cd.value = "<?=$field[11]?>";
		opener.document.kcbResultForm.tel_no.value = "<?=$field[12]?>";
		opener.document.kcbResultForm.return_msg.value = "<?=$field[16]?>";
		opener.document.kcbResultForm.action = "safe_hs_cert4.php";
		opener.document.kcbResultForm.submit();
		self.close();
	}	
	</script>
	</head>
	<body onload="javascript:fncOpenerSubmit()">
	</body>
</html>