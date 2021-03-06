<?php

namespace App\Zhenggg\Form\Field;

class Mobile extends Text
{
    protected static $js = [
        '/packages/front/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js',
    ];

    /**
     * @see https://github.com/RobinHerbots/Inputmask#options
     *
     * @var array
     */
    protected $options = [
        'mask' => '99999999999',
    ];

    public function render()
    {
        $options = json_encode($this->options);

        $this->script = <<<EOT

$('{$this->getElementClassSelector()}').inputmask($options);
EOT;

        $this->prepend('<i class="fa fa-phone"></i>')
            ->defaultAttribute('style', 'width: 150px');

        return parent::render();
    }
}
