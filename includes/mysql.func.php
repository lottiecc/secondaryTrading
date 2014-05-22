<?php
//防止恶意调用
if(!defined('IN_ST')){
	exit('非法调用');
}

/**
*_connect()链接MySQL数据库
*@access public
*@return void
*/
function _connect(){
	//global表示全局变量，使得此变量在函数外部也能访问
	global $_conn;
	if(!$_conn=mysql_connect(DB_HOST,DB_USER,DB_PWD)){
		exit('数据库连接失败！');
	}
}

/**
*_select_db选择一款数据库
*@return void
*/
function _select_db(){
	if(!mysql_select_db(DB_NAME)){
		exit('找不到指定的数据库！');
	}
}

function _set_names(){
	if(!mysql_query('SET NAMES UTF8')){
		exit('字符集错误！');
	}
}

function _query($_sql){
	if(!$_result=mysql_query($_sql)){
		exit('SQL执行失败');
	}
	return $_result;
}

function _fetch_array($_sql){
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}


function _is_repeat($_sql,$_info){
	if(_fetch_array($_sql)){
		_alert_back($_info);
	}
}

/**
*_affected_rows表示影响到的记录数
*/
function _affected_rows(){
	return mysql_affected_rows();
}


function _close() {
	if (!mysql_close()) {
		exit('关闭异常');
	}
}

?>