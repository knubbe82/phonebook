<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCommand extends Command
{
    public function configure()
    {
        $this->setName('show')
            ->setDescription('Show all phones.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->showAllPhones($output);
    }
}