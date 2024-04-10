<?php

require 'vendor/autoload.php'; // Load Composer's autoloader

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Set your AWS credentials and region
$credentials = [
    'key'    => 'YOUR_AWS_ACCESS_KEY_ID',
    'secret' => 'YOUR_AWS_SECRET_ACCESS_KEY',
    'region' => 'YOUR_AWS_REGION', // e.g., 'us-east-1'
];

// Instantiate an S3 client
$s3 = new S3Client([
    'version'     => 'latest',
    'credentials' => $credentials
]);

// Specify your bucket name
$bucketName = 'YOUR_BUCKET_NAME';

// Specify the key (name) of the file you want to retrieve from S3
$keyName = 'desired/name/in/s3.txt';

try {
    // Get file from S3
    $result = $s3->getObject([
        'Bucket' => $bucketName,
        'Key'    => $keyName,
    ]);

    // Output file contents
    echo "File contents:\n" . $result['Body']->getContents() . "\n";
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage() . "\n";
}
?>
