<?php
if (!function_exists('isDateInRange')) {
    function isDateInRange($date, $deadline_date) {
        $deadline_date_array = explode(",", $deadline_date);
        $deadline_date_array = array_filter($deadline_date_array, function($value) { return $value; });
        $is_date_in_range = false;

        foreach ($deadline_date_array as $value) {
            $date_array = explode("~", $value);
            $dateObj = new DateTime($date);
            $startObj = new DateTime($date_array[0]);
            $endObj = new DateTime($date_array[1]);

            if ($dateObj >= $startObj && $dateObj <= $endObj) {
                $is_date_in_range = true;
            }
        }

        return $is_date_in_range;
    }
}



function dowYoil($strdate)
{
	$yoil = array("일","월","화","수","목","금","토");
	$date= $strdate;

    $dow = $yoil[date('w',strtotime($date))];
    return $dow;
}
function viewSQ($textToFilter)
{		
		$textToFilter = str_replace('ins&#101rt','insert',$textToFilter);
		$textToFilter = str_replace('s&#101lect','select',$textToFilter);
		$textToFilter = str_replace('valu&#101s','values',$textToFilter);
		$textToFilter = str_replace('wher&#101','where',$textToFilter);
		$textToFilter = str_replace('ord&#101r','order',$textToFilter);
		$textToFilter = str_replace('int&#111','into',$textToFilter);
		$textToFilter = str_replace('dr&#111p','drop',$textToFilter);
		$textToFilter = str_replace('delet&#101','delete',$textToFilter);
		$textToFilter = str_replace('updat&#101','update',$textToFilter);
		$textToFilter = str_replace('s&#101t','set',$textToFilter);
		$textToFilter = str_replace('fl&#117sh','flush',$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('&#59',";",$textToFilter);
		$textToFilter = str_replace('&gt;',">",$textToFilter);
		$textToFilter = str_replace('&lt;',"<",$textToFilter);
		$textToFilter = str_replace('&#34',"\"",$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('&amp;',"&",$textToFilter);
		$textToFilter = str_replace('scr&#105pt'," ",$textToFilter);

		return $textToFilter;
}



?>