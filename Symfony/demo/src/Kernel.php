<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Bref\SymfonyBridge\BrefKernel;

class Kernel extends BrefKernel
{
    use MicroKernelTrait;
}
