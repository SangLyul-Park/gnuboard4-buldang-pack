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

include_once("$g4[path]/head.sub.php");
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
		// ��ȣȭ�� �� �Ǵ��� ���� ���� �� Ǯ���ش�.
		// echo "��ȣȭ ��û ȣ�� ����.<br/>";

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
// *** �׽�Ʈ�� �� ���� Ȯ���ϰ� ���� ��� Ǯ���ּ���.
//print_r($field);die;

// ������ �α׸� �����
$sql = " insert into $g4[realcheck_table] set mb_id = '$member[mb_id]', cb_authtype = '$hsCertRqstCausCd', cb_ip = '$_SERVER[REMOTE_ADDR]', cb_datetime = '$g4[time_ymdhis]', cb_errorcode = '$resultCd' ";
sql_query($sql);

// ���ó�� ===
switch ($resultCd) {
case "B000" : // ����ó��
    $sql = " update $g4[member_table] set mb_name = '$name', mb_realcheck = '$g4[time_ymdhis]', mb_hp = '$field[12]' where mb_id = '$member[mb_id]' ";
    sql_query($sql);
    
    include("./realcheck.skin.php");
    break;
default :     // ������ �ƴ� ���
    include("./realcheck.error.skin.php");
    break;
}

include_once("$g4[path]/tail.sub.php");
?>