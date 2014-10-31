<?php
    global $link;
    global $result;
    global $select_db;
    $link = mysql_connect('localhost', 'root', '');
    if (!$link){
        die("Database Connection Failed" . mysql_error());
    }
    $select_db = mysql_select_db('a_database');
    if (!$select_db){
        die("Database Selection Failed" . mysql_error());
    }
    $option = '';
    $sql = "SELECT * FROM `uploadInfo`";
    $result = mysql_query($sql);

    while ($row = mysql_fetch_assoc($result)){

         $option .= '<option value = "'.$row['FileName'].'">'.$row['FileName'].'</option>';}

    
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