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

use Evrinoma\DashBoardBundle\Std\SysInfo\CpuStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\DevStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\DiskStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\NetworkStd;
use Evrinoma\DashBoardBundle\Std\SysInfo\ScsiStd;
use Evrinoma\DashBoardBundle\Std\SysInfoStd;
use Evrinoma\ShellBundle\Core\ShellInterface;

/**
 * Class SysInfo.
 */
class SysInfo implements InfoInterface
{
    private const NOT_AVAILABLE = 'N.A.';
    private const ERROR = 'ERROR';

    /**
     * @var SysInfoStd
     */
    private $sysInfo;

    /**
     * @var ShellInterface
     */
    private $shellManager;

    /**
     * SysInfo constructor.
     *
     * @param ShellInterface $shellManager
     */
    public function __construct(ShellInterface $shellManager)
    {
        $this->sysInfo = new SysInfoStd();
        $this->shellManager = $shellManager;
    }

    // get our apache SERVER_NAME or vhost
    protected function getDistr(): SysInfo
    {
        $this->sysInfo->setDistr('Linux');

        return $this;
    }

    protected function getIpAddress(): SysInfo
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $varName = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $varName = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $varName = $_SERVER['REMOTE_ADDR'];
        } else {
            $varName = getenv('SERVER_ADDR');
        }

        if ('' !== $varName && false !== $varName) {
            $this->sysInfo->setIpAddress($varName);
        }

        return $this;
    }

    protected function getVHostName(): SysInfo
    {
        if (SysInfoStd::UNKNOWN !== $this->sysInfo->getIpAddress()) {
            $varName = gethostbyaddr($this->sysInfo->getIpAddress());
        } else {
            $varName = getenv('SERVER_NAME');
        }

        if ('' !== $varName && false !== $varName) {
            $this->sysInfo->setVHostName($varName);
        }

        return $this;
    }

    protected function getCHostName(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/sys/kernel/hostname', 1)) {
            $this->sysInfo->setCHostName(gethostbyaddr(gethostbyname(trim($this->shellManager->getResult()))));
        }

        return $this;
    }

    protected function getKernel(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/version', 1)) {
            if (preg_match('/version (.*?) /', $this->shellManager->getResult(), $ar_buf)) {
                $result = $ar_buf[1];
                if (preg_match('/SMP/', $this->shellManager->getResult())) {
                    $result .= ' (SMP)';
                }
            }
            $this->sysInfo->setKernel($result);
        } else {
            $this->sysInfo->setKernel(self::NOT_AVAILABLE);
        }

        return $this;
    }

    // get the IP address of our canonical hostname

    protected function getUptime(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/uptime', 1)) {
            $ar_buf = preg_split('/\s/', $this->shellManager->getResult());
            $this->sysInfo->setUpTime(trim($ar_buf[0]));
        }

        return $this;
    }

    protected function getUsers(): SysInfo
    {
        if ($this->shellManager->executeProgram('who', '-q')) {
            $who = explode('=', $this->shellManager->getResult());
            $this->sysInfo->setUsers($who[1]);
        }

        return $this;
    }

    protected function getLoadAvg(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/loadavg')) {
            $results = preg_split("/\s/", $this->shellManager->getResult(), 4);
            $this->sysInfo->getLoadAvg()->setLoadAve1($results[0])->setLoadAve5($results[1])->setLoadAve15($results[2]);
            if ($this->shellManager->rfts('/proc/stat', 1)) {
                sscanf($this->shellManager->getResult(), '%*s %f %f %f %f', $ab, $ac, $ad, $ae);
                $this->sysInfo->getLoadAvg()->setUserCpuLast($ab)->setNiceCpuLast($ac)->setSystemCpuLast($ad)->setIdleCpuLast($ae);

                sleep(1);

                $this->shellManager->rfts('/proc/stat', 1);
                sscanf($this->shellManager->getResult(), '%*s %f %f %f %f', $ab, $ac, $ad, $ae);
                $this->sysInfo->getLoadAvg()->setUserCpuNext($ab)->setNiceCpuNext($ac)->setSystemCpuNext($ad)->setIdleCpuNext($ae);
            }
        }

        return $this;
    }

    protected function getCpuInfo(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/cpuinfo')) {
            $cpu = new CpuStd();
            foreach ($this->shellManager->toArrayString() as $item) {
                $splite = preg_split('/\s+:\s+/', $item);
                if (\count($splite) > 1) {
                    [$key, $value] = $splite;
                    switch ($key) {
                        case 'model name':
                        case 'cpu':
                        case 'Processor':
                            $cpu->setModel($value);
                            break;
                        case 'BogoMIPS':
                            $cpu->setCpuSpeed($value);
                            break;
                        case 'cpu MHz':
                        case 'clock':
                            $cpu->setCpuSpeed(sprintf('%.2f', $value));
                            break;
                        case 'cycle frequency [Hz]':
                            $cpu->setCpuSpeed(sprintf('%.2f', $value / 1000000));
                            break;
                        case 'cache size':
                        case 'L2 cache':
                        case 'I size':
                            $cpu->setCache($value);
                            break;
                        case 'D size':
                            $cpu->addCache($value);
                            break;
                        case 'revision':
                        case 'cpu model':
                            $cpu->setModel($cpu->getModel().' ( rev: '.$value.')');
                            break;
                        case 'bogomips':
                        case 'BogoMips': // For sparc arch
                            $cpu->addBogomips($value);
                            break;
                        case 'system type': // Alpha arch - 2.2.x
                            $cpu->setModel($cpu->getModel().', '.$value.' ');
                            break;
                        case 'platform string': // Alpha arch - 2.2.x
                            $cpu->setModel($cpu->getModel().' ('.$value.')');
                            break;
                        case 'Cpu0ClkTck': // Linux sparc64
                            $cpu->setCpuSpeed(sprintf('%.2f', hexdec($value) / 1000000));
                            break;
                        case 'Cpu0Bogo': // Linux sparc64 & sparc32
                            $cpu->setBogomips($value);
                            break;
                    }
                }
            }
            $this->sysInfo->addCpu($cpu);
        }

        return $this;
    }

    protected function getPci(): SysInfo
    {
        if ($this->shellManager->executeProgram('lspci', '', false)) {
            foreach ($this->shellManager->toArrayString() as $buf) {
                $device = explode(' ', $buf, 4);
                if (\array_key_exists(3, $device)) {
                    $pci = new DevStd();
                    $pci->setProduct($device[2].$device[1])->setSerialNumber($device[0])->setDescription($device[3]);
                    $this->sysInfo->addPci($pci);
                }
            }
        }

        return $this;
    }

    protected function getScsi(): SysInfo
    {
        $dev_type = '';
        $get_type = 0;

        if ($this->shellManager->executeProgram('lsscsi', '-c', false) || $this->shellManager->rfts('/proc/scsi/scsi')) {
            foreach ($this->shellManager->toArrayString() as $buf) {
                if (str_contains($buf, 'Vendor')) {
                    preg_match('/Vendor: (.*) Model: (.*) Rev: (.*)/i', $buf, $dev);
                    [$key, $value] = preg_split('/:\s/', $buf, 2);
                    $get_type = true;
                    continue;
                }

                if ($get_type) {
                    preg_match('/Type:\s+(\S+)/i', $buf, $dev_type);
                    $scsi = new ScsiStd();
                    $scsi
                        ->setModel($dev[1].' '.$dev[2].' ('.$dev_type[1].')')
                        ->setMedia('Hard Disk');
                    $this->sysInfo->addScsi($scsi);
                    $get_type = false;
                }
            }
        }

        return $this;
    }

    protected function getUsb(): SysInfo
    {
        if ($this->shellManager->executeProgram('lsusb', '', false)) {
            foreach ($this->shellManager->toArrayString() as $buf) {
                $device = explode(' ', $buf, 7);
                if (\array_key_exists(6, $device)) {
                    $usb = new DevStd();
                    $usb->setProduct($device[6])->setSerialNumber($device[5]);
                    $this->sysInfo->addUsb($usb);
                }
            }
        } elseif ($this->shellManager->rfts('/proc/bus/usb/devices')) {
            $values = $this->shellManager->toArrayString();
            $keys = preg_grep('/^\s*$/', explode("\n", $values));
            $i = 0;
            $stop = true;
            do {
                $j = $i + 1;
                if (\array_key_exists($i, $keys)) {
                    $i = $keys[$i];
                }
                if (\array_key_exists($j, $keys)) {
                    $j = $keys[$j];
                } else {
                    $j = \count($values);
                    $stop = false;
                }
                $usb = new DevStd();
                for (; $i < $j; ++$i) {
                    [$key, $value] = explode('=', $values[$i], 2);
                    switch ($key) {
                        case 'Manufacturer':
                            $usb->setDescription($value);
                            break;
                        case 'Product':
                            $usb->setProduct($value);
                            break;
                        case 'SerialNumber':
                            $usb->setSerialNumber($value);
                            break;
                    }
                }
                $this->sysInfo->addUsb($usb);
            } while ($stop);
        }

        return $this;
    }

    protected function getNetwork(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/net/dev')) {
            foreach (preg_grep('/:/', $this->shellManager->toArrayString()) as $buf) {
                [$dev_name, $stats_list] = explode(':', $buf, 2);
                $stats = preg_split('/\s+/', trim($stats_list));
                $network = new NetworkStd();
                $network->setName($dev_name)
                    ->setRxBytes($stats[0])
                    ->setRxPackets($stats[1])
                    ->setRxErrors($stats[2])
                    ->setRxDrop($stats[3])
                    ->setTxBytes($stats[8])
                    ->setTxPackets($stats[9])
                    ->setTxErrors($stats[10])
                    ->setTxDrop($stats[11]);
                $this->sysInfo->addNetwork($network);
            }
        }

        return $this;
    }

    protected function getMemory(): SysInfo
    {
        if ($this->shellManager->rfts('/proc/meminfo')) {
            foreach ($this->shellManager->toArrayString() as $buf) {
                if (preg_match('/^MemTotal:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setMemTotal((int) $ar_buf[1] * 1000);
                    continue;
                }
                if (preg_match('/^MemFree:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setMemFree((int) $ar_buf[1] * 1000);
                    continue;
                }
                if (preg_match('/^Cached:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setCached((int) $ar_buf[1] * 1000);
                    continue;
                }
                if (preg_match('/^Buffers:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setBuffers((int) $ar_buf[1] * 1000);
                    continue;
                }
                if (preg_match('/^SwapTotal:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setSwapTotal((int) $ar_buf[1] * 1000);
                    continue;
                }
                if (preg_match('/^SwapFree:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
                    $this->sysInfo->getMemory()->setSwapFree((int) $ar_buf[1] * 1000);
                    continue;
                }
            }

            if ($this->shellManager->rfts('/proc/swaps')) {
                foreach ($this->shellManager->toArrayString() as $item) {
                    if ('' !== $item & (!str_contains($item, 'Filename'))) {
                        $arBuf = preg_split('/\s+/', $item, 6);
                        $devSwap = new DiskStd();
                        $devSwap
                            ->setName($arBuf[0])
                            ->setTotal((int) $arBuf[2])
                            ->setUsed((int) $arBuf[3]);
                        $this->sysInfo->getMemory()->addDevSwap($devSwap);
                    }
                }
            }
        }

        return $this;
    }

    /**
     * @param bool $showBind
     *
     * @return $this
     */
    protected function getFilesystems($showBind = true): self
    {
        $j = 0;

        if ($this->shellManager->executeProgram('df', '-kPl')) {
            $df = preg_grep('/(\\%\\s)/', preg_split("/\n/", $this->shellManager->getResult(), -1, \PREG_SPLIT_NO_EMPTY));
        } else {
            $df = [];
        }

        if ($this->shellManager->executeProgram('df', '-iPl')) {
            $dfInode = preg_grep('/(\\%\\s)/', preg_split("/\n/", $this->shellManager->getResult(), -1, \PREG_SPLIT_NO_EMPTY));
        } else {
            $dfInode = [];
        }

        if ($this->shellManager->executeProgram('mount')) {
            $mount = preg_split("/\n/", $this->shellManager->getResult(), -1, \PREG_SPLIT_NO_EMPTY);
        } else {
            $mount = [];
        }

        foreach ($df as $line) {
            $dfBuf = preg_split('/(\%\s)/', $line, 2);

            preg_match('/(.*)(\s+)(([0-9]+)(\s+)([0-9]+)(\s+)([0-9]+)(\s+)([0-9]+)$)/', $dfBuf[0], $dfSplit);

            $df_buf = [$dfSplit[1], $dfSplit[4], $dfSplit[6], $dfSplit[8], $dfSplit[10], $dfBuf[1]];

            preg_match_all('/([0-9]+)%/', $dfInode[$j + 1], $inode_buf, \PREG_SET_ORDER);

            $df_buf[0] = trim(str_replace('$', '\$', $df_buf[0]));
            $df_buf[5] = trim($df_buf[5]);

            $current = 0;

            foreach ($mount as $mount_line) {
                ++$current;
                if (preg_match('#'.$df_buf[0].' on '.$df_buf[5]." type (.*) \((.*)\)#", $mount_line, $mount_buf)) {
                    $mount_buf[1] .= ','.$mount_buf[2];
                } elseif (!preg_match('#'.$df_buf[0].'(.*) on '.$df_buf[5]." \((.*)\)#", $mount_line, $mount_buf)) {
                    continue;
                }

                if ($showBind || false === stripos($mount_buf[2], 'bind')) {
                    $disk = new DiskStd();
                    $disk
                        ->setName(str_replace('\$', '$', $df_buf[0]))
                        ->setTotal($df_buf[1] * 1000)
                        ->setUsed($df_buf[2] * 1000)
                        ->setFree($df_buf[3] * 1000)
                        ->setMount($df_buf[5])
                        ->setFstype(substr($mount_buf[1], 0, strpos($mount_buf[1], ',')))
                        ->setOptions(substr($mount_buf[1], strpos($mount_buf[1], ',') + 1, \strlen($mount_buf[1])));

                    if (isset($inode_buf[\count($inode_buf) - 1][1])) {
                        $disk->setInodes($inode_buf[\count($inode_buf) - 1][1]);
                    }
                    $this->sysInfo->addDisk($disk);
                    ++$j;
                    unset($mount[$current - 1]);
                    sort($mount);
                    break;
                }
            }
        }

        return $this;
    }

    public function createInfo(): InfoInterface
    {
        $this
            ->getMemory()
            ->getLoadAvg()
            ->getCHostName()
            ->getCpuInfo()
            ->getIpAddress()
            ->getKernel()
            ->getFilesystems()
            ->getNetwork()
            ->getPci()
            ->getUptime()
            ->getUsb()
            ->getUsers()
            ->getScsi()
            ->getVHostName()
            ->getDistr();

        return $this;
    }

    public function getInfo()
    {
        return $this->sysInfo;
    }

    public function getAlias(): string
    {
        return 'sysinfo';
    }
}
