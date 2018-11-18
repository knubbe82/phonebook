<?php

namespace Knubbe;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    protected $database;

    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;
        parent::__construct();
    }

    protected function showAllPhones(OutputInterface $output)
    {
        if (!$phones = $this->database->fetchAll('phones'))
        {
            return $output->writeln('<comment>There is no phones at the moment!</comment>');
        }
        $table = new Table($output);
        $table->setHeaders(['ID', 'name', 'phone'])
              ->setRows($phones)
              ->render();
    }

    protected function emptyValidation($input)
    {
        $input->setValidator(function ($answer) {
            if (!$answer) {
                throw new \RuntimeException('This field can not be empty');
            }
            return $answer;
        });
    }
}