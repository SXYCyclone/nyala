<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Concerns\HasOptions;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\Support\Arrayable;

class RichSelect extends Field
{
    use HasOptions;

    protected string $view = 'forms.components.rich-select';

    protected array | Arrayable | Closure $descriptions = [];

    public function descriptions(array | Arrayable | Closure $descriptions): static
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function hasDescription($value): bool
    {
        return array_key_exists($value, $this->getDescriptions());
    }

    public function getDescription($value): ?string
    {
        return $this->getDescriptions()[$value] ?? null;
    }

    public function getDescriptions(): array
    {
        $descriptions = $this->evaluate($this->descriptions);

        if ($descriptions instanceof Arrayable) {
            $descriptions = $descriptions->toArray();
        }

        return $descriptions;
    }
}
