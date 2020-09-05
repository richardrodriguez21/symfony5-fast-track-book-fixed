<?php
/**
 * Created by PhpStorm.
 * User: rrodriguez2
 * Date: 2020-09-05
 * Time: 10:02
 */

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Contracts\Cache\CacheInterface;

class StepInfoCommand extends Command {

  protected static $defaultName = 'app:step:info';

  private $cache;

  public function __construct(CacheInterface $cache) {
    $this->cache = $cache;

    parent::__construct();
  }

  protected function execute(InputInterface $input, OutputInterface $output): int {
    // $process = new Process(['git', 'tag', '-l', '--points-at', 'HEAD']);

    //    $process = new Process(['git', 'status']);
    //    $process->mustRun();
    //    $output->write($process->getOutput());

    $step = $this->cache->get('app.current_step', function ($item) {
      $process = new Process(['git', 'status']);
      $process->mustRun();
      $item->expiresAfter(30);

      return $process->getOutput();
    });
    $output->writeln($step);
    return 0;
  }


}