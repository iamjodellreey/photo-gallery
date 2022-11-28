<?php

class Paginate {

    public $currentPage;
    public $itemsPerPage;
    public $totalCount;

    public function __construct($page=0, $itemsPerPage=4, $totalCount=0)
    {
        $this->currentPage = (int)$page;
        $this->itemsPerPage = (int)$itemsPerPage;
        $this->totalCount = (int)$totalCount;
    }

    public function next(){
        return $this->currentPage + 1;
    }

    public function previous(){
        return $this->currentPage - 1;
    }

    public function totalPage(){
        return ceil($this->totalCount/$this->itemsPerPage);
    }

    public function hasNext(){
        return $this->next() <= $this->totalPage() ? true : false;
    }

    public function hasPrevious(){
        return $this->previous() >= 1 ? true : false;
    }

    public function offset(){
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }
}
