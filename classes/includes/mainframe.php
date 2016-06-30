<?php 
  class MainFrame {
          function redirect($url)
		   {
		   		echo "<script>window.location.href='".$url."'</script>"; 
		      // header('Location: '.$url);
		   }
		  function miniredirect($url)
		   {
		     echo "<script type='text/javascript'>window.parent.location.href='".$url."'</script>";
			 echo "<script> window.parent.SqueezeBox.close() </script>";
		   }  
		  function selectbox($name,$data,$selected)
		   {
		     $select = array();
			 $select[] = '<select name="'.$name.'" id="'.$name.'">';
			 foreach($data as $key=>$value):
			 $select[] = '<option value="'.$key.'" '.(($key == $selected)?'selected="selected"':'').'>'.$value.'</option>';
			 endforeach;
			 $select[] = '</select>';
			 $select = implode('\n',$select);
			 echo $select;
		   }    
  }

?>