<?php
$password="1234";
// configuration
$url = '';
$file = 'getsimple_eclass_C-ST.html'; //might require REAL PATH

// check if form has been submitted
if (isset($_POST['text']) && $_POST['pass']==$password)
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<form action="" method="post">
<input type="submit" />
<input type="reset" /><br>
<textarea cols=100 rows=50 name="text"><?php echo htmlspecialchars($text) ?></textarea>
<BR>Password:<input type="password" name="pass" /></br>
<input type="submit" />
<input type="reset" />
</form>