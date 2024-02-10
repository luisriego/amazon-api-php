<?php

namespace App\Adapter\Framework\Http\Dto\Address;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateAddressRequestDto implements RequestDto
{
    public ?string $name;
    public string $number;
    public string $street;
    public ?string $street2;
    public ?string $department;
    public ?string $neighborhood;
    public string $city;
    public string $zipCode;
    public ?string $country;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->number = $request->request->get('number');
        $this->street = $request->request->get('street');
        $this->street2 = $request->request->get('street2');
        $this->department = $request->request->get('department');
        $this->neighborhood = $request->request->get('neighborhood');
        $this->city = $request->request->get('city');
        $this->zipCode = $request->request->get('zipCode');
        $this->country = $request->request->get('country');
    }
}