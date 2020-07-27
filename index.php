<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: *');
header('Content-Type: application/json');
require 'controllers/posts.php';

$connect = mysqli_connect('localhost', 'root', 'root', 'api');
$path = $_GET['q'];
$params = explode('/', $path);
$address = $params[0];
$id = $params[1];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if ($address === 'posts') {
        if ( isset($id) ) {
            getPost($connect, $id);
        } else {
            getAllPosts($connect);
        }
    }
} elseif ($method === 'POST') {
    if ($address === 'posts') {
        addPost($connect, $_POST);
    }
} elseif ($method === 'PATCH') {
    if ($address === 'posts' && isset($id)) {
        $json = file_get_contents('php://input');
        $json = json_decode($json, true);
        editPost($connect, $id, $json);
    }
} elseif ($method === 'DELETE') {
      if ($address === 'posts' && isset($id)) {
          deletePost($connect, $id);
      }
  }
