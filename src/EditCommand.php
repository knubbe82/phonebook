<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class EditCommand extends Command
{
    public function configure()
    {
        $this->setName('edit')
            ->setDescription('Edit a phone by its id.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /* question for user input */
        $helper = $this->getHelper('question');
        $idQuestion = new Question('ID of user to edit: ');
        $nameQuestion = new Question('Name: ');
        $phoneQuestion = new Question('Phone number: ');

        /* validation */
        $this->emptyValidation($idQuestion);
        $this->emptyValidation($nameQuestion);
        $this->emptyValidation($phoneQuestion);

        /* get user input */
        $id = $helper->ask($input, $output, $idQuestion);
        $name = $helper->ask($input, $output, $nameQuestion);
        $phone = $helper->ask($input, $output, $phoneQuestion);

        /* update db */
        $this->database->query(
            'update phones set name=:name, phone=:phone where id = :id',
            compact('id', 'name', 'phone')
        );

        $output->writeln('<info>Phone Updated!</info>');

        $this->showAllPhones($output);
    }
}