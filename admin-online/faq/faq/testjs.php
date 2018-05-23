<!--
Document   : How to check whether CKEDITOR value is blank or not
Created on : Jul 29, 2011, 12:00:21 PM
Author     : Ketan Prajapati
-->

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>check whether CKEDITOR value is blank or not</title>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">google.load("jquery", "1.3.2");</script>

<script type="text/javascript" src="http://ckeditor.com/apps/ckeditor/3.6.1/ckeditor.js?1311599564"></script>
<script type="text/javascript" src="http://ckeditor.com/apps/ckeditor/3.6.1/_source/lang/_languages.js?1311599564"></script>

<!--
I have used online repositoty for Jquery & CKEDITOR , you can also use already downloaded CKEDITOR.js & jquery**.js
-->

<script type="text/javascript">

</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">

function validate(obj)
{
$(".errDiv").remove();
if(validateCKEDITORforBlank($.trim(CKEDITOR.instances.textarea_1.getData().replace(/<[^>]*>|\s/g, '')))){
$("#textarea_1").parent().append("<div class='errDiv' id='errDiv' style='color:red;'>Please enter inputs</div>");
CKEDITOR.instances.textarea_1.setData("");
}
else
{
$("#textarea_1").parent().append("<div class='errDiv' id='errDiv' style='color:green;'></div>");
document.getElementById("errDiv").innerHTML ="Input Text:"+CKEDITOR.instances.textarea_1.getData();
}
}

function validateCKEDITORforBlank(field)
{
var vArray = new Array();
vArray = field.split("&nbsp;");
var vFlag = 0;
for(var i=0;i<vArray.length;i++)
{
if(vArray[i] == '' || vArray[i] == "")
{
continue;
}
else
{
vFlag = 1;
break;
}
}
if(vFlag == 0)
{
return true;
}
else
{
return false;
}
}
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24837008-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
<table border="1" width="100%">
<thead>
<tr>
<th colspan="2" style="margin-left: 1 px;">How to check whether CKEDITOR value is blank or not</th>
</tr>
</thead>
<tbody>
<tr>
<td width="30%">Input Text  :</td>
<td width="70%">
<textarea rows="5" id="textarea_1" name="textarea_1"></textarea>
<script type="text/javascript">
CKEDITOR.replace( 'textarea_1',
{
fullPage : false
});
</script>
</td>
</tr>
<tr>
<td></td>
<td><input name="button" type="button" id="button" value="Check" onclick="return validate(this)"/></td>
</tr>
<tr>
<td colspan="2">
Note : CKEDITOR takes 2 or more white spaces as & nbsp,so using trim() function will not treat field as empty even though white spaces are equal to blank.
<BR>
Same is problem with enter, tab also,In such case you can use above function.
</td>
</tr>
</tbody>
</table>

</body>
</html>


