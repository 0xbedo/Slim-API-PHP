<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
/* Security Checks 
1. Size Validation
2. Extentions Validation 
3. MimeType Validation
*/
$app->post("/uploadfiles",function(Request $req , Response $res){
  $error = $this->get('ErrorOperation'); 

  // $data = $req->getParsedBody();
  $files = $req->getUploadedFiles();
  $newImage = $files["Profile_photo"];
  // Prevent Xss, RCE, DOS
  //1. Define Allowed Ext or detect the ext from content file then butin my file name
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  //2. Define the MIME-TYPE
  $allowedMimeTypes = [
      'image/jpeg' => 'jpg',
      'image/png'  => 'png',
      'image/gif'  => 'gif',
  ];  
    $allowedSize = 2 * 1024 * 1024; 
  if($newImage->getError() === UPLOAD_ERR_OK){
    //get  extentions
    $uploadFileName = $newImage->getClientFilename();
    $getExtentions = strtolower(pathinfo( $uploadFileName,PATHINFO_EXTENSION));
    // 3. Check the ACTUAL file content (Server-Side)  
    // This reads the first few bytes of the file to see what it really is.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $realMimeType = $finfo->file($newImage->getStream()->getMetadata('uri'));
    // $type = $newImage->getClientMediaType();
      $size = $newImage->getSize();
    echo $uploadFileName .":" .$getExtentions.":".$realMimeType."Size: ".$size;
    //1. Size Validation
    if($size > $allowedSize){
      return $error->error($res, 'File To Large', 413);
    //2. Validate the Extentions 
    if(!in_array($getExtentions, $allowedExtensions)){
      $res->getBody()->write(json_encode(["status"=> "error","message"=> "Extentions Not Valid"]));
      return $res->withStatus(415)->withAddedHeader("Content-Type","application/json");

      //3. Validate the MIME TYPE 

      }if(!array_key_exists($realMimeType, $allowedMimeTypes)){
      $res->getBody()->write(json_encode(["status"=> "error","message"=> "MIME Type Not allowed"]));
      return $res->withStatus(415)->withAddedHeader("Content-Type","application/json");
    }}
    else{
      $realExtintion = $allowedMimeTypes[$realMimeType];
      $randomName = bin2hex(random_bytes(16));
      $name="$randomName.$realExtintion";

      //localServer
      $whiteList = array('127.0.0.1','::1');
      if(!in_array($_SERVER['REMOTE_ADDR'],$whiteList)){
        $newImage->moveTo(__DIR__ . "/../public/photos/$name");

      }else{
        $newImage->moveTo(__DIR__ . "/../public/photos/$name");
      } 
      $photoURL = "http://localhost/Slim-API-PHP/public/photos/$name";

      $responseData=['status' =>'success','photo'=> $photoURL];
       $res->getBody()->write(json_encode( $responseData));
      return $res->withAddedHeader("Content-Type","application/json");
    }
      }

});
/*
// no validation in extention
  PHP RCE.php
  <?php system($_GET['cmd'])?>

  XSS.html
  <html>
<body>
    <h1>XSS Test</h1>
    <script>alert("0xbedo here")</script>
</body>
</html>

*/