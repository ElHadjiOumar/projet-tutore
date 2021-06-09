
<?php
 require './vendor/autoload.php'; 

use Aws\Rekognition\RekognitionClient;

$client = new Aws\Rekognition\RekognitionClient([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAXX5PDQNAYASFASFF',
        'secret' => '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'
    ]
]);

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;


// Get local image
$photo = $target_file;
$fp_image = fopen($photo, 'r');
$image = fread($fp_image, filesize($photo));
fclose($fp_image);

$result = $client->detectText([
    'Image' => [
        'Bytes' => $image, 
    ],
]);

//print_r($result);
echo "<h1>Rekognition</h1>";
$i=0;
foreach ($result['TextDetections'] as $phrase) {
    $i++;
    if($phrase['Type'] == "WORD"){
        if($phrase['DetectedText'] == "AA-001-AA")
        {
            echo "
            La plaque N°: ".$phrase['DetectedText']." appartient à Pape
            
            <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='card.css'>
        <title>Document</title>
    </head>
    <body>
        <script src='https://kit.fontawesome.com/b99e675b6e.js'></script>

        <div class='wrapper'>
            <div class='left'>
                <img src='https://i.imgur.com/cMy8V5j.png' alt='user' width='100'>
                <h4>Alex William</h4><br><br>
                <h3>".$phrase['DetectedText']."</h3>
            </div>
            <div class='right'>
                <div class='info'>
                    <h3>Information</h3>
                    <div class='info_data'>
                        <div class='data'>
                            <h4>Email</h4>
                            <p>alex@gmail.com</p>
                        </div>
                        <div class='data'>
                        <h4>Phone</h4>
                            <p>0001-213-998761</p>
                    </div>
                    </div>
                </div>
            
            <div class='projects'>
                    <h3>Projects</h3>
                    <div class='projects_data'>
                        <div class='data'>
                            <h4>Recent</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class='data'>
                        <h4>Most Viewed</h4>
                            <p>dolor sit amet.</p>
                    </div>
                    </div>
                </div>
            
                
            </div>
        </div>
    </body>
</html>
            
            ";
            
        }
        if($phrase['DetectedText'] == "AA-296-AG")
        {
            echo "La plaque N°: ".$phrase['DetectedText']." appartient à Ousmane";
        }
        if($phrase['DetectedText'] == "AA-555-AA")
        {
            echo "La plaque N°: ".$phrase['DetectedText']." appartient à Ousmane";
        }
        return;
    }
     
      
  }
?>