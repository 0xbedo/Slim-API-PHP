<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;




// optional paramter
$app->get('/optional[/{id}]',function(Request $req , Response $res, $args){
    $id = $args["id"]  ?? null;
    if($id === null){
        $res->getBody()->write("The ID is Null Value");
    }else{
        $res->getBody()->write("This is your ID: ".$id);
    }
    return $res;

});

// Multiable optional paramter
$app->get('/moptional[/{year}[/{month}]]',function(Request $req , Response $res, $args){

    $hasYear = array_key_exists('year', $args);
    $hasmonth = array_key_exists('month', $args);

    $year = $args["year"]  ?? date("Y");
    $month = $args["month"]  ?? date("m");

    if( !$hasYear && !$hasmonth ){
        $res->getBody()->write("This data For Year $year & Month $month  (Current)");
    }elseif($hasYear && !$hasmonth){
        $res->getBody()->write("This data For Year $year (specific Year) ");
    }else{
        $res->getBody()->write("This data For Year $year & Month $month  (specific)");
    }
    return $res;
});
