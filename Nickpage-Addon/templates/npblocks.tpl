<br>
			<h2>{SUB_TITLE}</h2>
			<div id="wrapper2">
				<div class="wrapper_prof_pic">
					<div id="npblocklist">
						<div class="padding_4">
							<br>
							Gesamtanzahl der Blocklist-Eintr&auml;ge: {BLOCKCOUNT}<br>
							{BLOCKLIST}
							<br>
						</div>
					</div>
					<div id="blocklisteditbox">
						<div class="padding_4">
							<strong>Einen User in die Blockliste eintragen</strong>
							Um einen User in die Blockliste einzutragen, gib einfach den 
							Usernamen in das nachfolgende Textfeld ein und klick auf "Eintragen":<br>
							<form action="nickpage.php">
								<input type="hidden" name="site" value="npblocks">
								<input type="hidden" name="sid" value="{SID}">
								<input type="hidden" name="senduid" value="{SENDUID}">
								<input type="hidden" name="showid" value="{SHOWID}">
								<input type="hidden" name="auth" value="{AUTH}">
								<input type="hidden" name="ac" value="addblock">
								<input type="text" name="username">&nbsp; <input type="submit" name="submit" value="Eintragen">
							</form>{ERRORMESSAGE}
							<br><br>
							<strong>Einen User aus der Blockliste entfernen</strong>
							Um einen User aus der Blockliste zu entfernen musst du nur auf das <img src="{STYLE}gfx/delete.gif" border="0"> vor dem Usernamen in der Blockliste klicken.<br><br>
						</div>
					</div>
				</div>
				<div id="clearbox"></div>
			</div>
			<br><br>