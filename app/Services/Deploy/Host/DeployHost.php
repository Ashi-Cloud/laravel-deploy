<?php

namespace App\Services\Deploy\Host;

use App\Models\Project;
use App\Models\Server;
use App\Services\Deploy\Traits\PrivateKeyManager;
use Closure;
use Spatie\Ssh\Ssh;

class DeployHost extends Ssh
{
    use PrivateKeyManager;

    private $output;
    private Project $project;
    private Server $server;

    protected $password = null;
    protected $sshPassPath;

    public function __construct($username, $host, $port = 22)
    {
        $this->sshPassPath = app_path('Services/Deploy/Host/sshpass');
        parent::__construct($username, $host, $port);
    }

    public static function createFromProject(Project $project, Closure $output): self
    {
        return (new static($project->server->user, $project->server->host, $project->server->port))
            ->setProject($project)
            ->onOutput($output)
            ->disableStrictHostKeyChecking()
            ->addExtraOption('-o LogLevel=ERROR');
    }

    /**
     * @param string $password
     * 
     * @return self
     */
    public function usePassword($password): self
    {
        unset($this->extraOptions['private_key']);
        $this->extraOptions['password_auth'] = "-o PubkeyAuthentication=no";
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $pathToPrivateKey
     * 
     * @return self
     */
    public function usePrivateKey(string $pathToPrivateKey): self
    {
        unset($this->extraOptions['password_auth']);
        $this->password = null;
        return parent::usePrivateKey($pathToPrivateKey)
            ->disablePasswordAuthentication();
    }

    /**
     * @param string $command
     * 
     * @return string
     */
    public function getExecuteCommand($command): string
    {
        $sshCommand = parent::getExecuteCommand($command);

        if ($this->isPasswordAuthentication()) {
            $sshCommand = "{$this->getSshPassExecutable()} -p'{$this->password}' {$sshCommand}";
        }

        return $sshCommand;
    }

    /**
     * @param string $command
     * 
     * @return bool
     */
    public function test($command)
    {
        $true = '+' . array_rand(array_flip(['accurate', 'appropriate', 'correct', 'legitimate', 'precise', 'right', 'true', 'yes', 'indeed']));
        return trim($this->runCommand("if $command; then echo $true; fi"),"\n") === $true;
    }

    /**
     * @param string $command
     * 
     * @return string
     */
    public function runCommand($command)
    {
        return $this->execute($command)->getOutput();
    }

    /**
     * @return bool
     */
    protected function isPasswordAuthentication(): bool
    {
        return !is_null($this->password);
    }

    /**
     * @return string
     */
    protected function getSshPassExecutable(): string
    {
        return $this->sshPassPath;
    }

    /**
     * @param string $path
     */
    protected function setSshPassExecutable($path)
    {
        $this->sshPassPath = $path;
        return $this;
    }

    /**
     * @param App\Models\Project $project;
     * 
     * @return self
     * 
     * Sets the project for this host and also set 
     * password or private key for host.
     */
    protected function setProject(Project $project): self
    {
        $this->project = $project;
        $this->server = $project->server;

        if ($this->server->isPasswordAuthentication()) {
            return $this->usePassword($this->server->password);
        }

        $this->keyPath = "keys/{$this->server->user}/";
        return $this->createKeyFile($this->server)
            ->usePrivateKey($this->getPrivateKeyPath());
    }

    /**
     * Deletes private key file from storage
     */
    public function __destruct()
    {
        $this->deleteKeyFile();
    }
}
