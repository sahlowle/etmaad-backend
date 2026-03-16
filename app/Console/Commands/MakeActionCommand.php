<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

final class MakeActionCommand extends GeneratorCommand
{
    protected $signature = 'make:action {name}';

    protected $description = 'Create a new action class';

    protected $type = 'Action';

    public function handle(): int|bool|null
    {
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return 1;
        }

        return parent::handle();
    }

    protected function getNameInput(): string
    {
        $name = $this->argument('name');

        return Str::of(trim($name))
            ->replaceEnd('.php', '')
            ->replaceEnd('Action', '')
            ->append('Action')
            ->toString();
    }

    /**
     * Build the class with an inline stub.
     */
    protected function buildClass($name): string
    {
        $namespace = $this->getNamespace($name);
        $class = class_basename($name);

        return str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $class],
            $this->getStub()
        );
    }

    /**
     * Inline stub definition.
     */
    protected function getStub(): string
    {
        return <<<'PHP'
            <?php

            declare(strict_types=1);

            namespace {{ namespace }};

            use Illuminate\Support\Facades\DB;

            final readonly class {{ class }}
            {
                /**
                 * Execute the action.
                 */
                public function handle(): void
                {
                    DB::transaction(function (): void {
                        //
                    });
                }
            }

            PHP;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return app_path(str_replace('\\', '/', $name).'.php');
    }
}
