<?php
	require_once dirname(__FILE__) . '/../../Phpmodbus/ModbusMasterTcp.php';
	require_once dirname(__FILE__) . '/../config.php';

	// Create Modbus object
	$modbus = new ModbusMasterTcp($test_host_ip);
	// Read multiple registers
	try {
		$recData = $modbus->readMultipleRegisters(1, 20, 1);
	}
	catch (Exception $e) {
		// Print error information if any
		echo $modbus;
		echo $e;
		exit;
	}
	/*
	// 数据库设备的数据描述
	$devicesDataBlock = [
		"0" => "给水设备1",
		"1" => "给水设备2",
		"2" => "给水设备3",
		"3" => "除湿机",
		"4" => "照明",
		"5" => "门禁",
		"6" => "排风机",
		"7" => "摄像头"
	];
	//print_r($recData[1]);
	$realData = [];

	//var_dump($realData);die;
	
	// Print data in string format
	//echo PhpType::bytes2string($recData);
	$bin = decbin($recData[1]);
	$bin = str_pad($bin, 8, 0, STR_PAD_LEFT);
	for($i=0)
	echo $bin;
	*/
?>