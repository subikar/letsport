var OxO44d8=["inp_class","inp_width","inp_height","sel_align","sel_textalign","sel_float","inp_forecolor","img_forecolor","inp_backcolor","img_backcolor","inp_tooltip","value","className","width","style","height","align","styleFloat","cssFloat","textAlign","title","backgroundColor","color","","class","onclick"];var inp_class=Window_GetElement(window,OxO44d8[0],true);var inp_width=Window_GetElement(window,OxO44d8[1],true);var inp_height=Window_GetElement(window,OxO44d8[2],true);var sel_align=Window_GetElement(window,OxO44d8[3],true);var sel_textalign=Window_GetElement(window,OxO44d8[4],true);var sel_float=Window_GetElement(window,OxO44d8[5],true);var inp_forecolor=Window_GetElement(window,OxO44d8[6],true);var img_forecolor=Window_GetElement(window,OxO44d8[7],true);var inp_backcolor=Window_GetElement(window,OxO44d8[8],true);var img_backcolor=Window_GetElement(window,OxO44d8[9],true);var inp_tooltip=Window_GetElement(window,OxO44d8[10],true);UpdateState=function UpdateState_Common(){} ;SyncToView=function SyncToView_Common(){inp_class[OxO44d8[11]]=element[OxO44d8[12]];inp_width[OxO44d8[11]]=element[OxO44d8[14]][OxO44d8[13]];inp_height[OxO44d8[11]]=element[OxO44d8[14]][OxO44d8[15]];sel_align[OxO44d8[11]]=element[OxO44d8[16]];if(Browser_IsWinIE()){sel_float[OxO44d8[11]]=element[OxO44d8[14]][OxO44d8[17]];} else {sel_float[OxO44d8[11]]=element[OxO44d8[14]][OxO44d8[18]];} ;sel_textalign[OxO44d8[11]]=element[OxO44d8[14]][OxO44d8[19]];inp_tooltip[OxO44d8[11]]=element[OxO44d8[20]];inp_forecolor[OxO44d8[11]]=revertColor(element[OxO44d8[14]].color);inp_forecolor[OxO44d8[14]][OxO44d8[21]]=inp_forecolor[OxO44d8[11]];img_forecolor[OxO44d8[14]][OxO44d8[21]]=inp_forecolor[OxO44d8[11]];inp_backcolor[OxO44d8[11]]=revertColor(element[OxO44d8[14]].backgroundColor);inp_backcolor[OxO44d8[14]][OxO44d8[21]]=inp_backcolor[OxO44d8[11]];img_backcolor[OxO44d8[14]][OxO44d8[21]]=inp_backcolor[OxO44d8[11]];} ;SyncTo=function SyncTo_Common(element){element[OxO44d8[12]]=inp_class[OxO44d8[11]];try{element[OxO44d8[14]][OxO44d8[13]]=inp_width[OxO44d8[11]];element[OxO44d8[14]][OxO44d8[15]]=inp_height[OxO44d8[11]];} catch(x){} ;element[OxO44d8[16]]=sel_align[OxO44d8[11]];if(Browser_IsWinIE()){element[OxO44d8[14]][OxO44d8[17]]=sel_float[OxO44d8[11]];} else {element[OxO44d8[14]][OxO44d8[18]]=sel_float[OxO44d8[11]];} ;element[OxO44d8[14]][OxO44d8[19]]=sel_textalign[OxO44d8[11]];element[OxO44d8[20]]=inp_tooltip[OxO44d8[11]];element[OxO44d8[14]][OxO44d8[22]]=inp_forecolor[OxO44d8[11]];element[OxO44d8[14]][OxO44d8[21]]=inp_backcolor[OxO44d8[11]];if(element[OxO44d8[12]]==OxO44d8[23]){element.removeAttribute(OxO44d8[12]);} ;if(element[OxO44d8[12]]==OxO44d8[23]){element.removeAttribute(OxO44d8[24]);} ;if(element[OxO44d8[20]]==OxO44d8[23]){element.removeAttribute(OxO44d8[20]);} ;if(element[OxO44d8[16]]==OxO44d8[23]){element.removeAttribute(OxO44d8[16]);} ;} ;img_forecolor[OxO44d8[25]]=inp_forecolor[OxO44d8[25]]=function inp_forecolor_onclick(){SelectColor(inp_forecolor,img_forecolor);} ;img_backcolor[OxO44d8[25]]=inp_backcolor[OxO44d8[25]]=function inp_backcolor_onclick(){SelectColor(inp_backcolor,img_backcolor);} ;