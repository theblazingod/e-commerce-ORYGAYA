<?php

namespace App\View\Components\Profile;

use Illuminate\View\Component;

class UpdateProfileInformationForm extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}