<br>
			<h2>{SUB_TITLE}{ADDITIONAL}</h2>
			<div id="wrapper2">
				<div class="padding_4">
					<br>
					<form action="nickpage.php" method="post" name="npform">
						<input type="hidden" name="showid" value="{SHOWID}">
						<input type="hidden" name="senduid" value="{SENDUID}">
						<input type="hidden" name="sid" value="{SID}">
						<input type="hidden" name="auth" value="{AUTH}">
						<input type="hidden" name="site" value="guestbook">
						<input type="hidden" name="subsite" value="comment">
						<input type="hidden" name="id" value="{GB_ID}">
						<input type="hidden" name="ac" value="save">
						<u><strong>Eingabebereich:</strong></u><br>
						<textarea name="data" id="data" rows="15" cols="80"></textarea><br>
                        <br><br>
                        <input type="submit" name="submit" value="Speichern">
                        <br><br>
					</form>
				</div>
			</div>
			<br><br>