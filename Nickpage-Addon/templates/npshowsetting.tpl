<br>
			<h2>{SUB_TITLE}</h2>
			<div id="wrapper2">
				<div id="wrapper_npshowsetting"><br>
					Hier k�nnt ihr festlegen welche User eure Nickpage betrachten d�rfen.<br><br>
					<form action="nickpage.php">
						<input type="hidden" name="site" value="npshowsetting">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="ac" value="save">
						<input type="radio" name="showsetting" id="showsetting0" value="0"{FLAG_SHOWSET0}> <label for="showsetting0">Alle Mitglieder (Ausser G&auml;ste) d�rfen die Nickpage betrachten</label><br>
						<input type="radio" name="showsetting" id="showsetting1" value="1"{FLAG_SHOWSET1}> <label for="showsetting1">Nur Freunde d�rfen die Nickpage betrachten <strong>*</strong></label><br>
						<input type="submit" name="submit" value="Speichern">
					</form><br><br>
					<strong>*</strong> Mitglieder m�ssen auf <strong>deiner</strong> Freundesliste stehen!
				</div>
			</div>
			<br><br>