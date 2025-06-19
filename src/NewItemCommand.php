<?php

namespace Samwilson\Hmw;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NewItemCommand extends Command {

    protected static $defaultName = 'newitem';

    protected static $defaultDescription = 'Create a new item.';

    public function execute(InputInterface $input, OutputInterface $output) {
        $currentCount = count(glob(dirname(__DIR__) . '/content/items/*.md'));
        $newFile = dirname(__DIR__) . '/content/items/' . ( $currentCount + 1 ) . '.md';
        if (file_exists($newFile)) {
            $output->writeln("File already exists: $newFile");
            return Command::FAILURE;
        }
        copy(dirname(__DIR__) . '/_item_template.md', $newFile);
        $output->writeln("File created: $newFile");
        return Command::SUCCESS;
    }

}
