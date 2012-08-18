function insertBBCode(aTag, eTag, setflag){
  var input = document.forms['npform'].elements['data'];
  input.focus();
  if(typeof document.selection != 'undefined'){
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = aTag + insText + eTag;
    range = document.selection.createRange();
    if (insText.length == 0){
    	if(setflag == 'true'){
    		range.moveStart('character', aTag.length + insText.length + eTag.length);
    	}else{
    		range.move('character', -eTag.length);
    	}
    }else{
      range.moveStart('character', aTag.length + insText.length + eTag.length);
    }
    range.select();
  }else if(typeof input.selectionStart != 'undefined'){
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
    var pos;
    if (insText.length == 0){
    	if(setflag == 'true'){
    		pos = start + aTag.length + insText.length + eTag.length;
    	}else{
    		pos = start + aTag.length;
    	}
    }else{
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }else{
    alert("Leider können die automatischen Einfügeoperationen der BBCode-Tags nur mit dem Internet-Explorer oder Mozilla-Browsern genutzt werden!");
  }
}
function buildIMGCode(){
	var input = document.forms['npform'].elements['data'];
    var error = '';
    var b = prompt("Bitte die vollständige Url zum Bild eingeben.", "http://");
    if(!b){
        error += " " + "Es wurde keine Url angegeben";
    }
    if (error) {
        alert("FEHLER! "+error);
        return;
    }else{
    	insertBBCode("[IMG]"+b, "[/IMG]", 'true');
    }
}
function buildURLCode(){
	var input = document.forms['npform'].elements['data'];
    var error = '';
    var b = prompt("Bitte die vollständige Url eingeben", "http://");
    var a = prompt("Einen Namen für den Link eingeben", "Linkname");
    if(!b){
        error += " " + "Es wurde keine Url eingegeben.";
    }
    if(!a){
    	error += " " + "Es wurde kein Name für den Link eingegeben.";
    }
    if(error){
        alert("Fehler! "+error);
        return;
    }else{
    	insertBBCode("[URL="+b+"]"+a, "[/URL]", 'true');
    }
}
function insertEmo(emocode){
	insertBBCode(emocode, "", 'false');
}
function buildFontFamilyCode(para){
	insertBBCode("[FAMILY="+para+"]", "[/FAMILY]", 'false');
}
function buildFontSizeCode(para){
	insertBBCode("[SIZE="+para+"]", "[/SIZE]", 'false');
}
function buildFontColorCode(para){
	insertBBCode("[COLOR="+para+"]", "[/COLOR]", 'false');
}
function setAction(para){
	document.forms['npform'].elements['ac'].value=para;
	document.forms['npform'].submit();
}