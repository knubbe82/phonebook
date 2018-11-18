<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EditCommand extends Command
{
    public function configure()
    {
        $this->setName('edit')
            ->setDescription('Edit a phone by its id.')
            ->addArgument('id', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::REQUIRED, 'Add a name')
            ->addArgument('phone', InputArgument::REQUIRED, 'Add a phone number');;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $name = $input->getArgument('name');
        $phone = $input->getArgument('phone');

        $this->database->query(
            'update phones set name=:name, phone=:phone where id = :id',
            compact('id', 'name', 'phone')
        );

        $output->writeln('<info>Phone Updated!</info>');

        $this->showAllPhones($output);
    }
}