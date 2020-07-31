<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\CommandManager;

class CommandController extends Controller
{
    /**
     * @var CommandManager
     */
    private $commandManager;

    /**
     * @param CommandManager $commandManager
     */
    public function __construct(CommandManager $commandManager)
    {
        $this->commandManager = $commandManager;
    }

    /**
     * Execute the command.
     *
     * @return \Illuminate\View\View
     */
    public function command()
    {
        $response = $this->commandManager->executeCommands();

        return redirect()->route('LaravelInstaller::final')
                         ->with(['commandMessage' => $response]);
    }
}
