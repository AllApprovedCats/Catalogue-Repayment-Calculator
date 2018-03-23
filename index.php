<?php
function letscalculate( $loanamount , $rateapr, $numbermonths ) {

$rateaprnt = $rateapr/1200;
$rateaprnt1 = 1+$rateaprnt;
$r1 = pow($rateaprnt1, $numbermonths);

$pmt = $loanamount*($rateaprnt*$r1)/($r1-1);

    return $pmt;

}
?>
<?php
if(isset($_POST['numbermonths'])){ $submonths = $_POST['numbermonths']; }
if(!is_numeric($submonths) || $submonths == ""){ $submonths = "1"; }

if(isset($_POST['rateapr'])){ $subrateapr = $_POST['rateapr']; }
if(!is_numeric($subrateapr) || $subrateapr == ""){ $subrateapr = "6"; }

if(isset($_POST['loanamount'])){ $subloanamount = $_POST['loanamount']; }
if(!is_numeric($subloanamount) || $subloanamount == ""){ $subloanamount = "100"; }

?>
<html>
<head>
<title>Catalogue Order Repayment Calculator by AllApprovedCatalogues.co.uk</title>
<meta name="viewport" content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0" />
</head>
<body>
<h3>Catalogue Loan Repayment Calculator</h1>
<form action="" method="POST">

	<!-- Begin Dropdown for Months Selector -->
	<label>Loan Repayment Time</label><br/>
	<select name="numbermonths" style=" width:100%;">
	<?php
	//Outputs field options for 36 months
	$months = range(1, 36);
		foreach($months as $month){
		//Marks Default Month from previous submission
		if($submonths == $month){ $default = " selected"; }else{ $default = ""; }
		//If the month is singular, output month, else output months
		if($month == "1"){ echo "<option value=\"1\">1 Month</option\n"; }else{ echo"<option value=\"$month\"$default>$month Months</option>\n"; }
		}
	?>	</select><br/>
	<!-- End Dropdown for Months Selector -->
	
		<!-- Begin APR Rate Field -->
		<label>APR Rate</label><br/>
		<span style="border: 1px inset #ccc;"><input type="number" name="rateapr" min="0" value="<?php echo $subrateapr; ?>" max="10" step="0.1" style="text-align:right; border:none; padding:0px; outline:none; width:95%;"/>%</span><br/>
		<!-- End APR Rate Field -->
	
	
		<!-- Begin Loan Amount Field -->
		<label>Catalogue Order Amount</label><br/>
		<span style="border: 1px inset #ccc;">£<input type="number" name="loanamount" min="0" value="<?php echo $subloanamount; ?>" step="50" style="text-align:right; border:none; padding:0px; outline:none; width:96%;"/></span><br/>
		<!-- End Loan Amount Field -->
	
		<!-- Hidden input to indicate start of calculation -->
		<input type="hidden" name="calculate" value="yes">
		<!-- End Hidden input -->
		<!-- Submit -->
		<input type="submit" value="Calculate Repayment Amount">
		<!-- End Submit -->
</form><br>
<?php
//If hidden field is set, start calculation
if($_POST['calculate'] == "yes"){
$interestvalue = letscalculate($subloanamount, $subrateapr, $submonths);
$totalrepayment = $subloanamount+$interestvalue;
$permonth = $totalrepayment/$submonths;
$permonth = round($permonth, 2);
$totalrepayment = round($totalrepayment, 2);
$interestvalue = round($interestvalue, 2);
echo"With an initial loan of <font color=\"green\">£$subloanamount</font> you should pay approximately <font color=\"red\">£$interestvalue</font> in interest. You will pay around <b>£$permonth per month</b> for <i>$submonths months</i> (not including fees or penalties if applicable). ";	
}
?><br><br><small>Calculator PHP Script can be downloaded or changed on Github. Originally developed by <a href="https://allapprovedcatalogues.co.uk/">AllApprovedCatalogues.co.uk</a></small><br></body></html>
