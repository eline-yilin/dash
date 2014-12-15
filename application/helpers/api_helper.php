<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_api_request'))
{
    function my_api_request($url , $method = 'get', $param = array())
    {
    	$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL,  $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		
		// 执行并获取HTML文档内容
		$output = curl_exec ( $ch );
		// 释放curl句柄
		curl_close ( $ch );
		return $output;
		//print_r ( $output );
       
    }   
}