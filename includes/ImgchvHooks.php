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
	
	public static function renderImgchv( $input, array $args, Parser $parser, PPFrame $frame ) {
	    global $wgImgchvDomainName;
	    $parser->getOutput()->addModules( 'ext.imgchv' );
        $args['width'] = isset($args['width']) ? htmlspecialchars($args['width']):'100%';
        $args['height'] = isset($args['height']) ? htmlspecialchars($args['height']):'auto';
        $inputurl  = $parser->replaceVariables(isset($args['src']) ? htmlspecialchars($args['src']):'', $frame );
        if(substr($inputurl,0,8)!='https://'){//no url
            $outhtml =  '<div style="position:relative;width:'.$args['width'].';height:'.$args['height'].';"><p>没有图片</p></div>';
        }else{
            $tmpurl = preg_replace('/^(http|https):\/\//', '',$inputurl);
    		$tmpdomain = substr($tmpurl,0,strpos($tmpurl,'/'));
    		if(in_array($tmpdomain,$wgImgchvDomainName) && strpos($tmpurl,'.md.')===false){//url in array
        		$tmp1 = substr($tmpurl,0,strrpos($tmpurl,'.'));
        		$tmp2 = substr($tmpurl,strrpos($tmpurl,'.'));
        		$mdurl = 'https://'.$tmp1.'.md'.$tmp2;
        		$outhtml =  '<div style="position:relative;width:'.$args['width'].';height:'.$args['height'].';"><img width=100% src="'.$mdurl.'" /><button class="button-showoimg" data-src="'.$inputurl.'" style="position:absolute;top:0;right:0;background-color:white;border-color:blue;color:black;box-shadow: 1px 1px 3px black;" type="button">'.wfMessage("imgchv-button-showoimg")->text().'</button></div>';
    		}else{//url not in array
    		    $outhtml = '<div style="position:relative;width:'.$args['width'].';height:'.$args['height'].';"><img width=100% src="'.$inputurl.'" /></div>';
    		}
        }
        return $outhtml;
    }
}
