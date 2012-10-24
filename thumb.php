<?
include_once("./lib/thumb.lib.php");

echo "source: 800x600 image file�� ����� ���� �Դϴ�</BR></BR>";

// $file_name   : ���ϸ�
// $width       : ������� ��
// $height      : ������� ���� (�������� ������ ������� ���̸� ���)
//                * $width, $height�� ��� ���� ������, �̹��� ������ �״�� thumb�� ����
// $is_create   : ������� �̹� ���� ��, ���� �������� ���θ� ����
// $is_crop     : ���� ���̰� $height�� ���� �� crop �� �������� ����
//                1 : �⺻ crop
//                2 : �߰��� �������� crop
// $quality     : ������� quality (jpeg, png���� �ش��ϸ�, gif���� �ش� ����)
// $small_thumb : true(1)�̸�, �̹����� ������� ��/���̺��� ���� ������ ���� ����
// $watermark   : ���͸�ũ ��¿� ���� ���� 
//                $watermark[][filename] - ���͸�ũ ���ϸ�
//                $watermark[location] - center, top, top_left, top_right, bottom, bottom_left, bottom_right
//                $watermark[x],$watermark[y] - location������ offset
// $filter      : php imagefilter, http://kr.php.net/imagefilter
//                $filter[type], [arg1] ... [arg4]
// $noimg       : noimage, $noimg[type] = text(�ؽ�Ʈ���), img(�̹�������), nothing(�ƹ��͵� ����)
//
//function thumbnail($file_name, $width=0, $height=0, $is_create=false, $is_crop=2, $quality=70, $small_thumb=true, $watermark="", $filter="", $noimg="") 
?>

<?
$noimg = "/img/search_top.gif";
?>
<img src="<?=thumbnail('/data/file/nothing.jpg', 600, 700, 0, 0, 75, 1, "", "", $noimg)?>" >
<BR>600*700 no image, image file<BR>

<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 75, 1)?>" >
<BR>600*700 Quality 75, no filter<BR>

<?
// case  IMG_FILTER_UBSHARPMASK: UnsharpMask($target, $filter[arg1], $filter[arg2], $filter[arg3]);
// function UnsharpMask($img, $amount, $radius, $threshold)
$filter[type] = 99;
$filter[arg1] = 80;
$filter[arg2] = 0.5;
$filter[arg3] = 3;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 74, 1,"", $filter)?>" >
<BR>600*700 Quality 74, unsharp-mask filter<BR>

<img src="<?=thumbnail('/data/file/', 600, 700, 12)?>" >
<BR>600*700 ũ�� �״�� no-image<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom_right";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
$watermark[1][filename] = "./data/file/watermark/watermark.png";
$watermark[1][location] = "center";
$watermark[1][x] = 0;
$watermark[1][y] = 0;

$filter[type] = IMG_FILTER_GRAYSCALE;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 50, 1, $watermark, $filter)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (50% quality, watermark - bottom_right + center, IMG_FILTER_GRAYSCALE filter)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom_right";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
$watermark[1][filename] = "./data/file/watermark/watermark.png";
$watermark[1][location] = "center";
$watermark[1][x] = 0;
$watermark[1][y] = 0;

$filter[type] = IMG_FILTER_GAUSSIAN_BLUR;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 1, 0, 60, 1, $watermark, $filter)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (60% quality, watermark - bottom_right + center, IMG_FILTER_GAUSSIAN_BLUR filter)<BR>
���� ���Ͱ� ���� �Ͱ� �񱳸� �غ�����.<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom_right";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
$watermark[1][filename] = "./data/file/watermark/watermark.png";
$watermark[1][location] = "center";
$watermark[1][x] = 0;
$watermark[1][y] = 0;

?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 69,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - bottom_right + center)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom_right";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 70,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - bottom_right)<BR>

<?
$watermark = array();
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom_left";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 71,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - bottom_left)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "bottom";
$watermark[0][x] = 0;
$watermark[0][y] = 20;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 72,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - bottom)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "center";
$watermark[0][x] = 0;
$watermark[0][y] = 0;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 73,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - center)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "top";
$watermark[0][x] = 0;
$watermark[0][y] = 0;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 74,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - top)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "top_left";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 75,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - top_left)<BR>

<?
$watermark[0][filename] = "./data/file/watermark/watermark.png";
$watermark[0][location] = "top_right";
$watermark[0][x] = 20;
$watermark[0][y] = 20;
?>
<img src="<?=thumbnail('/data/file/800-600.jpg', 600, 700, 0, 0, 76,1,$watermark)?>" >
<BR>600*700 ũ�� �״�� ����� ����� (watermark - top_right)<BR>

<img src="<?=thumbnail('/data/file/800-600.jpg', 400, 300, 0, 0, 100)?>" >
<BR>400*300 ũ�� �״�� ����� ����� (quality 100)<BR>

<img src="<?=thumbnail('/data/file/800-600.jpg', 401, 301, 0, 0, 20)?>" >
<BR>401*301 ũ�� �״�� ����� ����� (quality 20)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg')?>" >
<BR>800*600 ũ�� �״�� ����� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 1000,1000)?>" >
<BR>1000*1000���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 300)?>" >
<BR>���� 300���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 0,100)?>" >
<BR>���̸� 100���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg',0,120,0,1)?>" >
<BR>���̸� 120���� �����ѽ���� �����(crop)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 200,200,0,1)?>" >
<BR>200*200���� �����ѽ���� �����(crop)<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 300,100)?>" >
<BR>300*100���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 300,300)?>" >
<BR>300*300���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 1000,300)?>" >
<BR>1000*300���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 100,300)?>" >
<BR>100*300���� �����ѽ���� �����<BR>

<img src="<?=thumbnail('./data/file/800-600.jpg', 1000,200,0,1)?>" >
<BR>1000*200���� �����ѽ���� ����� (crop)<BR>
