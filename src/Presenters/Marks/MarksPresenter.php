<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\MarkFacade;
use Marks\Presenters\BasePresenter;

/**
 * @Property MarksTemplate $template
 */
class MarksPresenter extends BasePresenter
{
    public function __construct(
        private readonly MarkFacade $marks
    ) {
        parent::__construct();
    }

    protected function createComponentMarkCollection(): MarkCollectionControl
    {
        return new MarkCollectionControl($this->marks);
    }
}
