<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeApiController extends Command
{
    protected $signature = 'api:make-controller 
                            {name : The name of the controller}
                            {--resource : Generate a resource controller with CRUD methods}
                            {--model= : The model to use for the resource controller}';

    protected $description = 'Create a new API controller in Controllers\\Api directory';

    public function __construct(protected Filesystem $files)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $name = $this->getControllerName();

        $path = $this->getControllerPath($name);

        if ($this->files->exists($path)) {
            $this->components->error("Controller [{$name}] already exists.");

            return self::FAILURE;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildStub($name));

        $this->components->info("Controller [{$name}] created successfully.");
        $this->line("  <fg=blue>Location:</> app/Http/Controllers/Api/{$name}.php");

        return self::SUCCESS;
    }

    // -------------------------------------------------------
    // Helpers
    // -------------------------------------------------------

    private function getControllerName(): string
    {
        $name = $this->argument('name');

        // Ensure it ends with "Controller"
        if (! str_ends_with($name, 'Controller')) {
            $name .= 'Controller';
        }

        return $name;
    }

    private function getControllerPath(string $name): string
    {
        return app_path("Http/Controllers/Api/{$name}.php");
    }

    private function makeDirectory(string $path): void
    {
        $directory = dirname($path);

        if (! $this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    private function buildStub(string $name): string
    {
        $stub = $this->option('resource')
            ? $this->resourceStub()
            : $this->plainStub();

        $model = $this->option('model') ?? str_replace('Controller', '', $name);
        $modelVar = lcfirst($model);
        $modelPlural = lcfirst($model).'s';

        return str_replace(
            ['{{ name }}', '{{ model }}', '{{ modelVar }}', '{{ modelPlural }}'],
            [$name,         $model,        $modelVar,         $modelPlural],
            $stub
        );
    }

    // -------------------------------------------------------
    // Stubs
    // -------------------------------------------------------

    private function plainStub(): string
    {
        return <<<PHP
        <?php

        namespace App\Http\Controllers\Api;

        use Illuminate\Http\JsonResponse;
        use Illuminate\Http\Request;

        class {{ name }} extends BaseApiController
        {
            //
        }
        PHP;
    }

    private function resourceStub(): string
    {
        return <<<PHP
        <?php

        namespace App\Http\Controllers\Api;

        use App\Models\{{ model }};
        use Illuminate\Http\JsonResponse;
        use Illuminate\Http\Request;

        class {{ name }} extends BaseApiController
        {
            public function index(): JsonResponse
            {
                \${{ modelPlural }} = {{ model }}::paginate(10);

                return \$this->paginated(\${{ modelPlural }});
            }

            public function store(Request \$request): JsonResponse
            {
                \$validated = \$request->validate([
                    //
                ]);

                \${{ modelVar }} = {{ model }}::create(\$validated);

                return \$this->created(\${{ modelVar }});
            }

            public function show({{ model }} \${{ modelVar }}): JsonResponse
            {
                return \$this->success(\${{ modelVar }});
            }

            public function update(Request \$request, {{ model }} \${{ modelVar }}): JsonResponse
            {
                \$validated = \$request->validate([
                    //
                ]);

                \${{ modelVar }}->update(\$validated);

                return \$this->success(\${{ modelVar }});
            }

            public function destroy({{ model }} \${{ modelVar }}): JsonResponse
            {
                \${{ modelVar }}->delete();

                return \$this->noContent();
            }
        }
        PHP;
    }
}
