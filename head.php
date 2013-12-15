<?
if (!defined("_GNUBOARD_")) exit; // ���� ������ ���� �Ұ�

include_once("$g4[path]/head.sub.php");

// ��ʰ��� lib
include_once("$g4[path]/lib/banner.lib.php");

// ����� ȭ�� ��ܰ� ������ ����ϴ� �������Դϴ�.
// ���, ���� ȭ���� �ٹ̷��� �� ������ �����մϴ�.
?>

<?
// ��ܺο� alert �˾��� ��� �մϴ�.
include_once("$g4[path]/lib/popup.lib.php");
echo popup("alert", "popup_alert")
?>

<header class="header-wrapper"><!-- ��� header ���� -->
<div class="container">
<div class="row visible-sm visible-md visible-lg">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-5">
    </div>
    <div class="col-sm-5">
        <?
        echo get_banner("top_github", "basic", "github");
        echo get_banner("top", "basic", "", 1);
        ?>
    </div>
</div>

<div class="navbar navbar-default" role="navigation">
<div class="container">
<div class="row">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-sm-2">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-search-top-collapse">
            <i class="glyphicon glyphicon-search"></i>
        </button>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <i class="glyphicon glyphicon-list"></i>
        </button>
        <a class="navbar-brand" href="<?=$g4['path']?>/">
        <img src="<?=$g4[path]?>/images/logo_opencode.gif" align=absmiddle alt="brand logo">
        </a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse col-sm-7">
    <ul class="nav navbar-nav">
        <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=qna">�����Խ���</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">��ũ <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=notice">����</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_100">�״�����100�Ͽϼ�</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_books">�״���������</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=sitetips">����Ʈ���߿</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=biz">����Ͻ������ڷ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/good_list.php">����Ʈ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/new.php">�ֱٰԽñ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=test">�׽�Ʈ</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=test2">�׽�Ʈ2</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">������ <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=linux_tips">Linux</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=virtual">����ȭ</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=apache_tips">Apache</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=mysql_tips">MySQL</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=mariadb_tips">Maria DB</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=nosql">NoSQL</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=css">CSS/��Ʈ��Ʈ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=php_tips">PHP</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=jquery_tips">jQuery</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=javascript_tips">Java Script</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=ajax">AJAX</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=html_tips">HTML</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=html5_tips">HTML5</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=other_tips">��Ÿ ����</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=cheditor">cheditor(���)</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">�״�4 <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_turning">�״�����4 Ʃ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_turning2">�״�����4 Ʃ��(�����)</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=memo4">����5</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=thumb">�Ҵ��/Resize</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=layout">�Ҵ����(100%��������)</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=g4_recycle">������/Recycle</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_unicro">����ũ������/�Խ���</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_skin">�״����彺Ų</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_tips">�״�������</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_qna">�״����� ���� ���ϱ�</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">App <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_talk">�ȵ���̵� �Խ���</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_tip">�ȵ���̵� ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=and_pds">�ȵ���̵� �ڷ��</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=webapp">����</a></li>
            </ul>
        </li>

        <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">�Ҵ��� <b class="caret"></b></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack">�Ҵ��Ѵٿ�ε�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_book">�Ҵ��� �Ŵ���</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_skin">�Ҵ��� ��Ų</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_req">�Ҵ��� ���� �� ����</a></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gnu4_pack_qna">�Ҵ��� ������ϱ�</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=gblog">gblog �Ҵ����</a></li>
                <li><a href="<?=$g4[path]?>/blog/" target=new>gblog �׽�Ʈ</a></li>
                <li class="divider"></li>
                <li><a href="<?=$g4[bbs_path]?>/board.php?bo_table=club2">Ŭ��2</a></li>
                <li><a href="$g4[path]?>/club/">Ŭ��2 �׽�Ʈ</a></li>
            </ul>
        </li>
        <li><a href="<?=$g4[plugin_path]?>/attendance/attendance.php">�⼮</a></li>
    </ul>
    </div>

    <div class="col-sm-3 pull-right">
    <form class="navbar-form collapse navbar-collapse navbar-search-top-collapse" role="search" method="get" onsubmit="return fsearchbox_submit(this);" >
    <div class="input-group">
        <input type="hidden" name="sfl" value="wr_subject||wr_content">
        <input type="hidden" name="sop" value="and">
        <input type="text" class="form-control" placeholder="�˻���� 2�ܾ����" name="stx" id="stx" maxlength="20" value="<?=$stx;?>">
        <div class="input-group-btn">
            <button type="submit" class="btn">�˻� <i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    </form>
    </div>

</div>

</div>
</div>
</div>
</header><!-- ��� header �� -->


<!-- �߰��� ���κ� ���� -->
<div role="main" class="container">
<div class="row">

<!-- ���� side ���� -->
<div class="col-sm-2 visible-sm visible-md visible-lg">
<?
// �ƿ��α���
include_once("$g4[path]/lib/outlogin.lib.php");
echo outlogin("basic");
?>

<!-- �α��ιڽ����� ���� -->
    <table><tr><td height="1px"></td></tr></table>
    <?
    // ��ǥ
    include_once("$g4[path]/lib/poll.lib.php");
    echo poll();
    ?>
    <?
    // �湮��
    include_once("$g4[path]/lib/visit.lib.php");
    echo visit();
    ?>
    <?
    include_once("$g4[path]/lib/popular.lib.php");
    echo board_popular("board","", 14, 5);
    ?>
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

</div><!-- ���� side �� -->

<div class="col-sm-10" id="main"><!-- ���� content ���� -->

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