<?php
namespace App\Command;

use App\Service\CsvImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'app:import-csv',description: 'Importe un CSV')]
class ImportCsvCommand extends Command
{
    private $csvImporter;

    public function __construct(CsvImporter $csvImporter)
    {
        $this->csvImporter = $csvImporter;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('csvFile', InputArgument::REQUIRED, 'Le chemin vers le fichier CSV à importer.');
    }

    //Execution de la commande d'import, en récupérant le CSV donné en argument
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csvFile = $input->getArgument('csvFile');

        $this->csvImporter->import($csvFile);

        $output->writeln('Importation terminée. Vous pouvez afficher le tableau en allant sur http://localhost/Test-import-CSV/public/');
        return Command::SUCCESS;
    }
}
