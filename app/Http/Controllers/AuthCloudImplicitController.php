<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;
use App\Http\Controllers\DatabaseController;
class AuthCloudImplicitController extends Controller
{

    function auth_cloud_implicit($projectId)
    {
        $config = [
            'projectId' => $projectId,
        ];
        # If you don't specify credentials when constructing the client, the
        # client library will look for credentials in the environment.
        $storage = new StorageClient($config);
        # Make an authenticated API request (listing storage buckets)
        foreach ($storage->buckets() as $bucket) {
            printf('Bucket: %s' . PHP_EOL, $bucket->name());
        }
    }
}
