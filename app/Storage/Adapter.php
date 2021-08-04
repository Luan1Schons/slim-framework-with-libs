<?php

namespace SlimMonsterKit\Storage;

use Aws\S3\S3Client;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Adapter\Ftp;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class Adapter
{
    private $storage;
    private $path;

    public function __construct($container, $path)
    {
        $this->storage = $container->get('settings')['storage'];
        $this->path = $path;
    }

    public function getAdapter()
    {
        if ($this->storage['driver'] == "AWS_S3") {
            return $this->getAwsS3();
        }

        if ($this->storage['driver'] == "GOOGLE") {
            return $this->getGoogleCloudStorage();
        }

        if ($this->storage['driver'] == "AZURE") {
            return $this->getAzure();
        }

        if ($this->storage['driver'] == "DIGITAL_OCEAN") {
            return $this->getDigitalOcean();
        }

        if ($this->storage['driver'] == "DROPBOX") {
            return $this->getDropbox();
        }

        if ($this->storage['driver'] == "FTP") {
            return $this->getFtp();
        }

        return $this->getLocal();
    }

    private function getLocal()
    {
        return new Local($this->path);
    }

    private function getAwsS3()
    {
        $client = new S3Client([
            'credentials' => [
                'key' => $this->storage['aws']['key'],
                'secret' => $this->storage['aws']['secret'],
            ],
            'region' => $this->storage['aws']['region'],
            'version' => $this->storage['aws']['version'],
        ]);
        return new AwsS3Adapter($client, $this->storage['aws']['bucket']);
    }

    private function getGoogleCloudStorage()
    {
        $client = new StorageClient([
            'projectId' => $this->storage['google']['project_id']
        ]);
        $bucket = $client->bucket($this->storage['google']['bucket']);
        return new GoogleStorageAdapter($client, $bucket);
    }

    private function getAzure()
    {
        $connectString  = "DefaultEndpointsProtocol=https;";
        $connectString .= "AccountName={$this->storage['azure']['account_name']};";
        $connectString .= "AccountKey={$this->storage['azure']['account_key']};";

        $client = BlobRestProxy::createBlobService($connectString);
        return new AzureBlobStorageAdapter($client, $this->storage['azure']['container_name']);
    }

    private function getDigitalOcean()
    {
        $client = new S3Client([
            'credentials' => [
                'key' => $this->storage['digitalocean']['key'],
                'secret' => $this->storage['digitalocean']['secret'],
            ],
            'region' => $this->storage['digitalocean']['region'],
            'version' => $this->storage['digitalocean']['version'],
            'endpoint' => $this->storage['digitalocean']['endpoint'],
        ]);

        $adapter = new AwsS3Adapter($client, $this->storage['digitalocean']['bucket']);
    }

    private function getDropbox()
    {
        $client = new Client($this->storage['dropbox']['token']);
        return new DropboxAdapter($client);
    }

    private function getFtp()
    {
        return new Ftp($this->storage['ftp']);
    }

    public function getSensitive()
    {
        if ($this->storage['driver'] == "DROPBOX") {
            return false;
        }
        return true;
    }
}
