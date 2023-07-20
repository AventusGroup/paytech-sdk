<?php

namespace PayTech\PayTechBundle\Commands;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class EnvCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('paytech:add-vars');
        $this->setDescription('Add required vars');
    }

    public function __construct(private LoggerInterface $logger)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $path = __DIR__.'/../../../../.env.local';
        
        if (!file_exists($path)){
            touch($path);
        }
        
        try {
            $newEnvs = "PAYTECH_API_URL=http://processing.local/" . PHP_EOL .
                "PAYTECH_MERCHANT_KEY=1234567890"  . PHP_EOL .
                "PAYTECH_MERCHANT_NAME=TestMerchant";

            file_put_contents($path, $newEnvs, FILE_APPEND | LOCK_EX);
                return Command::SUCCESS;
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());
            return Command::FAILURE;
        }
    }
}