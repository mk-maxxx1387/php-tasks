<?php

class HtmlHelper {
	public static function getSelect($vals, $selVal = ''){
        if(!is_array($vals)){
            return FALSE;
        }
        //$cnt = count($vals)+1;
        $select = "";
        foreach($vals as $val){
        	if ($selVal == $val) {
        		$select .= "<option selected value='$val'>$val</option>";
        	} else {
        		$select .= "<option value='$val'>$val</option>";
        	}
        }
        return $select;
    }
}