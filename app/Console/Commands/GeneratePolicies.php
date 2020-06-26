<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class GeneratePolicies extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'policy:generate {name?} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom command for generating Policy files';

     /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = "Policy";

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/policy.stub';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if($this->getNameInput()){
            return parent::handle();
        }
        \Nova::resourcesIn(app_path('Nova'));
        $i = 1;
        foreach (\App\Nova\Role::getResources() as $resource) {
            $model = $resource::$model;
            $name = str_replace($this->rootNamespace(), $this->rootNamespace().'Policies\\', $model.'Policy');

            $this->info($i++.' - '.$name);
            $this->call('policy:generate', [
                'name' => $name,
                '--force' => $this->option('force'),
            ]);
        }
        $this->info('generated policies');
    }

}
