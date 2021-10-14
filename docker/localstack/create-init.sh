#!/bin/sh
awslocal s3 mb s3://my-bucket
awslocal s3 mb s3://test
awslocal sqs create-queue --queue-name test
awslocal s3api put-bucket-notification-configuration --bucket test --notification-configuration '{
     "QueueConfigurations": [
       {
         "QueueArn": "arn:aws:sqs:elasticmq:foobar:test",
           "Events": [
             "s3:ObjectCreated:*"
           ]
       }
     ]
   }'