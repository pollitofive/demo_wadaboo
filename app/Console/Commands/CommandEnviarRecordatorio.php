<?php

namespace App\Console\Commands;

use App\Repositories\RepoUser;
use Illuminate\Console\Command;

class CommandEnviarRecordatorio extends Command
{
    protected $signature = 'enviar:recordatorio';

    protected $description = 'Busca los usuarios con el mail sin validar y envia un recordatorio';
    private $repoUser;

    public function __construct(RepoUser $repoUser)
    {
        parent::__construct();
        $this->repoUser = $repoUser;
    }

    public function handle()
    {
        $usuarios = $this->repoUser->darUsuariosConElMailSinValidar();

        foreach($usuarios as $usuario)
        {
            $usuario->sendEmailVerificationNotification();
            $usuario->actualizarEnvioRecordatorio();
            sleep(5);

        }

    }
}
