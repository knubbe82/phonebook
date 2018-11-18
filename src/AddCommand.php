<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class AddCommand extends Command
{
    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add a new phone.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /* question for user input */
        $helper = $this->getHelper('question');
        $nameQuestion = new Question('Name: ');
        $phoneQuestion = new Question('Phone number: ');

        /* validation */
        $this->emptyValidation($nameQuestion);
        $this->emptyValidation($phoneQuestion);
        /* get user input */
        $name = $helper->ask($input, $output, $nameQuestion);
        $phone = $helper->ask($input, $output, $phoneQuestion);

        /* store to db */
        $this->database->query(
            'insert into phones(name, phone) values(:name, :phone)',
            compact('name', 'phone')
        );

        /* message */
        $output->writeln('<info>Phone Added!</info>');

        $this->showAllPhones($output);
    }
}