<?php

namespace ApiGratis;
class Base
{

    public static function validateWhatsAppService($action, array $data, $error = [])
    {
        // validate inputs obrigatory fields for good request
        try {
            
            //validate action and data is exist
            if(!isset($action) and !isset($data)){
                $error['error'][] = 'action and data are empty';
            }
            
            //validate action or data is not empty 
            if(empty($action) and empty($data)){
                $error['error'][] = 'action and data are not empty';
            }

            //validate action or data is not empty or not null or diff empty
            if($action == '' and $data == '' or $action == null or $data == null){
                $error['error'][] = 'action and data are not empty or null';
            }
            
            //validate action is a string and server_host is not empty 
            if($action == '' and $data['server_host'] == ''){
                $error['error'][] = 'action and data or server_host are not empty or null';
            }

            //validate action is a string and data is array
            if( !is_string($action) or !is_array($data)){
                $error['error'][] = 'data bad request, format action is string and data is array[]';
            }
            
            //validate sessionkey is not empty
            if( !is_string($data['sessionkey']) or empty($data['sessionkey'])){
                $error['error'][] = 'sessionkey must be a string or diff of null';
            }

            //validate session is not empty
            if( !is_string($data['session']) or empty($data['session'])){
                $error['error'][] = 'session must be a string or diff of null';
            }

            //validate number exist if number is integer
            if( isset($data['number']) ){
                if( !is_int($data['number']) ){
                    $error['error'][] = 'number must be a number';
                }

                if( strlen($data['number']) < 12 ) {
                    $error['error'][] = 'number must be a number and length is 12';
                }
            }

            return isset($error['error']) ? $error : true;
            
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
}