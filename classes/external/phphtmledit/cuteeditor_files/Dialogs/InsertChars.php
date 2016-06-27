<?php
error_reporting(E_ALL ^ E_NOTICE);
	include_once("Include_GetString.php") ;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo GetString("InsertChars") ; ?> </title>
		
		<meta name="content-type" content="text/html ;charset=Unicode" />
		<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.1)" />
		<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.1)" />
		<link href="../Themes/<?php echo $Theme; ?>/dialog.css" type="text/css" rel="stylesheet" />
		<style type="text/css">	
		table.Grid
		{
			border-width: 4px;
			border-style: none;
			background-color: White;
			border-color: gray;
			font-size:12px;
		}

		table.Grid TD, table.Grid TH
		{
			padding: 3px 3px 3px 3px;
			border: solid 1px #E1E1E1;
			vertical-align: top;
		}
		</style>
		<!--[if IE]>
			<link href="../Style/IE.css" type="text/css" rel="stylesheet" />
		<![endif]-->
		<script type="text/javascript" src="../Scripts/Dialog/DialogHead.js"></script>
		<script type="text/javascript">
			var tds=22;	

			function spcOver(el)
			{
				el.style.background="#0A246A";el.style.color="white";
			}
			function spcOut(el)
			{
				el.style.background="white";el.style.color="black";
			}
			function writeChars()
			{
				var str="";
				for(var i=33;i<256;)
				{
					document.write("<tr>");
					for(var j=0;j<=tds;j++)
					{
						document.write("<td onClick='getchar(this)' onmouseover='spcOver(this)' onmouseout='spcOut(this)'>");
						document.write("\x26#"+i+";");
						document.write("</td>");
						i++;
					}
					document.write("</tr>");
				}
			}

			function writeChars2()
			{
				var arr=["&#402;","&#913;","&#914;","&#915;","&#916;","&#917;","&#918;","&#919;","&#920;","&#921;","&#922;","&#923;","&#924;","&#925;","&#926;","&#927;","&#928;","&#929;","&#931;","&#932;","&#933;","&#934;","&#935;","&#936;","&#937;","&#945;","&#946;","&#947;","&#948;","&#949;","&#950;","&#951;","&#952;","&#953;","&#954;","&#955;","&#956;","&#957;","&#958;","&#959;","&#960;","&#961;","&#962;","&#963;","&#964;","&#965;","&#966;","&#967;","&#968;","&#969;","&#977;","&#978;","&#982;","&#8226;","&#8230;","&#8242;","&#8243;","&#8254;","&#8260;","&#8472;","&#8465;","&#8476;","&#8482;","&#8501;","&#8592;","&#8593;","&#8594;","&#8595;","&#8596;","&#8629;","&#8656;","&#8657;","&#8658;","&#8659;","&#8660;","&#8704;","&#8706;","&#8707;","&#8709;","&#8711;","&#8712;","&#8713;","&#8715;","&#8719;","&#8722;","&#8722;","&#8727;","&#8730;","&#8733;","&#8734;","&#8736;","&#8869;","&#8870;","&#8745;","&#8746;","&#8747;","&#8756;","&#8764;","&#8773;","&#8773;","&#8800;","&#8801;","&#8804;","&#8805;","&#8834;","&#8835;","&#8836;","&#8838;","&#8839;","&#8853;","&#8855;","&#8869;","&#8901;","&#8968;","&#8969;","&#8970;","&#8971;","&#9001;","&#9002;","&#9674;","&#9824;","&#9827;","&#9829;","&#9830;"];
				for(var i=0;i<arr.length;i+=tds)
				{
					document.write("<tr>");
					for(var j=i;j<i+tds&&j<arr.length;j++)
					{
						var n=arr[j];
						
						document.write("<td onClick='getchar(this)' onmouseover='spcOver(this)' onmouseout='spcOut(this)' title='" + n+" - "+n.replace("&","&amp;") + "' >");
						document.write(n);
						document.write("</td>");
					}
					document.write("</tr>");
				}
			}
		</script>
	</head>
	<body>
		<div id="ajaxdiv">
			<table border="0" cellspacing="2" cellpadding="2" width="98%">
				<tr>
					<td class="normal">
						<?php echo GetString("FontName") ; ?>: 
						<input type="radio" onpropertychange="sel_font_change()" id="selfont1" name="selfont" value="" checked="checked"  /><label for="selfont1"><?php echo GetString("Default") ; ?></label> 
						<input type="radio" onpropertychange="sel_font_change()" id="selfont2" name="selfont" value="webdings"  /><label for="selfont2">Webdings</label>
						<input type="radio" onpropertychange="sel_font_change()" id="selfont3" name="selfont" value="wingdings" /><label for="selfont3">Wingdings</label>
						<input type="radio" onpropertychange="sel_font_change()" id="selfont4" name="selfont" value="symbol" /><label for="selfont4">Symbol</label>
						<input type="radio" onpropertychange="sel_font_change()" id="selfont5" name="selfont" value="Unicode" /><label for="selfont5">Unicode</label>
					</td>
				</tr>
				<tr>
					<td align="center">
						<br />
						<table style="border-collapse: collapse;" class="Grid" width="100%" border="0" ID="charstable1">
							<script type="text/javascript">
							writeChars();
							</script>
						</table>
						<table style="border-collapse: collapse;" class="Grid" width="100%" border="0" ID="charstable2">
							<script type="text/javascript">
							writeChars2();
							</script>
						</table>
					</td>
				</tr>
			</table>
			<div align="center" style="margin-top:10px">
				<input type="button" value="<?php echo GetString("Cancel") ; ?>" class="formbutton" onclick="Close()" />
			</div>
		</div>
	</body>
	<script type="text/javascript" src="../Scripts/Dialog/DialogFoot.js"></script>
	<script type="text/javascript" src="../Scripts/Dialog/Dialog_InsertChars.js"></script>
	<script type="text/javascript">
	sel_font_change()
	</script>
</html>
