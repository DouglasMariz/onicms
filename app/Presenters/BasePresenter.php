<?php

namespace Onicms\Presenters;

use Laracasts\Presenter\Presenter;

abstract class BasePresenter extends Presenter
{
    public function createdAt()
    {
    	if($this->created_at != null)
        	return $this->created_at->diffForHumans();
       	return '-';
    }

    public function updatedAt()
    {
    	if($this->updated_at != null)
        	return $this->updated_at->diffForHumans();
       	return '-';
    }

    public function deletedAt()
    {
    	if(isset($this->deleted_at) && ($this->deleted_at != null))
        	return $this->deleted_at->diffForHumans();
       	return '-';
    }

}