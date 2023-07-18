<?php

namespace PayTech\PayTechBundle\Commands;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class StatusCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('paytech:status');
        $this->setDescription('Check if merchant is active');
    }

    public function __construct(private LoggerInterface $logger, private $url, private $name, private $key)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $client = new Client();
        try {
            $this->logger->info('Performing Check');
            $response = $client->post($this->url . 'v1/merchant/merchant-status', ['json' => ['key' => $this->name]]);
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody()->getContents());

                if ($result->key != $this->key) {
                    $io->error('Merchant key IS INVALID');

                    $key = $result->key;

                    unset($result->key);
                    $result->status =  $result->status ? 'Active' : 'Inactive';
                    $result = json_decode(json_encode($result), true);
                    $io->horizontalTable(['name', 'status', 'a2cBalance', 'c2aBalance'], [$result]);

                    return Command::FAILURE;
                }
                unset($result->key);
                $result->status =  $result->status ? 'Active' : 'Inactive';
                $result = json_decode(json_encode($result), true);
                $io->horizontalTable(['name', 'status', 'a2cBalance', 'c2aBalance'], [$result]);

                return Command::SUCCESS;
            }
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());
            return Command::FAILURE;
        }
        return Command::FAILURE;
    }
}