<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ����� ȭ�� ������ �ϴ��� ����ϴ� �������Դϴ�.
// ����, �ϴ� ȭ���� �ٹ̷��� �� ������ �����մϴ�.
?>

</div><!-- ��� ���� div - content �� -->

<!-- ������ �÷� div - side ���� -->
<div class="aside">
    <div>
    <?
        // ������� ���� ���ּž� �մϴ�. ��..��...
        include_once("$g4[path]/adsense_aside.php");
    if ($is_member) {
        $loading_msg = "Loading...";
        include_once("$g4[path]/lib/whatson.lib.php");
        echo "<div id='my_whatson'>$loading_msg</div>";
        //echo whatson("basic");
    
        include_once "$g4[path]/lib/latest.my.lib.php";
        echo "<div id='my_post' style='height:260px'>$loading_msg</div>";
        echo "<div id='my_comment' style='height:260px'>$loading_msg</div>";
    };
    
    // �׻� �������
    include_once("$g4[path]/adsense_aside2.php");
    ?>
    </div>
</div><!-- ������ �÷� div - side �� -->

</div><!-- �߰��� div - container �� -->

<!-- ������ �ϴܺ� footer -->
<div id="footer">
		<ul  class="footer-nav">
  			<li><a href="<?=$g4[path]?>/">Ȩ����</a></li>
	  		<li><a href="<?=$g4[path]?>/company/privacy.php?mnb=info&snb=privacy"><b>����������޹�ħ</b></a></li>
  			<li><a href="<?=$g4[path]?>/company/service.php?mnb=info&snb=service">�̿���</a></li>
        <li><a href="<?=$g4[path]?>/company/disclaimer.php?mnb=info&snb=disclaimer">å���Ѱ�͹�������</a></li>
        <li><a href="<?=$g4[path]?>/company/rejection.php?mnb=info&snb=rejection">�̸����ּҹ��ܼ����ź�</a></li>
		</ul>
    <p class="info">
        OpenCode�� �����߰��ڷμ� ������ �ֹ�, ��� �� ȯ���� �ǹ��� å���� �� ȸ���� �ֽ��ϴ�.
    </p>
    <p class="info2">
        ����ڵ�Ϲ�ȣ :000-00-00000 <span>����Ǹž��Ű��ȣ</span> :��2009-��⼺��-0000ȣ<br>
        ��ǥ�̻� :�ƺ��Ҵ� <span>�ּ�</span> :����� ���ʱ� ���ʵ�<br>
        ��ǥ��ȭ :00-000-0000 <span>�ѽ�</span> :02-0000-0000
    </p>
    <p class="copyright">
        Copyright &copy; <a href="http://opencode.co.kr" target="_blank">Opencode.co.kr</a>. All rights reserved.
    </p>
</div>

</div><!-- ��ü div : wrap �� -->

<script type="text/javascript">
// jquery�� �̿��� �񵿱� ������ �ε� �Դϴ�

<? if ($is_member) { ?>

$("#my_whatson").html( " <? echo remove_nr( trim(  whatson('basic')   ))?> " );

<? if ($g4[path] == ".") { ?>

$("#my_post").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_post", 1, "latest_my('naver','�����ø���',80,10,25)")   ))?> " );
<?} else { ?>
$("#my_post").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_post_sub", 1, "latest_my('naver','�����ø���',80,10,25)")   ))?> " );
<? } ?>

<? if ($g4[path] == ".") { ?>
$("#my_comment").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_comment", 1, "latest_my('naver','�����ø� �ڸ�Ʈ',80,10,25,'comment')")   ))?> " );
<?} else { ?>
$("#my_comment").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_comment_sub", 1, "latest_my('naver','�����ø� �ڸ�Ʈ',80,10,25,'comment')")   ))?> " );
<? } ?>

<? if ($g4[path] == ".") { ?>
$("#my_response").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_update", 1, "latest_my_update('naver','�����ǹ���',80,10,25)")   ))?> " );
<?} else { ?>
$("#my_response").html( " <? echo remove_nr( trim(   db_cache("$member[mb_id]_latest_my_update_sub", 1, "latest_my_update('naver','�����ǹ���',80,10,25)")   ))?> " );
<? } ?>

<? } ?>

</script> 

<?
include_once("$g4[path]/tail.sub.php");
?>