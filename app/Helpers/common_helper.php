<?

function updateSQ($textToFilter)
{
    //a = &#97;
    //e = &#101;
    //i = &#105;
    //o = &#111;
    //u  = &#117;

    //A = &#65;
    //E = &#69;
    //I = &#73;
    //O = &#79;
    //U = &#85;
    if ($textToFilter != null) {
        $textToFilter = str_replace('insert', 'ins&#101rt', $textToFilter);
        $textToFilter = str_replace('select', 's&#101lect', $textToFilter);
        $textToFilter = str_replace('values', 'valu&#101s', $textToFilter);
        $textToFilter = str_replace('where', 'wher&#101', $textToFilter);
        $textToFilter = str_replace('order', 'ord&#101r', $textToFilter);
        $textToFilter = str_replace('into', 'int&#111', $textToFilter);
        $textToFilter = str_replace('drop', 'dr&#111p', $textToFilter);
        $textToFilter = str_replace('delete', 'delet&#101', $textToFilter);
        $textToFilter = str_replace('update', 'updat&#101', $textToFilter);
        $textToFilter = str_replace('set', 's&#101t', $textToFilter);
        $textToFilter = str_replace('flush', 'fl&#117sh', $textToFilter);
        $textToFilter = str_replace("'", "''", $textToFilter);
        $textToFilter = str_replace('"', "&#34", $textToFilter);
        $textToFilter = str_replace('>', "&gt;", $textToFilter);
        $textToFilter = str_replace('<', "&lt;", $textToFilter);
        $textToFilter = str_replace('script', 'scr&#105pt', $textToFilter);
        //	$textToFilter = nl2br($textToFilter);
        $filterInputOutput = $textToFilter;
        return trim($filterInputOutput);
    }

}

function viewSQ($textToFilter)
{
    $textToFilter = str_replace('ins&#101rt', 'insert', $textToFilter);
    $textToFilter = str_replace('s&#101lect', 'select', $textToFilter);
    $textToFilter = str_replace('valu&#101s', 'values', $textToFilter);
    $textToFilter = str_replace('wher&#101', 'where', $textToFilter);
    $textToFilter = str_replace('ord&#101r', 'order', $textToFilter);
    $textToFilter = str_replace('int&#111', 'into', $textToFilter);
    $textToFilter = str_replace('dr&#111p', 'drop', $textToFilter);
    $textToFilter = str_replace('delet&#101', 'delete', $textToFilter);
    $textToFilter = str_replace('updat&#101', 'update', $textToFilter);
    $textToFilter = str_replace('s&#101t', 'set', $textToFilter);
    $textToFilter = str_replace('fl&#117sh', 'flush', $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('&#59', ";", $textToFilter);
    $textToFilter = str_replace('&gt;', ">", $textToFilter);
    $textToFilter = str_replace('&lt;', "<", $textToFilter);
    $textToFilter = str_replace('&#34', "\"", $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('&amp;', "&", $textToFilter);
    $textToFilter = str_replace('scr&#105pt', " ", $textToFilter);

    return $textToFilter;
}

function updateSQText($textToFilter)
{
    //a = &#97;
    //e = &#101;
    //i = &#105;
    //o = &#111;
    //u  = &#117;

    //A = &#65;
    //E = &#69;
    //I = &#73;
    //O = &#79;
    //U = &#85;
    if ($textToFilter != null) {
        $textToFilter = str_replace('insert', 'ins&#101rt', $textToFilter);
        $textToFilter = str_replace('select', 's&#101lect', $textToFilter);
        $textToFilter = str_replace('values', 'valu&#101s', $textToFilter);
        $textToFilter = str_replace('where', 'wher&#101', $textToFilter);
        $textToFilter = str_replace('order', 'ord&#101r', $textToFilter);
        $textToFilter = str_replace('into', 'int&#111', $textToFilter);
        $textToFilter = str_replace('drop', 'dr&#111p', $textToFilter);
        $textToFilter = str_replace('delete', 'delet&#101', $textToFilter);
        $textToFilter = str_replace('update', 'updat&#101', $textToFilter);
        $textToFilter = str_replace('set', 's&#101t', $textToFilter);
        $textToFilter = str_replace('flush', 'fl&#117sh', $textToFilter);
        $textToFilter = str_replace("'", "''", $textToFilter);
        $textToFilter = str_replace('"', "&#34", $textToFilter);
        $textToFilter = str_replace('>', "&gt;", $textToFilter);
        $textToFilter = str_replace('<', "&lt;", $textToFilter);
        $textToFilter = str_replace('script', 'scr&#105pt', $textToFilter);
        $textToFilter = strip_tags($textToFilter);
        //	$textToFilter = nl2br($textToFilter);
        $filterInputOutput = $textToFilter;
        return trim($filterInputOutput);
    }

}

function get_korean_day(date)
{
		 $weekdays  = ['일', '월', '화', '수', '목', '금', '토'];
		 $dowIndex  = date('w', strtotime($date));									
		 $dateDow   = $weekdays[$dowIndex];								
		 
		 return $dateDow;
}	

?>