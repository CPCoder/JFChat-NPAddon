<br>
			<h2>{SUB_TITLE}</h2>
			<div id="wrapper2">
				<div class="wrapper_prof_pic">
					<div id="picture">
						<div class="padding_4">
							<table cellpadding="2" cellspacing="0" border="0">
								<tr>
									<td><strong>Punkte:</strong>&nbsp; </td>
									<td>{POINTS}</td>
								</tr>
								<tr>
									<td><strong>Shop-Umsatz:</strong>&nbsp; </td>
									<td>{TRANSVOL}</td>
								</tr>
								<tr>
									<td><strong>Nickpage-Besucher:</strong>&nbsp; </td>
									<td>{VISITORSCOUNT}</td>
								</tr>
								<tr>
									<td><strong>G&auml;stebucheintr&auml;ge:</strong>&nbsp; </td>
									<td>{GBCOUNT}</td>
								</tr>
								<tr>
									<td><strong>Davon Privat:</strong>&nbsp; </td>
									<td>{PRIVCOUNT}</td>
								</tr>
								<tr>
									<td><strong>Onlinezeit:</strong>&nbsp; </td>
									<td>
									<script type="text/javascript">
										var time={ONLINETIME};
										if(time == '')
											time=0;
										document.write(Math.floor(time/60)+' Std. '+(time%60)+' Min.');
									</script>
									</td>
								</tr>
								<tr>
									<td><strong>Chatzeit:</strong>&nbsp; </td>
									<td>
									<script type="text/javascript">
										var time={CHATTIME};
										if(time == '')
											time=0;
										document.write(Math.floor(time/60)+' Std. '+(time%60)+' Min.');
									</script>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="profdata1">
						<div class="padding_4">
							<table cellpadding="2" cellspacing="0" border="0">
								<tr>
									<td><strong>Themen im Forum:</strong>&nbsp; </td>
									<td>{THREADS}</td>
								</tr>
								<tr>
									<td><strong>Antworten im Forum:</strong>&nbsp; </td>
									<td>{ANSWERS}</td>
								</tr>
								<tr>
									<td><strong>Gesperrte Themen:</strong>&nbsp; </td>
									<td>{THREADSLOCKED}</td>
								</tr>
								<tr>
									<td><strong>Mitglied seit:</strong>&nbsp; </td>
									<td>{MEMBERSINCE}</td>
								</tr>
								<tr>
									<td><strong>Zuletzt hier am:</strong>&nbsp; </td>
									<td>{LASTLOGINDATE}</td>
								</tr>
								<tr>
									<td><strong>um:</strong>&nbsp; </td>
									<td>{LASTLOGINTIME} Uhr</td>
								</tr>
								<tr>
									<td><strong>Onlinestatus:</strong>&nbsp; </td>
									<td>{ISONLINE}</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="profdata2">
					{OBJECTS}
					</div>
				</div><br>
			</div>
			{VISITORS}
			<br><br>