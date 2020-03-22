<?php
	// $cada =  registers by page
	// $num = total number of registers 
	// $pagTotal = total pages, rounded up to the next highest. 
	$pagTotal = ceil($num/$cada);
	// Set $pagActual = current page from parameter 'pag' of URL
	// $pagAnterior = previous page of current
	// $pagSiguiente = next page of current
	if (!isset($_GET['pag'])) {
		$pagActual = 1;
		$pagi = 1;
	} else {
		$pagActual = $_GET['pag'];
		$pagi = $_GET['pag'];
	}
	$pagAnterior = $pagActual - 1;
	$pagSiguiente = $pagActual + 1;

	$paginator = '<!-- paginator --><div id="paginator">'."\n";
	$paginator .= '<span id="navigator">'.i18n_r('guestbook/Pag').'</span>'."\n";

		$pgIntervalo = 2; // number of pages, before and after of current page
		$pgMaximo = ($pgIntervalo*2)+1; // Maximum number of pages in pagination
		$pg = (($pagActual-$pgIntervalo)<=0) ? '2' : (($pagActual-$pgIntervalo)>($pagTotal-$pgMaximo) ? ($pagTotal-$pgMaximo) : ($pagActual-$pgIntervalo));
		$i = 0;

		//Previous page
		if ($pagActual > 1) {
			$paginator .= '<a class="prev" href="'.$idpret.'&amp;pag='.$pagAnterior.'" title="'.i18n_r('guestbook/Prever').'"> '.i18n_r('guestbook/Prev').' </a>'."\n";
		}

		//First page = 1
		$activ = ($pagActual == 1) ? 'class="activ"' : '';
		$paginator .= '<a '.$activ.' href="'.$idpret.'&amp;pag=1" title="'.i18n_r('guestbook/firstpage').'">1</a>'."\n";

		//separation only if first interval is out
		if ($pagAnterior > 3 && ($pagTotal) > 7){ $paginator .= '<span class="point">'.i18n_r('guestbook/separate').'</span>'; }

		//List of pages 
		while ($i<$pgMaximo) {
			$activ = ($pg == $pagActual) ? 'class="activ"' : '';
			if ($pg>1 and $pg<$pagTotal) {
				$paginator .=  '<a '.$activ.' href="'.$idpret.'&amp;pag='.$pg.'">'.$pg.'</a>'."\n";
				$i++;
			}
			if ($pg > $pagTotal) {$i = $pgMaximo;} 
			$pg++;
		}

		//Separation only if last interval is out
		if (($pagTotal - $pagSiguiente) > 2 && ($pagTotal) > 7){ 
			$paginator .=  '<span class="point">'.i18n_r('guestbook/separate').'</span>'."\n"; 
		}

		//Last page
		if ($pagTotal > 1){
			$activ = ($pagActual == $pagTotal) ? 'class="activ"' : '';
			$paginator .= '<a '.$activ.' href="'.$idpret.'&amp;pag='.$pagTotal.'" title="'.i18n_r('guestbook/lastpage').'">'.$pagTotal.'</a>'."\n";
		}

		//Next page
		if ($pagActual < $pagTotal) {
			$paginator .= '<a class="next" href="'.$idpret.'&amp;pag='.$pagSiguiente.'" title="'.i18n_r('guestbook/Nexter').'"> '.i18n_r('guestbook/Next').' </a>'."\n";
		}

	$paginator .= '</div><!-- end paginator -->'."\n";
?>
