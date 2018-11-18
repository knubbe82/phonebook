<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command
{
    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add a new phone.')
            ->addArgument('name', InputArgument::REQUIRED, 'Add a name')
            ->addArgument('phone', InputArgument::REQUIRED, 'Add a phone number');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $phone = $input->getArgument('phone');

        $this->database->query(
            'insert into phones(name, phone) values(:name, :phone)',
            compact('name', 'phone')
        );

        $output->writeln('<info>Phone Added!</info>');

        $this->showAllPhones($output);
    }
}