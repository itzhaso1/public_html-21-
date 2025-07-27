<?php
namespace App\View\Components\Form;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
class Input extends Component {
    public $type, $name, $label, $value, $attributes;
    public function __construct($name, $type = 'text', $label = null, $value = null) {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value ?? old($name);
    }

    public function render(): View|Closure|string {
        return view('components.form.input');
    }
}
