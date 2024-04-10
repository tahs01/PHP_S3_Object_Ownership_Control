# s3 object ownership ACL

# Viewing the Object Ownership setting for	an S3 bucket

S3 Object Ownership is an Amazon S3 bucket-level setting that you can use to disable [access control lists (ACLs)](https://docs.aws.amazon.com/AmazonS3/latest/userguide/acl-overview.html) and take ownership of every object in your bucket, simplifying access management for data stored in Amazon S3. By default, S3 Object Ownership is set to the Bucket owner enforced setting, and ACLs are disabled for new buckets. With ACLs disabled, the bucket owner owns every object in the bucket and manages access to data exclusively by using access-management policies. We recommend that you keep ACLs disabled, except in unusual circumstances where you must control access for each object individually. Object Ownership has three settings that you can use to control ownership of objects uploaded to your bucket and to disable or enable ACLs:

### ACLs disabled

- **Bucket owner enforced (default)** – ACLs are disabled, and the bucket owner automatically owns and has full control over every object in the bucket. ACLs no longer affect permissions to data in the S3 bucket. The bucket uses policies to define access control.

### ACLs enabled

- **Bucket owner preferred** – The bucket owner owns and	has full control over new objects that other accounts write to the bucket with the `bucket-owner-full-control` canned ACL.
- **Object writer** – The AWS account that	uploads an object owns the object, has full control over it, and can grant other users access to it through ACLs.

**Permissions:** To use this operation, you must have the`s3:GetBucketOwnershipControls` permission. 

For more information about Amazon S3 permissions, see [Actions, resources, and condition keys for Amazon S3](https://docs.aws.amazon.com/service-authorization/latest/reference/list_amazons3.html) in the *Service Authorization Reference*.

### **Verify the ACL enable or disable**

`aws s3api get-bucket-ownership-controls --bucket BUCKET_NAME`

### **Object Ownership ACL disable**

`aws s3api put-bucket-ownership-controls --bucket BUCKET_NAME --ownership-controls="Rules=[{ObjectOwnership=BucketOwnerEnforced}]"`

### **Object Ownership ACL enable**

`aws s3api put-bucket-ownership-controls --bucket BUCKET_NAME --ownership-controls="Rules=[{ObjectOwnership=BucketOwnerPreferred}]"`

### **Create Object disabling ACL**

`aws s3api create-bucket --bucket BUCKET_NAME --region ap-southeast-2 --create-bucket-configuration LocationConstraint=ap-southeast-2 --object-ownership BucketOwnerEnforced`

### **Create Object disabling ACL**

`aws s3api create-bucket --bucket BUCKET_NAME --region ap-southeast-2 --create-bucket-configuration LocationConstraint=ap-southeast-2 --object-ownership BucketOwnerPreferred`