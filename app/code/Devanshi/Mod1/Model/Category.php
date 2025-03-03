<?php

namespace Devanshi\Mod1\Model;

use Devanshi\Mod1\Api\CategoryInterface;

class Category implements CategoryInterface
{
    public function getCategoryName(): string
    {
        return "Devanshi's Sample Category";
    }
}