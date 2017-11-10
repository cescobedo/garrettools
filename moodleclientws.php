<?php
// DUMMY Client WS to test WS in Moodle.

ini_set('display_errores', 1);
error_reporting(E_ALL);

$token = 'fdgsdf435234h5bkl34j2h5k342'; // MOODLE TOKEN WS.
$serverurl = 'http://localhost.dev/moodle/webservice/soap/server.php'. 
			'?wsdl=1&wstoken=' . $token;

// WS Functions to test.
echo $serverurl;
$params = array();
$function = 'core_user_get_users_by_field';
$params = array('username', array('webservice'));

//$function = 'core_user_view_user_list';
//$params = array('username', array('webservice'));

//$function = 'core_user_create_users';
//$function = 'core_user_update_users';
//$user = new StdClass();
//$user->id = 3863;
//$user->username = 'dummy2';
//$user->password = '12345';
//$user->firstname = 'dummy2';
//$user->lastname = 'dummy2last';
//$user->email = 'dummy2@a.com';
//user->customfields[0]->type = 'testingfield';
//$user->customfields[0]->value = '1111';

//$users[0][customfields][0][type]=testingfield&users[0][customfields][0][value]=1111

//$params[0] = array($user);
//$params[] = array($user);


$testclient = new SoapClient($serverurl);
try {
    $response = $testclient->__soapCall($function, $params);
    var_dump($response);
} catch (Exception $ex) {
    print_r($ex);
}

// Call WS by browser.

// http://localhost.dev/moodle/webservice/rest/simpleserver.php?wsusername=wstest&wspassword=wstest&moodlewsrestformat=json&wsfunction=core_user_get_users_by_field&field=username&values[0]=test

//http://localhost.dev/moodle/webservice/rest/simpleserver.php?wsusername=wstest&wspassword=wstest&wsfunction=core_user_create_users&users[0][username]=testuser&users[0][firstname]=Test&users[0][lastname]=UserLastName&users[0][email]=testuser@example.com&users[0][password]=Abc­1234&users[0][customfields][0][type]=testfield&users[0][customfields][0][value]=1111

/*

curl http://localhost.dev/webservice/rest/server.php -d "wstoken=fdgsdf435234h5bkl34j2h5k342&moodlewsrestformat=json&wsfunction=core_user_create_users&users[0][username]=testuser&users[0][firstname]=Test&users[0][lastname]=UserLastName&users[0][email]=testuser@a.com&users[0][password]=Abc­1234&users[0][customfields][0][type]=cp&users[0][customfields][0][value]=08208

curl http://localhost.dev/moodle/webservice/rest/server.php -d "wsusername=wstest&wspassword=wstest&moodlewsrestformat=json&wsfunction=core_user_get_users_by_field&field=username&values[0]=wstest"

*/
