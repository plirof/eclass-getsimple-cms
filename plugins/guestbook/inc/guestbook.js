<script type="text/javascript">
<!--

	function Insertcom(id){
		var frm=document.getElementById(id);
		if(frm.style.display=="block"){
			frm.style.display="none";
		}
		else
		if(frm.style.display=="none"){
				frm.style.display="block";
		}
	}

	function Smile(id,texto){
		var frm=document.getElementById(id);
		frm.comentario.value = frm.comentario.value + texto;
	}

	function rec_cpt(id,ourl){
		var aleat = Math.random();
		var mf = document.getElementById(id);
		mf.src = ourl + "/guestbook/&" + aleat;
	}

	function imgbbcode(id, action1, action2){
		if (action2 == 'select'){
			var count = id.substr(8, id.lenght);
			var select = document.getElementById('bbc_color'+count);
			if (select.options[select.selectedIndex].value == "") { exit;}
			action1 = action1 + select.options[select.selectedIndex].value + "]";
			action2 = "[/color]";
		}
		var txt=document.getElementById(id);
		if ('selectionStart' in txt) {
			// check whether some text is selected in the textarea: http://help.dottoro.com/ljtfkhio.php
                	if (txt.selectionStart != txt.selectionEnd) {
				//there is selection
				selection = txt.value.substring(txt.selectionStart, txt.selectionEnd);
                    		var newText = txt.value.substring (0, txt.selectionStart) + action1 + txt.value.substring(txt.selectionStart, txt.selectionEnd) + action2 + txt.value.substring(txt.selectionEnd);
				txt.value = newText;
			} else {
				//there is not selection
				if (action2 == '[/img]') {
					var img_link = prompt("<?php echo i18n_r('guestbook/url'); ?>","http://");
					//if (img_link != null && img_link != "http://") {
					if (img_link != null) {
						action1 = '[img]' + img_link;
					} else {
						action1 = "";
						action2 = "";
					}
				} else if (action2 == '[/url]') {
					var url_link = prompt("<?php echo i18n_r('guestbook/url'); ?>","http://");
					var url_text = prompt("<?php echo i18n_r('guestbook/urlbbc'); ?>","");
					if (url_text == null || url_text == ''){
						url_text = url_link;
					}
					if (url_link != null && url_link != "http://"){
						action1 = '[url=' + url_link + ']' + url_text;
					} else {
						action1 = "";
						action2 = "";
						alert ("<?php echo i18n_r('guestbook/urlbbc_n'); ?>");
					}
				}
				txt.value = txt.value + action1 + action2;
			}
		} else {  // Internet Explorer before version 9
			// create a range from the current selection
                	var textRange = document.selection.createRange ();
                    	// check whether the selection is within the textarea
               		var rangeParent = textRange.parentElement ();
                	if (rangeParent === txt) {
				//there is selection
                    		textRange.text = action1 + textRange.text + action2;
			} else {
				//there is not selection
				if (action2 == '[/img]') {
					var img_link = prompt("URL:?","http://");
					if (img_link != null) {
						action1 = '[img]' + img_link;
					} else {
						action1 = "";
						action2 = "";
					}
				} else if (action2 == '[/url]') {
					var url_link = prompt("<?php echo i18n_r('guestbook/url'); ?>","http://");
					var url_text = prompt("<?php echo i18n_r('guestbook/urlbbc'); ?>","");
					if (url_text == null || url_text == ''){
						url_text = url_link;
					}
					if (url_link != null && url_link != "http://"){
						action1 = '[url=' + url_link + ']' + url_text;
					} else {
						action1 = "";
						action2 = "";
						alert ("<?php echo i18n_r('guestbook/urlbbc_n'); ?>");
					}
				}
				txt.value = txt.value + action1 + action2;
			}
		} 
	}

-->
</script>
