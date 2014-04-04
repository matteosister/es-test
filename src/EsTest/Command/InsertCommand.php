<?php
/**
 * @author Matteo Giachino <matteog@gmail.com>
 */

namespace EsTest\Command;

use Elasticsearch\Client;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('estest:insert')
            ->setDescription('adds in elasticsearch')
            ->addArgument('number', InputArgument::REQUIRED, 'number of items');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        for ($i = 1; $i <= $input->getArgument('number'); $i++) {
            $params = array();
            $params['body']  = array('testField' => 'abc');
            $params['index'] = 'customers';
            $params['type']  = 'customer';
            //$params['id']    = md5(uniqid('es', true));
            $ret = $this->client->index($params);
        }
    }
} 