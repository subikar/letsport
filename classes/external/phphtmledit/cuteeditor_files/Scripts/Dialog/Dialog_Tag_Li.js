var OxO931b=["inp_src","box1","box2","box3","box4","box5","box6","box7","box8","box9","inp_start","CustomBullet","nodeName","LI","parentNode","none","decimal","upper-roman","upper-alpha","lower-alpha","lower-roman","disc","circle","square","listStyleType","style","border","solid 2px #708090","listStyleImage","","value","visibility","hidden","length","start","url(\x27","\x27)","visible","UL","OL","document","firstChild","element","solid 2px #ffffff","solid 2px #ECECF6","onclick"];var inp_src=Window_GetElement(window,OxO931b[0],true);var box1=Window_GetElement(window,OxO931b[1],true);var box2=Window_GetElement(window,OxO931b[2],true);var box3=Window_GetElement(window,OxO931b[3],true);var box4=Window_GetElement(window,OxO931b[4],true);var box5=Window_GetElement(window,OxO931b[5],true);var box6=Window_GetElement(window,OxO931b[6],true);var box7=Window_GetElement(window,OxO931b[7],true);var box8=Window_GetElement(window,OxO931b[8],true);var box9=Window_GetElement(window,OxO931b[9],true);var inp_start=Window_GetElement(window,OxO931b[10],true);var CustomBullet=Window_GetElement(window,OxO931b[11],true);OriginalnodeName=element[OxO931b[12]];if(element[OxO931b[12]]&&element[OxO931b[12]]==OxO931b[13]){OriginalnodeName=(element[OxO931b[14]])[OxO931b[12]];} ;var OriginalnodeName,CurrentnodeName,selectedObject;SyncToView=function SyncToView_LI(){if(element[OxO931b[12]]==OxO931b[13]){element=element[OxO931b[14]];} ;switch((element[OxO931b[25]][OxO931b[24]]).toLowerCase()){case OxO931b[15]:selectedObject=box1;break ;;case OxO931b[16]:selectedObject=box2;break ;;case OxO931b[17]:selectedObject=box3;break ;;case OxO931b[18]:selectedObject=box4;break ;;case OxO931b[19]:selectedObject=box5;break ;;case OxO931b[20]:selectedObject=box6;break ;;case OxO931b[21]:selectedObject=box7;break ;;case OxO931b[22]:selectedObject=box8;break ;;case OxO931b[23]:selectedObject=box9;break ;;default:selectedObject=box1;break ;;} ;selectedObject[OxO931b[25]][OxO931b[26]]=OxO931b[27];if(element[OxO931b[25]][OxO931b[28]]==OxO931b[29]){inp_src[OxO931b[30]]=OxO931b[29];CustomBullet[OxO931b[25]][OxO931b[31]]=OxO931b[32];} else {var Ox49;Ox49=element[OxO931b[25]][OxO931b[28]];Ox49=Ox49.substring(4,Ox49[OxO931b[33]]-1);inp_src[OxO931b[30]]=Ox49;} ;} ;SyncTo=function SyncTo_LI(element){switch(selectedObject){case box1:;case box2:;case box3:;case box4:;case box5:;case box6:try{element.setAttribute(OxO931b[34],inp_start.value);} catch(er){} ;break ;;case box7:;case box8:;case box9:break ;;} ;if(inp_src[OxO931b[30]]){element[OxO931b[25]][OxO931b[28]]=OxO931b[35]+inp_src[OxO931b[30]]+OxO931b[36];} ;} ;function ToggleCustomBullet(){if(CustomBullet[OxO931b[25]][OxO931b[31]]==OxO931b[32]){CustomBullet[OxO931b[25]][OxO931b[31]]=OxO931b[37];} else {CustomBullet[OxO931b[25]][OxO931b[31]]=OxO931b[32];} ;} ;function doClick1(Ox26f){if(element[OxO931b[12]]==OxO931b[13]){element=element[OxO931b[14]];} ;selectedObject=Ox26f;switch(selectedObject){case box1:element[OxO931b[25]][OxO931b[24]]=OxO931b[15];break ;;case box2:element[OxO931b[25]][OxO931b[24]]=OxO931b[16];break ;;case box3:element[OxO931b[25]][OxO931b[24]]=OxO931b[17];break ;;case box4:element[OxO931b[25]][OxO931b[24]]=OxO931b[18];break ;;case box5:element[OxO931b[25]][OxO931b[24]]=OxO931b[19];break ;;case box6:element[OxO931b[25]][OxO931b[24]]=OxO931b[20];break ;;case box7:element[OxO931b[25]][OxO931b[24]]=OxO931b[21];break ;;case box8:element[OxO931b[25]][OxO931b[24]]=OxO931b[22];break ;;case box9:element[OxO931b[25]][OxO931b[24]]=OxO931b[23];break ;;} ;var Ox2fd=false;switch(selectedObject){case box1:;case box2:;case box3:;case box4:;case box5:;case box6:if(OriginalnodeName==OxO931b[38]){OriginalnodeName=OxO931b[39];Ox2fd=true;} ;break ;;case box7:;case box8:;case box9:if(OriginalnodeName==OxO931b[39]){OriginalnodeName=OxO931b[38];Ox2fd=true;} ;break ;;} ;if(Ox2fd){var Ox465=editwin[OxO931b[40]].createElement(OriginalnodeName);while(element[OxO931b[41]]){Ox465.appendChild(element.firstChild);} ;element[OxO931b[14]].insertBefore(Ox465,element);element[OxO931b[14]].removeChild(element);var arg=Window_FindDialogArguments(window);arg[OxO931b[42]]=element=Ox465;} ;box1[OxO931b[25]][OxO931b[26]]=OxO931b[43];box2[OxO931b[25]][OxO931b[26]]=OxO931b[43];box3[OxO931b[25]][OxO931b[26]]=OxO931b[43];box4[OxO931b[25]][OxO931b[26]]=OxO931b[43];box5[OxO931b[25]][OxO931b[26]]=OxO931b[43];box6[OxO931b[25]][OxO931b[26]]=OxO931b[43];box7[OxO931b[25]][OxO931b[26]]=OxO931b[43];box8[OxO931b[25]][OxO931b[26]]=OxO931b[43];box9[OxO931b[25]][OxO931b[26]]=OxO931b[43];selectedObject[OxO931b[25]][OxO931b[26]]=OxO931b[27];inp_src[OxO931b[30]]=OxO931b[29];SyncTo();} ;function doMouseOut(Ox26f){if(Ox26f==selectedObject){Ox26f[OxO931b[25]][OxO931b[26]]=OxO931b[27];} else {Ox26f[OxO931b[25]][OxO931b[26]]=OxO931b[43];} ;} ;function doMouseOver(Ox26f){Ox26f[OxO931b[25]][OxO931b[26]]=OxO931b[44];} ;btnbrowse[OxO931b[45]]=function btnbrowse_onclick(){function Ox25b(Ox27){if(Ox27){inp_src[OxO931b[30]]=Ox27;SyncTo(element);} ;} ;editor.SetNextDialogWindow(window);if(Browser_IsSafari()){editor.ShowSelectImageDialog(Ox25b,inp_src.value,inp_src);} else {editor.ShowSelectImageDialog(Ox25b,inp_src.value);} ;} ;