<?php
include_once("./_common.php");

$g4[title] = "KCB(�ڸ���ũ�������) - okname ��������";
include_once("./_head.php");
include_once("./nc.config.php");


//	������� ���� Ȯ�μ��� ��� ȭ��
/* ���� ���� �׸� */
$idcfMbrComCd		  = $_POST["idcf_mbr_com_cd"];		  // �����ڵ�
$hsCertSvcTxSeqno	= $_POST["hs_cert_svc_tx_seqno"];	// �ŷ���ȣ
$hsCertRqstCausCd	= $_POST["hs_cert_rqst_caus_cd"];	// ������û�����ڵ� 2byte  (00:ȸ������, 01:��������, 02:ȸ����������, 03:��й�ȣã��, 04:��ǰ����, 99:��Ÿ);// 

$resultCd			    = $_POST["result_cd"];				    // ����ڵ�
$resultMsg			  = $_POST["result_msg"];				    // ����޼���
$certDtTm			    = $_POST["cert_dt_tm"];				    // �����Ͻ�
$di					      = $_POST["di"];						        // DI
$ci					      = $_POST["ci"];						        // CI
$name				      = $_POST["name"];					        // ����
$birthday			    = $_POST["birthday"];				      // �������
$gender				    = $_POST["gender"];					      //����
$nation				    = $_POST["nation"];					      //���ܱ��α���
$telComCd			    = $_POST["tel_com_cd"];			      //��Ż��ڵ�
$telNo				    = $_POST["tel_no"];					      //�޴�����ȣ
$returnMsg			  = $_POST["return_msg"];			      //���ϸ޽���
?>

<? if ($resultCd == "B000") { ?>
<h3>������ ���� ����Ȯ���� �Ǿ����ϴ�</h3>
<ul>
  <li>����			: <?=$name?> </li>
  <li>�������		: <?=$birthday?> </li>
  <li>����			: <?=$gender?> </li>
  <li>���ܱ��α���	: <?=$nation?> </li>
  <li>��Ż��ڵ�	: <?=$telComCd?> </li>
  <li>�޴�����ȣ	: <?=$telNo?> </li>
</ul>

��Ȱ�� ���� �̿��� ���� �ٸ� ����� ��Ź�帳�ϴ�.<br>
���� ������ ���� �ٸ� ����� ���������� �����Ͽ� ���ͳ� ���񽺿� �����ϴ� ���� ����� ����������<br>
<b>3�� ������ ¡���Ǵ� 1õ���� ������ ����</b>�� ó���� �� �ֽ��ϴ�.

<? } else {?>
<h3>����Ȯ�� �����Դϴ�</h3>
<ul>
  <li>����ڵ�		: <?=$resultCd?></li>
  <li>����޼���	: <?=$resultMsg?></li>
  <li>�ŷ���ȣ		: <?=$hsCertSvcTxSeqno?> </li>
  <li>����			: <?=$name?> </li>
  <li>�������		: <?=$birthday?> </li>
  <li>����			: <?=$gender?> </li>
  <li>���ܱ��α���	: <?=$nation?> </li>
  <li>��Ż��ڵ�	: <?=$telComCd?> </li>
  <li>�޴�����ȣ	: <?=$telNo?> </li>
</ul>

�ٽ� ���������÷���, <a href="./index.php">�̰�</a>�� Ŭ�����ּ���.
<? } ?>

<!--  // ���߰��������� Open�ؼ� ������.
<h3>�������</h3>
<ul>
  <li>�����ڵ�	: <?=$idcfMbrComCd?> </li>
  <li>���������ڵ�	: <?=$hsCertRqstCausCd?></li>
  <li>����ڵ�		: <?=$resultCd?></li>
  <li>����޼���	: <?=$resultMsg?></li>
  <li>�ŷ���ȣ		: <?=$hsCertSvcTxSeqno?> </li>
  <li>�����Ͻ�		: <?=$certDtTm?> </li>
  <li>DI			: <?=$di?> </li>
  <li>CI			: <?=$ci?> </li>
  <li>����			: <?=$name?> </li>
  <li>�������		: <?=$birthday?> </li>
  <li>����			: <?=$gender?> </li>
  <li>���ܱ��α���	: <?=$nation?> </li>
  <li>��Ż��ڵ�	: <?=$telComCd?> </li>
  <li>�޴�����ȣ	: <?=$telNo?> </li>
</ul>
-->

<?
include_once("./_tail.php"); 
?>