<?php
/*
Plugin Name: Spoiler Button
Description: Adds "[spoiler]Spoiler Text[/spoiler]" Tags
Version: 1.9
Author: ePirat
Author URI: http://www.epirat.de/
*/

// Get the correct ID for plugin
$thisfile=basename(__FILE__, ".php");
// Register plugin
register_plugin(
	$thisfile, 
	'Spoiler Button', 	
	'1.9', 		
	'ePirat',
	'http://www.epirat.de/', 
	'Adds [spoiler][/spoiler] (BBCode Style)',
	'plugins',
	'spoiler_settings_display'  
);
// Register hooks and filters
add_action('theme-header','code');
add_filter('content','spoiler_button_display');
add_action('plugins-sidebar','createSideMenu',array($thisfile,'Spoiler Settings'));
// Hook and filter functions

// Display Settings Page function
function spoiler_settings_display(){
    $errors = array();
    if (!empty($_POST)){
        if (!isset($_POST['dtype'])){
            $errors[] = "Please select a Display Type";
        }
        if (!isset($_POST['after'])){
            $after = false;
        } else {
            $after = true;
        }
        if ( (!isset($_POST['showtext'])) OR (empty($_POST['showtext'])) ){
            $errors[] = "Please enter a default show text.";
        }
        if (count($errors) == 0){
            $xml = new SimpleXMLElement('<settings></settings>');
            $xml->addChild('dtype', $_POST['dtype']);
            $xml->addChild('after', $after);
            $xml->addChild('showtext', $_POST['showtext']);
            $xml->addChild('hidetext', $_POST['hidetext']);
            $xml->addChild('clbtn', $_POST['clbtn']);
            $xml->addChild('cldiv', $_POST['cldiv']);
            if (!file_exists(GSDATAOTHERPATH."spoiler/")){
                mkdir(GSDATAOTHERPATH."spoiler/");  
            }
            $xml->asXML(GSDATAOTHERPATH."spoiler/settings.xml");
        }
        ?>
        <div class="updated">Settings Saved.</div>
        <!-- TODO: Error Message?! -->
        <?php
    }
        if (file_exists(GSDATAOTHERPATH."spoiler/settings.xml")){
            $xml = new SimpleXMLElement(GSDATAOTHERPATH."spoiler/settings.xml", 0, true);
        } else {
            $xml = (object) array();
            $xml->dtype = "Button";
            $xml->after = false;
            $xml->showtext = "Show Spoiler";
            $xml->hidetext = "Hide Spoiler";
            $xml->cldiv = "spoiler";
        }
        if (!isset($xml->cldiv) or empty($xml->cldiv)){
            $xml->cldiv = "spoiler";
        }
        if (!isset($xml->clbtn) or empty($xml->clbtn)){
            $xml->clbtn = "spoilerbtn";
        }
        ?>
        <h2>Spoiler Plugin Settings</h2>
        <form method="post" action="">
        <h3>Display Type:</h3>
        <p>
        <!-- Spoiler type (Button/Link) and before/after -->
        <input type="radio" name="dtype" value="Link" <?php if($xml->dtype == "Link"){ echo('checked="checked"'); } ?> /> Link<br />
        <input type="radio" name="dtype" value="Button" <?php if($xml->dtype == "Button"){ echo('checked="checked"'); } ?> /> Button<br />
        <input type="checkbox" name="after" value="true" <?php if($xml->after == True){ echo('checked="checked"'); } ?> /> Show Link/Button after spoiler</p>

        <h3>Default Text:</h3>
        <table>
        <tr>
        <td valign="middle">Show: </td>
        <td valign="middle"><input type="text" class="text short" name="showtext" value="<?php echo($xml->showtext); ?>" /></td>
        </tr>
        <tr>
        <td valign="middle">Hide: </td>
        <td valign="middle"><input type="text" class="text short" name="hidetext" value="<?php echo($xml->hidetext); ?>" /></td>
        </tr>
        </table>
        <h3>Classes:</h3>
        <table>
            <tr>
                <td valign="middle">Button:</td>
                <td valign="middle"><input type="text" class="text short" name="clbtn" value="<?php echo($xml->clbtn); ?>"></td>
            </tr>
            <tr>
                <td valign="middle">Div:</td>
                <td valign="middle"><input type="text" class="text short" name="cldiv" value="<?php echo($xml->cldiv); ?>"></td>
            </tr>
        </table>
        <input type="submit" value=" Save ">
        </form>
        <?php
}

// Main function
function code(){
	global $content;
	global $xml;
    if (file_exists(GSDATAOTHERPATH."spoiler/settings.xml")){
            $xml = new SimpleXMLElement(GSDATAOTHERPATH."spoiler/settings.xml", 0, true);
    } else {
        $xml = (object) array();
        $xml->dtype = "Button";
        $xml->after = false;
        $xml->showtext = "Show Spoiler";
        $xml->hidetext = "Hide Spoiler";
        $xml->cldiv = "spoiler";
    }
    if (!isset($xml->cldiv) or empty($xml->cldiv)){
        $xml->cldiv = "spoiler";
    }
    // Only inject code if necesary
	if (preg_match('/\[spoiler(?:=([^]]+))?\](.*?)\[\/spoiler\]/s', $content)){
		?>
		<!-- JavaScripts -->

        <script type="text/javascript">
        
        
        (function(){

            var DomReady = window.DomReady = {};

        	// Everything that has to do with properly supporting our document ready event. Brought over from the most awesome jQuery. 

            var userAgent = navigator.userAgent.toLowerCase();

            // Figure out what browser is being used
            var browser = {
            	version: (userAgent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [])[1],
            	safari: /webkit/.test(userAgent),
            	opera: /opera/.test(userAgent),
            	msie: (/msie/.test(userAgent)) && (!/opera/.test( userAgent )),
            	mozilla: (/mozilla/.test(userAgent)) && (!/(compatible|webkit)/.test(userAgent))
            };    

        	var readyBound = false;	
        	var isReady = false;
        	var readyList = [];

        	// Handle when the DOM is ready
        	function domReady() {
        		// Make sure that the DOM is not already loaded
        		if(!isReady) {
        			// Remember that the DOM is ready
        			isReady = true;

        	        if(readyList) {
        	            for(var fn = 0; fn < readyList.length; fn++) {
        	                readyList[fn].call(window, []);
        	            }

        	            readyList = [];
        	        }
        		}
        	};

        	// From Simon Willison. A safe way to fire onload w/o screwing up everyone else.
        	function addLoadEvent(func) {
        	  var oldonload = window.onload;
        	  if (typeof window.onload != 'function') {
        	    window.onload = func;
        	  } else {
        	    window.onload = function() {
        	      if (oldonload) {
        	        oldonload();
        	      }
        	      func();
        	    }
        	  }
        	};

        	// does the heavy work of working through the browsers idiosyncracies (let's call them that) to hook onload.
        	function bindReady() {
        		if(readyBound) {
        		    return;
        	    }

        		readyBound = true;

        		// Mozilla, Opera (see further below for it) and webkit nightlies currently support this event
        		if (document.addEventListener && !browser.opera) {
        			// Use the handy event callback
        			document.addEventListener("DOMContentLoaded", domReady, false);
        		}

        		// If IE is used and is not in a frame
        		// Continually check to see if the document is ready
        		if (browser.msie && window == top) (function(){
        			if (isReady) return;
        			try {
        				// If IE is used, use the trick by Diego Perini
        				// http://javascript.nwbox.com/IEContentLoaded/
        				document.documentElement.doScroll("left");
        			} catch(error) {
        				setTimeout(arguments.callee, 0);
        				return;
        			}
        			// and execute any waiting functions
        		    domReady();
        		})();

        		if(browser.opera) {
        			document.addEventListener( "DOMContentLoaded", function () {
        				if (isReady) return;
        				for (var i = 0; i < document.styleSheets.length; i++)
        					if (document.styleSheets[i].disabled) {
        						setTimeout( arguments.callee, 0 );
        						return;
        					}
        				// and execute any waiting functions
        	            domReady();
        			}, false);
        		}

        		if(browser.safari) {
        		    var numStyles;
        			(function(){
        				if (isReady) return;
        				if (document.readyState != "loaded" && document.readyState != "complete") {
        					setTimeout( arguments.callee, 0 );
        					return;
        				}
        				if (numStyles === undefined) {
        	                var links = document.getElementsByTagName("link");
        	                for (var i=0; i < links.length; i++) {
        	                	if(links[i].getAttribute('rel') == 'stylesheet') {
        	                	    numStyles++;
        	                	}
        	                }
        	                var styles = document.getElementsByTagName("style");
        	                numStyles += styles.length;
        				}
        				if (document.styleSheets.length != numStyles) {
        					setTimeout( arguments.callee, 0 );
        					return;
        				}

        				// and execute any waiting functions
        				domReady();
        			})();
        		}

        		// A fallback to window.onload, that will always work
        	    addLoadEvent(domReady);
        	};

        	// This is the public function that people can use to hook up ready.
        	DomReady.ready = function(fn, args) {
        		// Attach the listeners
        		bindReady();

        		// If the DOM is already ready
        		if (isReady) {
        			// Execute the function immediately
        			fn.call(window, []);
        	    } else {
        			// Add the function to the wait list
        	        readyList.push( function() { return fn.call(window, []); } );
        	    }
        	};

        	bindReady();

        })();
        
        
        
        
        /*
            Developed by Robert Nyman, http://www.robertnyman.com
            Code/licensing: http://code.google.com/p/getelementsbyclassname/
        */  
var getElementsByClassName = function (className, tag, elm){
    if (document.getElementsByClassName) {
        getElementsByClassName = function (className, tag, elm) {
            elm = elm || document;
            var elements = elm.getElementsByClassName(className),
                nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
                returnElements = [],
                current;
            for(var i=0, il=elements.length; i<il; i+=1){
                current = elements[i];
                if(!nodeName || nodeName.test(current.nodeName)) {
                    returnElements.push(current);
                }
            }
            return returnElements;
        };
    }
    else if (document.evaluate) {
        getElementsByClassName = function (className, tag, elm) {
            tag = tag || "*";
            elm = elm || document;
            var classes = className.split(" "),
                classesToCheck = "",
                xhtmlNamespace = "http://www.w3.org/1999/xhtml",
                namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
                returnElements = [],
                elements,
                node;
            for(var j=0, jl=classes.length; j<jl; j+=1){
                classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
            }
            try {
                elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
            }
            catch (e) {
                elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
            }
            while ((node = elements.iterateNext())) {
                returnElements.push(node);
            }
            return returnElements;
        };
    }
    else {
        getElementsByClassName = function (className, tag, elm) {
            tag = tag || "*";
            elm = elm || document;
            var classes = className.split(" "),
                classesToCheck = [],
                elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
                current,
                returnElements = [],
                match;
            for(var k=0, kl=classes.length; k<kl; k+=1){
                classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
            }
            for(var l=0, ll=elements.length; l<ll; l+=1){
                current = elements[l];
                match = false;
                for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
                    match = classesToCheck[m].test(current.className);
                    if (!match) {
                        break;
                    }
                }
                if (match) {
                    returnElements.push(current);
                }
            }
            return returnElements;
        };
    }
    return getElementsByClassName(className, tag, elm);
};
            DomReady.ready(function () {
                var spoilers = getElementsByClassName("<?php echo($xml->cldiv); ?>");
                for (var i = spoilers.length - 1; i >= 0; i--) {
                    (function () {
                        var spoiler = spoilers[i];
                        spoiler.style.display = "none";
                        var name = getElementsByClassName("spoilerbuttonname", "", spoiler);
                        switch (name.length) {
							case 0:
    							name = "<?php echo($xml->showtext) ?>";
    							nameh = "<?php echo($xml->hidetext) ?>";
    							break;
    						case 1:
    							name = name[0].innerHTML;
    							nameh = name;
    							break;
    						case 2:
    							var nameh = name[1].innerHTML;
    							name = name[0].innerHTML;
    							break;
						}
                        <?php if($xml->dtype == "Button"): ?>
                        var button = document.createElement("button");
                        <?php else: ?>
                        var button = document.createElement("a");
                        button.setAttribute("href","#");
                        <?php endif; ?>
                        button.innerHTML = name;
                        <?php if(isset($xml->clbtn) and !empty($xml->clbtn)): ?>
                            button.setAttribute("class","<?php echo($xml->clbtn); ?>");
                        <?php endif; ?>
                        <?php if($xml->after == True): ?>
                        spoiler.parentNode.insertBefore(button, spoiler.nextSibling);
                        <?php else: ?>
                        spoiler.parentNode.insertBefore(button, spoiler);
                        <?php endif; ?>
                        try {
                        button.addEventListener("click", function (event) {
                            if (spoiler.style.display !== "none") {
                                spoiler.style.display = "none";
                                button.innerHTML = name;
                            } else {
                                spoiler.style.display = "block";
                                spoiler.style.backgroundColor = "transparent";
                                button.innerHTML = nameh;
                            }
							event.preventDefault();
                        }, false);
                        } catch (e) {
                            button.attachEvent("onclick", function (event) {
                                if (spoiler.style.display !== "none") {
                                    spoiler.style.display = "none";
                                    button.innerHTML = name;
                                } else {
                                    spoiler.style.display = "block";
                                    spoiler.style.backgroundColor = "transparent";
                                    button.innerHTML = nameh;
                                }
                                return false;
                            });
                        }
                        
                    }());
                }
            });
        </script>
		<style type="text/css">
		<!--
		div.spoiler:hover { background-color: transparent; }
		div.spoiler { background-color: #333; color: #333; }
		div.spoiler img { visibility: hidden; }
		div.spoiler:hover img { visibility: hidden; }
		-->
		</style>
		<?php
	}
}

function spoiler_button_display($content)
{
		// This regex is from iszak (freenode #regex channel)
		$content = preg_replace_callback("/\[spoiler(?:=(.*?))?\](.*?)\[\/spoiler\]/s", "replika", $content);
		return $content;
}
function replika($cont) {
    global $xml;
	$string = "<div class=\"".$xml->cldiv."\">";
	if (!empty($cont[1])){
		$split = explode("|||", $cont[1], 2); // TODO: Do this better! Horrible!
		foreach ($split as $splitted){
			$string .= "<p class=\"spoilerbuttonname\" style=\"display: none;\">".$splitted."</p>";
		}
	}
	$string .= "<p class=\"spoilertextcont\">".$cont[2]."</p></div>";
	return $string;
}
?>