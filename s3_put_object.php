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

// Specify the file to upload and the desired name in S3
$filePath = 'path/to/your/file.txt';
$keyName = 'desired/name/in/s3.txt';

try {
    // Upload file to S3
    $result = $s3->putObject([
        'Bucket'     => $bucketName,
        'Key'        => $keyName,
        'SourceFile' => $filePath,
    ]);

    echo "File uploaded successfully to S3 at: " . $result['ObjectURL'] . "\n";
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage() . "\n";
}
?>
