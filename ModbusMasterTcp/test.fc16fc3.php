<?php
require_once dirname(__FILE__) . '/../../Phpmodbus/ModbusMasterTcp.php';
require_once dirname(__FILE__) . '/../config.php';

// Create Modbus object
$modbus = new ModbusMasterTcp($test_host_ip);

// Data to be writen - BYTE
$data = array(255);
$dataTypes = array("BYTE");
// Write data - FC 16
$modbus->writeMultipleRegister(1, 20, $data, $dataTypes);
// Read data - FC3
$recData = $modbus->readMultipleRegisters(1, 20, 1);
print_r($recData[1]);
/*
// Data to be writen - INT
$data = array(0, 1, -1, pow(2,15)-1, -pow(2,15));
$dataTypes = array("INT", "INT", "INT", "INT", "INT");
// Write data - FC 16
$modbus->writeMultipleRegister(0, 12288, $data, $dataTypes);
// Read data - FC3
$recData = $modbus->readMultipleRegisters(0, 12288, 5);
print_r($recData);

// Data to be writen - DINT
$data = array(0, 1, -1, pow(2,31)-1, -pow(2,31));
$dataTypes = array("DINT", "DINT", "DINT", "DINT", "DINT");
// Write data - FC 16
$modbus->writeMultipleRegister(0, 12288, $data, $dataTypes);
// Read data - FC3
$recData = $modbus->readMultipleRegisters(0, 12288, 10);
print_r($recData);

// Data to be writen - REAL
$data = array(0, 1, -2, 1/3, 25);
$dataTypes = array("REAL", "REAL", "REAL", "REAL", "REAL");
// Write data - FC 16
$modbus->writeMultipleRegister(0, 12288, $data, $dataTypes);
// Read data - FC3
$recData = $modbus->readMultipleRegisters(0, 12288, 10);
print_r($recData);
*/
?>