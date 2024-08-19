<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$bucketName = 'your-bucket-name'; // Replace with your desired bucket name
$region = 'your-region'; // Replace with your desired AWS region, e.g., 'us-west-2'

// AWS credentials
$accessKey = 'your-access-key-id'; // Replace with your AWS Access Key ID
$secretKey = 'your-secret-access-key'; // Replace with your AWS Secret Access Key

$s3Client = new S3Client([
    'region'  => $region,
    'version' => 'latest',
    'credentials' => [
        'key'    => $accessKey,
        'secret' => $secretKey,
    ],
]);

try {
    // Create S3 bucket
    $result = $s3Client->createBucket([
        'Bucket' => $bucketName,
    ]);
    echo "Bucket created successfully: " . $bucketName . PHP_EOL;

    // Wait until the bucket is created
    $s3Client->waitUntil('BucketExists', [
        'Bucket' => $bucketName,
    ]);

    // Set ACL and Object Ownership to Object Writer
   // $result = $s3Client->putBucketAcl([
     //   'Bucket' => $bucketName,
       // 'ACL'    => 'public-read', // Replace with the desired ACL, e.g., 'private', 'public-read', etc.
    //]);

    // Set Object Ownership Preference
    $result = $s3Client->putBucketOwnershipControls([
        'Bucket' => $bucketName,
        'OwnershipControls' => [
            'Rules' => [
                [
                    'ObjectOwnership' => 'BucketOwnerPreferred',
                ],
            ],
        ],
    ]);

    echo "ACL and Object Ownership set successfully for bucket: " . $bucketName . PHP_EOL;

} catch (AwsException $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

