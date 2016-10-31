</div>
<?php 
	if(isset($_SESSION['id'])){
?>
<footer>
	  <p>
      &copy; 2016 DGR All rights reserved

            &nbsp;&nbsp;&nbsp;&nbsp;

      Design by Romain and David | 
      
      <a href="ami.php">Page ami</a> |
           <a href="mur.php?id=<?php echo $_SESSION['id'] ?>">Mon mur</a> |
            <a href="http://validator.w3.org/check?uri=referer">XHTML</a> |
      <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
      </p>
</footer>
<?php } ?>
</body>
</html>