<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component {
    public $name, $label, $checked, $id, $class;
    public function __construct($name, $label = null, $checked = false, $id = null, $class = null) {
        $this->name = $name;
        $this->label = $label;
        $this->checked = old($name, $checked);
        $this->id = $id ?? $name;
        $this->class = $class;
    }

    public function render(): View|Closure|string {
        return view('components.form.checkbox');
    }
}