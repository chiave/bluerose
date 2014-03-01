<?php
namespace Chiave\ErepublikScrobblerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MilitaryUnitFetcherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('egov:fetcher:militaryUnits')
            ->setDescription('Fetch military units data.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $muFetcher = $this->getContainer()->get('egov_nationalraport_fetcher');
        $muFetcher->updateMilitaryUnits();

        $output->writeln('Done. I think.');
    }
}
