<?php
/**
 * @author Matteo Giachino <matteog@gmail.com>
 */

namespace EsTest\Command;

use Elasticsearch\Client;
use Faker\Factory;
use Symfony\Component\Console\Helper\ProgressHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertCommand extends BaseCommand
{
    private $faker;

    protected function configure()
    {
        $this
            ->setName('estest:insert')
            ->setDescription('adds in elasticsearch')
            ->addArgument('number', InputArgument::REQUIRED, 'number of items');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->faker = Factory::create('it_IT');
        $number = $input->getArgument('number');
        /** @var ProgressHelper $progress */
        $progress = $this->getHelperSet()->get('progress');
        $progress->setBarWidth(100);
        $progress->setRedrawFrequency(100);
        $progress->start($output, $number);
        for ($i = 1; $i <= $number; $i++) {
            $params = array();
            $params['body']  = $this->getCustomer();
            $params['index'] = 'customers';
            $params['type']  = 'customer';
            //$params['id']    = md5(uniqid('es', true));
            $ret = $this->client->index($params);
            $progress->advance();
        }
        $progress->finish();
    }

    private function getCustomer()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName
        ];
    }
} 