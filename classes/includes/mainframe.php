<?php 
  class MainFrame {
          function redirect($url)
		   {
		   		echo "<script>window.location.href='".$url."'</script>"; 
		      // header('Location: '.$url);
		   } 
		  function selectbox($name,$data,$selected)
		   {
		     $select = array();
			 $select[] = '<select name="'.$name.'" id="'.$name.'">';
			 foreach($data as $key=>$value):
			 $select[] = '<option value="'.$key.'">'.$value.'</option>';
			 endforeach;
			 $select[] = '</select>';
			 $select = implode('\n',$select);
			 echo $select;
		   }    
  }

?>