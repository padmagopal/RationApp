<html>
<meta charset="UTF-8">
<?php  // PHP Yandex Translate API v1.5 - Working Example PHP Code - http://www.aw6.de/yandex/  11.02.18
$AW6_text = "what are you doing";
$AW6_from = 'en';
$AW6_to = 'ta';

    $AW6_translation = translate($AW6_text, $AW6_from, $AW6_to);

function translate($text, $from, $to)
{
    $api = 'trnsl.1.1.20190224T181835Z.a2ae44dfe68c4b04.b1d07057e47ce96b2ce318d7855ae3e15800a1c8'; // TODO: Get your key from https://tech.yandex.com/translate/
    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $api . '&lang=' . $from . '-' . $to . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];
}
// Yandex Translation API v1.5 End
echo $AW6_translation;
?>
</html>