<?php

namespace App\Adapter\Framework\Http\Dto;

use Symfony\Component\HttpFoundation\Request;

interface RequestDto
{
    public function __construct(Request $request);
}