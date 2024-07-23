<?PHP

namespace Mastermind;
if(!isset ($_SESSION)){
    session_start();
}

function flash($name = '', $message = '',$class ='form - message -red'){
    if (!empty($message)&& empty($HTTP_SESSION[$name])) {
        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;

    }else if(!empty($message)&& empty($HTTP_SESSION[$name.'_class'])){
        $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] :$class;
        echo '<div class="'.$class.'">'.$message.'</div>';
        unset($_SESSION[$name.'_class']);
        unset($_SESSION[$name.'_message']);
    }
}
function redirect($location){
    header('Location: '.$location);
    exit();
}