<?php

namespace App\Zhenggg\Grid\Displayers;

use App\Zhenggg\Front;

class RowSelector extends AbstractDisplayer
{
    public function display()
    {
        Front::script($this->script());

        return <<<EOT
<input type="checkbox" class="grid-row-checkbox" data-id="{$this->getKey()}" />
EOT;
    }

    protected function script()
    {
        return <<<'EOT'
$('.grid-row-checkbox').iCheck({checkboxClass:'icheckbox_minimal-blue'}).on('ifChanged', function () {
    if (this.checked) {
        $(this).closest('tr').css('background-color', '#ffffd5');
    } else {
        $(this).closest('tr').css('background-color', '');
    }
});
EOT;
    }
}
