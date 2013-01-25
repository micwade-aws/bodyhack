<?php
//bodyhack.php - main processing script for a rather simple application that 
// tracks the data from a withings scale.

/*
Basic functionality:
1. Flat File (csv) is used to save off the data (one file per user). 
2. Syncs/Edits of data based on pushes from Withings
3. Functions to print/fetch the data
4. Functions to create a plot of data

That's it.  Not a whole lot too this, but those are the basic goals.
Plan is to keep it all in this one file and as few lines of code as possible.
*/

/////////////////////
// CSV handling
/////////////////////

//initialize() - check if there is a username.csv file in the present directory.
// if not, create a new one based on the values from config.php.  Nothing there 
// either?!?  OK, bomb out.
function initialize(){
	
}
?>