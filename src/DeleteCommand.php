<?php

namespace Knubbe;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class DeleteCommand extends Command
{
    public function configure()
    {
        $this->setName('delete')
            ->setDescription('Delete a phone by its id.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /* question for user input */
        $helper = $this->getHelper('question');
        $idQuestion = new Question('ID of user to delete: ');

        /* validation */
        $this->emptyValidation($idQuestion);

        /* get user input */
        $id = $helper->ask($input, $output, $idQuestion);

        /* delete from database */
        $this->database->query('delete from phones where id = :id', compact('id'));

        $output->writeln('<info>Phone Deleted!</info>');

        $this->showAllPhones($output);
    }
}