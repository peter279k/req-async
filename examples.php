<?php

require './vendor/autoload.php';
use Async\Req;
use Async\Run;

$req = new Req();
$promise = array();


$promise[] = $req::Get('https://httpbin.org/get'); // GET method
$promise[] = $req::Post('https://httpbin.org/post'); // POST method
$promise[] = $req::Put('https://httpbin.org/put'); // CUSTOM method


$headers = ['Origin: https://google.com/', 'X-msg: Testing async resquest'];
$post = ['name' => 'John', 'age' => '25'];

// Using customs headers
$promise[] = $req::Get('https://httpbin.org/get', $headers);

// Using custom post data
$promise[] = $req::Post('https://httpbin.org/post', $post);

// Using custom headers and post data
$promise[] = $req::Post('https:/httpbin.org/post', $post, $headers);

// Using cookies | GET method
$promise[] = $req::Get('https://httpbin.org/cookies/set?name=John&age=25', null, null, 'file_example_cookie_file');
$promise[] = $req::Get('https://httpbin.org/cookies', $headers, ['METHOD' => 'TUNNEL', 'SERVER' => '103.28.149.107:3128'], 'file_example_cookie_file'); // Headers and http proxy
$promise[] = $req::Get('https://httpbin.org/get', $headers, ['METHOD' => 'TUNNEL', 'SERVER' => '', 'AUTH' => 'user:pass'], 'file_example_cookie_file'); // Headers and auth proxy


print_r(Run::Async($promise));
// echo json_encode(Run::Async($promise));