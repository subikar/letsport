var OxOd453=["SetStyle","length","","GetStyle","GetText",":",";","cssText","inp_color","inp_color_Preview","tb_image","btnbrowse","sel_bgrepeat","sel_bgattach","sel_hor","tb_hor","sel_hor_unit","sel_ver","tb_ver","sel_ver_unit","outer","div_demo","onclick","value","disabled","selectedIndex","style","backgroundImage","backgroundColor","backgroundRepeat","backgroundAttachment","backgroundPositionX","options","backgroundPositionY","url(",")","background-image","backgroundPosition","none"];function pause(Ox37b){var Ox2f9= new Date();var Ox37c=Ox2f9.getTime()+Ox37b;while(true){Ox2f9= new Date();if(Ox2f9.getTime()>Ox37c){return ;} ;} ;} ;function StyleClass(Oxed){var Ox37e=[];var Ox37f={};if(Oxed){Ox384();} ;this[OxOd453[0]]=function SetStyle(name,Ox7,Ox381){name=name.toLowerCase();for(var i=0;i<Ox37e[OxOd453[1]];i++){if(Ox37e[i]==name){break ;} ;} ;Ox37e[i]=name;Ox37f[name]=Ox7?(Ox7+(Ox381||OxOd453[2])):OxOd453[2];} ;this[OxOd453[3]]=function GetStyle(name){name=name.toLowerCase();return Ox37f[name]||OxOd453[2];} ;this[OxOd453[4]]=function Ox383(){var Oxed=OxOd453[2];for(var i=0;i<Ox37e[OxOd453[1]];i++){var Ox8d=Ox37e[i];var p=Ox37f[Ox8d];if(p){Oxed+=Ox8d+OxOd453[5]+p+OxOd453[6];} ;} ;return Oxed;} ;function Ox384(){var arr=Oxed.split(OxOd453[6]);for(var i=0;i<arr[OxOd453[1]];i++){var p=arr[i].split(OxOd453[5]);var Ox8d=p[0].replace(/^\s+/g,OxOd453[2]).replace(/\s+$/g,OxOd453[2]).toLowerCase();Ox37e[Ox37e[OxOd453[1]]]=Ox8d;Ox37f[Ox8d]=p[1];} ;} ;} ;function GetStyle(Ox21,name){return  new StyleClass(Ox21.cssText).GetStyle(name);} ;function SetStyle(Ox21,name,Ox7,Ox385){var Ox386= new StyleClass(Ox21.cssText);Ox386.SetStyle(name,Ox7,Ox385);Ox21[OxOd453[7]]=Ox386.GetText();} ;function ParseFloatToString(Ox1b){var Ox84=parseFloat(Ox1b);if(isNaN(Ox84)){return OxOd453[2];} ;return Ox84+OxOd453[2];} ;var inp_color=Window_GetElement(window,OxOd453[8],true);var inp_color_Preview=Window_GetElement(window,OxOd453[9],true);var tb_image=Window_GetElement(window,OxOd453[10],true);var btnbrowse=Window_GetElement(window,OxOd453[11],true);var sel_bgrepeat=Window_GetElement(window,OxOd453[12],true);var sel_bgattach=Window_GetElement(window,OxOd453[13],true);var sel_hor=Window_GetElement(window,OxOd453[14],true);var tb_hor=Window_GetElement(window,OxOd453[15],true);var sel_hor_unit=Window_GetElement(window,OxOd453[16],true);var sel_ver=Window_GetElement(window,OxOd453[17],true);var tb_ver=Window_GetElement(window,OxOd453[18],true);var sel_ver_unit=Window_GetElement(window,OxOd453[19],true);var outer=Window_GetElement(window,OxOd453[20],true);var div_demo=Window_GetElement(window,OxOd453[21],true);btnbrowse[OxOd453[22]]=function btnbrowse_onclick(){function Ox25b(Ox27){if(Ox27){tb_image[OxOd453[23]]=Ox27;} ;} ;editor.SetNextDialogWindow(window);if(Browser_IsSafari()){editor.ShowSelectImageDialog(Ox25b,tb_image.value,tb_image);} else {editor.ShowSelectImageDialog(Ox25b,tb_image.value);} ;} ;UpdateState=function UpdateState_Background(){tb_hor[OxOd453[24]]=sel_hor_unit[OxOd453[24]]=(sel_hor[OxOd453[25]]>0);tb_ver[OxOd453[24]]=sel_ver_unit[OxOd453[24]]=(sel_ver[OxOd453[25]]>0);div_demo[OxOd453[26]][OxOd453[7]]=element[OxOd453[26]][OxOd453[7]];} ;SyncToView=function SyncToView_Background(){tb_image[OxOd453[23]]=element[OxOd453[26]][OxOd453[27]];FixTbImage();inp_color[OxOd453[23]]=element[OxOd453[26]][OxOd453[28]];inp_color[OxOd453[26]][OxOd453[28]]=element[OxOd453[26]][OxOd453[28]];inp_color_Preview[OxOd453[26]][OxOd453[28]]=element[OxOd453[26]][OxOd453[28]];sel_bgrepeat[OxOd453[23]]=element[OxOd453[26]][OxOd453[29]];sel_bgattach[OxOd453[23]]=element[OxOd453[26]][OxOd453[30]];sel_hor[OxOd453[23]]=element[OxOd453[26]][OxOd453[31]];sel_hor_unit[OxOd453[25]]=0;if(sel_hor[OxOd453[25]]==-1){if(ParseFloatToString(element[OxOd453[26]].backgroundPositionX)){tb_hor[OxOd453[23]]=ParseFloatToString(element[OxOd453[26]].backgroundPositionX);for(var i=0;i<sel_hor_unit[OxOd453[32]][OxOd453[1]];i++){var Ox2b=sel_hor_unit[OxOd453[32]][i][OxOd453[23]];if(Ox2b&&element[OxOd453[26]][OxOd453[31]].indexOf(Ox2b)!=-1){sel_hor_unit[OxOd453[25]]=i;break ;} ;} ;} ;} ;sel_ver[OxOd453[23]]=element[OxOd453[26]][OxOd453[33]];sel_ver_unit[OxOd453[25]]=0;if(sel_ver[OxOd453[25]]==-1){if(ParseFloatToString(element[OxOd453[26]].backgroundPositionY)){tb_ver[OxOd453[23]]=ParseFloatToString(element[OxOd453[26]].backgroundPositionY);for(var i=0;i<sel_ver_unit[OxOd453[32]][OxOd453[1]];i++){var Ox2b=sel_ver_unit[OxOd453[32]][i][OxOd453[23]];if(Ox2b&&element[OxOd453[26]][OxOd453[33]].indexOf(Ox2b)!=-1){sel_ver_unit[OxOd453[25]]=i;break ;} ;} ;} ;} ;} ;SyncTo=function SyncTo_Background(element){if(tb_image[OxOd453[23]]){element[OxOd453[26]][OxOd453[27]]=OxOd453[34]+tb_image[OxOd453[23]]+OxOd453[35];} else {SetStyle(element.style,OxOd453[36],OxOd453[2]);} ;try{element[OxOd453[26]][OxOd453[28]]=inp_color[OxOd453[23]]||OxOd453[2];} catch(x){element[OxOd453[26]][OxOd453[28]]=OxOd453[2];} ;element[OxOd453[26]][OxOd453[29]]=sel_bgrepeat[OxOd453[23]]||OxOd453[2];element[OxOd453[26]][OxOd453[30]]=sel_bgattach[OxOd453[23]]||OxOd453[2];element[OxOd453[26]][OxOd453[37]]=OxOd453[2];if(sel_hor[OxOd453[25]]>0){element[OxOd453[26]][OxOd453[31]]=sel_hor[OxOd453[23]];} else {if(ParseFloatToString(tb_hor.value)){element[OxOd453[26]][OxOd453[31]]=ParseFloatToString(tb_hor.value)+sel_hor_unit[OxOd453[23]];} else {element[OxOd453[26]][OxOd453[31]]=OxOd453[2];} ;} ;if(sel_ver[OxOd453[25]]>0){element[OxOd453[26]][OxOd453[33]]=sel_ver[OxOd453[23]];} else {if(ParseFloatToString(tb_ver.value)){element[OxOd453[26]][OxOd453[33]]=ParseFloatToString(tb_ver.value)+sel_ver_unit[OxOd453[23]];} else {element[OxOd453[26]][OxOd453[33]]=OxOd453[2];} ;} ;} ;function FixTbImage(){var Ox2b=tb_image[OxOd453[23]].replace(/^(\s+)/g,OxOd453[2]).replace(/(\s+)$/g,OxOd453[2]);if(Ox2b.substr(0,4).toLowerCase()==OxOd453[34]){Ox2b=Ox2b.substr(4,Ox2b[OxOd453[1]]-4);} ;if(Ox2b.substr(Ox2b[OxOd453[1]]-1,1)==OxOd453[35]){Ox2b=Ox2b.substr(0,Ox2b[OxOd453[1]]-1);} ;if(Ox2b==OxOd453[38]){Ox2b=OxOd453[2];} ;tb_image[OxOd453[23]]=Ox2b;} ;inp_color[OxOd453[22]]=inp_color_Preview[OxOd453[22]]=function inp_color_onclick(){SelectColor(inp_color,inp_color_Preview);} ;