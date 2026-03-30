<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

final class MakeApiRequest extends GeneratorCommand
{
    protected $signature = 'api:make-request {name}';

    protected $description = 'Create a new API form request class';

    protected $type = 'Request';

    public function handle(): int|bool|null
    {
        if ($this->alreadyExists($this->getNameInput())) {
            $this->components->error($this->type.' already exists!');

            return 1;
        }

        return parent::handle();
    }

    protected function getNameInput(): string
    {
        $name = $this->argument('name');

        return Str::of(trim($name))
            ->replaceEnd('.php', '')
            ->replaceEnd('Request', '')
            ->append('Request')
            ->toString();
    }

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

    protected function getStub(): string
    {
        return <<<'PHP'
            <?php

            declare(strict_types=1);

            namespace {{ namespace }};

            use Illuminate\Contracts\Validation\ValidationRule;
            use Illuminate\Validation\Rule;
            use App\Http\Requests\Api\BaseApiFormRequest;

            final class {{ class }} extends BaseApiFormRequest
            {
                /**
                 * Determine if the user is authorized to make this request.
                 */
                public function authorize(): bool
                {
                    return true;
                }

                /**
                 * Get the validation rules that apply to the request.
                 *
                 * @return array<string, ValidationRule|array<mixed>|string>
                 */
                public function rules(): array
                {
                    return [
                        //
                    ];
                }
            }

            PHP;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Requests\Api';
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return app_path(str_replace('\\', '/', $name).'.php');
    }
}
