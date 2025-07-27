<?php
namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class BaseForm extends Component {
    public $action, $method, $enctype;
    public function __construct($action = '', $method = 'POST', $enctype = null) {
        $this->action = $action;
        $this->method = strtoupper($method);
        $this->enctype = $enctype;
    }

    public function render(): View|Closure|string {
        return view('components.form.form');
    }
}
