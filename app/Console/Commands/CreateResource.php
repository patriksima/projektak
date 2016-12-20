<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateResource extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * All the files being generated.
     *
     * @var array
     */
    protected $stubs = [
        'controller' => 'app/Http/Controllers/Api',
        'filter' => 'app/Filters',
        'repository' => 'app/Repositories',
    ];

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->argument('name');

        foreach ($this->stubs as $stub => $path) {
            $path = base_path("{$path}/{$name}{$this->suffix($stub)}.php");

            $this->makeDirectory($path);

            $this->files->put($path, $this->buildClass($stub, $name));
        }

        $this->appendRoutes();

        $this->info('Resource created successfully.');
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Builds given class.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function buildClass($stub, $name)
    {
        $stub = $this->files->get($this->getStub($stub));

        return $this->replaceResource($stub, $name)->replaceLowercase($stub, $name);
    }

    /**
     * Replace the resource for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceResource(&$stub, $name)
    {
        $stub = str_replace(
            '{resource}', $name, $stub
        );

        return $this;
    }

    /**
     * Replace the resource for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceLowercase($stub, $name)
    {
        return str_replace(
            '{resource-lowercase}', strtolower($name), $stub
        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @param  string  $class
     * @return string
     */
    protected function getStub($class)
    {
        return __DIR__."/stubs/{$class}.stub";
    }

    /**
     * Returns the file suffix.
     *
     * @param  string  $stub
     * @return string
     */
    protected function suffix($stub)
    {
        return ucfirst($stub);
    }

    /**
     * Appends to the routes file.
     *
     * @return void
     */
    protected function appendRoutes()
    {
        $this->files->append(
            base_path('routes/api.php'),
            $this->buildClass('routes', $this->argument('name'))
        );
    }
}
