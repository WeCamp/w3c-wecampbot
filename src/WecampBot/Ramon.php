<?php

declare(strict_types=1);

namespace W3C;

use PhpSlackBot\Command\BaseCommand;

final class Ramon extends BaseCommand
{
    protected function configure()
    {
        $this->setName('!ramon');
    }

    protected function execute($message, $context)
    {
        $this->send($this->getCurrentChannel(), null, '<@f_u_e_n_t_e> :dancer: :clap: :clap:');
    }
}
