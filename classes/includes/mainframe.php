<?php 
  class MainFrame {
          function redirect($url)
		   {
		   		echo "<script>window.location.href='".$url."'</script>"; 
		      // header('Location: '.$url);
		   }   
  }

?>