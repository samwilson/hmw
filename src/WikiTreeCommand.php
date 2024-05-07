<?php

namespace Samwilson\Hmw;

use App\Database;
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class WikiTreeCommand extends Command {

    protected static $defaultName = 'wikitree';

    protected static $defaultDescription = 'Check against WikiTree and add missing information.';

    /** @var Database */
    private $db;

    /** @var Client */
    private $client;

    /** @var SymfonyStyle */
    private $io;

    public function execute(InputInterface $input, OutputInterface $output) {
        $this->db = new Database( __DIR__ . '/../cache/database/db.sqlite3' );
        $this->client = new Client();
        $this->io = new SymfonyStyle($input, $output);

        // Margaret Wilson.
        $this->ancestors('Hall-55121');
        // William Murray Wilson.
        //$this->ancestors('Wilson-84876');

        return Command::SUCCESS;
    }

    private function ancestors( $wikitreeId ) {
        $p = $this->db->query('select * from pages where wikitree = "' . $wikitreeId.'"')->fetch();

        $wikiTreeUrl = 'https://api.wikitree.com/api.php?action=getProfile&key=' . $wikitreeId;
        $response = $this->client->request( 'GET', $wikiTreeUrl );

        $profiles = json_decode( $response->getBody()->getContents(), true);

        foreach ($profiles[0]['profile']['Parents'] as $parent) {
            $parentPage = $this->db->query('select * from pages where wikitree = "' . $parent['Name'] . '"')->fetch();
            if ( !$parentPage ) {
                $possibleFilename = dirname( __DIR__ ) . '/content/people/' . preg_replace('/[^a-z]/', '-', strtolower($parent['LongName'])) . '.md';
                $n = 2;
                while (file_exists($possibleFilename)) {
                    $possibleFilename = substr( $possibleFilename, 0, -3 ) . '-' . $n . '.md';
                    $n++;
                }
                $markdown = "---\n"
                . "template: person\n"
                . "title: {$parent['LongName']}\n"
                . "parents:\n"
                . "  - \n"
                . "partners:\n"
                . "  - \n"
                . "wikitree: {$parent['Name']}\n"
                . "myheritage: \n"
                . "ancestry: \n"
                . "familysearch: \n"
                . "---\n";
                $this->io->error('No local page found for ' . $parent['Name'] . ', parent of ' . $p->id );
                $this->io->writeln( $markdown );
                $response = $this->io->ask( "Create $possibleFilename ?", 'Y' );
                if ($response === 'Y') {
                    file_put_contents($possibleFilename, $markdown);
                    $this->io->success('Saved ' . $possibleFilename);
                }
                continue;
            }
            $this->ancestors($parent['Name']);
        }
    }
}
