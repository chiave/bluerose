<?php
namespace Chiave\ErepublikScrobblerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CitizenScrobblerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('erepublik:scrobbler:citizens')
            ->setDescription('Fetch some citizens data.')
            ->addArgument(
                'citizenId',
                InputArgument::REQUIRED,
                'Id of citizen.'
            )
            // ->addArgument(
            //     'master_id',
            //     InputArgument::REQUIRED,
            //     'Master Id of entity'
            // )
            // ->addArgument(
            //     'slave_id',
            //     InputArgument::REQUIRED,
            //     'Slave Id of entity?'
            // )
            // ->addOption(
            //    'inception',
            //    null,
            //    InputOption::VALUE_NONE,
            //    'If set, the task will yell in uppercase letters'
            // )
            // ->addOption(
            //    'check',
            //    null,
            //    InputOption::VALUE_NONE,
            //    'Print information abour relation between entities'
            // )
            // ->addOption(
            //    'remove',
            //    null,
            //    InputOption::VALUE_NONE,
            //    'Remove relation between entities'
            // )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    // $output->writeln('<info>foo</info>');            // green text
    // $output->writeln('<comment>foo</comment>');      // yellow text
    // $output->writeln('<question>foo</question>');    // black text on a cyan background
    // $output->writeln('<error>foo</error>');          // white text on a red background
        $userIdToFetch = intval($input->getArgument('citizenId'));

        $cScrobbler = $this->getContainer()->get('erepublik_citizen_scrobbler');

        $status = $cScrobbler->updateCitizen($userIdToFetch);

        switch ($status) {
            case 'nouser':
                $message = '<error>User with given ID does not exist.</error>';
                break;
            case 'update':
                $message = '<comment>User updated.</comment>';
                break;
            case 'create':
                $message = '<info>User created.</info>';
                break;
        }

        $output->writeln($message);

        // $rawType = $input->getArgument('type');

        // $type = $this->getEntityName($rawType);
        // $master_id = intval($input->getArgument('master_id'));
        // $slave_id = intval($input->getArgument('slave_id'));

        // $error = $this->checkForErrors($type, $master_id, $slave_id);

        // if ($error) {
        //     $output->writeln($error);
        //     return;
        // }

        // $master = $this->getRepository($type)->find($master_id);
        // $slave = $this->getRepository($type)->find($slave_id);

        // if ($input->getOption('check')) {
        //     if ($master->getRelated()) {
        //         $output->writeln('<comment>Parent for first ' . $rawType . ' is ' . $rawType . ' with id: '. $master->getRelated()->getId() . '</comment>');
        //     } else {
        //         $output->writeln('<comment>First ' . $rawType . ' has no parent set.</comment>');
        //     }

        //     if ($slave->getRelated()) {
        //         $output->writeln('<comment>Parent for second ' . $rawType . ' is ' . $rawType . ' with id: '. $slave->getRelated()->getId() . '</comment>');
        //     } else {
        //         $output->writeln('<comment>Second ' . $rawType . ' has no parent set.</comment>');
        //     }

        //     if ($slave->getRelated() && $slave->getRelated()->getId() == $master->getId()) {
        //         $output->writeln('<comment>First ' . $rawType . ' is parent for the second one.</comment>');
        //     } elseif ($master->getRelated() && $master->getRelated()->getId() == $slave->getId()) {
        //         $output->writeln('<comment>Second ' . $rawType . ' is parent for the first one.</comment>');
        //     }

        //     return;
        // }

        // // if ($input->getOption('remove')) {
        // //     if ($slave->getRelated() && $slave->getRelated()->getId() == $master->getId()) {
        // //         $slave->setRelated(0);
        // //         $this->getEntityManager()->flush();
        // //         $output->writeln('<info>Relation between ' . $rawType . 's with id ' . ' and ' . '' . ' was removed.</info>');
        // //         return;

        // //     } else{
        // //         $output->writeln('<error>Picked ' . $rawType . 's were not related! Nothings changed.</error>');
        // //         return;
        // //     }

        // //     return;
        // // }

        // $slave->setRelated($master);
        // if ($input->getOption('inception') && $rawType == 'page'){
        //     $output->writeln('<info>Inception mode!<info>');

        //     // ultimateDataCollection
        //     // $dataToRelate = array();
        //     // foreach($master->getSections as $section) {
        //     //     foreach($section->getSegments as $segment) {
        //     //         foreach($segment->getWidgets as $widget) {

        //     //         }
        //     //     }
        //     // }

        //     // $arguments = array(
        //     //     'command' => 'coshi:r:e',
        //     //     'type' => 'coshi:r:e',
        //     //     'master_id' => 'coshi:r:e',
        //     //     'slave_id' => 'coshi:r:e',
        //     // );

        //     // $input = new ArrayInput($arguments);
        //     // $returnCode = $this
        //     //     ->getApplication()
        //     //     ->find('coshi:r:e')
        //     //     ->run($input, $output)
        //     // ;

        //     return;
        // } elseif ($input->getOption('inception')) {
        //     $output->writeln('<error>Inception is only avaible for pages!</error>');
        //     return;
        // }

        // //page->getSections()
        // //section->getSegments()
        // //segment->getWidgets()
        // //widget

        // $this->getEntityManager()->flush();

        // $output->writeln('<info>                                                               </info>');
        // $output->writeln('<info>                        Success!                               </info>');
        // $output->writeln('<info>                                                               </info>');
        // $output->writeln('<comment>' . $rawType . ' with id ' . $master_id .
        //     ' is now parent for the ' . $rawType . ' with id ' . $slave_id . '.</comment>')
        // ;
    }
}
