<?php
	require 'core.inc.php';
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>X Note Plus</title>
<link rel="stylesheet" href="styles.css" type="text/css" />

</head>
<body>
<div id="container">
    <header>
    	<h1><a href="/">X NOTE<span> PLUS</span></a></h1>
        <h2>Upload, Share, and compare notes</h2>
    </header>
    <nav>
    	<?php include 'menu.php'; ?>
    </nav>

	<img class="header-image" src="images/image.jpg" alt="Buildings" />

    <div id="body">

		

	  <section id="content">

	    <article>
				
			
		  <h1>Welcome to NotePlus</h1>
		    <h2>&nbsp;</h2>
			
		  
			<p>&nbsp;</p>
	    </article>
	    <article class="expanded">
		<h2> Registration successful. </h2>
		  <h2>&nbsp;</h2>
		</article>
        </section>
        
        <aside class="sidebar">
	
            <?php include 'aside.php'; ?>
		
      </aside>
    	<div class="clear"></div>
  </div>
    <footer>
        <div class="footer-content">
            <?php include 'footer.php' ?>;
    </footer>
</div>
</body>
</html>