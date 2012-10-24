<?php
error_reporting(E_ALL);
DEFINE ( 'AR' , dirname(__FILE__).'/' );
DEFINE ( 'AR1' , dirname(__FILE__).'/../data/' );
if ( !is_dir(AR1.'Log') ) { mkdir ( AR1.'Log', 0755 ); chmod( AR1.'Log', 0755); }
if ( !is_dir(AR1.'Log/Connect') ) { mkdir ( AR1.'Log/Connect', 0755 ); chmod( AR1.'Log/Connect', 0755); }
$noticeText = '<div id="rslt" class="r">�Ͻ��Թ����ڵ带 �Է��Ͻø� ����� ǥ���մϴ�.</div>';
if ( isset($_POST['zsfCode']) )
{
	$zsfCode = stripslashes(trim($_POST['zsfCode']));
	$noticeText = '�Ͻ��Թ����ڵ� �Է°��� ';
	include 'zmSpamFree.php';
	/*
		zsfCheck �Լ��� �� ���� �μ��� ����� �� �ִ�.
		$_POST['zsfCode'] : ����ڰ� �Է��� ���Թ����ڵ� ��
		'DemoPage' : �����ڰ� �α����Ͽ� ���ܳ��� ���� �޸�, ���� ��� bulletin �Խ����� comment ����� ���Թ����ڵ带 �Է��ߴ� �Ѵٸ�
						'bulletin|comment'��� �� ������, � �Խ����� � ��Ȳ���� ���������ڵ尡 �°ų� Ʋ�ȴ��� �� �� ���� ���̴�.
						�̿ܿ� '������ �Ϻ�'�� '�� ������ �Ϻ�'�� ���� ������, � ���Ա������ ���ܵǾ������� Ȯ���� �� �ִ�.
						����� �� �μ��� ���� �����ϴ�.
	*/
	$r = zsfCheck ( $_POST['zsfCode'],'DemoPage' );	# $_POST['zsfCode']�� �Էµ� ���Թ����ڵ� ���̰�, 'DemoPage'�� ��Ÿ ����ϰ���
	$noticeText .= $r ? '�¾ҽ��ϴ�.' : 'Ʋ�Ƚ��ϴ�.';
	$noticeText .= '(��: \''.$zsfCode.'\')';
	$noticeText = '<div id="rslt" class="r'.($r*1).'">'.$noticeText.'</div>';
}
$listNo=1;	# ��� ��ȣ
$solveNo=1;	# �����ذ� ��ȣ
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<title> ZmSpamFree 1.1 Demo - http://www.casternet.com/spamfree/</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="ZnMee,���ع�" />
	<meta name="keywords" content="http://www.casternet.com,http://www.spamfree.kr,CAPTCHA" />
	<meta name="description" content="Automatic test program to tell computers and humans apart. Programmed by ZnMee in Republic of Korea." />
	<style type="text/css">
	* { margin: 0; padding: 0; line-height: 1; }
	body { font-size: 12px; margin: 10px; background-color: #993300; color: #333; }
	a { text-decoration: none; }
	a:link { color: #754C23; }
	a:visited { color: #C69C6D; }
	span.lnk { color: #754C23; cursor: pointer; }
	a:hover, a:active { color: #754C23; text-decoration: underline; }
	#wrap { width: 450px; padding: 10px; background-color: #e4d5b8; border: solid 2px #5e2000; border-left: none; border-top: none; }
	.b1 { border: solid 2px #c1ac81; border-left: none; border-top: none; }
	.b2 { border: solid 2px #f3fffd; background-color: #e6d6b2; padding: 5px; }
	.tt { background-color: #d85f06; padding: 10px; border: solid 1px #930; border-right: none; border-bottom: none; }
	h1 { font-size: 18px; color: #00c; margin-bottom: 10px; font-family: Palatino Linotype; font-style: italic; }
	#wrap h1 a { color: #fff; text-decoration: none; border-bottom: solid 2px #e39819; }
	h2 { text-align: right; font-size: 11px; margin-bottom: 3px; font-weight: normal; color: #811c10; }
	.b1 p { text-align: right; line-height: 1.6; font-family: Arial; font-weight: bold; }
	.b1 p a { color: #e4d5b8; text-decoration: underline; }
	#wrap p { line-height: 1.6; }
	.tb { width: 100%; border-top: solid 2px #c99; border-collapse: collapse; background-color: #F4EEE3; margin: 5px 0; }
	.tb td { border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #E1DBCB; padding: 5px; line-height: 1;}
	.tb td.l { font-size: 13px; font-weight: bold; color: #B57D3D; background-color: #EFE6D4; }
	.tb td p.txt { line-height: 1.6; }
	h3 { font-size: 15px; color: #633; margin: 20px 0 5px 0; border-bottom: solid 1px #C7B297; padding-bottom: 3px; }
	#zsfCode { width: 80px; border: solid 1px #B57D3D; padding: 2px 1px; }
	#rslt { border-style: solid; border-width: 1px; padding: 8px; font-weight: bold; }
	#rslt.r { border-color: #999; background-color: #eee; color: #666; }
	#rslt.r1 { border-color: #696; background-color: #efe; color: #090; }
	#rslt.r0 { border-color: #966; background-color: #fee; color: #c00; }
	ol.txt { margin-left: 30px; }
	ol.txt li { margin-bottom: 5px; }
	ol.txt li p { background-color: #F4EEE3; padding: 3px; margin-top: 3px; text-align: left; border: solid 1px #999; border-right-color: #f3f3f3; border-bottom-color: #f3f3f3;}
	p.b, td.b, p.able1, p.able0 { font-weight: bold; }
	p.able1 { color: #090; }
	p.able0 { color: #c00; }
	p.err { margin-left: 20px; }
	#foot { margin: 30px 0; text-align: center; }
	#copy { margin-top: 5px; width: 450px; text-align: center; font: italic bold 14px/1.2 "Palatino Linotype"; margin-bottom: 100px; }
	#copy a { color: #C69C6D; }
	</style>
	<script type="text/javascript">
	//<![CDATA[
	// Window Open
	function n(t) {
		window.open(t.href);
		return false;
	}
	// AJAX Start
	function getHTTPObject () {
		var xhr = false;
		if ( window.XMLHttpRequest ) { xhr = new XMLHttpRequest (); }
		else if ( window.ActiveXObject ) {
			try { xhr = new ActiveXObject ( "Msxml2.XMLHTTP" ); }
			catch ( e ) {
				try { xhr = new ActiveXObject ( "Microsoft.XMLHTTP" ); }
				catch ( e ) { xhr = false; }
			}
		}
		return xhr;
	}
	function grabFile ( file, func ) {
		var req = getHTTPObject ();
		if ( req ) {
			req.onreadystatechange = function () { eval(func+"(req)"); };
			req.open ( "GET", file, true );
			req.send(null);
		}
	}
	function axOk ( req ) {	if ( req.readyState==4 && (req.status==200 || req.status==304) ) { return true; } else { return false; } }
	// AJAX End
	function chkZsf ( zsfObj ) {
		zsfV=zsfObj.value;
		if ( zsfV.length>0 ) {
			grabFile ( "zmSpamFree.php?zsfCode="+zsfV, 'rsltZsf' );
		}
		else {
			document.getElementById("rslt").innerHTML = '�Ͻ��Թ����ڵ带 �Է��Ͻø� ����� ǥ���մϴ�.';
			document.getElementById("rslt").className = "r";
			document.getElementById('zsfCode').focus();
		}
	}
	function rsltZsf ( req ) {
		if ( axOk(req) ) {
			zsfV = document.getElementById('zsfCode').value;
			rsltTxt = "Ʋ��";
			rsltCls = "0";
			if ( req.responseText*1 == true ) {
				rsltTxt = "�¾�";
				rsltCls = "1";
			}
			else {
				document.getElementById('zsfCode').value='';
				document.getElementById('zsfImg').src='zmSpamFree.php?re&zsfimg='+new Date().getTime();
			}
			document.getElementById("rslt").innerHTML = "�Ͻ��Թ����ڵ� �Է°��� "+rsltTxt+"���ϴ�.(��: '"+zsfV+"')";
			document.getElementById("rslt").className = "r"+rsltCls;
			document.getElementById('zsfCode').focus();
		}
	}
	//]]>
	</script>
</head>
<body onload="document.getElementById('zsfCode').focus();">
<div id="wrap">
<div class="b1"><div class="b2"><div class="tt">
<h1><a href="./" title="���Թ��� ������������ ZmSpamFree">ZmSpamFree 1.1 Demo</a></h1>
<h2>���Թ��� CAPTCHA ���¼ҽ� PHP �����α׷�</h2>
<p><cite><a href="http://www.casternet.com/spamfree/" onclick="return n(this);" title="�������������̾�">SpamFree.kr</a></cite></p>
</div></div></div>

<h3><?php echo $listNo++,'. '; ?>��� ��</h3>
<p>�Ʒ� <strong>�Ͻ��Թ����ڵ�</strong> �Է¶��� ���� �°�, Ʋ���� �Է��� ���鼭 �׽�Ʈ�� ������.</p>
<table class="tb">
<colgroup>
<col width="26%" />
<col width="74%" />
</colgroup>
<tr>
	<td class="l">���̹���</td><td><p><img id="zsfImg" src="zmSpamFree.php?zsfimg" alt="���⸦ Ŭ���� �ּ���." title="SpamFree.kr" style="border: none; cursor: pointer" onclick="this.src='zmSpamFree.php?re&amp;zsfimg='+new Date().getTime()" /></p><p>�� �̹����� Ŭ���Ͻø� �ٸ� ������ �ٲ�ϴ�.</p></td>
</tr>
<tr>
	<td class="l">�ξȳ���</td><td><p class="txt">�� 4�ڸ� ���ڸ� �״�� �Ʒ��� �Է��� �ּ���.<br />(���Ա��� ������ ����)</p></td>
</tr>
<tr>
	<td class="l">�Ͻ��Թ����ڵ�</td><td><form method="post" action="./" onsubmit="var zsfCode=document.getElementById('zsfCode'); if(zsfCode.value==''){alert('���Թ����ڵ带 �Է��� �ּ���.\r\n(���Ա��� ������ ����)'); zsfCode.focus(); return false;}"><p><input name="zsfCode" id="zsfCode" type="text"<?php # onblur="chkZsf(this);" ?> /> <input type="submit" value="OK" /></p></form></td>
</tr>
<tr>
	<td class="l">�нǽð� �˻�</td><td><p class="txt"><span onclick="chkZsf(document.getElementById('zsfCode'));" title="Ajax�� �ǽð� üũ" class="lnk">[�ǽð� �˻�]</span>�� Ŭ���Ͻø� Ajax�� �̿�, ������ �̵� ���� �˻��մϴ�.</p></td>
</tr>
<tr>
	<td class="l">�ѻ��ΰ�ħ ��ư</td><td><p class="txt">�� <strong>���̹���</strong>(����)�� ������ �ʰų� �ٸ� ������ ���÷���<br /><span onclick="document.getElementById('zsfImg').src='zmSpamFree.php?re&amp;zsfimg='+new Date().getTime();" title="�ٸ� ���� ����" class="lnk">[���ΰ�ħ]</span>�� Ŭ���� �ּ���.</p></td>
</tr>
<tr>
	<td class="l">�һ�â ��ư</td><td><p class="txt">�� <strong>���̹���</strong>(����)�� ��� ������ ������<br /><a href="zmSpamFree.php?zsfimg" onclick="window.open(this.href); return false;" title="�����ڵ带 �� â���� ����">[��â]</a>�� Ŭ���Ͽ� �����޽����� Ȯ���� �ּ���.</p></td>
</tr>
<tr>
	<td class="l">�Ӱ������</td><td><?php echo $noticeText; ?></td>
</tr>
</table>

<h3><?php echo $listNo++,'. '; ?>PHP ���� üũ (PHP 4.3 �̻�)</h3>

<?php
	$_phpver = phpversion();
	$verMsg = array ( '�Ұ�', '����' );
	$verRslt = false;
	if ( version_compare ( $_phpver, '4.3', '>=' ) ) { $verRslt = true; }
	echo '<p class="able',$verRslt*1,'">';
	echo '�� ������ PHP ������ ',$_phpver,'����, ��� ',$verMsg[$verRslt],'�մϴ�.</p>';
?>
<h3><?php echo $listNo++,'. '; ?>���α׷� ���� ���� ���� (����Լ� ���� üũ)</h3>
<?php
$funcArr = array ( 'imageCreateTrueColor', 'imageColorAllocate', 'imagefill', 'imageSetPixel', 'imageCopyResampled', 'imageFilledRectangle', 'imageRectangle' );
$errCnt = 0;
foreach ( $funcArr as $k => $v )
{ if ( !function_exists($v) ) { $errCnt ++; echo '<p class="err">',$errCnt,') <strong>',$v,'</strong> �Լ� ��� �Ұ�</p>'; } }
if ( !function_exists('imagepng') && !function_exists('imagegif') && !function_exists('imagejpeg') ) { $errCnt ++; echo '<p class="err">',$errCnt,') <strong>imagePng, imageGif, imageJpeg</strong> �Լ� ��� ��� �Ұ�</p>'; }
if ( !$errCnt ) { echo '<p class="able1">�˻� ���, ���� �����մϴ�.</p>'; }
else { echo '<p class="able0">�˻� ���, �� ',$errCnt,'����  �Լ��� �������� �ʾ�, ������ �Ұ����մϴ�.<br />����(��ȣ����) �����ڿ��� ������ �ּ���.</p>'; }
?>
<h3><?php echo $listNo++,'. '; ?>���α׷� ���� ��ġ���� �˻�</h3>
<?php
$chkFontName = array ( 'MalgunGothic40px', 'Gungsuh40px', 'Gulim40px', 'Impact40px', 'PyunjiR40px', 'YDISomaL40px', 'TimesNewRoman40px', 'Arial40px', 'Tahoma24px', 'TimesNewRoman26px', 'Arial26px', 'YDISomaL26px', 'PyunjiR24px', 'Impact27px', 'Gulim26px', 'Gungsuh27px', 'MalgunGothic24px' );
$errCnt = 0;
foreach ( $chkFontName as $v )
{
	if ( !is_file(AR.'Fonts/'.$v.'.php') ) { $errCnt ++; echo '<p class="err">',$errCnt,') <strong>',$v,'.php ������ �����ϴ�.</strong></p>'; }
}
if ( !$errCnt ) { echo '<p class="able1">�˻� ���, ��� �۲������� �ֽ��ϴ�.</p>'; }
else { echo '<p class="able0">�˻� ���, ',$errCnt,'���� �۲� ������ �����ϴ�.<br />������ ȯ�漳���� ���� ����� ������ ���� �ֽ��ϴ�.'; }
?>
<h3><?php echo $listNo++,'. '; ?>���� �ذ�</h3>
<ol class="txt">
	<li>���� �� ���������� <strong>Permission denied</strong>��� ������ ����.
		<p>���� �� ������ �ִ� <strong>���丮</strong>(zmSpamFree)�� <strong>�۹̼�</strong>�� <strong>777</strong>�� ������ ������.<br />�Ǵ� ���� ������ Log ���丮�� <strong>�۹̼�</strong>�� <strong>777</strong>�� ������ ������.<br />�۹̼� ���� �Ŀ��� ���Թ����̹����� �� �� Ŭ���ϼż� ���ΰ�ħ�� �ؾ� �մϴ�.</p></li>
	<li>���� <strong>��[���ΰ�ħ]</strong>�� Ŭ���ص� �̹����� ������ �ʾƿ�.
		<p><strong>��[��â]</strong>�� Ŭ���Ͻø� ������ �����޽����� �����ϼ���. <a href="http://www.casternet.com/spamfree/zmb/view.php?bd=manual&amp;no=6" onclick="return n(this);" title="��â�� Ŭ���ϸ� ������ �����޽��� ����">[�����ڷ� ����]</a></p></li>
	<li><strong>��[��â]</strong>�� Ŭ���ϸ� �̹�����, �����޽����� ������ �ʾƿ�.
		<p>������ ã�Ƴ� ������ �ش� ������ Ư��������, �ڼ��� ���� <a href="http://www.casternet.com/spamfree/zmb/view.php?bd=faq&amp;no=2" onclick="return n(this);" title="�̹����� ������ ������ �ʴ� ���">[�����ڷ� ����]</a>�� �����ϼ���.</p></li>
	<li>�ٸ� �� ������ ���µ�, ������ ���Թ����ڵ尡 Ʋ�ȴٰ� ���Ϳ�.
	<li>AJAX�� �̿��Ͽ� ���Թ����ڵ� �ǽð� �˻�� ��� �����ϳ���?
		<p><a href="http://www.casternet.com/spamfree/zmb/view.php?bd=manual&amp;no=8" title="AJAX�� �̿��� ���Թ����ڵ� �ǽð� �˻� ��������" onclick="return n(this);">[���Թ����ڵ� �ǽð� �˻� ��������]</a>�� �����Ͻø� ���� ������ �� �ֽ��ϴ�.</p></li>
	<li>�� ���α׷��� ������ ����� ������ ��� ����?
		<p><a href="uninstall.php" title="������������(ZmSpamFree) ���α׷� �����ϱ�" onclick="return n(this)">[���α׷� �����ϱ�]</a>�� Ŭ���ϰ�, �ȳ��� ���� uninstall.php ������ ���� �� �����Ͽ� �ڵ�������ϵ��� ���� ��, ������ �����ִ� ���� �� ���丮�� FTP ���� �̿�, �����Ͻø� �˴ϴ�.</p></li>
		<p>������ ã�Ƴ� ������ �ش� ������ ����������, �ڼ��� ���� <a href="http://www.casternet.com/spamfree/zmb/view.php?bd=faq&amp;no=10" onclick="return n(this);" title="������ Ʋ�ȴٰ� ������ ���">[�����ڷ� ����]</a>�� �����ϼ���.</p></li>
	<li>�� �ڷḦ �� �ôµ��� �ٸ� ������ �־��. �Ǵ� �� �ñ��� ���� �־��.
		<p><a href="http://www.casternet.com/spamfree/" onclick="return n(this);" title="�������������̾� Ȩ������">������ Ȩ������</a>�� <a href="http://www.casternet.com/spamfree/zmb/list.php?bd=faq" onclick="return n(this);" title="�������������̾� Ȩ������ �������� �Խ���">��������</a>�� �����Ͻð�, �׷��� ������ ������ <a href="http://www.casternet.com/spamfree/zmb/list.php?bd=qna" onclick="return n(this);" title="�������������̾� Ȩ������ ����&amp;�亯">����&amp;�亯</a> �Խ��ǿ� �� ���� �ּ���.</p></li>
</ol>
<div id="foot">
<p>�� ������ <a href="http://validator.w3.org/" onclick="return n(this);" title="The W3C Validation Service">XHTML 1.0 Strict</a> �� <a href="http://jigsaw.w3.org/css-validator/" onclick="return n(this);" title="W3C CSS Validation Service">CSS Level 2.1</a> �� �ؼ��մϴ�.</p>
<p>�� ���α׷��� <a href="http://www.casternet.com/" onclick="return n(this); " title="����ĳ���ͳ� CangNam CasterNet Co.">����ĳ���ͳ�</a>�� �Ŀ����� ����, ��������˴ϴ�.</p>
</div>
</div>
<div id="copy"><a href="http://www.casternet.com/" onclick="return n(this); " title="����ĳ���ͳ� CangNam CasterNet Co.">Powered by www.CasterNet.com</a></div>
</body>
</html>
