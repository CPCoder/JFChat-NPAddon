			<h2>{SUB_TITLE}{ADDITIONAL}</h2>
			<div id="wrapper2">
				<div class="padding_4">
					Hier kannst du eine Neue Galerie-Kategorie anlegen, fülle dazu einfach das nachfolgende Formular aus.<br>
					<form action="nickpage.php" method="post" name="npform">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="site" value="gallery">
						<input type="hidden" name="subsite" value="newcategory">
						<input type="hidden" name="ac" value="save">
					<table cellspacing="0" cellpadding="4" border="0">
						<tr>
							<td>
								<strong>Name der Kategorie:</strong><br>
								(max. 100 Zeichen)
							</td>
							<td>
								<input type="text" name="title">
							</td>
						</tr>
						<tr>
							<td>
								<strong>Kurze Beschreibung:</strong><br>
								(max. 500 Zeichen)
							</td>
							<td>
								<textarea name="description" rows="5" cols="60"></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Kategorie anlegen"></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			<br><br>