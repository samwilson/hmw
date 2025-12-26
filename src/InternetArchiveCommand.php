<?php


namespace Samwilson\Hmw;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class InternetArchiveCommand extends Command
{

    protected static $defaultName = 'ia';

    protected static $defaultDescription = 'Upload a set of images to the Internet Archive.';

    protected function configure()
    {
        $this->addArgument( 'dir', InputArgument::REQUIRED );
        $this->addArgument( 'filename', InputArgument::REQUIRED );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $dir = $input->getArgument( 'dir' );
        $filename = $input->getArgument( 'filename' );

        $find = new Process( [ 'find', $dir, '-name', "*$filename*" ] );
        $find->mustRun();
        $fileList = $find->getOutput();
        $files = array_filter(explode("\n", $fileList));
        sort($files);
        $io->writeln('Files found:');
        $io->listing($files);

        $itemId = $io->ask( 'Enter item ID', '', static function ($v) {
            if (!is_numeric($v)) {
                throw new RuntimeException();
            }
            return (int)$v;
        } );

        $archiveId = 'HMW' . $itemId;
        $zip = './' . $archiveId . '_images.zip';
        $continue = $io->ask('Create zip file ' . $zip . '?', 'Y');
        if ($continue !== 'Y') {
            return Command::SUCCESS;
        }

        $zipping = new Process(array_merge(['zip', '-j', $zip], $files));
        $zipping->setTimeout(null);
        $zipping->mustRun();

        $title = $io->ask( 'Enter item title' );

        $continue = $io->ask('Upload to ' . $archiveId . '?', 'Y');
        if ($continue !== 'Y') {
            return Command::SUCCESS;
        }

        $desc = '<p>This item is part of the <a href="https://hmwilson.archives.org.au">H.M. Wilson Archives</a>.</p>'
            . '<p>For more details, see: <a href="https://hmwilson.archives.org.au/items/'.$itemId.'.html">https://hmwilson.archives.org.au/items/'.$itemId.'.html</a></p>';
        $metadata = [
            'mediatype' => 'texts',
            'title' => $title,
            'description' => $desc,
            'subject' => 'hmwilson.archives.org.au',
        ];
        $command = ['ia', 'upload', $archiveId];
        foreach ( $metadata as $key => $val ) {
            $command[] = '-m';
            $command[] = "$key:$val";
        }
        $command[] = $zip;
        $upload = new Process($command);
        $upload->setTimeout(null);
        $upload->mustRun(function ($type, $buffer): void {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
        return Command::SUCCESS;
    }

}
