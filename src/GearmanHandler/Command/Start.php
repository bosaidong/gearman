<?php
namespace GearmanHandler\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GearmanHandler\Process;
use GearmanHandler\Daemon;
use GearmanHandler\Config;

class Start extends Command
{
    /**
     *
     */
    protected function configure()
    {
        $this->setName('start')
            ->setDescription('Greet someone')
            ->addOption('config', 'c', InputOption::VALUE_OPTIONAL);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (Process::isRunning()) {
            $output->writeln('<error>Process is already runnning</error>');
        }

        if ($config = $input->getOption('config')) {
            Config::setPath(realpath($config));
        }

        (new Daemon)->run();
    }
}