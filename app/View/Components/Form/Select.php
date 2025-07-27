<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component {
    public $name, $label, $options, $value, $multiple;

    public function __construct($name, $label = null, $options = [], $value = null, $multiple = false) {
        $this->name     = $name;
        $this->label    = $label;
        $this->options  = $options;
        $this->multiple = $multiple;
        $this->value    = $value ?? old($name);
    }
    public function render(): View|Closure|string {
        return view('components.form.select');
    }
}
