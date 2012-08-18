			<h2>{SUB_TITLE}{ADDITIONAL}</h2>
			<div id="wrapper2">
				<div class="padding_4">
					Hier kannst du ein neues Bild in deine Bilder-Galerie hochladen.<br>Folgende Datei-/Bild-Typen sind erlaubt: JPG, JPEG, GIF, PNG
					{TERMS}
					<form action="nickpage.php" method="post" name="npform" enctype="multipart/form-data">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="site" value="gallery">
						<input type="hidden" name="subsite" value="upload">
						<input type="hidden" name="ac" value="save">
					<table cellspacing="0" cellpadding="4" border="0">
						<tr>
							<td>
								<strong>Kurzer Text zum Bild:</strong><br>
								(max. 255 Zeichen)
							</td>
							<td><input type="text" name="title" maxlength="255"></td>
						</tr>
						<tr>
							<td>
								<strong>Bild auswählen:</strong>
							</td>
							<td><input type="file" name="image" size="20"></td>
						</tr>
						<tr>
							<td><strong>Kategorie:</strong></td>
							<td>
								<select name="id">
									<option value="0">Bitte auswählen:</option>
									{CATEGORYLIST}
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Bild hochladen"></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			<br><br>