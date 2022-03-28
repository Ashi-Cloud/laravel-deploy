<?php

namespace App\Services\Deploy\Traits;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

trait PrivateKeyManager
{
    private $disk = 'secure_disk';
    private $keyPath = "keys/";
    private $keyName = "private_key.pem";

    private function createKeyFile(Project $project): self
    {
        if ( !$this->isKeyExists() ){
            Storage::disk($this->disk)->put($this->getKeyFilePathWithName(),$project->private_key."\n");
        }

        return $this;
    }

    private function deleteKeyFile(): self
    {
        if ( $this->isKeyExists() ){
            Storage::disk($this->disk)->delete($this->getKeyFilePathWithName());
        }

        return $this;
    }
    
    private function isKeyExists(): bool
    {
        return Storage::disk($this->disk)->exists($this->getKeyFilePathWithName());
    }

    private function getKeyFilePathWithName(): string
    {
        return $this->keyPath.$this->keyName;
    }

    private function getPrivateKeyPath(): string
    {
        return Storage::disk($this->disk)->path($this->getKeyFilePathWithName());
    }
}
