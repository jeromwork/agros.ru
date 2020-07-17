<?php
$request = Params::getParam('request');

switch ($request) {
    case('my_request'):
        $id = Params::getParam('id');
        $json = array(
            'id' => $id,
            'message' => __('Your request id') 
        );
        echo json_encode($json);
        break;
    default:
        echo json_encode(array('error' => __('no action defined')));
        break;
}
       


?>