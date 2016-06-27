<?php
class Resizer
{
	public function img_resize($image_path,$params,$destFolder=NULL,$isName=NULL) 
	{
		if($destFolder==NULL):
			$destFolder="images/thumb";
		endif;
		
		$basePath=(dirname(dirname(dirname(__DIR__))));
		//$params = array('width' => $option["width"], 'height' =>$option["height"], 'rgb' => '0x000000', 'aspect_ratio' => false, 'crop' => false);		
		$imageName=Resizer::getFilename($image_path,$destFolder,$isName);
		$dest_path=$basePath.'/'.$imageName;
		if(!file_exists($dest_path))
		{
			$ini_path=$basePath.'/'.$image_path;
			$width = !empty($params['width']) ? $params['width'] : 100;
			$height = !empty($params['height']) ? $params['height'] : '';
			$constraint = !empty($params['constraint']) ? $params['constraint'] : false;
			$rgb = !empty($params['rgb']) ?  $params['rgb'] : 0x000000;
			$quality = !empty($params['quality']) ?  $params['quality'] : 100;
			$aspect_ratio = isset($params['aspect_ratio']) ?  $params['aspect_ratio'] : false;
			$crop = isset($params['crop']) ?  $params['crop'] : false;
		//print_r($crop); exit;
			if (!file_exists($ini_path)) 
			{
				return false;
			}	
		
			if (!is_dir($dir=dirname($dest_path))) mkdir($dir);
			$img_info = getimagesize($ini_path);
			if ($img_info === false) return false;
			
			/*if((int)$img_info[1] > (int)$img_info[0])
			$ini_p = $img_info[1]/$img_info[0];
			else*/
			$ini_p = $img_info[0]/$img_info[1];
						
			if ( $constraint ) 
			{
				$con_p = $constraint['width']/$constraint['height'];
				$calc_p = $constraint['width']/$img_info[0];
				if ( $ini_p < $con_p ) 
				{
					$height = $constraint['height'];
					$width = $height*$ini_p;
				}
				else 
				{
					$width = $constraint['width'];
					$height = $img_info[1]*$calc_p;
				}
			} 
			else 
			{
				if ( !$width && $height ) 
				{
					$width = ($height*$img_info[0])/$img_info[1];
				} 
				else if ( !$height && $width ) 
				{
					$height = ($width*$img_info[1])/$img_info[0];
				} 
				else if ( !$height && !$width ) 
				{
					$width = $img_info[0];
					$height = $img_info[1];
				}
			}
			
			preg_match('/\.([^\.]+)$/i',basename($dest_path), $match);
			$ext = $match[1];
			$output_format = ($ext == 'jpg') ? 'jpeg' : $ext;
			
			$format = strtolower(substr($img_info['mime'], strpos($img_info['mime'], '/')+1));
			$icfunc = "imagecreatefrom" . $format;
		
			$iresfunc = "image" . $output_format;
		
			if (!function_exists($icfunc)) return false;
		
			$dst_x = $dst_y = 0;
			$src_x = $src_y = 0;
			$res_p = $width/$height;
			if ( $crop && !$constraint ) {
				$dst_w  = $width;
				$dst_h = $height;
				if ( $ini_p > $res_p ) {
					$src_h = $img_info[1];
					$src_w = $img_info[1]*$res_p;
					$src_x = ($img_info[0] >= $src_w) ? floor(($img_info[0] - $src_w) / 2) : $src_w;
				} else {
					$src_w = $img_info[0];
					$src_h = $img_info[0]/$res_p;
					$src_y    = ($img_info[1] >= $src_h) ? floor(($img_info[1] - $src_h) / 2) : $src_h;
				}
			} else {
				if ( $ini_p > $res_p ) {
					$dst_w = $width;
					$dst_h = $aspect_ratio ? floor($dst_w/$img_info[0]*$img_info[1]) : $height;
					$dst_y = $aspect_ratio ? floor(($height-$dst_h)/2) : 0;
				} else {
					$dst_h = $height;
					$dst_w = $aspect_ratio ? floor($dst_h/$img_info[1]*$img_info[0]) : $width;
					$dst_x = $aspect_ratio ? floor(($width-$dst_w)/2) : 0;
				}
				$src_w = $img_info[0];
				$src_h = $img_info[1];
			}
		
			$isrc = $icfunc($ini_path);
			$idest = imagecreatetruecolor($width, $height);
			if ( ($format == 'png' || $format == 'gif') && $output_format == $format ) {
				imagealphablending($idest, false);
				imagesavealpha($idest,true);
				imagefill($idest, 0, 0, IMG_COLOR_TRANSPARENT);
				imagealphablending($isrc, true);
				$quality = 0;
			} else {
				imagefill($idest, 0, 0, $rgb);
			}
						
			imagecopyresampled($idest, $isrc, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
			$res = $iresfunc($idest, $dest_path, $quality);
			
			imagedestroy($isrc);
			imagedestroy($idest);
		 }	
		return $imageName;
	}
	public function getFilename($file,$destFolder,$isName)
	{
		if($isName!=NULL && $isName!="")
		{
			$createName=$isName;
		}
		else
		{
			$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
			if(!isset($ext))
			{
				$ext = strtolower(end(explode('.', $file )));
			}
			$createName=md5($file).'.'.$ext;
		}
		$dest_path=$destFolder."/".$createName;
		return  $dest_path; 
	}
	
	///Sample params....
	/*$params = array(
									'width' => 200,
									'height' => 200,
									'aspect_ratio' => true,
									'rgb' => '0x000000',
									'crop' => false
								);
					
	$params = array(
									'width' => 200,
									'height' => 200,
									'aspect_ratio' => false,
									'rgb' => '0x000000',
									'crop' => false
								);	*/			
}
?>