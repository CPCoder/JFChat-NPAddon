			<h2>{SUB_TITLE}{ADDITIONAL}</h2>
			<div id="wrapper2">
				<div class="padding_4">
					Hier kannst du eine Kategorie bearbeiten.<br>
					<form action="nickpage.php" method="post" name="npform">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="site" value="gallery">
						<input type="hidden" name="subsite" value="editcategory">
						<input type="hidden" name="ac" value="save">
						<input type="hidden" name="id" value="{CATEGORY_ID}">
					<table cellspacing="0" cellpadding="4" border="0">
						<tr>
							<td><strong>Name der Kategorie:</strong></td>
							<td><input type="text" name="title" value="{CATEGORY_TITLE}"></td>
						</tr>
						<tr>
							<td><strong>Kurze Beschreibung:</strong></td>
							<td><textarea name="description" rows="5" cols="60">{CATEGORY_DESCRIPTION}</textarea></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="&Auml;nderungen Speichern"></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
			<br><br>