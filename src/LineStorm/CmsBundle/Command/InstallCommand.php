<?php

namespace LineStorm\CmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\SecurityBundle\Tests\Functional\app\AppKernel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * This command will install all the assets
 *
 * Class IndexCommand
 *
 * @package LineStorm\SearchBundle\Command
 */
class InstallCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('linestorm:cms:assets')
            ->setDescription('Trigger an cms assets build')
            ->addArgument('input')
            ->addOption('symlink', null, InputOption::VALUE_NONE, 'If set, will symlink rather than hard copy')

        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        switch($input->getArgument('input'))
        {
            case 'install':

                /** @var AppKernel $kernel */
                $kernel = $container->get('kernel');
                $bundles = $kernel->getBundles();

                $base = $kernel->getRootDir().'/../web/assets/cms/sass/';
                if(!file_exists($base))
                    mkdir($base, 0644, true);

                foreach($bundles as $bundle)
                {
                    $path = $bundle->getPath()."/Resources/assets";
                    if(file_exists($path))
                    {
                        $link = $base.strtolower(str_replace('Bundle', '', $bundle->getName()));

                        if($input->getOption('symlink'))
                        {
                            if(file_exists($link))
                                unlink($link);

                            $output->writeln("Symlinking {$path} to {$link}");
                            symlink($path, $link);
                        }
                        else
                        {
                            if(file_exists($link))
                                rmdir($link);

                            $output->writeln("Copying {$path} to {$link}");
                            copy($path, $link);
                        }
                    }
                }

                break;

            default:
                $output->writeln('Unknown option');
                return;
                break;
        }

        $output->writeln("Finished");

    }
}
