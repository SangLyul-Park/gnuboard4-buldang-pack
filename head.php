<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

include_once("$g4[path]/head.sub.php");

// ����� ȭ�� ��ܰ� ������ ����ϴ� �������Դϴ�.
// ���, ���� ȭ���� �ٹ̷��� �� ������ �����մϴ�.

// layout ���� �� �б�
$g4[layout_path] = $g4[path] . "/layout";                             // layout�� ���� �մϴ�.
$g4[layout_skin] = "naver";                                           // layout skin�� ���� �մϴ�
$g4[layout_skin_path] = $g4[layout_path] . "/" . $g4[layout_skin];    // layout skin path�� ���� �մϴ�.

// top, side �޴��� class�� ����
$top_menu = "menu mc_gray";
$side_menu = "menu_v";

// �ʿ��� ���̾ƿ� ���ϵ��� �о� ���Դϴ�.
include_once("$g4[layout_skin_path]/layout.php");
include_once("$g4[layout_path]/layout.lib.php");
?>

<!-- �������� ��ü�� div -->
<div id="wrap">

<div id="header">

    <!-- ��ü navi ���� -->
    <div class="gnb">
    </div>

    <!-- ��ܺ� log ������ �־��ִ� �� -->
    <div class="sta">
        <!-- �̷� ������ table�� div ���� ��~ ���մϴ� -->
        <table width=100%>
            <tr>
                <td align=left>
                <a href="<?=$g4['path']?>/"><img src="<?=$g4[path]?>/images/logo_opencode.gif" align=absmiddle alt=""></a>
                </td>
                <td align=right>
                <?
                include_once("$g4[path]/lib/naver.lib.php");
                ?>
                <div style="width:200px;float:right" id="naver_popular">
                ���̹� �α�˻��� loading...
                </div>
                <a href="https://github.com/open2/gnuboard4-buldang-pack/commits/master/" target=new><img src="<?=$g4[path]?>/images/github_logo.jpg" align=absmiddle alt=""></a>
                <a href="http://dmshopkorea.com/" target=new><img src="<?=$g4[path]?>/images/dmshop.gif" align=absmiddle alt=""></a>
                <a href="http://onedayro.phps.kr" target=new><img src="<?=$g4[path]?>/images/onedayro.png" align=absmiddle alt=""></a>
                <a href="http://huddak.net" target=new><img src="<?=$g4[path]?>/images/hu.gif" align=absmiddle alt=""></a>
                </td>
            </tr>
        </table>
    </div>

    <div id="menu" class="<?=$top_menu?>">
        <div class="inset">
        <!-- �ָ޴� -->
        <div class="major">
            <?=print_mnb($mnb_arr)?>
        </div>
        <!-- �������� ��� �ִ� �޴� -->
        <div class="aside">
            <ul>
            <li>
            <!-- �˻�â -->
            <form name="fsearchbox" method="get" onsubmit="return fsearchbox_submit(this);" style="margin:0px;" class="srch" style="border:0">
            <input type="hidden" name="sfl" value="wr_subject||wr_content">
            <input type="hidden" name="sop" value="and">
            <span><input accesskey="s" class="keyword" title=�˻��� name="stx" type="text" maxlength="20" value="<?=$stx;?>" > <input alt=�˻� src="<?=$g4[layout_skin_path]?>/img/btn_srch.gif" type="image" alt=""></span>
            </form>
            </li>
            </ul>
        </div>
        <span class="gradient"></span>
    </div>
    <span class="shadow"></span>
    </div><!-- ��� �޴� div - menu �� -->

</div><!-- ��� div - header �� -->

<!-- �߰��� ���κ� ���� -->
<div id="container">

<!-- ���� side div ���� -->
<div class="snb">

<?
// �ƿ��α���
include_once("$g4[path]/lib/outlogin.lib.php");
echo outlogin("transparent");
?>

<!--���� �޴� -->
<table><tr><td height="1px"></td></tr></table>
<div id="menu_v" class="<?=$side_menu?>">
    <?
    switch ($mnb) {
        case "myon"     : print_snb($snb_arr['myon'], 'MyOn'); print_snb($snb_arr['myboard'], '���� �Խ���'); print_snb($snb_arr['myvisit'], '���� �湮�� �Խ���');break;
        case "tips"     :
        case "gnu4_b4"  :
        case "gblog"    :
        case "club2"    :
        case "android"  : // ������� ��쿡�� �Ʒ�ó���� ���ָ� �ȴ�.
        case "mart"     : print_snb($snb_arr[$mnb], mnb_name($mnb_arr, $mnb)); break;
                          // 2��° �޴��� yc4_old�� test�� $mnb�� �ƴϹǷ�, ������ �׳� �������ش�. �̷������� ��� �޴��� ���� ���� �� �ִ�.
        case "yc4"      : print_snb($snb_arr[$mnb], mnb_name($mnb_arr, $mnb)); print_snb($snb_arr['yc4_old'], "��īƮ4(�����ڷ�)"); break;
        case "gnu4"     :
        case "talk"     : print_snb($snb_arr[$mnb], mnb_name($mnb_arr, $mnb)); print_snb($snb_arr['test'], '�׽�Ʈ');break;
        case "info"     : print_snb($snb_arr[$mnb], 'Info'); break;
        default         : // $mnb�� ���� ������ ����� ������� ����Ѵ�.
                          print_snb($snb_arr['talk'], mnb_name($mnb_arr, 'talk'));
                          ?>
                          <?
                          print_snb($snb_arr['test'], '�׽�Ʈ'); break;
                          break;
    }
    ?>
</div>

<!--//ui object -->

<!-- �α��ιڽ����� ���� -->
    <table><tr><td height="1px"></td></tr></table>
    <?
    // ��ǥ
    include_once("$g4[path]/lib/poll.lib.php");
    echo poll();
    ?>
    
    <table><tr><td height="1px"></td></tr></table>
    <?
    // �湮��
    include_once("$g4[path]/lib/visit.lib.php");
    echo visit();
    ?>

    <table><tr><td height="1px"></td></tr></table>
    <?
    include_once("$g4[path]/lib/popular.lib.php");
    echo board_popular("board","", 14, 5);
    ?>

    <table><tr><td height="1px"></td></tr></table>
    <? // ����������
    include_once("$g4[path]/lib/connect.lib.php");
    echo connect();
    ?>

    <table><tr><td height="1px"></td></tr></table>
    <center>
    <a href="http://idc.gabia.com/colo/" target=new><img src="<?=$g4[path]?>/img/banner/gabia.gif" alt=""></a>
    <a href="http://idc.kinx.net/" target=new><img src="<?=$g4[path]?>/img/banner/kinx.gif" alt=""></a>
    <a href="http://worknet.co.kr" target=new><img src="<?=$g4[path]?>/img/banner/worknet.gif" alt=""></a>
    <a href="http://jobnet.co.kr" target=new><img src="<?=$g4[path]?>/img/banner/jobnet.gif" alt=""></a>
    <a href="http://bugsboard.co.kr" target=new><img src="<?=$g4[path]?>/img/banner/bugs4_logo.gif" alt=""></a>
    <a href="http://peoplenjob.com" target=new><img src="<?=$g4[path]?>/img/banner/peoplenjob.gif" alt=""></a>
    </center>

</div>
<!-- ���� side �޴� �� -->

<!-- ���� content �޴� ���� -->
<div id="content">

<script type="text/javascript">
function fsearchbox_submit(f)
{
    if (f.stx.value.length < 2) {
        alert("�˻���� �α��� �̻� �Է��Ͻʽÿ�.");
        f.stx.select();
        f.stx.focus();
        return false;
    }

    // �˻��� ���� ���ϰ� �ɸ��� ��� �� �ּ��� �����ϼ���.
    var cnt = 0;
    for (var i=0; i<f.stx.value.length; i++) {
        if (f.stx.value.charAt(i) == ' ')
            cnt++;
    }

    if (cnt > 1) {
        alert("���� �˻��� ���Ͽ� �˻�� ������ �Ѱ��� �Է��� �� �ֽ��ϴ�.");
        f.stx.select();
        f.stx.focus();
        return false;
    }

    f.action = "<?=$g4['bbs_path']?>/search.php";
    return true;
}
</script>

<?
// �ٹٲ� ���ڸ� ���ش�
$reg_e = array('/\n/','/\r/','/\"/'); 
$reg_p = array(' ',' ','\'');
?>
<script type="text/javascript">
$("#naver_popular").html( " <? echo preg_replace($reg_e, $reg_p, trim( db_cache("main_top_naver_cache", 300, "naver_popular('naver_popular', 4)")))?> " );
</script>
