<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    public $breadcrumb;
    public $vueActive;

    public function __construct($breadcrumb = array("main_title" => "", "second_level" => "", "ref" => "users"), 
    $vueActive = "app")
    {
        $this -> breadcrumb = $breadcrumb;
        $this -> vueActive = $vueActive;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.app');
    }
}
