<?php
// Kiểm tra đinh dang list gom chu va dau cach
function is_list($str) {
    return (!preg_match("/^[a-zA-Z ]*$/", $str)) ? FALSE : TRUE;
}
?>