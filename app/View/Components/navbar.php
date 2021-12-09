<?php

namespace App\View\Components;

use Illuminate\View\Component;
use \App\Models\Domain;
use App\Models\Practice;

class navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public $domainArrays = [];
    public function render()
    {
        array_push($this->domainArrays,["slug"=>"","name"=>"Tous","countPractices"=>Practice::allPublished()->count()]);
        $domains = Domain::all();
        foreach ($domains as $domain)
        {
            array_push($this->domainArrays,["slug"=>$domain->slug,"name"=>$domain->name,"countPractices"=>$domain->publishedPractices()->count()]);

        }
        return view('components.navbar');
    }
}
