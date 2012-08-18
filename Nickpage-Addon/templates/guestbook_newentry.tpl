<br>
			<h2>{SUB_TITLE}{ADDITIONAL}</h2>
			<div id="wrapper2">
				<div class="padding_4">
					<br>{PREVIEW}
					<form action="nickpage.php" method="post" name="npform">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="site" value="guestbook">
						<input type="hidden" name="subsite" value="newentry">
						<input type="hidden" name="ac" value="">
						<u><strong>Eingabebereich:</strong></u><br>
						<textarea name="data" id="data" rows="15" cols="80" onkeyup="checkSignCount(this)">{DATA}</textarea><br>
						Du kannst noch <strong><span id="counter">{MAXSIGNS}</span></strong> von <strong>{MAXSIGNS}</strong> Zeichen eingeben.
						<br><br>
						<u><strong>Textformatierung und Einf&uuml;ge Funktionen:</strong></u><br>
                        <input type="button" name="formtags" value="B" alt="Fett" title="Fett" onclick="javascript:insertBBCode('[B]', '[/B]', 'false');">&nbsp;
                        <input type="button" name="formtags" value="I" alt="Kursiv" title="Kursiv" onclick="javascript:insertBBCode('[I]', '[/I]', 'false');">&nbsp;
                        <input type="button" name="formtags" value="U" alt="Unterstreichen" title="Unterstreichen" onclick="javascript:insertBBCode('[U]', '[/U]', 'false');">&nbsp;
                        <input type="button" name="formtags" value="QUOTE" alt="Zitat" title="Zitat" onclick="javascript:insertBBCode('[QUOTE]', '[/QUOTE]', 'false');"><br>
                        <input type="button" onclick="javascript:insertBBCode('[YOUTUBE]', '[/YOUTUBE]', 'false');" name="formtags" alt="Youtube-Video einfügen" title="Youtube-Video einfügen" value="Youtube-Video einfügen">&nbsp;
                        <input type="button" id="urlbutton" onclick="javascript:buildURLCode();" name="formtags" alt="Link einfügen" title="Link einfügen" value="Link einfügen">&nbsp;
                        <input type="button" id="imgbutton" onclick="javascript:buildIMGCode();" name="formtags" alt="Bild einfügen" title="Link einfügen" value="Bild einfügen"><br>
                        <select name="fontfamily" style="height:25px;" onchange="javascript:buildFontFamilyCode(this.options[this.selectedIndex].value);">
                        	<option value="null">Schriftart</option>
                        	<option value="arial, sans-serif" style="font-family: arial, sans-serif;">Arial</option>
                        	<option value="comic, fantasy" style="font-family: comic, fantasy;">Comic</option>
                        	<option value="courier" style="font-family: courier, monospace;">Courier</option>
                        	<option value="courier, monospace" style="font-family: times, serif;">Times</option>
                        	<option value="verdana, sans-serif" style="font-family: verdana, sans-serif;">Verdana</option>
                        </select>&nbsp;
                        <select name="fontsize" style="height:25px;" onchange="javascript:buildFontSizeCode(this.options[this.selectedIndex].value);">
                        	<option value="null">Schriftgr&ouml;sse</option>
                        	<option value="8" style="font-size:8pt;">Klein</option>
                        	<option value="10" style="font-size:10pt;">Normal</option>
                        	<option value="18" style="font-size:18pt;">Gross</option>
                        </select>&nbsp;
                        <select name="fontcolor" style="height:25px;" onchange="javascript:buildFontColorCode(this.options[this.selectedIndex].value);">
                        	<option value="null">Schriftfarbe</option>
                        	<option value="0000FF" style="color: #0000FF;">Blau</option>
                        	<option value="FF0000" style="color: #FF0000;">Rot</option>
                        	<option value="800080" style="color: #800080;">Lila</option>
                        	<option value="808080" style="color: #808080;">Grau</option>
                        	<option value="FF8000" style="color: #FF8000;">Orange</option>
                        	<option value="FFFF00" style="color: #FFFF00;">Gelb</option>
                        	<option value="FF80C0" style="color: #FF80C0;">Rosa</option>
                        	<option value="804000" style="color: #804000;">Braun</option>
                        	<option value="000000" style="color: #000000;">Schwarz</option>
                        </select><br><br>
                        <u><strong>Emoticons:</strong></u><br>
                        <div id="emobox">
                        	<img src="{EMOS}grins.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:grins:]")'>&nbsp; 
                        	<img src="{EMOS}kratz.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:kratz:]")'>&nbsp; 
                        	<img src="{EMOS}kuss.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:kuss:]")'>&nbsp; 
                        	<img src="{EMOS}kippe.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:kippe:]")'>&nbsp; 
                        	<img src="{EMOS}kiss.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:kiss:]")'>&nbsp; 
                        	<img src="{EMOS}oberlehrer.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:oberlehrer:]")'>&nbsp; 
                        	<img src="{EMOS}box.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:box:]")'>&nbsp; 
                        	<img src="{EMOS}think.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:think:]")'>&nbsp; 
                        	<img src="{EMOS}knuddel.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:knuddel:]")'>&nbsp; 
                        	<img src="{EMOS}mauer.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:mauer:]")'>&nbsp; 
                        	<img src="{EMOS}zwinker.gif" alt="Hier klicken um diesen Emo einzuf&uuml;gen..." title="Hier klicken um diesen Emo einzuf&uuml;gen..." onclick='insertEmo("[:zwinker:]")'>
                        </div>
                        <br><br>
						<input type="checkbox" name="private"value="1"{CHECKED}> Diesen Eintrag privat eintragen<br>
                        <input type="submit" name="preview" value="Vorschau" onclick="javascript:setAction('preview');">&nbsp; <input type="submit" name="save" onclick="javascript:setAction('save');" value="Eintragen">
                        <br><br>
					</form>
				</div>
			</div>
			<br><br>