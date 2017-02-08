<script language=JavaScript>
var datePickerDivID = "datepicker";
var iFrameDivID = "datepickeriframe";

var dayArrayShort = new Array('Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa');
var dayArrayMed = new Array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
var dayArrayLong = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
var monthArrayShort = new Array('Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc');
var monthArrayMed = new Array('Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc');
var monthArrayLong = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

var defaultDateSeparator = "/";
var defaultDateFormat = "dmy"
var dateSeparator = defaultDateSeparator;
var dateFormat = defaultDateFormat;

function displayDatePicker(dateFieldName)
{
var targetDateField = dateFieldName;

 var displayBelowThisObject = targetDateField;

var dateSeparator = defaultDateSeparator;

var dateFormat = defaultDateFormat;

var x = displayBelowThisObject.offsetLeft;
var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight ;

var parent = displayBelowThisObject;
while (parent.offsetParent) {
parent = parent.offsetParent;
x += parent.offsetLeft;
y += parent.offsetTop ;
}

drawDatePicker(targetDateField, x, y);
}

function drawDatePicker(targetDateField, x, y)
{
var dt = getFieldDate(targetDateField.value );

if (!document.getElementById(datePickerDivID)) {

var newNode = document.createElement("div");
newNode.setAttribute("id", datePickerDivID);
newNode.setAttribute("class", "dpDiv");
newNode.setAttribute("style", "visibility: hidden;");
document.body.appendChild(newNode);
}

var pickerDiv = document.getElementById(datePickerDivID);
pickerDiv.style.position = "absolute";
pickerDiv.style.left = x + "px";
pickerDiv.style.top = y + "px";
pickerDiv.style.visibility = (pickerDiv.style.visibility == "visible" ? "hidden" : "visible");
pickerDiv.style.display = (pickerDiv.style.display == "block" ? "none" : "block");
pickerDiv.style.zIndex = 10000;

refreshDatePicker(targetDateField.name, dt.getFullYear(), dt.getMonth(), dt.getDate());
}

function refreshDatePicker(dateFieldName, year, month, day)
{
var thisDay = new Date();
if ((month >= 0) && (year > 0)) {
thisDay = new Date(year, month, 1);
} else {
day = thisDay.getDate();
thisDay.setDate(1);
}

var crlf = "\r\n";
var TABLE = "<table cols=7 class='dpTable'>" + crlf;
var xTABLE = "</table>" + crlf;
var TR = "<tr class='dpTR'><td></td>";
var TR_title = "<tr class='dpTitleTR'>";
var TR_days = "<tr class='dpDayTR'><td></td>";
var TR_todaybutton = "<tr class='dpTodayButtonTR'>";
var xTR = "<td></td></tr>" + crlf;
var TD = "<td class='dpTD' onMouseOut='this.className=\"dpTD\";' onMouseOver=' this.className=\"dpTDHover\";' "; // leave this tag open, because we'll be adding an onClick event
var TD_title = "<td colspan=5 class='dpTitleTD'>";
var TD_buttons = "<td class='dpButtonTD'>";
var TD_todaybutton = "<td colspan=9 class='dpTodayButtonTD'>";
var TD_days = "<td class='dpDayTD'>";
var TD_selected = "<td class='dpDayHighlightTD' onMouseOut='this.className=\"dpDayHighlightTD\";' onMouseOver='this.className=\"dpTDHover\";' "; // leave this tag open, because we'll be adding an onClick event
var xTD = "</td>" + crlf;
var DIV_title = "<div class='dpTitleText'>";
var DIV_selected = "<div class='dpDayHighlight'>";
var xDIV = "</div>";
var html = TABLE;

html += TR_title;
html += TD_buttons + getButtonCode(dateFieldName, thisDay, -12, "&lt;&lt;")+ xTD +TD_buttons+getButtonCode(dateFieldName, thisDay, -1, "&lt;") + xTD;
html += TD_title + DIV_title + monthArrayLong[ thisDay.getMonth()] + " " + thisDay.getFullYear() + xDIV + xTD;
html += TD_buttons + getButtonCode(dateFieldName, thisDay, 1, "&gt;")+ xTD +TD_buttons+getButtonCode(dateFieldName, thisDay, 12, "&gt;&gt;")+ xTD;
html += xTR;

html += TR_days;
for(i = 0; i < dayArrayShort.length; i++)
html += TD_days + dayArrayShort[i] + xTD;
html += xTR;

html += TR;

for (i = 0; i < thisDay.getDay(); i++)
html += ""+TD + "&nbsp;" + xTD;

do {
dayNum = thisDay.getDate();
TD_onclick = " onclick=\"updateDateField('" + dateFieldName + "', '" + getDateString(thisDay) + "');\">";

if (dayNum == day)
html += TD_selected + TD_onclick + DIV_selected + dayNum + xDIV + xTD;
else
html += TD + TD_onclick + dayNum + xTD;

if (thisDay.getDay() == 6)
html += xTR + TR;

thisDay.setDate(thisDay.getDate() + 1);
} while (thisDay.getDate() > 1)

if (thisDay.getDay() > 0) {
for (i = 6; i > thisDay.getDay(); i--)
html += TD + "&nbsp;" + xTD;
}
html += xTR;

var today = new Date();
var todayString = "Today is " + dayArrayMed[today.getDay()] + ", " + monthArrayMed[ today.getMonth()] + " " + today.getDate();
html += TR_todaybutton + TD_todaybutton;
html += "<button class='dpTodayButton' onClick='refreshDatePicker(\"" + dateFieldName + "\");'>Ce Mois</button> ";
html += "<button class='dpTodayButton' onClick='updateDateField(\"" + dateFieldName + "\");'>Fermer</button>";
html += xTD + xTR;

html += xTABLE;

document.getElementById(datePickerDivID).innerHTML = html;
adjustiFrame();
}

function getButtonCode(dateFieldName, dateVal, adjust, label)
{
var newMonth = (dateVal.getMonth () + adjust) % 12;
var newYear = dateVal.getFullYear() + parseInt((dateVal.getMonth() + adjust) / 12);
if (newMonth < 0) {
newMonth += 12;
newYear += -1;
}

return "<button class='dpButton' onClick='refreshDatePicker(\"" + dateFieldName + "\", " + newYear + ", " + newMonth + ");'>" + label + "</button>";
}

function getDateString(dateVal)
{
var dayString = "00" + dateVal.getDate();
var monthString = "00" + (dateVal.getMonth()+1);
dayString = dayString.substring(dayString.length - 2);
monthString = monthString.substring(monthString.length - 2);

switch (dateFormat) {
case "dmy" :
return dayString + dateSeparator + monthString + dateSeparator + dateVal.getFullYear();
case "ymd" :
return dateVal.getFullYear() + dateSeparator + monthString + dateSeparator + dayString;
case "mdy" :
default :
return monthString + dateSeparator + dayString + dateSeparator + dateVal.getFullYear();
}
}

function getFieldDate(dateString)
{
var dateVal;
var dArray;
var d, m, y;

try {
dArray = splitDateString(dateString);
if (dArray) {
switch (dateFormat) {
case "dmy" :
d = parseInt(dArray[0], 10);
m = parseInt(dArray[1], 10) - 1;
y = parseInt(dArray[2], 10);
break;
case "ymd" :
d = parseInt(dArray[2], 10);
m = parseInt(dArray[1], 10) - 1;
y = parseInt(dArray[0], 10);
break;
case "mdy" :
default :
d = parseInt(dArray[1], 10);
m = parseInt(dArray[0], 10) - 1;
y = parseInt(dArray[2], 10);
break;
}
dateVal = new Date(y, m, d);
} else if (dateString) {
dateVal = new Date(dateString);
} else {
dateVal = new Date();
}
} catch(e) {
dateVal = new Date();
}

return dateVal;
}

function splitDateString(dateString)
{
var dArray;
if (dateString.indexOf("/") >= 0)
dArray = dateString.split("/");
else if (dateString.indexOf(".") >= 0)
dArray = dateString.split(".");
else if (dateString.indexOf("-") >= 0)
dArray = dateString.split("-");
else if (dateString.indexOf("\\") >= 0)
dArray = dateString.split("\\");
else
dArray = false;

return dArray;
}

function updateDateField(dateFieldName, dateString)
{
var targetDateField = document.getElementsByName (dateFieldName).item(0);
if (dateString)
targetDateField.value = dateString;

var pickerDiv = document.getElementById(datePickerDivID);
pickerDiv.style.visibility = "hidden";
pickerDiv.style.display = "none";

adjustiFrame();
targetDateField.focus();

if ((dateString) && (typeof(datePickerClosed) == "function"))
datePickerClosed(targetDateField);
}

function adjustiFrame(pickerDiv, iFrameDiv)
{

var is_opera = (navigator.userAgent.toLowerCase().indexOf("opera") != -1);
if (is_opera)
return;

try {
if (!document.getElementById(iFrameDivID)) {

var newNode = document.createElement("iFrame");
newNode.setAttribute("id", iFrameDivID);
newNode.setAttribute("src", "javascript:false;");
newNode.setAttribute("scrolling", "no");
newNode.setAttribute ("frameborder", "0");
document.body.appendChild(newNode);
}
if (!pickerDiv)
pickerDiv = document.getElementById(datePickerDivID);
if (!iFrameDiv)
iFrameDiv = document.getElementById(iFrameDivID);
try {
iFrameDiv.style.position = "absolute";
iFrameDiv.style.width = pickerDiv.offsetWidth;
iFrameDiv.style.height = pickerDiv.offsetHeight ;
iFrameDiv.style.top = pickerDiv.style.top;
iFrameDiv.style.left = pickerDiv.style.left;
iFrameDiv.style.zIndex = pickerDiv.style.zIndex - 1;
iFrameDiv.style.visibility = pickerDiv.style.visibility ;
iFrameDiv.style.display = pickerDiv.style.display;
} catch(e) {
}
} catch (ee) {
}
}
</script>

<style>
body {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
}
/* the div that holds the date picker calendar */
.dpDiv {
}
/* the table (within the div) that holds the date picker calendar */
.dpTable {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
text-align: center;
color: #000000;
background-color: #F7F7F7;
border: 1px solid #666666;
}
/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
}
/* the top table row that holds the month, year, and forward/backward buttons */
.dpTitleTR {
}
/* the second table row, that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTR {
}
/* the bottom table row, that has the "This Month" and "Close" buttons */
.dpTodayButtonTR {
}
/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {
border: 1px solid #F5EFE7;
}
/* a table cell that holds a highlighted day (usually either today's date or the current date field value) */
.dpDayHighlightTD {
background-color: #999999;
border: 1px solid #F5EFE7;
}
/* the date number table cell that the mouse pointer is currently over (you can use contrasting colors to make it apparent which cell is being hovered over) */
.dpTDHover {
background-color: #aca998;
border: 1px solid #888888;
cursor: pointer;
color: red;
}
/* the table cell that holds the name of the month and the year */
.dpTitleTD {
}
/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
}
/* the table cell that holds the "This Month" or "Close" button at the bottom */
.dpTodayButtonTD {
}
/* a table cell that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTD {
background-color: #E9E9E9;
border: 1px solid #AAAAAA;
color: #000000;
}
/* additional style information for the text that indicates the month and year */
.dpTitleText {
font-size: 11px;
color: #000000;
font-weight: bold;
font-family: Verdana, Arial, Helvetica, sans-serif;
}
/* additional style information for the cell that holds a highlighted day (usually either today's date or the current date field value) */
.dpDayHighlight {
color: #0000FF;
font-weight: bold;
}
/* the forward/backward buttons at the top */
.dpButton {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 11px;
color: #000000;
}
/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 10px;
color: #000000;
}
.Style2 {font-size: 11px}
</style>


