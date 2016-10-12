$url = 'http://www.example.com/';
$start = '<div class="example">';
$end = "</div>";

// initiate curl oject
$ch = curl_init();

// specify the file or url to load
curl_setopt($ch, CURLOPT_URL, $url);

// tell it to return the raw content
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// if connection error
$result = curl_exec($ch) or die("Couldn't connect to $url.");

// close curl 
curl_close($ch);

// echo $result; 
// or get specific html element only
// find the start position
$startposition = strpos($result, $start);

if ($startposition > 0) {

    // find the end position
    $endposition = strpos($result, $end, $startposition);

    // add enough chars to include the tag
    $endposition += strlen($end);

    $length = $endposition - $startposition;

    $result = substr($result, $startposition, $length);

    //replace links with p tags
    $result = str_replace('<a', '<p', $result);

    // close the div manually
    $result .= '</div>';
    
    echo $result;
}
