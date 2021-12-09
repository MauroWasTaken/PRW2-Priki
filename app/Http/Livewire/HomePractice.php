<?php

namespace App\Http\Livewire;

use App\Models\Practice;
use App\Models\PublicationState;
use Livewire\Component;

class HomePractice extends Component
{

    public $practices;
    public $numberOfDays=5;
    public function render()
    {
        $publication = PublicationState::where('slug', 'PUB')->get();
        $this->practices = Practice::publishedModifiedOnes($this->numberOfDays);
        return view('livewire.home-practice');
    }
}
