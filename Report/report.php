<?php require_once('../Connections/Leave.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_report = "1";
if (isset($_GET['Leave_id'])) {
  $colname_report = $_GET['Leave_id'];
}
mysql_select_db($database_Leave, $Leave);
$query_report = sprintf("SELECT Leave_id, empid, empname, desig, department, leave_type, from_date, to_date, app_date, no_days, reason, leave_status, Approved_principal, Approved_registerar FROM leave_page WHERE Leave_id = %s", GetSQLValueString($colname_report, "int"));
$report = mysql_query($query_report, $Leave) or die(mysql_error());
$row_report = mysql_fetch_assoc($report);
$totalRows_report = mysql_num_rows($report);
$fname = $row_report['empname'];
$desig = $row_report['desig'];
$dep = $row_report['department'];
$leave = $row_report['leave_type'];
$from = $row_report['from_date'];
$to = $row_report['to_date'];
$app = $row_report['app_date'];
$no = $row_report['no_days'];
$hod = $row_report['leave_status'];
$principal = $row_report['Approved_principal'];
$registerar = $row_report['Approved_registerar'];
mysql_free_result($report);
require("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->Addpage();
$pdf->SetFont("Arial","B",20);
$pdf->Cell(0,10,"Vidya Vikas First Grade College",0,1,'C');
$pdf->SetFont("Arial","B",10);
$pdf->Cell(0,5,"Allanah Halli Mysore ",0,1,'C');
$pdf->Image('images\logo.jpg', 90, 25, 30, 25);
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,65,"\nLeave Application ",0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Multicell(0,5,"\nName of Applicant:   {$fname}\n
Designation:\t\t\t\t\t\t\t\t\t\t\t\t\t\t {$desig}\n
Department: \t\t\t\t\t\t\t\t\t\t\t{$dep}\n
Leave Type: \t\t\t\t\t\t\t\t\t\t\t{$leave}\n
From Date:  \t\t\t{$from}\n
TO Date:   \t\t\t\t\t\t{$to}\n
Applied Date: {$app}\n
Number of Days:\t\t\t{$no}\n
Approved BY :\n
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tHOD : {$hod}\n
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tPrincipal : {$principal}\n
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\tRegisterar : {$registerar}\n
",1,1);
$pdf->Cell(0,61,"HOD Signature \t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t Signature of the Applicant  ",0,1,'');

$pdf->output();
?>
