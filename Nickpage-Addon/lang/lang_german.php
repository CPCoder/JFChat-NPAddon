<?php
/*
 * Project		Nickpage-Addon
 * Filename		lang_german.php
 * Author		Steffen Haase
 * Date			19.01.2010
 * License		GPL v3
*/


#########################
# Bereichs-Überschrift
$lang['title']['systemmsg']			= 'Systemmeldung';
$lang['title']['profile']			= 'Userprofil';
$lang['title']['friends']			= 'Freunde';
$lang['title']['slogan']			= 'Motto';
$lang['title']['statistics']		= 'Statistik';
$lang['title']['guestbook']			= 'G&auml;stebuch';
$lang['title']['blog']				= 'Blog';
$lang['title']['gallery']			= 'Bilder-Galerie';
$lang['title']['npblocks']			= 'Nickpage-Blocks';
$lang['title']['npshowsetting']		= 'Nickpage-Anzeige';

#########################
# Zusatz zu Bereichs-Überschriften
$lang['additional']['gbedit']		= ' (Bearbeitung)';
$lang['additional']['gbcomment']	= ' (Kommentieren)';
$lang['additional']['gbnew']		= ' (Neuer Eintrag)';
$lang['additional']['galnewcat']	= ' (Neue Kategorie anlegen)';
$lang['additional']['galeditcat']	= ' (Kategorie bearbeiten)';
$lang['additional']['galupload']	= ' (Neues Bild hochladen)';
$lang['additional']['galmanage']	= ' (Verwaltung)';

#########################
# Geschlechts-Ausgabe
$lang['gender']['male']				= 'M&auml;nnlich';
$lang['gender']['female']			= 'Weiblich';
$lang['gender']['unknow']			= 'Keine Angabe';

#########################
# Profil-Links
$lang['profile']['edit']			= '<a href="http://'.$chathost.':'.$chatport.$comstring.'{SID}?auth=1'.
										'&amp;profil=np&amp;design=0">Profil bearbeiten</a><br>';
$lang['profile']['sendmail']		= '<a href="http://'.$chathost.':'.$chatport.$comstring.'{SID}?showhtml=mailsend'.
										'&amp;tmp1={TOUSER}&amp;tmp2=Nickpage-Nachricht'.
										'&amp;design=0">Interne Nachricht schreiben</a><br>';
$lang['profile']['addfriend']		= '<a href="{INSTALL}nickpage.php?site=profile&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;ac=addfriend&amp;sid={SID}">'.
										'Zu Freunden hinzuf&uuml;gen</a><br>';
$lang['profile']['delfriend']		= '<a href="{INSTALL}nickpage.php?site=profile&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;ac=delfriend&amp;sid={SID}">'.
										'Freundschaft k&uuml;ndigen</a><br>';
$lang['profile']['locknp']			= '---- Adminlinks ----<br><a href="{INSTALL}nickpage.php?site=profile&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;ac=locknp&amp;sid={SID}">'.
										'Nickpage sperren</a><br>';
$lang['profile']['unlocknp']		= '<br><br><a href="{INSTALL}nickpage.php?site=profile&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;ac=unlocknp&amp;sid={SID}">'.
										'Nickpage entsperren</a>';
$lang['profile']['npblocks']		= '<a href="{INSTALL}nickpage.php?site=npblocks&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Nickpage-Blocks bearbeiten</a><br>';
$lang['profile']['npshowsetting']	= '<a href="{INSTALL}nickpage.php?site=npshowsetting&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Nickpage-Anzeige bearbeiten</a><br>';
$lang['profile']['deleteslogan']	= '<br><br><a href="{INSTALL}nickpage.php?site=slogan&amp;subsite=delete&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Motto l&ouml;schen</a><br>';

#########################
# Diverse Ausgaben
$lang['other']['online']			= 'Online';
$lang['other']['offline']			= 'Offline';
$lang['other']['youwait']			= 'Zu Freunden hinzuf&uuml;gen<br>(Du hast schon eine Anfrage geschickt!)<br>';
$lang['other']['hewait']			= 'Zu Freunden hinzuf&uuml;gen<br>(Mitglied wartet auf eine Best&auml;tigung von dir!)<br>';
$lang['other']['henomore']			= 'Zu Freunden hinzuf&uuml;gen<br>(Dieses Mitglied kann keine Freunde mehr aufnehmen!)<br>';
$lang['other']['younomore']			= 'Zu Freunden hinzuf&uuml;gen<br>(Du kannst keine Freunde mehr aufnehmen!)<br>';

#########################
# Galerie-Ausgaben
$lang['gallery']['managelink']		= '<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;senduid={SENDUID}'.
										'&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Zur Galerie-Verwaltung</a><br><br>';
$lang['gallery']['catadded']		= 'Die neue Kategorie wurde gespeichert.<br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;'.
										'senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Zur&uuml;ck zur Galerie-Verwaltung</a><br><br>';
$lang['gallery']['catsavededit']	= 'Die &Auml;nderungen an der Kategorie wurden gespeichert.<br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;'.
										'senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Zur&uuml;ck zur Galerie-Verwaltung</a><br><br>';
$lang['gallery']['deletecatquest']	= 'Bist du sicher das du diese Kategorie l&ouml;schen willst?<br>'.
										'<strong>Hinweis:</strong> Alle Bilder in dieser Kategorie werden dabei gel&ouml;scht!<br><br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;ac=deletecat&amp;'.
										'senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}&amp;id={CATEGORY_ID}">'.
										'<font color="#FF0000"><strong>JA</strong></font>, diese Kategorie l&ouml;schen</a><br>'.
										'<a href="javascript:history.back(1);"><font color="#006400"><strong>NEIN</strong></font>, nicht l&ouml;schen</a><br><br>';
$lang['gallery']['catdeleted']		= 'Die gew&auml;hlte Bilder-Galerie wurde gel&ouml;scht.<br><br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;'.
										'senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Zur&uuml;ck zur Galerie-Verwaltung</a><br>';
$lang['gallery']['imagesaved']		= 'Das neue Bild wurde deiner Galerie hinzugefügt.<br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;'.
										'senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">'.
										'Zur&uuml;ck zur Galerie-Verwaltung</a><br><br>';
$lang['gallery']['terms']			= '<br><br><b>Hinweis:</b><br>Bevor das Bild in deiner Galerie zu sehen ist, muss es erst noch duch einen '.
										'Administrator begutachtet werden!<br><br>';
$lang['gallery']['locked']			= '<b>Wartet auf Freischaltung</b>';

#########################
# Blog Ausgaben
$lang['blog']['entry']				= 'Eintrag';
$lang['blog']['entries']			= 'Eintr&auml;ge';
$lang['blog']['site']				= 'Seite';
$lang['blog']['sites']				= 'Seiten';
$lang['blog']['entriesinfo']		= 'Es gibt insgesamt {COUNT_ENTRIES} {ENTRIES} auf {COUNT_SITES} {SITES}.<br>';
$lang['blog']['delete']				= 'Beitrag l&ouml;schen';
$lang['blog']['edit']				= 'Beitrag bearbeiten';
$lang['blog']['preview']			= '<strong>Beitrags-Vorschau:</strong><br><div id="previewbox">'.
										'<div class="padding_4">{CONTENT_PREVIEW}</div></div><br><br>';
$lang['blog']['entrysaved']			= 'Der Eintrag wurde gespeichert.<br><br>'.
										'<a href="nickpage.php?site=blog&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;sid={SID}&amp;auth={AUTH}">Zur&uuml;ck zum Blog</a><br><br>';
$lang['blog']['deletelink']			= '<a href="{INSTALL}nickpage.php?site=blog&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&ac=delete&amp;id={BLOG_ID}">'.
										'<img src="{STYLE}gfx/delete.gif" alt="'.$lang['blog']['delete'].
										'" title="'.$lang['blog']['delete'].'" border="0"></a>&nbsp; &nbsp; ';
$lang['blog']['editlink']			= '<a href="{INSTALL}nickpage.php?site=blog&amp;subsite=edit&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&amp;id={BLOG_ID}">'.
										'<img src="{STYLE}gfx/edit.gif" alt="'.$lang['blog']['edit'].
										'" title="'.$lang['blog']['edit'].'" border="0"></a>&nbsp; &nbsp; ';
$lang['blog']['newentrylink']		= '<a href="nickpage.php?site=blog&amp;subsite=newentry&amp;sid={SID}'.
										'&amp;showid={SHOWID}&amp;senduid={SENDUID}&amp;auth={AUTH}">'.
										'Neuen Eintrag machen</a><br><br>';       
$lang['blog']['editinfo']			= 'Bearbeitet von <userid>{ADMIN}</userid> am {DATE} um {TIME} Uhr.';
#########################
# Gästebuch Ausgaben
$lang['guestbook']['deleteduser']	= 'Mitglied existiert nicht mehr';
$lang['guestbook']['private']		= '(Privater Eintrag)';
$lang['guestbook']['alternative']	= '<i><strong>Dieser Eintrag ist privat und kann nur vom Nickpage-Inhaber '.
										'und dem Ersteller gelesen werden.</strong></i><br><br>';
$lang['guestbook']['entry']			= 'Eintrag';
$lang['guestbook']['entries']		= 'Eintr&auml;ge';
$lang['guestbook']['site']			= 'Seite';
$lang['guestbook']['sites']			= 'Seiten';
$lang['guestbook']['entriesinfo']	= 'Es gibt insgesamt {COUNT_ENTRIES} {ENTRIES} auf {COUNT_SITES} {SITES}.<br>';
$lang['guestbook']['switch']		= 'Umschalten zwischen Privat und &Ouml;ffentlich';
$lang['guestbook']['comment']		= 'Kommentar verfassen';
$lang['guestbook']['edit']			= 'Beitrag bearbeiten';
$lang['guestbook']['delete']		= 'Beitrag l&ouml;schen';
$lang['guestbook']['editinfo']		= 'Bearbeitet von <userid>{ADMIN}</userid> am {DATE} um {TIME} Uhr.';
$lang['guestbook']['preview']		= '<strong>Beitrags-Vorschau:</strong><br><div id="previewbox">'.
										'<div class="padding_4">{CONTENT_PREVIEW}</div></div><br><br>';
$lang['guestbook']['entrysaved']	= 'Der Eintrag wurde gespeichert.<br><br>'.
										'<a href="nickpage.php?site=guestbook&amp;showid={SHOWID}&amp;'.
										'senduid={SENDUID}&amp;sid={SID}&amp;auth={AUTH}">'.
										'Zur&uuml;ck zum G&auml;stebuch</a><br><br>';
$lang['guestbook']['commentsaved']	= 'Der Kommentar wurde gespeichert.<br><br>'.
										'<a href="nickpage.php?site=guestbook&amp;showid={SHOWID}&amp;'.
										'senduid={SENDUID}&amp;sid={SID}&amp;auth={AUTH}&amp;page={PAGE}">'.
										'Zur&uuml;ck zum G&auml;stebuch</a><br><br>';
$lang['guestbook']['commentlink']	= '<a href="{INSTALL}nickpage.php?'.
										'site=guestbook&amp;subsite=comment&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&amp;id={GB_ID}">'.
										'<img src="{STYLE}gfx/comment.gif" alt="'.$lang['guestbook']['comment'].
										'" title="'.$lang['guestbook']['comment'].'" border="0"></a>&nbsp; &nbsp; ';       
$lang['guestbook']['deletelink']	= '<a href="{INSTALL}nickpage.php?'.
										'site=guestbook&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&ac=delete&amp;id={GB_ID}">'.
										'<img src="{STYLE}gfx/delete.gif" alt="'.$lang['guestbook']['delete'].
										'" title="'.$lang['guestbook']['delete'].'" border="0"></a>&nbsp; &nbsp; ';       
$lang['guestbook']['switchlink']	= '<a href="{INSTALL}nickpage.php?'.
										'site=guestbook&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&ac=switch&amp;id={GB_ID}">'.
										'<img src="{STYLE}gfx/switch.gif" alt="'.$lang['guestbook']['switch'].
										'" title="'.$lang['guestbook']['switch'].'" border="0"></a>&nbsp; &nbsp; ';       

$lang['guestbook']['editlink']		= '<a href="{INSTALL}nickpage.php?'.
										'site=guestbook&amp;subsite=edit&amp;showid={SHOWID}&amp;senduid='.
										'{SENDUID}&amp;auth={AUTH}&amp;page={PAGE}&amp;sid={SID}&amp;id={GB_ID}">'.
										'<img src="{STYLE}gfx/edit.gif" alt="'.$lang['guestbook']['edit'].
										'" title="'.$lang['guestbook']['edit'].'" border="0"></a>&nbsp; &nbsp; ';       
#########################
# Fehlermeldungen
$lang['error']['session']			= 'Leider gibt es Probleme mit deiner SessionID.<br>'.
										'Ein Relogin in die Community k&ouml;nnte dieses Problem beheben.';
$lang['error']['sitenotavailable']	= 'Die angeforderte Seite ist nicht verfügbar.';
$lang['error']['nofriends']			= '<br><strong>Dieses Mitglied hat noch keine Freunde.</strong><br><br>';
$lang['error']['noslogan']			= '<br><strong>Dieses Mitglied hat kein Motto.</strong><br><br>';
$lang['error']['noobjects']			= '<br><strong>Dieses Mitglied besitzt noch keine Objekte.</strong><br><br>';
$lang['error']['nogbentries']		= '<strong>Es sind noch keine Eintr&auml;ge im G&auml;stebuch vorhanden!</strong><br><br>';
$lang['error']['npislocked']		= 'Diese Nickpage wurde von einem Administrator gesperrt!';
$lang['error']['gbislocked']		= 'Das Mitglied hat sein G&auml;stebuch abgesperrt!'; 	
$lang['error']['noselfentry']		= 'Du kannst dir nicht selbst einen G&auml;stebuch-Eintrag schreiben!';
$lang['error']['floodmsg']			= 'Du hast erst vor {LASTENTRYMINUTES} Minute(n) einen Eintrag geschrieben.<br>'.
										'Es kann nur alle {FLOODMINUTES} Minuten ein G&auml;stebucheintrag geschrieben werden!';
$lang['error']['nogbdata']			= 'Es wurde kein Beitrag verfasst!<br><br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck zum Formular</a><br><br>';  	
$lang['error']['nocomment']			= 'Du bist nicht berechtigt einen Kommentar zu diesem G&auml;stebuch-Eintrag zu schreiben!';
$lang['error']['unknowgbid']		= 'Unbekannte Beitrags-ID!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['nocommentdata']		= 'Es wurde kein Kommentar verfasst!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['noblogentry']		= 'Du bist nicht berechtigt hier einen Blog-Eintrag zu schreiben!';
$lang['error']['noblogdata']		= 'Es wurde kein Beitrag verfasst!<br><br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck zum Formular</a><br><br>';
$lang['error']['unknowblogid']		= 'Unbekannte Beitrags-ID!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['noblogentries']		= '<strong>Es sind noch keine Eintr&auml;ge im Blog vorhanden!</strong><br><br>';
$lang['error']['noblogedit']		= 'Du hast keine Berechtigung diesen Blog-Eintrag zu bearbeiten!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['nonewkat']			= 'Du hast keine Berechtigung hier eine Kategorie anzulegen!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['hasnokat']			= 'Du hast noch keine Bilder-Kategorie!<br>'.
										'Bevor du ein Bild in deine Galerie hochladen kanns, musst du erst eine Kategorie anlegen!<br><br>'.
										'<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=newcategory&amp;senduid={SENDUID}'.
										'&amp;showid={SHOWID}&amp;auth={AUTH}&amp;sid={SID}">Eine Kategorie anlegen</a><br><br>';
$lang['error']['noimages']			= '<br><center><strong>Es sind noch keine Bilder in der Galerie vorhanden.</strong></center><br><br>';
$lang['error']['notallowed']		= 'Du hast keine Berechtigung für dieses Bereich!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['nocattitle']		= 'Es wurde kein Titel für die Kategorie angegeben!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['unknowcatid']		= 'Unbekannte Kategorie-ID!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['maxcatcount']		= 'Leider kannst du keine weitere Kategorie mehr anlegen!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['maximgcount']		= 'Leider kannst du keine weiteren Bilder mehr in diese Kategorie hochladen!<br><br>'.
										'<a href="javascript:history.back(1)">Zur&uuml;ck</a><br><br>';
$lang['error']['noimagefile']		= 'Es wurde kein Bild ausgewählt!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['imagemaxsize']		= 'Das hochgeladene Bild ist zu gross!<br>'.
										'Das hochzuladende Bild darf max. '.$gal_max_width.' Pixel Breit und '.$gal_max_height.' Pixel hoch sein!<br><br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['wrongtype']			= 'Es dürfen nur Bilder in den Formaten JPG, JPEG, GIF oder PNG hochgeladen werden!<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['imgcantsave']		= 'Das Bild konnte leider nicht im Zielverzeichnis gespeichert werden.<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['takeacat']			= 'Bitte eine Kategorie auswählen, in der das Bild erscheinen soll.<br>'.
										'<a href="javascript:history.back(1);">Zur&uuml;ck</a><br><br>';
$lang['error']['nponlyfriends']		= 'Das Profil kann nur von Freunden angesehen werden!<br><br>';
$lang['error']['unknowuser']		= '<font color="#FF0000"><strong>Es existiert kein Mitglied mit dem Namen "{USERNAME}"!</strong></font>';
$lang['error']['nonamegiven']		= '<font color="#FF0000"><strong>Bitte einen Usernamen angeben!</strong></font>';
$lang['error']['isblockedinnp']		= 'Das Mitglied verweigert dir die Ansicht der Nickpage!';
$lang['error']['unknowuser2']		= '<strong>Dieses Mitglied existiert nicht!</strong>';
$lang['error']['noselfblock']		= '<font color="#FF0000"><strong>Du kannst dich nicht selbst blocken!</strong></font>';
$lang['error']['noadminblock']		= '<font color="#FF0000"><strong>Administratoren k&ouml;nnen nicht geblockt werden!</strong></font>';
$lang['error']['noguests']			= '<strong>G&auml;ste besitzen keine Berechtigung die Usernickpages zu betrachten!</strong>';
$lang['error']['hasblock']			= '<font color="#FF0000"><strong>Dieses Mitglied steht bereits in der Blockliste!</strong></font>';

?>