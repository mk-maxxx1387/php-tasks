<?php
include("config/config.php");
class HtmlHelper {
    public static function getRadioGroup($vals, $title = null, $name = null, $checkedId = null){
        if(!isset($title)){
            $title = RBG_TITLE;
        }
        if(!isset($name)){
            $name = RBG_NAME;
        }

        $radios = "<fieldset>";
        $radios .= "<legend>$title</legend>";

        $inpStr = "<input name='$name' type='radio'";
        if(is_array($vals)){
            for($i = 0; $i < count($vals); $i++){
                $radios .= "<p>$inpStr value='$vals[$i]' ";
                if($i === $checkedId-1){
                    $radios .= 'checked';
                }
                $radios .= "> $vals[$i]</p>";
            }
        }
        $radios .= "</fieldset>";
        return $radios;
    }

    public static function getCheckboxes($title, $name, $vals, $checked){
        $checks = "<fieldset>";
        $checks .= "<legend>$title</legend>";

        $inpStr = "<p><input type='checkbox' name='$name' ";

        if(is_array($vals) && is_array($checked)){
            for($i = 0; $i < count($vals); $i++){
                $checks .= "$inpStr value='$vals[$i]' ";
                if(in_array($i+1, $checked)){
                    $checks .= "checked ";
                }
                $checks .= "> $vals[$i]</p>";
            }
            $checks .= "</fieldset>";
            return $checks;
        }
        return FALSE;
    }

    public static function getTable($head, $trs){
        $table = "<table border='1'>";
        $theadClass = THEAD_CL;

        if(is_array($head) && is_array($trs)){
            $table .= "<tr>";
            foreach($head as $th){
                $table .= "<th>$th</th>";
            }
            foreach($trs as $tr){
                $table .= "<tr>";
                foreach($tr as $td){
                    $table .= "<td>$td</td>";
                }
                $table .= "</tr>";
            }
            $table .= "</table>";
            return $table;
        }
        return FALSE;
    }

    public static function getSelectMulti($name, $vals){
        if(!is_array($vals)){
            return FALSE;
        }
        $cnt = count($vals)+1;
        $select = "<select size='$cnt' multiple name='$name"."[]'>";
        $select .= "<option disabled> --Select elements-- </option>";
        foreach($vals as $val){
            $select .= "<option value='$val'>$val</option>";
        }
        $select .= "</select>";
        return $select;
    }

    public static function getUlOl($ulOl){
        $ulClass = UL_CL;
        $liClass = LI_CL;
        $type = UL_TYPE;
        $list = "<ul type='$type' class='$ulClass'>";
        if(is_array($ulOl)){
            foreach($ulOl as $country => $marks){
                $list .= "<li class='$liClass'>$country</li>";
                $list .= "<ol>";
                foreach($marks as $mark){
                    $list .= "<li>$mark</li>";
                }
                $list .= "</ol>";
            }
            $list .= "</ul>";
            return $list;
        }
        return FALSE;
    }

    public static function getDlDtDd($dtDd){
        $dlClass = DL_CL;
        $dtClass = DT_CL;
        $ddClass = DD_CL;

        $dl .= "<dl class='$dlClass'>";
        if(is_array($dtDd)){
            foreach($dtDd as $dt => $dd){
                
                $dl .= "<dt class='$dtClass'><b>$dt</b></dt>";
                $dl .= "<dd class='$ddClass'>$dd</dd>";
            }
            $dl .= "</dl>";
            return $dl;
        }
        return FALSE;
    }
}
