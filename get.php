<?php

//支持跨域
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers:x-requested-with, content-type,token');

require_once dirname(__FILE__) . '/Phpmodbus/ModbusMasterTcp.php';
//require_once dirname(__FILE__) . '/../config.php';


date_default_timezone_set('PRC');
function convertUrlQuery($query)
{
    $queryParts = explode('&', $query);
    if(count($queryParts)>1)
    {
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }
	else if(count('=')==1)
	{
		$params = array();
		$item = explode('=', $query);
		$params[$item[0]] = $item[1];
        return $params;
	}
    else
        return null;
}


#判断参数
$page = null;
$limit = null;

$url = $_SERVER['REQUEST_URI'];
$arr = parse_url($url);

$ip = "154.8.205.252";
$port = null;
$data = null;

$input = file_get_contents("php://input");
$params = null;
//header('Content-Type:application/json; charset=utf-8');
//header("Content-Type: text/html; charset=utf-8");
parse_str($input,$params);
foreach($params as $key =>$item){
	if($key == 'ip')
	{
		$GLOBALS['ip'] = $item;
	}
	
	if($key == 'port')
	{
		$GLOBALS['port'] = $item;
	}
	
	if($key == 'data')
	{
		$GLOBALS['data'] = $item;
	}

} 

header('Content-Type:application/json; charset=utf-8');
if(array_key_exists('query',$arr))
{
    $arr_query = convertUrlQuery($arr['query']);
    if(count($arr_query))
    {
		if(array_key_exists('ip',$arr_query))
			$GLOBALS['ip'] = $arr_query['ip'];
		if(array_key_exists('port',$arr_query))
			$GLOBALS['port'] = $arr_query['port'];
		if(array_key_exists('data',$arr_query))
			$GLOBALS['data'] = $arr_query['data'];
		
    }
}
// Create Modbus object
$modbus = new ModbusMasterTcp($GLOBALS['ip'],$GLOBALS['port']);
// Read multiple registers
try {
	$recData = $modbus->readMultipleRegisters(1, 0, 1);
	$ret = array(); 
	$ret['code']=0;
	$ret['data']=$recData[1];
	echo json_encode($ret);
}
catch (Exception $e) {
	// Print error information if any
	$ret = array(); 
	$ret['code']=-1;
	echo json_encode($ret);
	//echo $modbus;
	//echo $e;
	exit;
}

?>