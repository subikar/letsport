var OxO17dd=["stringSearch","stringReplace","MatchWholeWord","MatchCase","document","checked","length","value","Nothing to search.","selection","body","type","Control","rangeCount","userAgent","innerText","text","Finished Searching the document. Would you like to start again from the top?","","textedit"," : ","Please use replace function."];var editwin=Window_GetDialogArguments(window);var stringSearch=Window_GetElement(window,OxO17dd[0],true);var stringReplace=Window_GetElement(window,OxO17dd[1],true);var MatchWholeWord=Window_GetElement(window,OxO17dd[2],true);var MatchCase=Window_GetElement(window,OxO17dd[3],true);var editdoc=editwin[OxO17dd[4]];function get_ie_matchtype(){var Ox20e=0;var Ox20f=0;var Ox210=0;if(MatchCase[OxO17dd[5]]){Ox20f=4;} ;if(MatchWholeWord[OxO17dd[5]]){Ox210=2;} ;Ox20e=Ox20f+Ox210;return (Ox20e);} ;function checkInputString(){if(stringSearch[OxO17dd[7]][OxO17dd[6]]<1){alert(OxO17dd[8]);return false;} else {return true;} ;} ;function IsMatchSearchValue(Ox1b){if(!Ox1b){return false;} ;if(stringSearch[OxO17dd[7]]==Ox1b){return true;} ;if(MatchCase[OxO17dd[5]]){return false;} ;return stringSearch[OxO17dd[7]].toLowerCase()==Ox1b.toLowerCase();} ;var _ie_range=null;function IE_Restore(){editwin.focus();if(_ie_range!=null){_ie_range.select();} ;} ;function IE_Save(){editwin.focus();_ie_range=editdoc[OxO17dd[9]].createRange();} ;function MoveToBodyStart(){if(Browser_UseIESelection()){range=document[OxO17dd[10]].createTextRange();range.collapse(true);range.select();IE_Save();} else {editwin.getSelection().collapse(editdoc.body,0);} ;} ;function DoFind(){if(Browser_UseIESelection()){IE_Restore();var Ox20=editdoc[OxO17dd[9]];if(Ox20[OxO17dd[11]]==OxO17dd[12]){MoveToBodyStart();} ;var Ox114=Ox20.createRange();Ox114.collapse(false);if(Ox114.findText(stringSearch.value,1000000000,get_ie_matchtype())){Ox114.select();IE_Save();return true;} ;} else {var Ox114;var Ox20=editwin.getSelection();if(Ox20[OxO17dd[13]]>0){Ox114=editwin.getSelection().getRangeAt(0);} ;var Ox119=!!navigator[OxO17dd[14]].match(/Trident\/7\./);if(Ox119){editdoc[OxO17dd[10]][OxO17dd[15]].indexOf(stringSearch.value)>-1;} else {if(editwin.find(stringSearch.value,MatchCase.checked,false,false,MatchWholeWord.checked,false,false)){return true;} ;} ;} ;} ;function DoReplace(){if(Browser_UseIESelection()){IE_Restore();var Ox20=editdoc[OxO17dd[9]];if(Ox20[OxO17dd[11]]!=OxO17dd[12]){var Ox114=Ox20.createRange();if(IsMatchSearchValue(Ox114.text)){Ox114[OxO17dd[16]]=stringReplace[OxO17dd[7]];Ox114.collapse(false);IE_Save();return true;} ;} ;} else {var Ox20=editwin.getSelection();if(IsMatchSearchValue(Ox20.toString())){Ox20.deleteFromDocument();Ox20.getRangeAt(0).insertNode(editdoc.createTextNode(stringReplace.value));Ox20.getRangeAt(0).collapse(false);return true;} ;} ;return false;} ;function FindTxt(){if(!checkInputString()){return false;} ;while(true){if(DoFind()){return ;} ;if(!confirm(OxO17dd[17])){return ;} ;MoveToBodyStart();} ;} ;function ReplaceTxt(){if(!checkInputString()){return ;} ;DoReplace();FindTxt();} ;function ReplaceAllTxt(){if(!checkInputString()){return ;} ;var Ox21c=0;var msg=OxO17dd[18];MoveToBodyStart();if(Browser_UseIESelection()){var Ox20=editdoc[OxO17dd[9]];if(Ox20[OxO17dd[11]]==OxO17dd[12]){MoveToBodyStart();} ;var Ox21d=Ox20.createRange();var Ox21c=0;var msg=OxO17dd[18];Ox21d.expand(OxO17dd[19]);Ox21d.collapse();Ox21d.select();while(Ox21d.findText(stringSearch.value,1000000000,get_ie_matchtype())){Ox21d.select();Ox21d[OxO17dd[16]]=stringReplace[OxO17dd[7]];Ox21c++;} ;if(Ox21c==0){msg=WordNotFound;} else {msg=WordReplaced+OxO17dd[20]+Ox21c;} ;alert(msg);} else {if((stringReplace[OxO17dd[7]]).indexOf(stringSearch.value)==-1){DoFind();while(DoReplace()){Ox21c++;DoFind();FindTxt();} ;if(Ox21c==0){msg=WordNotFound;} else {msg=WordReplaced+OxO17dd[20]+Ox21c;} ;alert(msg);} else {FindTxt();alert(OxO17dd[21]);} ;} ;} ;