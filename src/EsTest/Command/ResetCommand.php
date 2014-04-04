<?php
/**
 * @author Matteo Giachino <matteog@gmail.com>
 */

namespace EsTest\Command;

use Elasticsearch\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResetCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('estest:reset')
            ->setDescription('reset elasticsearch');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $deleteParams['index'] = static::INDEX;
        $this->client->indices()->delete($deleteParams);
    }
} 