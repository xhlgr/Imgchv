<?php
/**
 * ImgchvHooks
 */

class ImgchvHooks {
	/**
	 * @param Parser $parser
	 * @return bool
	 */
	public static function onParserFirstCallInit( $parser ) {
		$parser->setHook('imgchv','ImgchvHooks::renderImgchv');
		return true;
	}
	
	public static function onBeforePageDisplay($out, $skin) {
        $out->addModules( 'ext.imgchv' );
        return true;
    }
	
	public static function renderImgchv( $input, array $args, Parser $parser, PPFrame $frame ) {
	    global $wgImgchvDomainName,$wgImgchvDsrc;
	    //$parser->getOutput()->addModules( 'ext.imgchv' );
        $inputwidth = $parser->replaceVariables(isset($args['width']) ? htmlspecialchars($args['width']):'100%');
        $inputheight = $parser->replaceVariables(isset($args['height']) ? htmlspecialchars($args['height']):'auto');
        $inputurl  = $parser->replaceVariables(isset($args['src']) ? htmlspecialchars($args['src']):'', $frame );
        if(substr($inputurl,0,8)!='https://'){//no url
            if(!empty($wgImgchvDsrc)){
                $outhtml =  '<img style="width:'.$inputwidth.';height:'.$inputheight.';" src="'.$wgImgchvDsrc.'" />';
            }else{
                $outhtml =  '<div style="position:relative;width:'.$inputwidth.';height:'.$inputheight.';">'.wfMessage("imgchv-div-nodefaultimg")->text().'</div>';
            }
        }else{
            $tmpurl = preg_replace('/^(http|https):\/\//', '',$inputurl);
    		$tmpdomain = substr($tmpurl,0,strpos($tmpurl,'/'));
    		if(!in_array($tmpdomain,$wgImgchvDomainName)){//first not in array then get the primary domain
    		    $tmpdomainarr = explode('.',$tmpdomain);
    		    $tmax = count($tmpdomainarr);
    		    if($tmax>1){
    		        $tmpdomain = $tmpdomainarr[$tmax-2].'.'.$tmpdomainarr[$tmax-1];
    		    }
    		}
    		if(in_array($tmpdomain,$wgImgchvDomainName) && strpos($tmpurl,'.md.')===false && strpos($tmpurl,'.png')===false){//url in array and no .png
        		$tmp1 = substr($tmpurl,0,strrpos($tmpurl,'.'));
        		$tmp2 = substr($tmpurl,strrpos($tmpurl,'.'));
        		$mdurl = 'https://'.$tmp1.'.md'.$tmp2;
        		/*curl the md link to sure it exist
        	    $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$mdurl);
                curl_setopt($ch,CURLOPT_HEADER,1);
                curl_setopt($ch,CURLOPT_NOBODY,1);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_TIMEOUT,10);
                curl_exec($ch);
                $httpcode = curl_getinfo($ch,CURLINFO_HTTP_CODE); 
                curl_close($ch);
                if($httpcode == 200){
        		    $outhtml =  '<div class="mdimgdiv" style="position:relative;width:'.$inputwidth.';height:'.$inputheight.';"><img width=100% src="'.$mdurl.'"/><button class="showoimg mw-ui-button mw-ui-progressive" data-src="'.$inputurl.'" style="position:absolute;top:0;right:0;box-shadow: 1px 1px 3px black;" type="button">'.wfMessage("imgchv-button-showoimg")->text().'</button></div>';
                }else{
                    $outhtml = '<img style="width:'.$inputwidth.';height:'.$inputheight.';" src="'.$inputurl.'" />';
                }//curl end*/
                //no curl, js onerror
                $outhtml =  '<div class="mdimgdiv" style="position:relative;width:'.$inputwidth.';height:'.$inputheight.';"><img width=100% src="'.$mdurl.'"/><button class="showoimg mw-ui-button mw-ui-progressive" data-src="'.$inputurl.'" style="position:absolute;top:0;right:0;box-shadow: 1px 1px 3px black;" type="button">'.wfMessage("imgchv-button-showoimg")->text().'</button></div>';
    		}else{//url not in array
    		    $outhtml = '<img style="width:'.$inputwidth.';height:'.$inputheight.';" src="'.$inputurl.'" />';
    		}
        }
        return $outhtml;
    }
}