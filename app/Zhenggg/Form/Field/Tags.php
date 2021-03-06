<?php

namespace App\Zhenggg\Form\Field;

use App\Zhenggg\Form\Field;

class Tags extends Field
{
    protected $value = [];

    protected static $css = [
        '/packages/front/AdminLTE/plugins/select2/select2.min.css',
    ];

    protected static $js = [
        '/packages/front/AdminLTE/plugins/select2/select2.full.min.js',
    ];

    public function fill($data)
    {
        $this->value = array_get($data, $this->column);

        if (is_string($this->value)) {
            $this->value = explode(',', $this->value);
        }

        $this->value = array_filter((array) $this->value);
    }

    public function prepare($value)
    {
        return array_filter($value);
    }

    public function render()
    {
        $this->script = "$(\"{$this->getElementClassSelector()}\").select2({
            tags: true,
            tokenSeparators: [',']
        });";

        return parent::render();
    }
}
