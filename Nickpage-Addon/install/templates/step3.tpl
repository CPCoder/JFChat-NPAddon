<h2>{SUBTITLE}</h2>
Im vorletzten Schritt der Installation werden nun die ben&ouml;tigten Tabellen angelegt und in der Registry-/Visitor-Tabelle 
der JFChat-Datenbank zus&auml;tzliche Spalten hinzugef&uuml;gt.<br><br>
<strong>Sollte es hier zu Fehlern kommen, so pr&uuml;fe bitte deine Einstellungen (Datenbank-Einstellungen) 
in der "config.php"!</strong>
<br><br>

<strong>Ben&ouml;tigte Tabellen:</strong><br>
<table cellpadding="4" cellspacing="0" border="0" class="smallborder" width="600">
	<tr>
		<td width="50%">{DBPREF}npblog</td>
		<td width="50%">{BLOG_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}npgalcategories</td>
		<td width="50%">{GALCAT_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}npgalimages</td>
		<td width="50%">{GALIMG_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}npblocks</td>
		<td width="50%">{NPBLOCKS_STATUS}</td>
	</tr>
</table>
<br>
<strong>Zus&auml;tzliche Spalten:</strong><br>
<table cellpadding="4" cellspacing="0" border="0" class="smallborder" width="600">
	<tr>
		<td width="50%">{DBPREF}registry (gblastvisit)</td>
		<td width="50%">{GBLASTV_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}registry (nplock)</td>
		<td width="50%">{NPLOCK_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}guestbooks (nponlyfriends)</td>
		<td width="50%">{NPONLYFRIENDS_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}visitors (id)</td>
		<td width="50%">{VISITID_STATUS}</td>
	</tr>
	<tr>
		<td width="50%">{DBPREF}guestbooks (editinfo)</td>
		<td width="50%">{EDITINFO_STATUS}</td>
	</tr>
</table>
<br>
{DB_ERRORMESSAGE}
{LINK}