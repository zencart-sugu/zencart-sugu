<html>




<?php
$n = count($_SESSION['navigation']->path);
$unsecure = $_SESSION['navigation']->snapshot['page'];
$cPath = isset($_SESSION['navigation']->snapshot['get']['cPath'])? 'cPath='.$_SESSION['navigation']->snapshot['get']['cPath']:"";
foreach($_SESSION['navigation']->snapshot['get'] as $key=>$value){
    $get = $key."=".$value;
    break;
}
if($_SESSION['last_secure_page'] == FILENAME_PRODUCT_REVIEWS_WRITE){
    foreach($_SESSION['navigation']->path as $i){
        foreach($i as $key=>$value){
            if(($key == 'page') && ($value == FILENAME_PRODUCT_REVIEWS_WRITE)){
                $get = "";
                foreach($i['get'] as $key2=>$value2){
                    if($key2 != "zenid"){
                        $get .= $key2."=".$value2."&";
                    }
                }
            }
        }
    }
}

if(!isset($_GET['confirm'])){
    if($_SESSION['last_secure_page'] != FILENAME_TELL_A_FRIEND){
        echo TEXT_LOGOUT_CONFIRM_DESCRIPTION;
        echo "<br><br>";
        echo "&#xE6E2;<a href =".zen_href_link(FILENAME_LOGOUT_CONFIRM, 'confirm=1', 'SSL')." accesskey=1>".TEXT_LOGOUT_CONFIRM_YES."</a>";
        echo "<BR>";
        echo "&#xE6E3;<a href =".zen_href_link(FILENAME_LOGOUT_CONFIRM, 'confirm=0', 'SSL')." accesskey=2>".TEXT_LOGOUT_CONFIRM_NO."</a>";
    }else{
        /*
        foreach($_SESSION['navigation']->path as $i){
            foreach($i as $key => $value){
                if(($key == 'page') && ($value == FILENAME_TELL_A_FRIEND)){
                    foreach($i['post'] as $key2 => $name){
                        if($key2 == 'to_name'){
                            $mail_success = sprintf(TEXT_EMAIL_SUCCESSFUL_SENT_MOBILE,$name);
                        }
                    }
                }
            }
        }
        */
        $_SESSION['last_secure_page'] = $unsecure;
        $_SESSION['navigation']->reset();
        echo TEXT_EMAIL_SUCCESSFUL_SENT_MOBILE."<br>";
        echo "&#xE6E2;<a href =".zen_href_link($unsecure,$get,'SSL')." accesskey=1>".TEXT_BACK."</a>";
    }
}else{
    if($_GET['confirm'] == "1"){        
        zen_session_destroy();
        unset($_SESSION['customer_id']);
        zen_session_recreate();
        $_SESSION['navigation']->reset();
        if($unsecure == "index"){
            zen_redirect(zen_href_link($unsecure));    
        }else{
            zen_redirect(zen_href_link($unsecure,$get,'SSL')); 
        }   
    }else{ 
        zen_redirect(zen_href_link($_SESSION['last_secure_page'],$get,'SSL')); 
    }
}
    ?>
        
        
        </html>
