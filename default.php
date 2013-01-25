<html>
<head>
<title>Body Info</title>
<style type="text/css">
body {color:white;}
h1 {color:white;}
p {color:white;}
</style>
</head>
<body bgcolor="black">
<h1>Weight Data</h1>
<p>This is data I collected automatically via my Withings Scale...
<pre>
<?php
  // Need all this stuff
  include("./config.php");
  require("./wbs.php");
  require_once("./bodyhack.php");
  
  // Setup the Withings Body Scale (WBS) interface
  $wbs = new wbs_Account();
  $wbs->setUserEmail($withings_user);
  $wbs->setUserPassword($withings_passwd);
  
  // Initialize the bodyhack application with the WBS and account info
  ///initBodyHack($wbs, $withings_user);
  
  // Process any pushes from Withings
  
  
  // Setup the filters from POST
  
  // Read in the data using the filters
  
  // Create a new plot image?
  
  // Print the raw data (again using the filters)
  
  //Dates?
  // These are handled in epochs...  Not a fan, but whatever.  Here is the code
  // I need to convert normal dates to epoch.    
  // print "Date: ".date("U",mktime(0,0,0,12,25,2012))."\t".date(DATE_ATOM, mktime(0,0,0,12,25,2012))."\n";

  /*
  TODO:
  - Read the complete notification section
  - Write data to a CSV file on each notification of a new/mod/del data
  - User "userid" gets a single userid.csv file AND a userid-stats.csv file
  - The stats will have the summary info, e.g. lowest weight to date.
  - Error handling
  - Plots for the last year and the goal weight.
  */
  
  $usersList = $wbs->getUsersList();
  
  foreach ($usersList as $user) {
    $user->setLimit(60);
	$user->setStartdate(date("U",mktime(0,0,0,12,25,2012)));
    $user->setEnddate(time());
    $measuresgroups = $user->getMeasures();
	print $user->getFullname() . "\n";
	if($measuresgroups){
		foreach($measuresgroups as $group) { //The error is b/c Marie has no data..
		  print "\t" . date('Y-m-d  H:i:s', $group->getDate()) . "\n";
		  foreach($group->getMeasures() as $measure) {
			$units = $measure->getUnitSuffix();
			$value = $measure->getValue();
			if($units == "kg"){
				$value = round($value* 2.20462262185, 2);
				$units = "lbs";
			}
			if($units == "meter"){
				$value = round($value*3.28084, 2);
				$units = "ft";
			}
			print "\t\t" . $measure->getUnitPrefix() . " ". $value . " " . $units . "\n";

		  }
		}
	}
  }

?></pre></p>
</body>
</html>