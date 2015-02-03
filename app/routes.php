<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
    return View::make('user', array('data'=>$data, 'uid' => $uid));
});

Route::get('/actionconfirmed', function()
{
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
    return Redirect::to('/')->with('message', 'Confirmado (agregar actividad aquí)');
});

Route::get('/actividad', function()
{
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
	$fecha = Maindate::getMainDate(); 
	$actividades = Actividad::Lista();
    return View::make('actividad', array('data'=>$data, 'actividades'=>$actividades, 'fecha'=>$fecha));
});

Route::get('/compras', function()
{
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
    return View::make('user', array('data'=>$data, 'uid' => $uid));
});

Route::get('/action/{kind}', function($kind)
{
    $data = array();
    if (Auth::check()) {
        $data = Auth::user();
    }
	$facebook = new Facebook(Config::get('facebook'));
	$uid = $facebook->getUser();
	$actividad = new Actividad();
	$actividad ->actividad_uid = $uid;
	$actividad ->fecha = MainDate::getMainDate()->fecha;
	$actividad ->actividad = $kind;

    if(!Actividad::Check($uid, Maindate::getMainDate()->fecha)) {
        $actividad->save();
    }

	
    return View::make('user', array('data'=>$data, 'uid' => $uid));
});


Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
    
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
     
    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
     
    $me = $facebook->api('/me');

	$profile = Profile::whereUid($uid)->first();
    if (empty($profile)) {

    	$user = new User;
    	$user->name = $me['first_name'].' '.$me['last_name'];
    	$user->email = $me['email'];
    	$user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=square';

        if(!empty($me['birthday'])) {
            $user->birthday = $me['birthday'];
        }
        $user->save();

        $profile = new Profile();
        $profile->uid = $uid;
    	$profile->username = $me['username'];
    	$profile = $user->profiles()->save($profile);
    }
     
    $profile->access_token = $facebook->getAccessToken();
    $profile->save();

    $user = $profile->user;
 
    Auth::login($user);

    return Redirect::to('/')->with('message', 'Ingresaste al sistema con éxito.');
});


Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('/');
});