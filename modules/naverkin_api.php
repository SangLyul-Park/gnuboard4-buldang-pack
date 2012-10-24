<?php 
include_once("./_common.php"); 

$html_title = "Naver Open API : ������ �˻� (search.naver.com)"; 
$g4[title] = "" . $html_title; 

// ���ȭ�� �ҷ�����(��ܸ޴��� ���ʸ޴��� �̰����� �ҷ�������) 
include_once("./_head.php"); 

// rss library  (������ �״����� lib ���丮 ȭ�Ϸ� ���μŵ� �����ϴ�.) 

    function rss_array($url){
       global $g_rss_array;
      // empty our global array
        $g_rss_array = array();
      // if the URL looks ok
        if(preg_match("/^http:\/\/([^\/]+)(.*)$/", $url, $matches)){
            $host = $matches[1];
            $uri = $matches[2];
            $request = "GET $uri HTTP/1.0\r\n";
            $request .= "Host: $host\r\n";
			$request .= "Connection: close\r\n\r\n";
           // open the connection
              // ���� ����,  �ִ뿬��ð� 10�ʷμ���
			if($http = @fsockopen($host, 80, $errno, $errstr, 10)){     
          // make the request
                fwrite($http, $request);
          // read in for max 10 seconds
                $timeout = time() + 10;
                while(time() < $timeout && !feof($http)) {
                    $response .= fgets($http, 4096);
                }
          // split on two newlines
                list($header, $xml) = preg_split("/\r?\n\r?\n/", $response, 2);
          // get the status
                if(preg_match("/^HTTP\/[0-9\.]+\s+(\d+)\s+/", $header, $matches)){
                    $status = $matches[1];
                 // if 200 OK
                    if($status == 200){
                 // create the parser
        $xml_parser = xml_parser_create();
           xml_set_element_handler($xml_parser, "startElement", "endElement");
           xml_set_character_data_handler($xml_parser, "characterData");
           // parse!
           xml_parse($xml_parser, trim($xml), true) or $g_rss_array[errors][] = xml_error_string(xml_get_error_code($xml_parser)) . " at line " . xml_get_current_line_number($xml_parser);

   // free parser
    xml_parser_free($xml_parser);
      }
     else {
         $g_rss_array[errors][] = "Can't get feed: HTTP status code $status";
         }
           }
  // Can't get status from header
      else {
         $g_rss_array[errors][] = "Can't get status from header";
           }
       }

		  else { 
             echo "<B><font color=#FF5F00>���� ���� �� �� �����ϴ�.<br />RSS�ּҶǴ¼������� ��� �� �ٽ� �õ��� ������.</font></B><br />"; 
               }
        }
        // Feed url looks wrong
        else {
            $g_rss_array[errors][] = "Invalid url: $url";
        }

	 // unset ������
        unset($g_rss_array[channel_title]);
        unset($g_rss_array[channel_description]);
        unset($g_rss_array[channel_lastBuildDate]);
        unset($g_rss_array[channel_total]);
		unset($g_rss_array[inside_rdf]);
        unset($g_rss_array[inside_rss]);
        unset($g_rss_array[inside_channel]);
        unset($g_rss_array[inside_item]);
        unset($g_rss_array[image_title]);
        unset($g_rss_array[image_link]);
		unset($g_rss_array[current_tag]);
        unset($g_rss_array[current_title]);
        unset($g_rss_array[current_link]);
        unset($g_rss_array[current_description]);


        return $g_rss_array;
    }
 //this function will be called everytime a tag starts
    function startElement($parser, $name){
        global $g_rss_array;
        $g_rss_array[current_tag] = $name;
        if($name == "RSS"){
            $g_rss_array[inside_rss] = true;
        }
        elseif($name == "RDF:RDF"){
            $g_rss_array[inside_rdf] = true;
        }
        elseif($name == "CHANNEL"){
            $g_rss_array[inside_channel] = true;
            $g_rss_array[channel_title] = "";
            $g_rss_array[channel_description] = "";
            $g_rss_array[channel_lastBuildDate] = "";
            $g_rss_array[channel_total] = "";
            $g_rss_array[channel_language] = "";
        }
        elseif(($g_rss_array[inside_rss] and $g_rss_array[inside_channel]) or $g_rss_array[inside_rdf]){
            if($name == "ITEM"){
                $g_rss_array[inside_item] = true;
            }
            elseif($name == "IMAGE"){
                $g_rss_array[inside_image] = true;
            }
        }
    }

// this function will be called everytime there is a string between two tags
    function characterData($parser, $data){
        global $g_rss_array;
        if($g_rss_array[inside_item]){
            switch($g_rss_array[current_tag]){
                case "TITLE":
                $g_rss_array[current_title] .= $data;
                break;
                case "DESCRIPTION":
                $g_rss_array[current_description] .= $data;
                break;
                case "LINK":
                $g_rss_array[current_link] .= $data;
                break;

            }
        }

        elseif($g_rss_array[inside_channel]){
            switch($g_rss_array[current_tag]){
                case "TITLE":
                $g_rss_array[channel_title] .= $data;
                break;
                case "DESCRIPTION":
                $g_rss_array[channel_description] .= $data;
                break;
                case "LASTBUILDDATE":
                $g_rss_array[channel_lastBuildDate] .= $data;
                break;
                case "TOTAL":
                $g_rss_array[channel_total] .= $data;
                break;
                case "LANGUAGE":
                $g_rss_array[channel_language] .= $data;
                break;
            }
        }
    }

    // this function will be called everytime a tag ends
    function endElement($parser, $name){
        global $g_rss_array;
      // end of item, add complete item to array
        if($name == "ITEM"){
            $g_rss_array[items][] = array(
				title => trim($g_rss_array[current_title]), 
				link => trim($g_rss_array[current_link]), 
				description => trim($g_rss_array[current_description]), 
			
			);
    // reset these vars for next loop
            $g_rss_array[current_title] = "";
            $g_rss_array[current_description] = "";									
			$g_rss_array[current_link] = "";
			$g_rss_array[inside_item] = false;
        }
        elseif($name == "RSS"){
            $g_rss_array[inside_rss] = false;
        }
        elseif($name == "RDF:RDF"){
            $g_rss_array[inside_rdf] = false;
        }
        elseif($name == "CHANNEL"){
            $g_rss_array[channel][title] = trim($g_rss_array[channel_title]);
            $g_rss_array[channel][description] = trim($g_rss_array[channel_description]);
            $g_rss_array[channel][lastBuildDate] = trim($g_rss_array[channel_lastBuildDate]);
            $g_rss_array[channel][total] = trim($g_rss_array[channel_total]);
			$g_rss_array[inside_channel] = false;
        }

    }


// ȸ���� ���ٱ��� ����� ����Ͻ÷��� �ּ��� �����ϼ���. 

if (!$member[mb_id]) { 

            alert("ȸ���̽ö�� �α��� �� �̿��� ���ʽÿ�.", "$g4[bbs_path]/login.php"); 
} 

// Naver OpenAPI ��û ���� (request parameter) ����

$s_requesturl = "http://openapi.naver.com/search?"; // OpenAPI ��û url
$map_key = "" ; // �̿� ����� ���� ���� key ��Ʈ�� �Է�
$s_target = "kin"; // Ÿ������ (������ kin, ��α� blog��)
$s_display ="20";  // �˻���� ��°Ǽ�
if($s_start == '')  { $s_start ="1"; } // �˻������ ������ġ
$s_sort = "sim"; // ���Ŀɼ� ����(sim,date,count point);
// �⺻ �˻�� �����մϴ�. (���� ��Ȳ�� �°�) �״������ �߽��ϴ�. �����Ͻø� �˴ϴ�.
if($channel_query == '') { $channel_query =""; } 

?> 
	<table width=100% cellpadding=0 cellspacing=0>
    <tr>
    <td background='../img/top_box_tl.gif' width=5 height=5></td>
    <td background='../img/top_box_tc.gif' width='' height=5></td>
    <td background='../img/top_box_tr.gif' width=5 height=5></td>
    </tr>
    </table>
    <!-- ���� --><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="3"></td></tr></table> 

    <!-- �˻� ���� --> 
    <form name=fnew method=get style="margin:0px;"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
    <tr> 
    <td height=30> 
        &nbsp;<b> ���̹�(www.naver.com) ������ �˻� : </b> 
        <input type=text id='channel_query' name='channel_query' value=''> 
        <input type=submit value='�˻�'> 
    </td> 
    </tr> 
    </table> 
    </form> 
    <!-- �˻� �� --> 

<? 
    // url_fopen ��� 
     if (ini_get("allow_url_fopen") == 0) { @ini_set("allow_url_fopen", 1); 
        } 
    // ���̹� ������ OpenAPI ��û url�Դϴ�. 
    $channel_list = $s_requesturl."display=".$s_display."&start=".$s_start."&target=".$s_target."&sort=".$s_sort."&key=".$map_key."&query="; 


$channel_query1 =iconv("euc-kr","utf-8",str_replace(" ","",$channel_query)); 


    // ������ ä�ο��� �˻��� ������ �о�´�. 

    $rss_array = rss_array($channel_list.$channel_query1); 

// �ܾ�� RSS�� ä�� �±��� Ÿ��Ʋ�� ���̹�(UTF-8���) euc-kr�� ��ȯ 
// ���� ȯ���� UTF-8�ϰ�� iconv�� ������� ������ �˴ϴ�.

$channel = $rss_array['channel']['title']; 
$s_total = $rss_array['channel']['total']; 
$s_lastBuildDate = $rss_array['channel']['lastBuildDate']; 

$mt_cha =iconv("utf-8","euc-kr","$channel");  

      $pubdate = date('Y-m-d H:i:s', strtotime($s_lastBuildDate));
      $arr_date = substr($pubdate, 0,4)."��".substr($pubdate, 5,2)."��".substr($pubdate, 8,2)."��  ".substr($pubdate, 11,8);

?> 

<table width="710" border="0" cellspacing="0" cellpadding="0"> 
<tr><td colspan=3 height=2 bgcolor=#B0ADF5></td></tr> 
<tr bgcolor=#F8F8F9 height=30 align=center> 
    <td width=710><font color='red'>'<b><?=$channel_query?></b></font>'�� ���� ���̹� ����iN ���񽺳� �˻�����Դϴ�. :: �˻��Ǽ� : <?=number_format($s_total)?>�� <?=$arr_date?></td>

</tr> 
<tr><td colspan=3 height=1 bgcolor=#B0ADF5></td></tr> 
<? 

if(count($rss_array['items']) > 0 ) { 

  foreach ($rss_array['items'] as $item) { 
      $mtt1 =iconv("utf-8","euc-kr","{$item[title]}");   
      $url = $item['link'];
?> 
<tr onmouseover="this.style.backgroundColor='#FAF1C2';" onmouseout="this.style.backgroundColor='#FFFFFF';"><td height='26' style='padding-left:10px;' width=710><a href='<?=$url?>' target='_blank'><?=$mtt1?></a></td></tr>
<tr><td colspan='3' height=1 bgcolor=#E7E7E7></td></tr> 
<? 

} //foreach 

// ������ ǥ��

$total_page = ceil($s_total/$s_display);
if (!$s_start) $s_start = 1;
$from_record = $total_count - (($s_start - 1) *$rows);
$end_record = $from_record - $s_display+1;
if($end_record < 0) $end_record = 0;

$write_pages = get_paging($s_display-10, $s_start, $total_page, "?&channel_query=".$channel_query."&s_start=");

echo("<tr><td align=center>".$write_pages."</td></tr>");


echo("</table><p><div align=center>�� ������ <a href="."http://openapi.naver.com/index.nhn"."><img src='http://openapi.naver.com/logo/logo01_1.gif' border=0 align=absmiddle>"."</a> ����IN �˻��� ���� �����ϴ� �������θ� �����Ǿ� �ֽ��ϴ�.</div><br></td></tr></table>"); 
}  // �˻� ���� IF 

else { 
echo("<tr><td colspan='3' align=center height=100>�˻��� �ڷᰡ �����ϴ�.</td></tr><tr><td colspan='3' height=1 bgcolor=#B0ADF5></td></tr></table><br></td></tr></table>"); 
} 
include_once("./_tail.php"); 
?>
