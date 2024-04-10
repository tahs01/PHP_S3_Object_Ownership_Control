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

// Specify the key (name) of the object you want to create in S3, including "folder" structure
$keyName = 'folder/subfolder/object.txt';

try {
    // Create an object (file) in S3
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $keyName,
        'Body'   => 'This is the content of the object.',
    ]);

    echo "Object created successfully in S3 at: " . $result['ObjectURL'] . "\n";
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage() . "\n";
}
?>
