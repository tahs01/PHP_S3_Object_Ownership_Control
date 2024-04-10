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

// Specify the keys (names) of the objects you want to delete from S3
$objectKeys = ['object1.txt', 'object2.txt', 'folder/object3.txt'];

try {
    // Delete objects from S3
    $result = $s3->deleteObjects([
        'Bucket'  => $bucketName,
        'Delete' => [
            'Objects' => array_map(function($key) {
                return ['Key' => $key];
            }, $objectKeys),
        ],
    ]);

    // Output deleted object keys
    echo "Deleted objects:\n";
    foreach ($result['Deleted'] as $deletedObject) {
        echo $deletedObject['Key'] . "\n";
    }
} catch (AwsException $e) {
    // Display error message
    echo $e->getMessage() . "\n";
}
?>
