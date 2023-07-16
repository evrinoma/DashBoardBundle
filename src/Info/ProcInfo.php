<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\DashBoardBundle\Info;

use Evrinoma\DashBoardBundle\Provider\DefaultServiceInterface;
use Evrinoma\DashBoardBundle\Provider\ProviderInterface;
use Evrinoma\DashBoardBundle\Provider\ScanServiceInterface;
use Evrinoma\DashBoardBundle\Std\ProcInfo\ServiceStd;
use Evrinoma\DashBoardBundle\Std\ProcInfoStd;

class ProcInfo implements InfoInterface
{
    private $timeout = 5;
    private $ports = [];

    private ?ProviderInterface $pluginManager = null;

    private ?ProcInfoStd $procInfo = null;

    public function __construct(ProviderInterface $pluginManager = null)
    {
        $this->procInfo = new ProcInfoStd();
        $this->pluginManager = $pluginManager;
    }

    public function createInfo(): InfoInterface
    {
        $this
            ->getLocalPorts()
            ->checkService()
            ->checkLocalWeb();

        return $this;
    }

    /**
     * @return $this
     *
     * @throws \Exception
     */
    private function checkService(): self
    {
        if ($this->pluginManager) {
            foreach ($this->pluginManager->getService() as $service) {
                $serviceStd = new ServiceStd();
                $serviceStd
                    ->setName($service->getName())
                    ->setHost($service->getHost())
                    ->setPort($service->getPort());

                switch (true) {
                    case $service instanceof ScanServiceInterface:
                        /* $service ScanServiceInterface */
                        $serviceStd->setPort($this->checkPrefix($service->getHost(), $service->getProtocol()));
                        $serviceStd->getPort() ? $serviceStd->setStatusOK() : $serviceStd->setStatusError();
                        break;
                    case $service instanceof DefaultServiceInterface:
                        /** $service DefaultServiceInterface */
                        $status = $this->checkPort($service->getHost(), $service->getPort());
                        $status ? $serviceStd->setStatusOK() : $serviceStd->setStatusError();
                        break;
                    default:
                        throw new \Exception('Bad service implementation, please use one from the DefaultServiceInterface, ScanServiceInterface');
                }

                $this->procInfo->addService($serviceStd);
            }
        }

        return $this;
    }

    private function checkLocalWeb(): self
    {
        $service = new ServiceStd();
        $service
            ->setName('Web Server')
            ->setHost('localhost')
            ->setStatusOK();

        $this->procInfo->addService($service);

        return $this;
    }

    private function getLocalPorts(): self
    {
        $cont = file('/proc/net/tcp');
        $array_port = '';
        $max = \count($cont);
        for ($i = 0; $i < $max; $i++) {
            $str = explode(' ', $cont[$i]);
            if (preg_match('/[a-fA-F0-9:]$/', $str[4])) {
                $data = explode(':', $str[4]);
                if (isset($data[1])) {
                    $array_port .= hexdec($data[1]).':';
                }
            }
        }
        $this->ports = array_diff(array_unique(explode(':', $array_port)), ['']);

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
        $max = \count($this->ports);
        $prefix = strtoupper($prefix);
        for ($i = 0; $i < $max; $i++) {
            if ($sock = @fsockopen($host, $this->ports[$i], $errno, $errstr, $this->timeout)) {
                stream_set_timeout($sock, 0, 100000);
                $tmp = strtoupper(fread($sock, 127));
                if (str_contains($tmp, $prefix)) {
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
    private function checkPort($host, $port): bool
    {
        if ($sock = @fsockopen($host, $port, $errno, $errstr, $this->timeout)) {
            fclose($sock);

            return true;
        }

        return false;
    }

    public function getInfo()
    {
        return $this->procInfo;
    }

    public function getAlias(): string
    {
        return 'procinfo';
    }
}
