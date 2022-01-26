<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Practice;
use App\Models\Domain;

class listPracticesByDomain extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mod=true,$domains)
    {
        $this->mod=$mod;
        $this->domains=$domains;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public $mod;
    public $domains;
    public function render()
    {
        return view('components.list-practices-by-domain');
    }
}
