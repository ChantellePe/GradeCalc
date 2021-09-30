<?php
ini_set('display_errors', TRUE);
header('Access-Control-Allow-Origin: *');

const DATA_FILE = 'votes.txt';

echo "You chose ". $_POST["poll"];
if (isset($_POST["poll"])) {
    addPoll($_POST["poll"]);
} else {
   echo "Please select a value";
}

function addPoll($poll) {
    $fileData = json_decode(file_get_contents('votes.txt'), true);
    if (isset($poll)) {
        if ($poll == 1) {
            $fileData["Terrible"]++;
        } else if ($poll == 2) {
            $fileData["Bad"]++;
        } else if ($poll == 3) {
            $fileData["Neutral"]++;
        } else if ($poll == 4) {
            $fileData["Good"]++;
        } else if ($poll == 5) {
            $fileData["Excellent"]++;
        }
    }
    $data = json_encode($fileData);
    print($data);
    file_put_contents(DATA_FILE, $data);
   // return http_response_code(200);

}
