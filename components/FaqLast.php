<?php namespace RedMarlin\Faq\Components;

use Cms\Classes\ComponentBase;
use RedMarlin\Faq\Models\Question;
use Router;

class FaqLast extends ComponentBase
{
    public $faqs;

    public function componentDetails()
    {
        return [
            'name'        => 'FAQ Latest Questions',
            'description' => 'Displays X latest questions from all categories'
        ];
    }

    public function defineProperties()
    {
        return [
             'questionNumber' => [
             'title'             => 'Question number',
             'description'       => 'Show X Last questions',
             'default'           => 5,
             'type'              => 'string',
             'validationPattern' => '^[0-9]+$',
             'validationMessage' => 'The Question number property can contain only numeric symbols'
            ],
            'linkid' => [
             'title'             => 'Link id',
             'description'       => 'Needed to show ',
             'default'           => ':linkid',
             'type'              => 'string',
             'validationPattern' => '',
             'validationMessage' => 'The Question number property can contain only numeric symbols'
             ]
        ];
    }
     public function onRun()
    {
        //$faq = new Question();

        $this->faqs = Question::whereIsApproved('1')
                        ->orderBy('id', 'desc')
                        ->with('category')
                        ->take($this->property['questionNumber'])
                        ->get();
    }


}