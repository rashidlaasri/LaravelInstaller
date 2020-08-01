<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\CommandManager;
use Illuminate\Http\Request;

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
    public function commands(Request $request)
    {
        $response = $this->commandManager->executeCommands();

        $request->session()->put(['commandMessage' => $response]);
        $request->session()->reflash();
        $request->session()->save();

        return redirect()->route('LaravelInstaller::final');
    }
}
