<?php
/**
 * @author Matteo Giachino <matteog@gmail.com>
 */

namespace EsTest\Command;

use Elasticsearch\Client;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    /**
     * @var \Elasticsearch\Client
     */
    protected $client;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->client = new Client();
    }

    const INDEX = 'customers';
    const TYPE = 'customer';
}