<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

class Registration extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Registration',
            'description'     => 'Displays registration page for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang'] = $this->getLanguage();

        $this->addCss('/plugins/cleanse/worldcup/assets/css/world-cup.css');
    }

    private function getLanguage()
    {
        $lang = Cookie::get('lang');

        if (isset($lang)) {
            $language = $lang;
        } else {
            $language = 'en';
        }

        return $language;
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/register')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }
}
