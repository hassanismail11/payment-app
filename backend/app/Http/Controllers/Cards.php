<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

use GuzzleHttp\Exception\RequestException;

class Cards extends Controller
{
    function s1()
    {
    }
    function s2()
    {
    }
    function s3()
    {
    }

    function all()
    {
        // Input Variables 
        $url1 = 'https://epgapi.taly.com.eg:5002/api/Key';
        $url2 =  'https://epgapi.taly.com.eg:5002/api/CreateJWT';
        $url3 = 'https://epgapi.taly.com.eg:8442/epg/rest/register.do';
        $your_username = 'bcfe_merch_api';
        $your_password = "Admin@123";
        $your_public_key = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvCm+FAPxowgAFbdL2W6T\nVDMTZU4+NPYrO/RZaEgIykvZvhE+5ddaAvv2Ax2NphQsVxxxE0DmTsAI2hVOAl3r\noEl5fn83yV4GyjNsGlPTGmSbHHy3EM9oodxW5A2vpXIwWreTA3uyo9HnhBhO5dA+\nk2msVuchd8Npxs5y4+mbmpY0tD0Mq9xzB/ovMOqLflzB7u4J9TfYNjtkqAQ3GLyX\nckZyZPbTZMJ/dLd1AoVUeJyPfrxEfAUhdAkYRtJs6dx2lU1tgj628lOvn6GCMdQI\nxz/3ArPC+1RXlTMi70gTvwDte7IMRDlyU6ZHYEDSv8DLSfN+sz2PxMjOIbfosF/Y\nAwIDAQAB\n-----END PUBLIC KEY-----\n";
        $your_private_key = "-----BEGIN RSA PRIVATE KEY-----\nMIIEpAIBAAKCAQEAvCm+FAPxowgAFbdL2W6TVDMTZU4+NPYrO/RZaEgIykvZvhE+\n5ddaAvv2Ax2NphQsVxxxE0DmTsAI2hVOAl3roEl5fn83yV4GyjNsGlPTGmSbHHy3\nEM9oodxW5A2vpXIwWreTA3uyo9HnhBhO5dA+k2msVuchd8Npxs5y4+mbmpY0tD0M\nq9xzB/ovMOqLflzB7u4J9TfYNjtkqAQ3GLyXckZyZPbTZMJ/dLd1AoVUeJyPfrxE\nfAUhdAkYRtJs6dx2lU1tgj628lOvn6GCMdQIxz/3ArPC+1RXlTMi70gTvwDte7IM\nRDlyU6ZHYEDSv8DLSfN+sz2PxMjOIbfosF/YAwIDAQABAoIBAA+J0uyMNtQjwP4K\nGPVnsDrvzNY8095DxeY5k3iNGky6XszXV75bPk+oxvQS6LOiTtcSvjO81EgEi7aW\ns852OxMNfj73+n9iiGUCQhcafQBc9oIvul5lAlr7eyFyD+M1vtB/AGD1QhdNKjU6\nXKmVvNUnkNfMVnMxa/bC7bHshLELOcDZm5WKKc8GM0OnOo72ytX4YZZe998NKDsU\nYVZ4NLTCbSllUWk3TDOAoSJMHCQvKFDJ4iBZPpvA2gjuM2noCj3x1j+e03QjWyPc\no3eDyZ7IILe9hhhuQs4/t9czapdhSbOJS18ka9UQ85NVsBoYJbtACeIUnkdXgBun\npyYBciECgYEA/peyjdtBIPhIQslIpmjWD2e9oIEr7mM2ZYxrrB/LzjqU3j9Squju\niE6uNnF1V0F8i/4YHuwD6XRYwhm2dgChYv6yc2HJO83JkI9JAL/Ej78tq2z+X0Cj\nYbn/4FLbCS/WqhgPBZDxhB++71tARgkOr4Zjs+2O/QXjVG5EYqH1hZ0CgYEAvTQI\nfPaOG1LdJOQDnINkjfmCK9SEVWOG0/T34nED72RjWC0XodYMF/BC7E+5+Qnv7lBJ\n8f33DQBIL98k107cp3S7s3ubXd1DlJmIaEYCjYimqK6UAH2/wTtjaOHmnjMGpAk+\nCkZOaX8r/xPj0QdJe+khbfWfa2ReyNSS/S38Mh8CgYEAyhgzFaZBGeHcwp8zO12m\n5o2sGlfPPqmkyZFg+z42MxuPhqhvf9ntV2hVpEQGKGCEdEAcd5dUN6IyvslYbG1t\nrr6Ne0fZTM67PTRwd9bCOnVA1H5tocEWsIHMWw6Kbs15soXsjreS8BWfJDOkXrPb\n43tjc7WUtsdQwHnTcRQtaIUCgYA5vUdZ22RCsmcKewsfGHn3Wc1/0rsP0++xf3Cm\nihbJV7l5j0lG+it2orvJogr/FSlDcP0f/IEIVq2w7kgv7MEp2VXu0Cn52yxkjPYz\n3CmrR6iUkbJY9Acw0Q7lUwst/CRqqudj+1CyoTyr+0Xq5G5oghzRkcO04kyKvVSe\nLwpnwQKBgQCXT2XSk8MSASXtpAjWUUzfEjnoPw/0+RQftXgw2Ww02GnWw0Q0ktH5\nQASZ73hr3agG3aAnrL4/N1+eNalru1BJKQktBRvXr86eLcTSmefuurNyUOsIXold\nJmsZdRXYtVCTaHqLcbh4CBcxozrFKdiM4W0m4cg3qgVA4ngE6Yr0Cg==\n-----END RSA PRIVATE KEY-----\n";
        $your_amount = intval(400 * 100);
        $your_currency = "818";
        $your_return_url = 'http://www.return.url.com';

        
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = '{
  "username": "bcfe_merch_api",
  "rsa_public_key": "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvCm+FAPxowgAFbdL2W6T\nVDMTZU4+NPYrO/RZaEgIykvZvhE+5ddaAvv2Ax2NphQsVxxxE0DmTsAI2hVOAl3r\noEl5fn83yV4GyjNsGlPTGmSbHHy3EM9oodxW5A2vpXIwWreTA3uyo9HnhBhO5dA+\nk2msVuchd8Npxs5y4+mbmpY0tD0Mq9xzB/ovMOqLflzB7u4J9TfYNjtkqAQ3GLyX\nckZyZPbTZMJ/dLd1AoVUeJyPfrxEfAUhdAkYRtJs6dx2lU1tgj628lOvn6GCMdQI\nxz/3ArPC+1RXlTMi70gTvwDte7IMRDlyU6ZHYEDSv8DLSfN+sz2PxMjOIbfosF/Y\nAwIDAQAB\n-----END PUBLIC KEY-----\n"
}';
        $request = new Request('POST', 'https://epgapi.taly.com.eg:5002/api/Key', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();


        // Step 2: POST request to url 2
        // $promise2 = $promise1->then(function () use ($client, &$jwtToken, $kid, $url2, $your_private_key) {
        //     return $client->postAsync($url2, [
        //         'json' => [
        //             'kid' => $kid,
        //             'private_key' => $your_private_key
        //         ]
        //     ])->then(function ($response2) use (&$jwtToken) {
        //         $body2 = json_decode($response2->getBody(), true);
        //         echo $body2;
        //         $jwtToken = $body2['JWToken'];
        //         echo $jwtToken;
        //     });
        // });


        // Step 3: POST request to url 3
        // $promise3 = $promise2->then(function () use ($client, $jwtToken, $url3, $your_username, $your_password, $your_amount, $your_currency, $your_return_url) {
        //     return $client->postAsync($url3, [
        //         'headers' => [
        //             'Authorization' => 'Bearer ' . $jwtToken,
        //         ],
        //         'form_params' => [
        //             'username' => $your_username,
        //             'password' => $your_password,
        //             'amount' => $your_amount,
        //             'currency' => $your_currency,
        //             'returnUrl' => $your_return_url
        //         ]
        //     ])->then(function ($response3) use (&$formUrl) {
        //         $body3 = json_decode($response3->getBody(), true);
        //         $formUrl = $body3['formUrl'];
        //         echo "Form URL: $formUrl";
        //     });
        // });


    }

    function index()
    {
        return json_decode(Storage::disk('res')->get('dumData.json'));
    }

    function store(Request $request)
    {
        $arrayData = json_decode(Storage::disk('res')->get('dumData.json'));

        array_push($arrayData, json_decode($request->getContent()));

        Storage::disk('res')->put('dumData.json', json_encode($arrayData));

        return json_decode(Storage::disk('res')->get('dumData.json'));
    }
}
