<?php

class Paginator {
    private int $limit;
    private int $count;
    private int $pages;
    
    public function __construct(int $limit, int $countList)
    {
        $this->limit = $limit;
        $this->count = $countList;

        if ($limit > 0 && $countList > 0) {
            $this->pages = intdiv($this->count, $this->limit);
        } else {
            $this->pages = 0;
        }
    }

    public function getOffset(int $curPage = null): int
    {
        $offset = 0;
        if ($curPage) {
            $offset = $curPage * $this->limit - $this->limit;
        }
        return $offset;
    }

    public function getPages(): int
    {
        return $this->pages;
    }
}