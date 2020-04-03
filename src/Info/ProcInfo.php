<?php

namespace Evrinoma\DashBoardBundle\Info;

use Evrinoma\DashBoardBundle\Dto\ProcInfo\ServiceDto;
use Evrinoma\DashBoardBundle\Dto\ProcInfoDto;
use Evrinoma\DashBoardBundle\Provider\DefaultServiceInterface;
use Evrinoma\DashBoardBundle\Provider\ProviderInterface;
use Evrinoma\DashBoardBundle\Provider\ScanServiceInterface;

/**
 * Class ProcInfo
 *
 * @package Evrinoma\DashBoardBundle\Info
 */
class ProcInfo implements InfoInterface
{
//region SECTION: Fields
    private $timeout = 5;
    private $ports   = [];
    /**
     * @var ProviderInterface
     */
    private $pluginManager;

    /**
     * @var ProcInfoDto
     */
    private $procInfo;
//endregion Fields

//region SECTION: Constructor
    public function __construct(ProviderInterface $pluginManager = null)
    {
        $this->procInfo      = new ProcInfoDto();
        $this->pluginManager = $pluginManager;
    }
//endregion Constructor

//region SECTION: Public
    public function createInfo(): InfoInterface
    {
        $this
            ->getLocalPorts()
            ->checkService()
            ->checkLocalWeb();

        return $this;
    }
//endregion Public

//region SECTION: Private
    /**
     * @return $this
     * @throws \Exception
     */
    private function checkService():self
    {
        if ($this->pluginManager) {
            foreach ($this->pluginManager->getService() as $service) {
                $serviceDto = new ServiceDto();
                $serviceDto
                    ->setName($service->getName())
                    ->setHost($service->getHost())
                    ->setPort($service->getPort());

                switch (true) {
                    case $service instanceof ScanServiceInterface:
                        /** $service ScanServiceInterface */
                        $serviceDto->setPort($this->checkPrefix($service->getHost(), $service->getProtocol()));
                        $serviceDto->getPort() ? $serviceDto->setStatusOK() : $serviceDto->setStatusError();
                        break;
                    case $service instanceof DefaultServiceInterface:
                        /** $service DefaultServiceInterface */
                        $status = $this->checkPort($service->getHost(), $service->getPort());
                        $status ? $serviceDto->setStatusOK() : $serviceDto->setStatusError();
                        break;
                    default:
                        throw new \Exception('Bad service implementation, please use one from the DefaultServiceInterface, ScanServiceInterface');
                }

                $this->procInfo->addService($serviceDto);
            }
        }

        return $this;
    }

    private function checkLocalWeb():self
    {
        $service = new ServiceDto();
        $service
            ->setName('Web Server')
            ->setHost('localhost')
            ->setStatusOK();

        $this->procInfo->addService($service);

        return $this;
    }

    private function getLocalPorts():self
    {
        $cont       = file('/proc/net/tcp');
        $array_port = '';
        $max        = count($cont);
        for ($i = 0; $i < $max; $i++) {
            $str = explode(' ', $cont[$i]);
            if (preg_match('/[a-fA-F0-9:]$/', $str[4])) {
                $data = explode(':', $str[4]);
                if (isset($data[1])) {
                    $array_port .= hexdec($data[1]).':';
                }
            }
        }
        $this->ports = array_diff(array_unique(explode(':', $array_port)), array(''));

        return $this;
    }

    /**
     * @param $host
     * @param $prefix
     *
     * @return mixed|null
     */
    private function checkPrefix($host, $prefix)
    {
        $max = count($this->ports);
        $prefix = strtoupper($prefix);
        for ($i = 0; $i < $max; $i++) {
            if ($sock = @fsockopen($host, $this->ports[$i], $errno, $errstr, $this->timeout)) {
                stream_set_timeout($sock, 0, 100000);
                $tmp = strtoupper(fread($sock, 127));
                if (strpos($tmp, $prefix) !== false) {
                    return $this->ports[$i];
                }
                fclose($sock);
            }
        }

        return null;
    }

    /**
     * @param $host
     * @param $port
     *
     * @return bool
     */
    private function checkPort($host, $port):bool
    {
        if ($sock = @fsockopen($host, $port, $errno, $errstr, $this->timeout)) {
            fclose($sock);

            return true;
        }

        return false;
    }
//endregion Private

//region SECTION: Getters/Setters
    public function getInfo()
    {
        return $this->procInfo;
    }

    public function getAlias(): string
    {
        return 'procinfo';
    }
//endregion Getters/Setters
}