<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
    <input type="text" name="search">
    <input type="submit" value="Buscar">
    </form>
</body>
</html>


<?php 

    if(@$_GET['search']) {

        echo $api_url = "https://en.wikipedia.org./w/api.php?format=json&action=query&prop=extracts&titles=".ucwords($_GET['search'])."&redirects=true";
        $api_url = str_replace('','%20',$api_url);

        if($data = json_decode(@file_get_contents($api_url))){
            foreach($data->query->pages as $key=>$val) {
                $pageId = $key;
                break;
            }

            $content = $data->query->pages->$pageId->extract;

            header('Content-Type:text/html; charset=utf-8');
            echo $content;

        }else{
            echo 'No Result Found...';
        }
    }