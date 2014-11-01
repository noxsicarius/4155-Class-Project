<?php

    include 'connect.inc.php';
    $option = '';
    $sql = "SELECT * FROM `uploadinfo`";
    $result = mysql_query($sql);

    while ($row = mysql_fetch_assoc($result)){

        $option .= '<option value = "'.$row['FileName'].'">'.$row['FileName'].'</option>';
	}
    
?>

<html>
<body>
	<form>
		<select>
			<?php echo $option; ?>
		</select>
	</form>
</body>
</html>