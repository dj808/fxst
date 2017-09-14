<?php

namespace App\Menber\Form\Field;

use App\Menber\Form;

class Captcha extends Text
{
    protected $rules = 'required|captcha';

    protected $view = 'menber::form.captcha';

    public function __construct($column, $arguments = [])
    {
        if (!class_exists(\Mews\Captcha\Captcha::class)) {
            throw new \Exception('To use captcha field, please install [mews/captcha] first.');
        }

        $this->column = '__captcha__';
        $this->label = trans('menber::lang.captcha');
    }

    public function setForm(Form $form = null)
    {
        $this->form = $form;

        $this->form->ignore($this->column);

        return $this;
    }

    public function render()
    {
        $this->script = <<<EOT

$('#{$this->column}-captcha').click(function () {
    $(this).attr('src', $(this).attr('src')+'?'+Math.random());
});

EOT;

        return parent::render();
    }
}
