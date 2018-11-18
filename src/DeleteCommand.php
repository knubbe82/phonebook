<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends Command
{
    public function configure()
    {
        $this->setName('delete')
            ->setDescription('Delete a phone by its id.')
            ->addArgument('id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');

        $this->database->query('delete from phones where id = :id', compact('id'));

        $output->writeln('<info>Phone Deleted!</info>');

        $this->showAllPhones($output);
    }
}