var OxO170e=["browse_Img_gallery","TargetUrl","uploader1","src","upload.php?","\x26FP=","\x26Type=Image","value","lightyellow","0px","-3px","all","getElementById","\x3Cdiv id=\x22tooltipdiv\x22 style=\x22visibility:hidden;background-color:","\x22 \x3E\x3C/div\x3E","tooltipdiv","left","offsetLeft","offsetTop","offsetParent","style","top","visibility","compatMode","BackCompat","documentElement","body","rightedge","opera","scrollLeft","clientWidth","pageXOffset","innerWidth","contentmeasure","offsetWidth","x","scrollTop","clientHeight","pageYOffset","innerHeight","offsetHeight","y","innerHTML","visible","hidden","px","bottomedge","undefined","hidetip()","element","editor","editdoc","^[a-z]*:[/][/][^/]*","","width","height","IMG","border","alt","product","Gecko","src_cetemp","Edit"];var browse_Img_gallery=Window_GetElement(window,OxO170e[0],true);var TargetUrl=Window_GetElement(window,OxO170e[1],true);function SetUpload_imagePath(Ox2a7){if(document.getElementById(OxO170e[2])){document.getElementById(OxO170e[2])[OxO170e[3]]=OxO170e[4]+setting+OxO170e[5]+Ox2a7+OxO170e[6];} ;} ;function row_click(Ox2a7){TargetUrl[OxO170e[7]]=Ox2a7;} ;function cancel(){Window_CloseDialog(window);} ;var tipbgcolor=OxO170e[8];var disappeardelay=250;var vertical_offset=OxO170e[9];var horizontal_offset=OxO170e[10];var delayhidetimerid;var ie4=document[OxO170e[11]];var ns6=document[OxO170e[12]]&&!document[OxO170e[11]];if(ie4||ns6){document.write(OxO170e[13]+tipbgcolor+OxO170e[14]);var dropmenuobj=Window_GetElement(window,OxO170e[15],true);} ;function getposOffset(Ox2d4,Ox2d5){var Ox2d6=(Ox2d5==OxO170e[16])?Ox2d4[OxO170e[17]]:Ox2d4[OxO170e[18]];var Ox2d7=Ox2d4[OxO170e[19]];while(Ox2d7!=null){Ox2d6+=(Ox2d5==OxO170e[16])?Ox2d7[OxO170e[17]]:Ox2d7[OxO170e[18]];Ox2d7=Ox2d7[OxO170e[19]];} ;return Ox2d6;} ;function showhide(obj,Ox2d9,Ox2da){if(ie4||ns6){dropmenuobj[OxO170e[20]][OxO170e[16]]=dropmenuobj[OxO170e[20]][OxO170e[21]]=-500;} ;obj[OxO170e[22]]=Ox2d9;} ;function iecompattest(){return (document[OxO170e[23]]&&document[OxO170e[23]]!=OxO170e[24])?document[OxO170e[25]]:document[OxO170e[26]];} ;function clearbrowseredge(obj,Ox2dd){var Ox2de=(Ox2dd==OxO170e[27])?parseInt(horizontal_offset)*-1:parseInt(vertical_offset)*-1;if(Ox2dd==OxO170e[27]){var Ox2df=ie4&&!window[OxO170e[28]]?iecompattest()[OxO170e[29]]+iecompattest()[OxO170e[30]]-15:window[OxO170e[31]]+window[OxO170e[32]]-15;dropmenuobj[OxO170e[33]]=dropmenuobj[OxO170e[34]];if(Ox2df-dropmenuobj[OxO170e[35]]<dropmenuobj[OxO170e[33]]){Ox2de=dropmenuobj[OxO170e[33]]-obj[OxO170e[34]];} ;} else {var Ox2df=ie4&&!window[OxO170e[28]]?iecompattest()[OxO170e[36]]+iecompattest()[OxO170e[37]]-15:window[OxO170e[38]]+window[OxO170e[39]]-18;dropmenuobj[OxO170e[33]]=dropmenuobj[OxO170e[40]];if(Ox2df-dropmenuobj[OxO170e[41]]<dropmenuobj[OxO170e[33]]){Ox2de=dropmenuobj[OxO170e[33]]+obj[OxO170e[40]];} ;} ;return Ox2de;} ;function showTooltip(Ox2e1,obj){Event_CancelEvent();clearhidetip();dropmenuobj[OxO170e[42]]=Ox2e1;if(ie4||ns6){showhide(dropmenuobj.style,OxO170e[43],OxO170e[44]);dropmenuobj[OxO170e[35]]=getposOffset(obj,OxO170e[16]);dropmenuobj[OxO170e[41]]=getposOffset(obj,OxO170e[21]);dropmenuobj[OxO170e[20]][OxO170e[16]]=dropmenuobj[OxO170e[35]]-clearbrowseredge(obj,OxO170e[27])+OxO170e[45];dropmenuobj[OxO170e[20]][OxO170e[21]]=dropmenuobj[OxO170e[41]]-clearbrowseredge(obj,OxO170e[46])+obj[OxO170e[40]]*1.1+2+OxO170e[45];} ;} ;function hidetip(){if( typeof dropmenuobj!=OxO170e[47]){if(ie4||ns6){dropmenuobj[OxO170e[20]][OxO170e[22]]=OxO170e[44];} ;} ;} ;function delayhidetip(){if(ie4||ns6){delayhidetimerid=setTimeout(OxO170e[48],disappeardelay);} ;} ;function clearhidetip(){clearTimeout(delayhidetimerid);} ;function cancel(){Window_CloseDialog(window);} ;var obj=Window_GetDialogArguments(window);var element=obj[OxO170e[49]];var editor=obj[OxO170e[50]];var editdoc=obj[OxO170e[51]];function insert(src){if(src){var Ox180=src.replace( new RegExp(OxO170e[52],OxO170e[53]),OxO170e[53]);function Actualsize(){var Ox2e4= new Image();Ox2e4[OxO170e[3]]=Ox180;if(Ox2e4[OxO170e[54]]>0&&Ox2e4[OxO170e[55]]>0){element[OxO170e[54]]=Ox2e4[OxO170e[54]];element[OxO170e[55]]=Ox2e4[OxO170e[55]];} else {setTimeout(Actualsize,400);} ;} ;if(element){element[OxO170e[3]]=Ox180;} else {element=editdoc.createElement(OxO170e[56]);element[OxO170e[3]]=Ox180;element[OxO170e[57]]=0;element[OxO170e[58]]=OxO170e[53];Actualsize();} ;if(navigator[OxO170e[59]]==OxO170e[60]){try{element.setAttribute(OxO170e[61],Ox180);} catch(e){} ;} else {if(editor.GetActiveTab()==OxO170e[62]){element.setAttribute(OxO170e[61],Ox180);} ;} ;editor.InsertElement(element);Window_CloseDialog(window);} ;} ;