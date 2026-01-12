<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    /**
     * Create a new component instance.
     */
    public string $action;
    public string $method;
    public string $confirm;
    public string $class;

    public function __construct(
        string $action,
        string $method = 'POST',
        string $confirm = 'Are you sure?',
        string $class = ''
    ) {
        $this->action = $action;
        $this->method = strtoupper($method);
        $this->confirm = $confirm;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('v2.components.action-button');
    }
}
