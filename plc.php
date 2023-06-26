<?php
require_once dirname(__FILE__) . '/../../Phpmodbus/ModbusMasterTcp.php';
require_once dirname(__FILE__) . '/../config.php';

// Create Modbus object
$modbus = new ModbusMasterTcp($test_host_ip);

$data = array(100);
$dataTypes = array("BYTE");
$modbus->writeMultipleRegister(1, 20, $data, $dataTypes);
$recData = $modbus->readMultipleRegisters(1, 20, 1);
print_r($recData[1]);
?>