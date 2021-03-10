$( function () {
    $(document).ready(function(){
    	$(".button-showoimg").on('click',function(){
    	    //alert($(this).attr("data-src"));
    	    /*直接切换src，但不易看不出变化
    	    let tmpsrc=$("img",$(this).parent()).attr("src");
    	    $("img",$(this).parent()).attr("src",$(this).attr("data-src"));
    	    $(this).attr("data-src",tmpsrc);
    	    if($(this).text()=='显示原图'){
    	        $(this).text('显示中图');
    	    }else{
    	        $(this).text('显示原图');
    	    }
    	    */
    	    let tmpw = $(window).width();
    	    let tmph = $(window).height();
    	    if(tmpw/3*2 > tmph) tmpw=tmph/2*3;//imgage 3:2;
    	    $tmptxt1='<div id="showoimgshade" style="z-index:999998;background-color:rgba(0,0,0,0.8);width:100%;height:100%;top:0;left:0;position:fixed;"></div>';
    	    $tmptxt2='<div id="showoimgdiv" style="z-index:999999;background-color:rgb(233,233,233);width:'+tmpw+'px;height:'+tmpw/3*2+'px;top:50%;left:50%;position:fixed;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);">';
    	    $tmptxt3='<button type="button" id="showoimgclose" style="position:fixed;top:0;right:0;width:4%;box-shadow: 1px 1px 3px black;">x</button>';
    	    $tmptxt4='<img style="width:92%;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);" src="'+$(this).attr("data-src")+'"/></div>';
    	    $("body").append($tmptxt1+$tmptxt2+$tmptxt3+$tmptxt4);
    	    $("#showoimgclose").on("click",function(){
                $("#showoimgshade").remove();
                $("#showoimgdiv").remove();
            });
            $("#showoimgshade").on("click",function(){
                $("#showoimgshade").remove();
                $("#showoimgdiv").remove();
            });
    	});
    });
});