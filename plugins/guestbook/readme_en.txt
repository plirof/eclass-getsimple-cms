------------------------------------------------------
Guestbook for GetSimple Version README April 2013
------------------------------------------------------

Description and Features:
-------------------------
  -  This plugin adds a 'Guestbook' to any GetSimple page which records and displays visitors' comments.
  -  Visitors can reply to comments making threaded conversations.
  -  Comments are arranged into numbered pages.
  -  Comments are displayed in chronological or reverse chronological order.
  -  Comments are saved with separate backups. 
  -	 Email notifications of new comments
  -  Unwanted comments can be deleted through the GetSimple Admin Pages.
  -	 BBCode is supported for comment writing.
  -  Emoticons are supported in comments.
  -  Emoticons can be added to and deleted from the library or completely turned off.
  -  Guestbook appearance can be styled with standard CSS. 
  -  CAPTCHA is included to eliminate spam.
  -  It is possible to limit the number of characters of comments.
  
  
Installation:
-------------------------
  -  Upload the contents of the zip file to your /plugins folder.
  -  Contents of the zip file are as follows:
      * guestbook.php
      * folder guestbook:
         + .htaccess.
         + Creature.ttf.
         + comprueba.php
         + img_cpt.php
         + guestbook.css
         + backup.php
         + folder /img_emots
         + folder /lang
  -  Activate the plugin in Admin > Plugins.
	
	
Usage:
-------------------------
The guestbook can be inserted into the content of a GetSimple page with the shortcode:

	[example 1] (% guestbook cumbe,6,D,Y,Y %)
	
or it can be called in a template with php:

	[example 2] <?php sv_book('timbo', 5, 'I', 'N', 'N'); ?>
	
In both cases there are the same five parameters:

	1)	The username of the administrator who will receive email notifications.
	2)	The number of comments to show per page.
	3)	The order in which comments are shown; I (increasing) shows first comments first, D (decreasing) show most recent comments first.
	4)	Include CAPTCHA Y/N .
	5)	Include emoticons Y/N .
	
So [example 1], the shortcode in the content: (% guestbook cumbe,6,D,Y,Y %) gives a guestbook using cumbe's email for notifications, with 6 comments (and the replies) per page, most recent first, including CAPTCHA and with emoticons enabled.

And [example 2], the php tags in the template file: <?php sv_book('timbo', 5, 'I', 'N', 'N'); ?> gives a guestbook using timbo's email for notifications, with 5 comments (and the replies) per page, shown in the order they were posted, without CAPTCHA and with without emoticons.

NB While it is highly recommended that CAPTCHA is always used on a public website to make the guestbook inaccessible to spam robots Site Administrators should be aware of accessibility issues around the use of CAPTCHA - http://www.w3.org/TR/turingtest/ .

If no comments have been made Admin > Plugins > Guestbook will show the message "missing guestbook.log". The log file is created only when a visitor has left a comment in the Guestbook.

Emoticon files are stored in the folder /img_emots . Emoticons are simply animated gif files. Emoticons can be added to and deleted from the folder as required

If you want to limit the numbers of characters, you have that edit file guestbook/comprueba.php. In line 79
  $numberofchars = 0; 
change 0 by the number of characters that you want to limit.
Value = 0, has not limit.

Styling:
-------------------------

The CSS file for styling the Guestbook is /plugins/guestbook/guestbook.css .

In the first section of the css file four colour schemes have been pre-defined. Users can choose their preferred colour scheme and comment out ( using /* and */ ) or delete the others.

Languages:
-------------------------

The folder /lang contains 5 language files: es_ES, en_US, de_DE (thanks Connie), ru_RU (thanks oleg06), cz_CZ(thanks mirek). Language files can be added as they become available.
