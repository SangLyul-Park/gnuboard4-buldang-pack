<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ����� ȭ�� ������ �ϴ��� ����ϴ� �������Դϴ�.
// ����, �ϴ� ȭ���� �ٹ̷��� �� ������ �����մϴ�.
?>

</div>
</div><!-- ���� content �� -->

</div><!-- class=row -->
</section><!-- �߰��� ���κ� �� -->

<!-- ������ �ϴܺ� footer -->
<footer class="footer-wrapper" role="contentinfo">
<div class="container">
    <div>
        <ul class="list-inline">
        <li><a href="<?=$g4[path]?>/">Ȩ����</a></li>
        <li><a href="<?=$g4[path]?>/company/privacy.php?mnb=info&snb=privacy"><b>����������޹�ħ</b></a></li>
        <li><a href="<?=$g4[path]?>/company/service.php?mnb=info&snb=service">�̿���</a></li>
        <li><a href="<?=$g4[path]?>/company/disclaimer.php?mnb=info&snb=disclaimer">å���Ѱ�͹�������</a></li>
        <li><a href="<?=$g4[path]?>/company/rejection.php?mnb=info&snb=rejection">�̸����ּҹ��ܼ����ź�</a></li>
        </ul>
    </div>
    <p>OpenCode�� �����߰��ڷμ� ������ �ֹ�, ��� �� ȯ���� �ǹ��� å���� �� ȸ���� �ֽ��ϴ�.</p>
    <p>����ڵ�Ϲ�ȣ :000-00-00000 <span>����Ǹž��Ű��ȣ</span> :��2009-���Ｍ��-0000ȣ<br>
       ��ǥ�̻� :�ƺ��Ҵ� <span>�ּ�</span> :����� ���ʱ� ���ʵ� �ջ� <span>��ȭ</span> :00-000-0000</p>
    <p>Copyright &copy; <a href="http://opencode.co.kr" target="_blank">Opencode.co.kr</a>. All rights reserved.</p>
</div>
</footer>

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