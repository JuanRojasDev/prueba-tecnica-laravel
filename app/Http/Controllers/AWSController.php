<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;

class AWSController extends Controller
{
    public function index()
    {
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials
        ]);
        $buckets = $s3Client->listBuckets();
        foreach($buckets['Buckets'] as $bucket){
            echo $bucket['Name'] . "<br>";
        }
    }
}