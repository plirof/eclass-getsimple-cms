<?php
			$myform .= '<img class="bbc" title="'.i18n_r('guestbook/bold').'" src="'.$SITEURL.'plugins/guestbook/images/bbc/bold.gif" onClick="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[b]&quot; , &quot;[/b]&quot;)" />';
			$myform .= '<img class="bbc" title="'.i18n_r('guestbook/italic').'" src="'.$SITEURL.'plugins/guestbook/images/bbc/italica.gif" onClick="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[i]&quot; , &quot;[/i]&quot;)" />';
			$myform .= '<img class="bbc" title="'.i18n_r('guestbook/underline').'" src="'.$SITEURL.'plugins/guestbook/images/bbc/underline.gif" onClick="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[u]&quot; , &quot;[/u]&quot;)" />';
			$myform .= '<img class="bbc_d" src="'.$SITEURL.'plugins/guestbook/images/bbc/divider.gif" />';
			$myform .= '<img class="bbc" title="'.i18n_r('guestbook/link').' '.i18n_r('guestbook/img').'" src="'.$SITEURL.'plugins/guestbook/images/bbc/img.gif" onClick="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[img]&quot; , &quot;[/img]&quot;)" />';
			$myform .= '<img class="bbc" title="'.i18n_r('guestbook/link').'" src="'.$SITEURL.'plugins/guestbook/images/bbc/url.gif" onClick="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[url]&quot; , &quot;[/url]&quot;)" />';
			$myform .= '<img class="bbc_d" src="'.$SITEURL.'plugins/guestbook/images/bbc/divider.gif" />';
			$myform .= '<select name="bbc_color" id="bbc_color'.$count.'" onChange="javascript:imgbbcode(&quot;textarea'.$count.'&quot;,&quot;[color=&quot; , &quot;select&quot;)">';
				$myform .= '<option value="">'.i18n_r('guestbook/color').'</option>';
				$myform .= '<option value="black">'.i18n_r('guestbook/black').'</option>';
				$myform .= '<option value="red">'.i18n_r('guestbook/red').'</option>';
				$myform .= '<option value="yellow">'.i18n_r('guestbook/yellow').'</option>';
				$myform .= '<option value="pink">'.i18n_r('guestbook/pink').'</option>';
				$myform .= '<option value="green">'.i18n_r('guestbook/green').'</option>';
				$myform .= '<option value="orange">'.i18n_r('guestbook/orange').'</option>';
				$myform .= '<option value="purple">'.i18n_r('guestbook/purple').'</option>';
				$myform .= '<option value="blue">'.i18n_r('guestbook/blue').'</option>';
				$myform .= '<option value="beige">'.i18n_r('guestbook/beige').'</option>';
				$myform .= '<option value="brown">'.i18n_r('guestbook/brown').'</option>';
				$myform .= '<option value="teal">'.i18n_r('guestbook/teal').'</option>';
				$myform .= '<option value="navy">'.i18n_r('guestbook/teal').'</option>';
				$myform .= '<option value="maroon">'.i18n_r('guestbook/maroon').'</option>';
				$myform .= '<option value="limegreen">'.i18n_r('guestbook/limegreen').'</option>';
				$myform .= '<option value="white">'.i18n_r('guestbook/white').'</option>';
			$myform .= '</select>';
?>
