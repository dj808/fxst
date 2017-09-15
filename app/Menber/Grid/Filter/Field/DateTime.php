<?php

namespace App\Menber\Grid\Filter\Field;

use App\Menber\Menber;

class DateTime
{
    /**
     * @var \App\Menber\Grid\Filter\AbstractFilter
     */
    protected $filter;

    protected $options = [];

    public function __construct($filter, array $options = [])
    {
        $this->filter = $filter;

        $this->options = $this->checkOptions($options);

        $this->prepare();
    }

    public function prepare()
    {
        $script = "$('#{$this->filter->getId()}').datetimepicker(".json_encode($this->options).');';

        Menber::script($script);
    }

    public function variables()
    {
        return [];
    }

    public function name()
    {
        return 'datetime';
    }

    protected function checkOptions($options)
    {
        $options['format'] = array_get($options, 'format', 'YYYY-MM-DD HH:mm:ss');
        $options['locale'] = array_get($options, 'locale', config('app.locale'));

        return $options;
    }
}