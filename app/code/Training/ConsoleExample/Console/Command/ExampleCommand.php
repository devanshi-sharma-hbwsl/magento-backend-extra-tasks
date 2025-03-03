<?php

declare(strict_types=1);

namespace Training\ConsoleExample\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    protected function configure()
    {
        parent::configure();
        $this->setName('training:example:run');
        $this->setDescription('Training Console Example');
        $this->addArgument('product_id', InputArgument::REQUIRED, 'Product Id');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello World');
        $output->writeln('<info>Hello World</info>');
        $output->writeln('<comment>Hello World</comment>');
        $output->writeln('<error>Hello World</error>');
        $output->writeln('<question>Hello World</question>');

        $productId = $input->getArgument('product_id');
        $output->writeln($productId);

        return Command::SUCCESS;
    }
}
