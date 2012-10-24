<?php

//**********************************************************
// ���ο� ���� ������ DB�� �߰��ϴ� �Լ�
// bool insert_employ(object db, array post_arr [, int user_num [, string company_type]] )
//**********************************************************
// db : MySQL ��ü
// post_arr : �Ѱܹ��� �� ������
// user_num : ȸ����ȣ(������ �� ����� �� ��)
// company_type : �������(������ �� ����� �� ��)
//**********************************************************
// ���ϰ� : ��� ������ ��� true, �ƴϸ� false
//**********************************************************
function insert_employ(&$db, &$post_arr, $user_num = '', $company_type = '')
{
	global $_PNJ, $login_user, $_SERVER;

	// addslashes ó��
	foreach($post_arr as $key => $value)
	{
		$post_arr[$key] = addslashes($value);
	}

	$user_num = $user_num == '' ? $login_user['num'] : $user_num;
	$company_type = $company_type == '' ? $login_user['company_type'] : $company_type;

	if( $company_type == 'H' )
	{
		// ������� ȸ���� ���
		$company_name = $login_user['ko_company_name'];
	}
	else
	{
		// ������� ȸ�簡 �ƴҰ��
		$company_name = $login_user['nickname'] != '' ? $login_user['nickname'] : $login_user['ko_company_name'];
		$company_name_en = $login_user['en_company_name'];
	}

	$tag = get_arr_val($post_arr, 'tag');
  $tag = strip_tags($tag);

	$company_name = addslashes($company_name);
	$company_name_en = addslashes($company_name_en);

	$job_title = get_arr_val($post_arr, 'job_title');
	$job_type = get_arr_val($post_arr, 'job_type');
	$job_code = get_arr_val($post_arr, 'job_code');
	$job_desc = get_arr_val($post_arr, 'job_desc');
	$job_req = get_arr_val($post_arr, 'job_req');
	$work_location = get_arr_val($post_arr, 'work_location');
	$payment = get_arr_val($post_arr, 'payment');
	$fin_year = get_arr_val($post_arr, 'fin_year');
	$fin_month = get_arr_val($post_arr, 'fin_month');
	$fin_day = get_arr_val($post_arr, 'fin_day');
	$fin_date = $fin_month&&$fin_day&&$fin_year&&checkdate($fin_month, $fin_day, $fin_year) ? $fin_year."-".$fin_month."-".$fin_day : '';
	$career_level = get_arr_val($post_arr, 'career_level');
	$career_type1 = get_arr_val($post_arr, 'career_type1');
	$career_type2 = get_arr_val($post_arr, 'career_type2');
	$process = get_arr_val($post_arr, 'process');
	$document = get_arr_val($post_arr, 'document');
	$hr_name = get_arr_val($post_arr, 'hr_name');
	$hr_tel1 = get_arr_val($post_arr, 'hr_tel1');
	$hr_tel2 = get_arr_val($post_arr, 'hr_tel2');
	$hr_tel3 = get_arr_val($post_arr, 'hr_tel3');
	$hr_tel = $hr_tel1 != '' && $hr_tel2 != '' && $hr_tel3 != '' ? $hr_tel1."-".$hr_tel2."-".$hr_tel3 : '';
	$hr_email = get_arr_val($post_arr, 'hr_email');
	$etc = get_arr_val($post_arr, 'etc');

	$is_online_apply = get_arr_val($post_arr, 'is_online_apply');
	$is_receipt_email = get_arr_val($post_arr, 'is_receipt_email');
	$is_receipt_url = get_arr_val($post_arr, 'is_receipt_url');
	$receipt_email = get_arr_val($post_arr, 'receipt_email');
	$receipt_url = get_arr_val($post_arr, 'receipt_url');
	$receipt_url = ! preg_match("/http:\/\//", $receipt_url) ? "http://".$receipt_url : $receipt_url;

	$overseas = get_arr_val($post_arr, 'overseas');
	$tech = get_arr_val($post_arr, 'tech');

	$hr_file = get_arr_val($post_arr, 'hr_file');
	$hr_file_save = get_arr_val($post_arr, 'hr_file_save');

	// ���� �ڵ带 �ش� �ؽ�Ʈ�� ã��
	$job_type_arr = get_job_type_row($db, $job_type);
	$job_code_arr = get_job_code_row($db, $job_code);
	$job_type_text_kr = $job_type_arr['jobsort_kr']."/".$job_code_arr['job_kr'];
	$job_type_text_en = $job_type_arr['jobsort_en']."/".$job_code_arr['job_en'];

	$career_type1_text = isset($_PNJ['career_type1_arr'][$career_type1]) ? $_PNJ['career_type1_arr'][$career_type1] : '';
	$career_type2_text = isset($_PNJ['career_type2_arr'][$career_type2]) ? $_PNJ['career_type2_arr'][$career_type2] : '';

  // ip_address
  $ip_addr = "$_SERVER[REMOTE_ADDR]";

	// �����ͺ��̽��� insert ���� ����
	$query  = "INSERT INTO `employ` ( `reg_date`, `user_num`, `company_type`, `company_name`, `company_name_en`, `job_title`, `job_type`, `job_code`, `job_type_text_kr`, `job_type_text_en`, `job_desc`, `job_req`, `work_location`, `payment`, `fin_date`, `career_level`, `career_type1`, `career_type2`, `process`, `document`, `hr_name`, `hr_tel`, `hr_email`, `etc`, `is_online_apply`, `is_receipt_email`, `is_receipt_url`, `receipt_email`, `receipt_url`, `ip_addr`, `tag`, `overseas`, `tech`, `hr_file`, `hr_file_save` ) ";
	$query .= "VALUES ( NOW(), '$user_num', '$company_type', '$company_name', '$company_name_en', '$job_title', '$job_type', '$job_code', '$job_type_text_kr', '$job_type_text_en', '$job_desc', '$job_req', '$work_location', '$payment', '$fin_date', '$career_level', '$career_type1_text', '$career_type2_text', '$process', '$document', '$hr_name', '$hr_tel', '$hr_email', '$etc', '$is_online_apply', '$is_receipt_email', '$is_receipt_url', '$receipt_email', '$receipt_url', '$ip_addr', '$tag', '$overseas', '$tech', '$hr_file', '$hr_file_save' )";

	$result = $db->query($query) or show_db_err($db);

	// posting_count�� 1 ����
	$query = "UPDATE `user_company` SET posting_count = posting_count - 1 WHERE base_num='$user_num'";
	$db->query($query) or show_db_err($db);

	// �ش� ������� ���� ä������ 1 ����
	$query = "UPDATE `user_company` SET cur_emp_cnt = cur_emp_cnt + 1 WHERE base_num='$user_num'";
	$db->query($query) or show_db_err($db);

	return $result;
}


//**********************************************************
// ���������� ������Ʈ ���ִ� �Լ�
// bool update_employ(object db, int employ_num, array post_arr [, string company_type] )
//**********************************************************
// db : MySQL ��ü
// employ_num : ä������ ��ȣ
// post_arr : �Ѱܹ��� �� ������
// company_type : �������(������ �� ����� �� ��)
//**********************************************************
// ���ϰ� : ������Ʈ ������ ��� true, �ƴϸ� false
//**********************************************************
function update_employ(&$db, $employ_num, &$post_arr, $company_type = '')
{
	global $_PNJ, $login_user;
	global $admin_user, $_SERVER;

	if( $company_type == 'H' )
	{
		// ������� ȸ���� ���
		$company_name = $login_user['ko_company_name'];
	}
	else
	{
		// ������� ȸ�簡 �ƴҰ��
		$company_name = $login_user['nickname'] != '' ? $login_user['nickname'] : $login_user['ko_company_name'];
	}
	$company_name = addslashes($company_name);

	$company_name_en = $login_user['en_company_name'];
	$company_name_en = addslashes($company_name_en);

	$employ_num = intval($employ_num);

	$tag = get_arr_val($post_arr, 'tag');
  $tag = strip_tags($tag);

	$job_title = get_arr_val($post_arr, 'job_title');
	$job_type = get_arr_val($post_arr, 'job_type');
	$job_code = get_arr_val($post_arr, 'job_code');
	$job_desc = get_arr_val($post_arr, 'job_desc');
	$job_req = get_arr_val($post_arr, 'job_req');
	$work_location = get_arr_val($post_arr, 'work_location');
	$payment = get_arr_val($post_arr, 'payment');
	$fin_year = get_arr_val($post_arr, 'fin_year');
	$fin_month = get_arr_val($post_arr, 'fin_month');
	$fin_day = get_arr_val($post_arr, 'fin_day');
	$fin_date = $fin_month&&$fin_day&&$fin_year&&checkdate($fin_month, $fin_day, $fin_year) ? $fin_year."-".$fin_month."-".$fin_day : '';
	$career_level = get_arr_val($post_arr, 'career_level');
	$career_type1 = get_arr_val($post_arr, 'career_type1');
	$career_type2 = get_arr_val($post_arr, 'career_type2');
	$process = get_arr_val($post_arr, 'process');
	$document = get_arr_val($post_arr, 'document');
	$hr_name = get_arr_val($post_arr, 'hr_name');
	$hr_tel1 = get_arr_val($post_arr, 'hr_tel1');
	$hr_tel2 = get_arr_val($post_arr, 'hr_tel2');
	$hr_tel3 = get_arr_val($post_arr, 'hr_tel3');
	$hr_tel = $hr_tel1 != '' && $hr_tel2 != '' && $hr_tel3 != '' ? $hr_tel1."-".$hr_tel2."-".$hr_tel3 : '';
	$hr_email = get_arr_val($post_arr, 'hr_email');
	$etc = get_arr_val($post_arr, 'etc');

	$is_online_apply = get_arr_val($post_arr, 'is_online_apply');
	$is_receipt_email = get_arr_val($post_arr, 'is_receipt_email');
	$is_receipt_url = get_arr_val($post_arr, 'is_receipt_url');
	$receipt_email = get_arr_val($post_arr, 'receipt_email');
	$receipt_url = get_arr_val($post_arr, 'receipt_url');
	$receipt_url = ! preg_match("/http:\/\//", $receipt_url) ? "http://".$receipt_url : $receipt_url;

	$overseas = get_arr_val($post_arr, 'overseas');
	$tech = get_arr_val($post_arr, 'tech');

	$hr_file = get_arr_val($post_arr, 'hr_file');
	$hr_file_save = get_arr_val($post_arr, 'hr_file_save');

	// ���� �ڵ带 �ش� �ؽ�Ʈ�� ã��
	$job_type_arr = get_job_type_row($db, $job_type);
	$job_code_arr = get_job_code_row($db, $job_code);
	$job_type_text_kr = $job_type_arr['jobsort_kr']."/".$job_code_arr['job_kr'];
	$job_type_text_en = $job_type_arr['jobsort_en']."/".$job_code_arr['job_en'];

	$career_type1_text = isset($_PNJ['career_type1_arr'][$career_type1]) ? $_PNJ['career_type1_arr'][$career_type1] : '';
	$career_type2_text = isset($_PNJ['career_type2_arr'][$career_type2]) ? $_PNJ['career_type2_arr'][$career_type2] : '';

	// �����ͺ��̽��� insert ���� ����
	$query  = "UPDATE `employ` SET modify_date=NOW(), ";
	$query .= $admin_user['id'] == '' ? "company_name='$company_name', " : '';
	$query .= $admin_user['id'] == '' ? "company_name_en='$company_name_en', " : '';	
	$query .= "job_title='$job_title', job_type='$job_type', job_code='$job_code', job_type_text_kr='$job_type_text_kr', job_type_text_en='$job_type_text_en', job_desc='$job_desc', job_req='$job_req', work_location='$work_location', payment='$payment', fin_date='$fin_date', career_level='$career_level', career_type1='$career_type1_text', career_type2='$career_type2_text', process='$process', document='$document', hr_name='$hr_name', hr_tel='$hr_tel', hr_email='$hr_email', etc='$etc', ";
	$query .= "is_online_apply='$is_online_apply', is_receipt_email='$is_receipt_email', is_receipt_url='$is_receipt_url', receipt_email='$receipt_email', receipt_url='$receipt_url', ";
  $query .= "tag='$tag', overseas='$overseas', tech='$tech', hr_file='$hr_file', hr_file_save='$hr_file_save' ";
	$query .= "WHERE num='$employ_num'";

	$result = $db->query($query) or show_db_err($db);

	return $result;
}

function delete_employ(&$db, $emp_num_arr, $user_num = '')
{
	if( sizeof($emp_num_arr) > 0 )
	{
		foreach( $emp_num_arr as $num )
		{
			if( intval($num) > 0 )
			{
        // ������ db�� ä������� ������ �����´�
				$query  = "SELECT * FROM `employ` WHERE num='$num' ";
      	$db->query($query) or show_db_err($db);
      	$row = $db->fetch();

				$query  = "DELETE FROM `employ` WHERE num='$num' ";
				$query .= $user_num != '' ? "AND user_num='$user_num' " : '';
				$db->query($query) or show_db_err($db);

				// ���� ä������ 1 ����
				$query = "UPDATE `user_company` SET cur_emp_cnt = cur_emp_cnt - 1 WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);				

				// �������� ����
				$query  = "DELETE FROM `apply` WHERE employ_num='$num' ";
				$db->query($query) or show_db_err($db);

				// ��ũ�� ���� ����
				$query  = "DELETE FROM `scrap_employ` WHERE employ_num='$num' ";
				$db->query($query) or show_db_err($db);
				
				// ���� log ���
				$query2 = "delete employ - user_num : $user_num, employ_num: $num";
				$query = "INSERT INTO `delete_log` SET log_datetime=NOW(), ip_addr='$_SERVER[REMOTE_ADDR]', action='$query2', user_id='$user_num', job_title='$row[job_title]' ";
				$db->query($query) or show_db_err($db);
			}
		}
	}

	return true;
}


//**********************************************************
// DB���� ���������� ������ �����ϴ� �Լ�
// array get_employ_info(object db, int num)
//**********************************************************
// db : MySQL ��ü
// num : ä�� ���� ��ȣ
//**********************************************************
// ���ϰ� : ���������迭
//**********************************************************
function get_employ_info(&$db, $num, $is_join_company = true)
{
	$num = intval($num);

	$query  = "SELECT E.num, DATE_FORMAT(E.reg_date, '%Y-%m-%d %h:%m') reg_date, E.user_num, E.company_name, E.company_type, E.job_title, E.job_type, E.job_code, E.job_type_text_kr, E.job_desc, E.job_req, E.work_location, E.payment, E.fin_date, E.career_level, E.career_type1, E.career_type2, E.process, E.document, E.hr_name, E.hr_tel, E.hr_email, E.etc, E.req_urgent_posting, E.is_online_apply, E.is_receipt_email, E.is_receipt_url, E.receipt_email, E.receipt_url, E.bitly_url, E.twitter, E.hit_count, E.tag, E.overseas, E.tech, E.hr_file, E.hr_file_save ";
	$query .= $is_join_company ? ", UC.ko_company_name, UC.en_company_name, UC.company_nickname, UC.company_brief, UB.modify_date com_modify_date, UC.address1, UC.address2, UB.tel1, UB.tel2, UB.ko_name, BC1.biz_sort_ko biz1, BC2.biz_sort_ko biz2, BC3.biz_sort_ko biz3, UC.homepage_global, UC.homepage_korea, UC.main_product, UC.welfare, UB.certify " : "";
	$query .= "FROM `employ` E ";

	$query .= $is_join_company ? "LEFT JOIN `user_company` UC ON ( UC.base_num = E.user_num ) " : '';
	$query .= $is_join_company ? "LEFT JOIN `user_base` UB ON ( UB.num = UC.base_num ) " : '';

//	$query .= $is_join_company ? ", `user_company` UC, `user_base` UB " : "";
	$query .= $is_join_company ? "LEFT JOIN `bizcode` BC1 ON ( BC1.code = UC.bizcode1 ) " : "";
	$query .= $is_join_company ? "LEFT JOIN `bizcode` BC2 ON ( BC2.code = UC.bizcode2 ) " : "";
	$query .= $is_join_company ? "LEFT JOIN `bizcode` BC3 ON ( BC3.code = UC.bizcode3 ) " : "";
	$query .= "WHERE E.`num` = '$num' ";
//	$query .= "AND E.user_num = UC.base_num AND UB.num = UC.base_num ";

	$db->query($query) or show_db_err($db);

	$row = $db->fetch();

	$row['fin_date'] = intval($row['fin_date']) == 0 ? 'ä��ñ���' : $row['fin_date'];

	if( isset($row['career_type2']) )
	{
		$row['career_type2'] = $row['career_type2'] == '' ? '����/���' : $row['career_type2'];
	}

	return $row;
}

//**********************************************************
// ������ ���� ������ �ٽ� DB�� insert�ϴ� �Լ�
// bool repost_employ(object db, array employ_numbers [, int user_num] )
//**********************************************************
// db : MySQL ��ü
// employ_numbers : ���� ���� ��ȣ �迭
// user_num : ȸ����ȣ(��������)
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//**********************************************************
function repost_employ(&$db, $employ_numbers, $user_num = '')
{
  global $_SERVER;

	// ��ȣ �迭 ����
	sort($employ_numbers, SORT_NUMERIC);

	// ���� �ð� ���ϱ�
	$cur_date_time = date("Y-m-d H:i:s");

	// ������ ���ϱ�
	$fin_date = date("Y-m-d", mktime(0,0,0,date("n"),date("j")+7,date("Y")));	// ���÷κ��� 7�� ���� ��¥ ���ϱ�

	foreach( $employ_numbers as $num )
	{
		if( $num > 0 )
		{
			// ���� ����
			$query =  "INSERT INTO `employ` ( `reg_date`, `user_num`, `company_type`, `company_name`,`job_title`, `job_type`, `job_code`, `job_type_text_kr`, `job_type_text_en`, `job_desc`, `job_req`, `work_location`, `payment`, `fin_date`, `career_level`, `career_type1`, `career_type2`, `process`, `document`, `hr_name`, `hr_tel`, `hr_email`, `partner_level`, `partner_type`, `emp_status`, `company_keyword`, `job_keyword`, `ip_addr` ) ";
			$query .= "SELECT '$cur_date_time', `user_num`, `company_type`, `company_name`, `job_title`, `job_type`, `job_code`, `job_type_text_kr`, `job_type_text_en`, `job_desc`, `job_req`, `work_location`, `payment`, '$fin_date', `career_level`, `career_type1`, `career_type2`, `process`, `document`, `hr_name`, `hr_tel`, `hr_email`, `partner_level`, `partner_type`, `emp_status`, `company_keyword`, `job_keyword`, '$_SERVER[REMOTE_ADDR]' FROM `employ` WHERE num = '$num' ";
			$query .= $user_num != '' ? "AND user_num = '$user_num' " : '';
			$query .= " ORDER BY num";
			$db->query($query) or show_db_err($db);

			// �ش� ������� ä�������Ƚ�� 1����
			if( $user_num > 0 )
			{
				$query = "UPDATE `user_company` SET posting_count=posting_count-1 WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);
				
				// �ش� ������� ���� ä������ 1 ����
				$query = "UPDATE `user_company` SET cur_emp_cnt = cur_emp_cnt + 1 WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);
			}
		}
	}

	return true;
}

//**********************************************************
// ������ ���� ������ ����ó���ϴ� �Լ�
// bool finish_employ(object db, array employ_numbers [, int user_num] )
//**********************************************************
// db : MySQL ��ü
// employ_numbers : ���� ���� ��ȣ �迭
// user_num : ȸ����ȣ(��������)
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//**********************************************************
function finish_employ(&$db, $employ_numbers, $user_num = '')
{
	// ������ ���
	$fin_date = date("Y-m-d", (time()-86400));

	// �Էµ� ��ȣ ����ŭ �ݺ�
	foreach( $employ_numbers as $num )
	{
		if( $num > 0 )	//��ȣ�� 0���� Ŭ ���...
		{
			// ���� ���� Ȯ��
			$query = "SELECT COUNT(*) FROM `employ` WHERE num='$num' AND fin_date < '".date("Y-m-d")."' AND fin_date != 0 ";
			$query .= $user_num != '' ? "AND user_num='$user_num' " : '';						
			$db->query($query) or show_db_err($db);
			if( $db->fetchOne() > 0 )
			{
				show_error_page('ä����� ���� ����', '�̹� ������ ä������Դϴ�.', false, true);				
			}

			// ���� ����
			$query  = "UPDATE `employ` SET fin_date = '$fin_date' WHERE num='$num' ";
			$query .= $user_num != '' ? "AND user_num='$user_num' " : '';

			// ���� ����
			$db->query($query) or show_db_err($db);
		}
	}

	return true;
}

//**********************************************************
// ������ ���� ������ �����̾� ���� �Ƿ� ó���ϴ� �Լ�
// bool req_employ_premium(object db, array employ_numbers [, int user_num] )
//**********************************************************
// db : MySQL ��ü
// employ_numbers : ���� ���� ��ȣ �迭
// user_num : ȸ����ȣ(��������)
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//**********************************************************
function req_employ_premium(&$db, $employ_numbers, $user_num = '', $value = 'R')
{
	// �Էµ� ��ȣ ����ŭ �ݺ�
	foreach( $employ_numbers as $num )
	{
		if( $num > 0 )	//��ȣ�� 0���� Ŭ ���...
		{
			// ���� ����
			$query  = "UPDATE `employ` SET req_premium_posting = '$value' WHERE num='$num' ";
			$query .= $user_num != '' ? "AND user_num='$user_num' " : '';

			// ���� ����
			$db->query($query) or show_db_err($db);
		}
	}

	return true;
}

//**********************************************************
// ������ ���� ������ Urgent ���� �Ƿ� ó���ϴ� �Լ�
// bool req_employ_urgent(object db, array employ_numbers [, int user_num] )
//**********************************************************
// db : MySQL ��ü
// employ_numbers : ���� ���� ��ȣ �迭
// user_num : ȸ����ȣ(��������)
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//**********************************************************
function req_employ_urgent(&$db, $employ_numbers, $user_num = '', $value = 'U')
{
	global $submenu_file, $selected_menu_num;
	global $admin_user;

	// �Էµ� ��ȣ ����ŭ �ݺ�
	foreach( $employ_numbers as $num )
	{
		if( ! $user_num )	// ����� ��ȣ�� �Էµ��� �ʾ��� ���
		{
			//DB���� ����� ��ȣ�� ������ 
			$query = "SELECT user_num FROM `employ` WHERE num='$num'";
			$db->query($query) or show_db_err($db);
			$user_num = $db->fetchOne();
		}
		
		if( $num > 0 )	//��ȣ�� 0���� Ŭ ���...
		{
			// ������ ���� �̹� urgent �������� Ȯ��
			$query = "SELECT COUNT(*) FROM `employ` WHERE num='$num' AND req_urgent_posting != ''";
			$db->query($query) or show_db_err($db);
			if( $db->fetchOne() > 0 )
			{
				show_error_page("URGENT ���� �Ұ�", "�����Ͻ� ����� �̹� Urgent �������Դϴ�.", false, true);
			}

			// ȸ���� urgent ���� ���� Ƚ�� Ȯ��
			if( $admin_user['id'] == '' )
			{
				$query  = "SELECT urgent_count FROM `user_company` WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);
				if( $db->fetchOne() <= 0 )
				{
					show_error_page("URGENT ���� �Ұ�", "URGENT ���� Ƚ���� �ʰ��Ǿ� ���̻� �����Ͻ� �� �����ϴ�", false, true);
				}
			}
			
			// ���� ����
			$query  = "UPDATE `employ` SET req_urgent_posting = '$value' WHERE num='$num' ";
			$query .= $user_num != '' ? "AND user_num='$user_num' " : '';
			$db->query($query) or show_db_err($db);

			if( $admin_user['id'] == '' )
			{
				// urgent count 1 ����
				$query = "UPDATE `user_company` SET urgent_count=urgent_count-1 WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);
			}
		}
	}

	return true;
}

//**********************************************************
// ������ ���� ������ Urgent ���� �����ϴ� �Լ�
// bool req_employ_unurgent(object db, array employ_numbers)
//**********************************************************
// db : MySQL ��ü
// employ_numbers : ���� ���� ��ȣ �迭
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//**********************************************************
function req_employ_unurgent(&$db, $employ_numbers, $is_recover_count = false)
{
	// �Էµ� ��ȣ ����ŭ �ݺ�
	foreach( $employ_numbers as $num )
	{
		if( $num > 0 )	//��ȣ�� 0���� Ŭ ���...
		{
			// ���� ����
			$query  = "UPDATE `employ` SET req_urgent_posting = '' WHERE num='$num' ";
			$db->query($query) or show_db_err($db);

			// urgent count 1 ����
			if( $is_recover_count )
			{
				$query = "UPDATE `user_company` SET urgent_count=urgent_count-1 WHERE base_num='$user_num'";
				$db->query($query) or show_db_err($db);
			}
		}
	}

	return true;
}

//**********************************************************
// ä�������� ��õ�ϴ� �Լ�
// bool recommand_employ(object db, int user_num, int employ_num)
//**********************************************************
// db : MySQL ��ü
// user_num : ��õ�� ����� ��ȣ
// employ_num : ä������ȣ
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//********************************************************** 
function recommand_employ(&$db, $user_num, $employ_num)
{
	// �ش� ä����� �̹� ��õ�ߴ��� Ȯ��
	$query = "SELECT COUNT(*) FROM `employ_recommand` WHERE user_num='$user_num' AND employ_num = '$employ_num'";
	$db->query($query) or show_db_err($db);
	if( $db->fetchOne() > 0 )
	{
		show_error_page("��õ �Ұ�", "�ش� ä������ �̹� ��õ�ϼ̽��ϴ�.", false, true);
		return false;
	}

	// �ش� ä������� ȸ�� ������ȣ select
	$query = "SELECT user_num FROM `employ` WHERE num='$employ_num'";
	$db->query($query) or show_db_err($db);
	$company_num = $db->fetchOne();
	
	// ��õ ���̺� ���
	$query = "INSERT INTO `employ_recommand` SET reg_date=NOW(), user_num='$user_num', employ_num='$employ_num'";
	$db->query($query) or show_db_err($db);

	// ä����� ��õ count 1 ����
	$query = "UPDATE `employ` SET recommand_count=recommand_count+1 WHERE num='$employ_num'";
	$db->query($query) or show_db_err($db);

	// ȸ�� ��õ count 1 ����
	$query = "UPDATE `user_company` SET recommand_count=recommand_count+1 WHERE base_num = '$company_num'";
	$db->query($query) or show_db_err($db);
	
	return true;
}

//**********************************************************
// ä�������� �Ű��ϴ� �Լ�
// bool bad_employ(object db, int user_num, int employ_num, string reason)
//**********************************************************
// db : MySQL ��ü
// user_num : �Ű��� ����� ��ȣ
// employ_num : ä������ȣ
// reason : ����
//**********************************************************
// ���ϰ� : ������ ��� true, �ƴϸ� false
//********************************************************** 
function bad_employ(&$db, $user_num, $employ_num, $reason)
{
	$reason = addslashes(stripslashes($reason));	

	// �Ű��� ä����� �̹� �Ű�Ǿ��ִ��� Ȯ��
	$query = "SELECT COUNT(*) FROM `employ_bad` WHERE user_num='$user_num' AND employ_num='$employ_num'";
	$db->query($query) or show_db_err($db);
	if( $db->fetchOne() > 0 )
	{
		echo "<html><script language=\"javascript\"> ";
		echo "alert('�ش� ä������ �̹� �Ű��Ͻ� ä������Դϴ�.'); ";
		echo "window.close(); ";
		echo "</script></html>";
		exit;
	}

	// �ش� ä������� ȸ�� ������ȣ select
	$query = "SELECT user_num FROM `employ` WHERE num='$employ_num'";
	$db->query($query) or show_db_err($db);
	$company_num = $db->fetchOne();	
	
	// �Ű� ���̺� ���
	$query = "INSERT INTO `employ_bad` SET reg_date=NOW(), user_num='$user_num', employ_num='$employ_num', reason='$reason'";
	$db->query($query) or show_db_err($db);

	// ä����� �Ű� count 1 ����
	$query = "UPDATE `employ` SET bad_count=bad_count+1 WHERE num='$employ_num'";
	$db->query($query) or show_db_err($db);

	// ȸ�� �Ű� count 1 ����
	$query = "UPDATE `user_company` SET bad_count=bad_count+1 WHERE base_num = '$company_num'";
	$db->query($query) or show_db_err($db);
	
	return true;
}

// ���� ��ϰ����� ä����� ������ �˷��ִ� �Լ�
//
function today_posting(&$db)
{
	global $_PNJ, $login_user, $userinfo_arr;
  global $g4;
  global $one_day_posting, $today_remain, $today_posting, $today_posting1, $after_time;

  $date_diff = date("Y-m-d H:i:s", $g4['server_time'] - 86400*3);
  $query = "SELECT count(*) FROM `employ` WHERE user_num='".$login_user['num']."' AND reg_date > '".$date_diff."';";
  $db->query($query) or show_db_err($db);
	$today_posting = $db->fetchOne();

  $today_remain = 1;
  if ($userinfo_arr[payment_expire_ut] >= $g4[server_time]) {
      // ���Ἥ��
      // �����̾� - 120��, ������ - 60��, Ŭ���� - 30��
      if (preg_match("/PREMIUM/i", $userinfo_arr[payment_type])) {
          $one_day_posting = 120/3;
          if ($today_posting >= 120)
          {
              $posting_limit = 120;
              $today_remain = 0;
          } 
          else
              $today_remain = 120 - $today_posting;
      }
      else if (preg_match("/DELUXE/i", $userinfo_arr[payment_type])) {
          $one_day_posting = 60/3;
          if ($today_posting >= 60)
          {
              $posting_limit = 60;
              $today_remain = 0;
          }
          else
              $today_remain = 60 - $today_posting;
      }
      else if (preg_match("/CLASSIC/i", $userinfo_arr[payment_type])) {
          $one_day_posting = 30/3;
          if ($today_posting >= 30)
          {
              $posting_limit = 30;
              $today_remain = 0;
          }
          else
              $today_remain = 30 - $today_posting;
      }
      else { 
          // ����ü�� ���� ���� �� - 15�Ǳ��� ����. ���� �ڵ带 �״�� �����ؼ� ���δ�.
          $one_day_posting = 15/3;
          if ($today_posting >= 15)
              $today_remain = 0;
          else
              $today_remain = 15 - $today_posting;
          }
  } else {
      // ���Ἥ�� - 15�Ǳ��� ����
      $one_day_posting = 15/3;
      if ($today_posting >= 15)
          $today_remain = 0;
      else
          $today_remain = 15 - $today_posting;
  }

  // ����ȸ�����Ը� �������� ��ϰ��������� check
  if ($today_remain == 0 && $posting_limit > 0) {
    $sql = " SELECT reg_date from  `employ` WHERE user_num='".$login_user['num']."' order by num desc LIMIT ".($posting_limit - 1).", 1;";
    $db->query($sql) or show_db_err($db);
	  $reg_date = $db->fetchOne();
    // ���ѰǼ��� �ɸ��� ������ �ð��� timestamp��
	  $after_time = 86400*3 - ($g4['server_time'] - strtotime($reg_date));

    // �ð������϶�
    $after_time_h = floor($after_time / 3600);
	      
    // ���� ��
    $after_time_m = floor( ($after_time - $after_time_h * 3600) / 60);
	      
    // ���� ��
    $after_time_s = ($after_time - $after_time_h * 3600 - $after_time_m * 60 );

    $after_time = $after_time_h ."�� " . $after_time_m ."�� " . $after_time_s . "��";
  }

  $date_diff1 = date("Y-m-d H:i:s", $g4['server_time'] - 86400*1);
	$query1 = "SELECT count(*) FROM `employ` WHERE user_num='".$login_user['num']."' AND reg_date > '".$date_diff1."';";
  $db->query($query1) or show_db_err($db);
	$today_posting1 = $db->fetchOne();  
}
?>