<?php
function letscalculate( $amt , $interest, $term ) {

$interestamount = $interest/12;
$interestpermonth = $interestamount*$term;
$newamount = $amt/100;
$newamountperc = 100+$interestpermonth;
$newamount = $newamount*$newamountperc;
$newamount = $newamount-$amt;
return $newamount;
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
	$months = range(3, 48);
		foreach($months as $month){
		//Marks Default Month from previous submission
		if($submonths == $month){ $default = " selected"; }else{ $default = ""; }
		//If the month is singular, output month, else output months
		if($month == "1"){ echo "<option value=\"1\">1 Month</option>\n"; }else{ echo"<option value=\"$month\"$default>$month Months</option>\n"; }
		}
	?>	</select><br/>
	<!-- End Dropdown for Months Selector -->
	
		<!-- Begin APR Rate Field -->
		<label>APR Rate</label><br/>
		<span style="border: 1px inset #ccc;"><input type="number" name="rateapr" min="0" value="<?php echo $subrateapr; ?>" max="30" step="0.1" style="text-align:right; border:none; padding:0px; outline:none; width:95%;"/>%</span><br/>
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
//$interestvalue = letscalculate($subloanamount, $subrateapr, $submonths);
// LETS CALCULATE INTEREST MONTHLY DIVIDE YEAR BY 12 AND WORK FROM HERE
$interestvalue = letscalculate($subloanamount, $subrateapr, $submonths);
$totalrepayment = $subloanamount+$interestvalue;
$permonth = $totalrepayment/$submonths;
$permonth = round($permonth, 2);
$totalrepayment = round($totalrepayment, 2); $totalrepayment = number_format((float)$totalrepayment, 2, '.', '');
$interestvalue = round($interestvalue, 2); $interestvalue = number_format((float)$interestvalue, 2, '.', '');
echo"With an initial loan of <font color=\"green\">£$subloanamount</font> you should pay approximately <font color=\"red\">£$interestvalue</font> in interest. You will pay around <b>£$permonth per month</b> for <i>$submonths months</i>. Your total repayment amount would be <b>£$totalrepayment</b>. (not including fees or penalties if applicable). ";	
}
?><br><br><small>Open Source PHP Script at <a href="https://github.com/AllApprovedCats/Catalogue-Repayment-Calculator/tree/master" target"_blank">Github</a>. Originally developed by <a href="https://allapprovedcatalogues.co.uk/">AllApprovedCatalogues.co.uk</a></small><br></body></html>
