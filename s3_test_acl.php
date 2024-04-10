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

// Specify the key (name) of the object you want to upload to S3
$keyName = 'test_object.txt';

// Specify the content you want to upload
$content = 'This is the content of the test object.';

try {
    // Upload object to S3
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $keyName,
        'Body'   => $content,
    ]);

    echo "Object uploaded successfully to S3.\n";

    // Retrieve object ACL
    $aclResult = $s3->getObjectAcl([
        'Bucket' => $bucketName,
        'Key'    => $keyName,
    ]);

    // Display owner information
    $owner = $aclResult['Owner'];
    echo "Object Owner:\n";
    echo "ID: " . $owner['ID'] . "\n";
    echo "DisplayName: " . $owner['DisplayName'] . "\n";
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage() . "\n";
}
?>
