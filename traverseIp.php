<?php
/**
 * Author	: sanfen
 * Time		: 2015-06-20
 * Email	: a@sanfen.me
 * 输入起始ip和结束ip，中间遍历操作。
 */

/**
 * 把ip字符串变成一个10进制的数字
 */
function ip2Num($ipStr)
{
	$ipNum = 0;
	$ipArray = explode(".", $ipStr);
	
	for($i=0; $i<4; $i++) {
		$ipNum += $ipArray[$i]*pow(255, 3-$i);
	}
	
	return $ipNum;
}


/**
 * 把一个10进制的数字变成ip字符串
 */
function num2Ip($ipNum)
{
	$ipArray = array();
	
	for($i=0; $i<4; $i++) {
		$div = pow(255, 3-$i);
		$ipArray[$i] = intval( $ipNum/$div );
		$ipNum = $ipNum % $div;
	}
	return implode(".", $ipArray);
}


function traverseIp($startIp, $endIp, $callback)
{
	$ipStartNum = ip2Num($startIp);
	$ipEndNum = ip2Num($endIp);
	
	//ip检查 排序
	if( $ipStartNum > $ipEndNum) {
		list($ipStartNum, $ipEndNum) = array($ipEndNum, $ipStartNum);
	}
	
	for( $ip=$ipStartNum; $ip<=$ipEndNum; $ip++) {
		
		$callback(num2Ip($ip));
	}
}


//example
$ipEnd = "1.1.1.45";
$ipStart = "1.1.2.2";
traverseIp($ipStart, $ipEnd, function($ip){ echo $ip."\n"; } );

