<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Easyhotspot_chillispot {
	
	function get_configuration(){
		$CI = &get_instance();
		$file = $CI->config->item('CHILLISPOT_CONFIG_FILE');
		$lines = file($file);
		
		foreach ($lines as $line){
			$comment=substr($line, 0, 1);
			if($comment!='#'){
				$pos = strpos($line,' ');
				$conf = substr($line,0,$pos);
				$value = substr($line,$pos+1);
				//echo $value.'<br>';
				switch ($conf){
					case 'radiusserver1':
						$data['radiusserver1']=$value;
						break;
					case 'radiusserver2':
						$data['radiusserver2']=$value;
						break;
					case 'radiussecret':
						$data['radiussecret']=$value;
						break;
					case 'dhcpif':
						$data['dhcpif']=$value;
						break;
					case 'uamserver':
						$data['uamserver']=$value;
						break;
					case 'uamhomepage':
						$data['uamhomepage']=$value;
						break;
					case 'uamsecret':
						$data['uamsecret']=$value;
						break;
					case 'uamallowed':
						$data['uamallowed']=$value;
						break;
					case 'net':
						$data['net']=$value;
						break;
					case 'coaport':
						$data['coaport']=$value;
						break;
				}
			}
		}
		
		if(isset($data)){
			return $data;
		}
		
	}
	
	function set_configuration($data){
		$CI = &get_instance();
		$file = $CI->config->item('CHILLISPOT_COFIG_FILE');
		$file_temp = '/tmp/chilli.conf';
		$handle_temp = fopen($file_temp,'w');
		$handle = fopen($file,'r');
		
		$lines = file($file);
		
		foreach ($lines as $line){
			$comment=substr($line, 0, 1);
			if($comment!='#'){
				$pos = strpos($line,' ');
				$conf = substr($line,0,$pos);
				$value = substr($line,$pos+1);
				switch ($conf){
					case 'radiusserver1':
						fwrite($handle_temp,"$conf ".$data['radiusserver1']."\n");
						break;
					case 'radiusserver2':
						fwrite($handle_temp,"$conf ".$data['radiusserver2']."\n");
						break;
					case 'radiussecret':
						fwrite($handle_temp,"$conf ".$data['radiussecret']."\n");
						break;
					case 'dhcpif':
						fwrite($handle_temp,"$conf ".$data['dhcpif']."\n");
						break;
					case 'uamserver':
						fwrite($handle_temp,"$conf ".$data['uamserver']."\n");
						break;
					case 'uamhomepage':
						fwrite($handle_temp,"$conf ".$data['uamhomepage']."\n");
						break;
					case 'uamsecret':
						fwrite($handle_temp,"$conf ".$data['uamsecret']."\n");
						break;
					case 'uamallowed':
						fwrite($handle_temp,"$conf ".$data['uamallowed']."\n");
						break;
					case 'net':
						fwrite($handle_temp,"$conf ".$data['net']."\n");
						break;
					case 'coaport':
						fwrite($handle_temp,"$conf ".$data['coaport']."\n");
						break;
					}
			}else{
				fwrite($handle_temp,$line);
			}
		}
		
		//default domain
		fwrite($handle_temp, 'domain key.chillispot.info'."\n");
		
		//let's apply new configuration
		fclose($handle);
		fclose($handle_temp);
		copy($file_temp,$file);
	}
}

?>
