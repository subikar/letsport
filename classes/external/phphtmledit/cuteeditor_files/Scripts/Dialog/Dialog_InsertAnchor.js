var OxO717d=["nodeName","INPUT","TEXTAREA","BUTTON","IMG","SELECT","TABLE","position","style","absolute","relative","|H1|H2|H3|H4|H5|H6|P|PRE|LI|TD|DIV|BLOCKQUOTE|DT|DD|TABLE|HR|IMG|","|","body","document","allanchors","anchor_name","editor","window","name","value","options","length","anchors","OPTION","text","#","images","className","cetempAnchor","anchorname","","--\x3E"," ","trim","prototype"];function Element_IsBlockControl(element){var name=element[OxO717d[0]];if(name==OxO717d[1]){return true;} ;if(name==OxO717d[2]){return true;} ;if(name==OxO717d[3]){return true;} ;if(name==OxO717d[4]){return true;} ;if(name==OxO717d[5]){return true;} ;if(name==OxO717d[6]){return true;} ;var Ox34=element[OxO717d[8]][OxO717d[7]];if(Ox34==OxO717d[9]||Ox34==OxO717d[10]){return true;} ;return false;} ;function Element_CUtil_IsBlock(Ox26f){var Ox270=OxO717d[11];return (Ox26f!=null)&&(Ox270.indexOf(OxO717d[12]+Ox26f[OxO717d[0]]+OxO717d[12])!=-1);} ;function Window_SelectElement(Ox90,element){if(Browser_UseIESelection()){if(Element_IsBlockControl(element)){var Ox1f=Ox90[OxO717d[14]][OxO717d[13]].createControlRange();Ox1f.add(element);Ox1f.select();} else {var Ox114=Ox90[OxO717d[14]][OxO717d[13]].createTextRange();Ox114.moveToElementText(element);Ox114.select();} ;} else {var Ox114=Ox90[OxO717d[14]].createRange();try{Ox114.selectNode(element);} catch(x){Ox114.selectNodeContents(element);} ;var Ox20=Ox90.getSelection();Ox20.removeAllRanges();Ox20.addRange(Ox114);} ;} ;var allanchors=Window_GetElement(window,OxO717d[15],true);var anchor_name=Window_GetElement(window,OxO717d[16],true);var obj=Window_GetDialogArguments(window);var editor=obj[OxO717d[17]];var editwin=obj[OxO717d[18]];var editdoc=obj[OxO717d[14]];var name=obj[OxO717d[19]];function insert_link(){var Ox275=anchor_name[OxO717d[20]];var Ox276=/[^a-z\d]/i;Ox275=Ox275.trim();if(Ox276.test(Ox275)){alert(ValidName);} else {Window_SetDialogReturnValue(window,Ox275);Window_CloseDialog(window);} ;} ;function updateList(){while(allanchors[OxO717d[21]][OxO717d[22]]!=0){allanchors[OxO717d[21]].remove(allanchors.options(0));} ;if(Browser_IsWinIE()){for(var i=0;i<editdoc[OxO717d[23]][OxO717d[22]];i++){var Ox278=document.createElement(OxO717d[24]);Ox278[OxO717d[25]]=OxO717d[26]+editdoc[OxO717d[23]][i][OxO717d[19]];Ox278[OxO717d[20]]=editdoc[OxO717d[23]][i][OxO717d[19]];allanchors[OxO717d[21]].add(Ox278);} ;} else {var Ox279=editdoc[OxO717d[27]];if(Ox279){for(var Ox5a=0;Ox5a<Ox279[OxO717d[22]];Ox5a++){var img=Ox279[Ox5a];if(img[OxO717d[28]]==OxO717d[29]){var Ox278=document.createElement(OxO717d[24]);Ox278[OxO717d[25]]=OxO717d[26]+img.getAttribute(OxO717d[30]);Ox278[OxO717d[20]]=img.getAttribute(OxO717d[30]);allanchors[OxO717d[21]].add(Ox278);} ;} ;} ;} ;} ;function selectAnchor(Ox27b){editor.FocusDocument();for(var i=0;i<editdoc[OxO717d[23]][OxO717d[22]];i++){if(editdoc[OxO717d[23]][i][OxO717d[19]]==Ox27b){anchor_name[OxO717d[20]]=Ox27b;Window_SelectElement(editwin,editdoc[OxO717d[23]][i]);} ;} ;} ;if(name&&name!=OxO717d[31]){name=name.replace(/[\s]*<!--[\s\S]*?-->[\s]*/g,OxO717d[31]);name=name.replace(OxO717d[32],OxO717d[33]);anchor_name[OxO717d[20]]=name;} ;updateList();String[OxO717d[35]][OxO717d[34]]=function (){return this.replace(/^\s*/,OxO717d[31]).replace(/\s*$/,OxO717d[31]);} ;