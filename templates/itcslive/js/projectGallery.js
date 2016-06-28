
// Project Gallery@ iTCSLive.
var ProjectGallery=new function()
{	
	 this.parseQuery=function( query ) 
	 {
		   var Params = new Object ();
		   if ( ! query ) return Params; // return empty object
		   var Pairs = query.split(/[;&]/);
		   for ( var i = 0; i < Pairs.length; i++ ) {
			  var KeyVal = Pairs[i].split('=');
			  if ( ! KeyVal || KeyVal.length != 2 ) continue;
			  var key = unescape( KeyVal[0] );
			  var val = unescape( KeyVal[1] );
			  val = val.replace(/\+/g, ' ');
			  Params[key] = val;
		   }
		   return Params;
	}
}
var scripts = document.getElementsByTagName('script');
var myScript = scripts[ scripts.length - 1 ];
var queryString = myScript.src.replace(/^[^\?]+\??/,'');
var params = ProjectGallery.parseQuery( queryString );
var workID=params.workid;
if(!isNaN(workID)){
var BaseURL='http://www.itcslive.in/'; //http://dev.itcslive.com/custom/itcslive/
//var BaseURL='http://dev.itcslive.com/custom/itcslive/';

var pageUrl=BaseURL+'openpopup?workID='+workID;
var closeIcon_path=BaseURL+"images/popup_close.png";

var imageHtml = '<img src="'+closeIcon_path+'">';

if(window.top==window){
	_$streamride=function(){
		var i=pageUrl;                                                 
		var c=928;    var g=500;   var d=200;  var b=null;                                                 
		var a=document.createElement("div"); 
		a.setAttribute("id",'pop-up-frame');  
		a.style.position="fixed";                                                 
		a.style.bottom="50px";                                                 
		a.style.width=c+"px";                                                 
		a.style.height=g+"px";                                                 
		a.style.right="50%";                                                 
		a.style.left="50%";                                                 
		a.style.marginLeft=-(c/2)+"px";                                                 
		a.style.marginRight=-(c/2)+"px";                                                 
		a.style.zIndex="2147483647";  
		a.style.border="0px";    
		a.style.display="none";  
		
		
		var j=document.createElement("iframe");  
		j.setAttribute("id",'pop-up-Iframe'); 
		j.setAttribute("src",i);                                                 
		j.setAttribute("onload","_$streamride.show();"); 
		j.setAttribute("width",c);                                                 
		j.setAttribute("height",g);                                                 
		j.setAttribute("marginwidth","1");                                                   
		j.setAttribute("marginheight","1");                                                   
		j.setAttribute("frameborder","1");                                                   
		j.setAttribute("scrolling","yes");                                                 
		j.setAttribute("allowtransparency","false");                                                                                                  
		j.style.position="absolute";                                                                                                
		j.style.width=c+"px";                                                                                                 
		j.style.height=g+"px";                                                                                                 
		j.style.top="0px";                                                                                                 
		j.style.right="0px";                                                                                                
		j.style.bottom="0px";                                                                                                
		j.style.left="0px";                                                                                                
		j.style.border="0px";                                                                                                 
		j.style.overflow="hidden";  
		

		var h=document.createElement("a");    
		h.setAttribute("id",'anchor-close-pop');
		h.innerHTML=imageHtml;
		h.setAttribute("href","javascript:void(0);");                                                                                                  
		h.setAttribute("title","Close");                                                                                                  
		h.setAttribute("onclick","_$streamride.hide(true); ");                                                 
		//h.style.backgroundImage="url('"+closeIcon_path+"')";                                                 
		h.style.position="absolute";                                                 
		h.style.width="24px";                                                 
		h.style.height="24px";                                                
		h.style.top="24px";                                                
		h.style.right="20px";      
		
		if(a.style.setExpression){
			a.style.position="absolute";                                                 
			a.style.setExpression("top","eval(document.documentElement.scrollTop + document.documentElement.clientHeight - this.offsetHeight)");                                               
			j.attachEvent("onload",f);                                                
			h.attachEvent("onclick",function(){
											 _$streamride.hide(true)
											 })
			}
			a.appendChild(j);                                                 
			a.appendChild(h);                                                 
			document.body.appendChild(a);                                                 
			function e(l){
				if(b){
					clearTimeout(b);                                                 
			b=null
			}
			if(l){
				a.style.display="none"
				}else{
					a.onmouseover=f;                                                
					a.style.height="5px";                                                
					for(var k=0; k<a.children.length; k++){
						a.children[k].style.display="none"
						}
						}
						}
						function f(){
							a.onmouseover=null;                                                 
							for(var k=0; k<a.children.length; k++){
								a.children[k].style.display="block"
								}
								a.style.height=g+"px";                                                 
								a.style.display="block";                                                 
								b=setTimeout(function(){
										  e(false)},d*1000)
								}
								return{hide:e,show:f}
		}()};                                                 
}