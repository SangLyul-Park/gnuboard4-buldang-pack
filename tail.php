<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ� 

// ����� ȭ�� ������ �ϴ��� ����ϴ� �������Դϴ�.
// ����, �ϴ� ȭ���� �ٹ̷��� �� ������ �����մϴ�.
?>

</div><!-- ���� content �� -->

</div>
</div><!-- �߰��� ���κ� �� -->

<!-- view page swipe -->
<script type="text/javascript">
    <? if ($bo_table && $wr_id) { ?>
    // �Խñ� view page swipe
    var hammertime1 = $("#view_<?=$wr_id?>").hammer();
    var link1 = "<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&page=<?=$page?>&qstr=<?=$qstr?>";
    hammertime1.on("swipeleft dragleft", function(ev) {
        ev.gesture.preventDefault();
        $(location).attr('href',link1);
    });
    <? } ?>

    <? if ($bo_table && !$wr_id) {
        // ������ �ø���
        if ($total_page > $page)
            $page2 = $page + 1;
        else
            $page2 = $page;
        // ������ ���̱�
        if ($page > 1)
            $page3 = $page - 1;
        else
            $page3 = 1;
    ?>
    // �Խñ� ��� page swipe
    var hammertime2 = $("#list_<?=$bo_table?>").hammer();
    var link2 = "<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&page=<?=$page2?>";
    var link3 = "<?=$g4[bbs_path]?>/board.php?bo_table=<?=$bo_table?>&page=<?=$page3?>";
    hammertime2.on("swipeleft dragleft", function(ev) {
        ev.gesture.preventDefault();
        $(location).attr('href',link2);
    });
    hammertime2.on("swiperight dragright", function(ev) {
        ev.gesture.preventDefault();
        $(location).attr('href',link3);
    });
    <? } ?>
</script>

<!-- ��/�Ʒ� �̵��ϴ� jQuery -->
<a href="#" class="btn btn-default back-to-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
<a href="#" class="btn btn-default go-to-bottom"><span class="glyphicon glyphicon-chevron-down"></span></a>
<style>
.back-to-top {
    position: fixed;
    bottom: 9em;
    right: 10px;
    padding: 1em;
    display: none;
}
.go-to-bottom {
    position: fixed;
    bottom: 5em;
    right: 10px;
    padding: 1em;
    display: none;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    var offset1 = 300;    // �������� ������� �������� ��ư�� ���ñ�?
    var offset2 = 100;    // �������� ������� �������� ��ư�� ���ñ�?
    var duration = 0;     // top���� �̵��Ҷ������� animate �ð� (�и�������, default�� 400. ������ �⺻�� 500)
    var delay1 = 3000;    // ��ư�� ������������� �ð� (3000 = 3��)

    var timer;
    $(window).bind('scroll',function () {
        clearTimeout(timer);
        timer = setTimeout( refresh , 150 );
    });
    var refresh = function () { 
        if ($(this).scrollTop() > offset2) {
            $('.go-to-bottom').fadeIn(duration);
            setTimeout(function(){$('.go-to-bottom').hide();},2000);
        } else {
            $('.go-to-bottom').fadeOut(duration);
        }

        if ($(this).scrollTop() > offset1) {
            $('.back-to-top').fadeIn(duration);
            setTimeout(function(){$('.back-to-top').hide();},2000);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    };

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
    $('.go-to-bottom').click(function(event) {
        event.preventDefault();
        $('html, body').animate({ scrollTop: $(document).height() }, duration);
        return false;
    })
});
</script>

<!-- ������ �ϴܺ� footer -->
<footer class="footer-wrapper col-sm-offset-2" role="contentinfo" style="margin-top:20px;">
<div class="container" id="footer">
    <div class="panel panel-default hidden-sm hidden-md hidden-lg">
    <div class="panel-heading">
        <div>
        <a class="btn btn-default" data-toggle="collapse" data-target=".navbar-bottom-collapse">Info.</a>
        <div class="btn-group">
        <? if ($member['mb_id']) { ?>
            <a class="btn btn-default visible-xs" href="<?=$g4['bbs_path']?>/logout.php">Logout</a>
        <? } else { 
            $login_url = "$g4[bbs_path]/login.php?$qstr";
        ?>
            <a class="btn btn-default visible-xs" href="<?=$login_url?>">Login</a>
        <? } ?>
        </div>

        <a href="<?=$g4[path]?>/company/company.php?id=privacy"><strong>����������޹�ħ</strong></a>
        <small>(��)�����ڵ�</small>

        <a class="btn btn-default pull-right" href="#" onclick="$('html, body').animate({scrollTop: 0}, duration);">TOP</a>

        </div>
    </div>
    </div>

    <div class="collapse navbar-collapse navbar-bottom-collapse">
        <ul class="list-inline">
            <li><a href="<?=$g4[path]?>/company/company.php?id=privacy"><strong>����������޹�ħ</strong></a></li>
            <li><a href="<?=$g4[path]?>/company/company.php?id=service">�̿���</a></li>
            <li><a href="<?=$g4[path]?>/company/company.php?id=disclaimer">å���Ѱ�͹�������</a></li>
            <li><a href="<?=$g4[path]?>/company/company.php?id=rejection">�̸����ּҹ��ܼ����ź�</a></li>
        </ul>
        <p>(��)�����ڵ� ����ڵ�Ϲ�ȣ :000-00-00000 ����Ǹž��Ű��ȣ :��2009-���Ｍ��-0000ȣ<br>
            ��ǥ�̻� :�ƺ��Ҵ� �ּ� :����� ���ʱ� ���ʵ� �ջ� ��ȭ :00-000-0000</p>
        <p><?=$config[cf_title]?>�� �����߰��ڷμ� ������ �ֹ�, ��� �� ȯ���� �ǹ��� å���� �� ȸ���� �ֽ��ϴ�.<br>
            <?=$config[cf_title]?>�� ���� ���� ���� ���� <?=$config[cf_title]?>�� ��ü�� ����, ������ �� UI���� ����� �������� ����, ����, ��ũ���� �� ���� ����� �� �����ϴ�.<br>
            Copyright &copy; <a href="http://opencode.co.kr" target="_blank">Opencode.co.kr</a>. All rights reserved.</p>
    </div>
</div>
</footer>
<?
include_once("$g4[path]/tail.sub.php");
?>