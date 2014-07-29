<?php namespace RainLab\Twitter\ReportWidgets;

use System\Models\Parameters;
use System\Classes\UpdateManager;
use Backend\Classes\ReportWidgetBase;
use RainLab\Twitter\Classes\TwitterClient;
use Exception;
use Request;
use Input;

/**
 * System status report widget.
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 */
class Tweet extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {

        $client = TwitterClient::instance();
        if (Request::ajax() && Input::get('new_message')) {
            $client->updateStatus(Input::get('new_message'));
        }

        $this->vars['user'] = $client->getUserData();
        $this->vars['posts'] = $client->homeTimeline($this->property('number'));

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'Widget title',
                'default'           => 'Twitter messages',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'The Widget Title is required.'
            ],
            'number' => [
                'title'             => 'Numbers of tweets',
                'description'       => 'The number of tweets beeing displayed in the timeline.',
                'default'           => '10',
                'type'              => 'string',
                'validationPattern' => '^\d+$',
                'validationMessage' => 'The Numbers of tweets input only accepts numbers.'
            ]
        ];
    }

    public function onSubmit()
    {
        echo "yes";
    }

}