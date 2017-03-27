<?php
	extract ($_POST);    // Create post variables.
	print <<<_A_
	<head>
	<title>Search Names</title>
	</head>

	<body>\n
_A_;

	if (isset($btn_1))
		state2();
	else
		state1();
		

print "</body>\n</html>";

//==========================================================

function state1()
	{
		print <<<_A_
			<p align="center"><b>SEARCH FOR PERSONS BY BIRTH YEAR</b></p>
			<form action="read_into_table.php" method="post" name="form1">
			<table border="1" cellspacing="0" cellpadding="8" align="center">
			<tr><td>Month:</td> <td><input type="text" name="mon" size="2" maxlength="2" value=""/></td> </tr>
			<tr><td colspan="2" align="center"><input type="submit" name="btn_1" value=" Next "/></td> </tr>
			</table>
			</form>\n
_A_;
	}

function state2()
	{
		extract ($_POST);    // Create post variables.
		print <<<_A_
			<p align="center"><b>Persons Born In Month $mon</b></p>
			<table border="1" cellspacing="0" cellpadding="2" align="center">
			<tr><th>First Name</th> <th>Last Name</th> <th>Birth Date</th> 
				<th>Gender</th> <th>City</th></tr>\n
_A_;
		$filename = "database.txt";
		$lines = file($filename) or die ("Cannot open $filename");
		foreach ($lines as $line)
			{
				$line = rtrim ($line);
				list ($fname, $lname, $bdate, $gender, $city) = split ("\t", $line);
				list ($y, $m, $d) = split ("-", $bdate);
				if ($mon == $m)	// or:    if ($mon == substr($bdate, 5, 2))
					{
						print "<tr><td>$fname</td> <td>$lname</td> <td>$d/$m/$y</td> <td>$gender</td> <td>$city</td> </tr>\n";
					}
			}
		print <<<_A_
			</table>
			<hr/><p align="center"><a href="read_into_table.php">Enter another month</a></p>
_A_;
	}
	
	
?>