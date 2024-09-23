<?PHP
// $config['clientId'] = 'V1:368042:LW9K:AA';
// $config['clientSecret'] = 'TP02989'; 
function setup_database(){
    
    global $config;
    $config = [];
   
    $config['cities_api_token'] = 'X-Authentication-Token:0fg9aiigpeqbvaQQJFMUogtt';
    $config['db_host'] = 'localhost';
    $config['db_username'] = 'root';
    $config['db_pass'] = '';
    $config['db_name'] = 'my_task';

}
