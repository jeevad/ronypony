<?php

namespace AvoRed\Framework\System\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Models\Contracts\LanguageInterface;
use Illuminate\Support\Facades\Session;

class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $defaultLanguage = 'en';
        $languages = [$defaultLanguage];
        
        if (Session::has('multi_language_enabled')) {
            $languages = Session::get('languages');
            $defaultLanguage = Session::get('default_language');
        }

        $view
            //->withAdditionalLanguages($additionalLanguages)
            //->withIsMutliLanguage($isMultiLanguage)
            ->withDefaultLanguage($defaultLanguage)
            ->withLanguages($languages);
    }
}
