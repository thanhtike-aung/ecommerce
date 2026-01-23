<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Developer information
        $developer = [
            'name' => 'Ei Phyu Lwin',
            'role' => 'Lead Developer',
            'bio' => 'Ei is a strategy first student.',
            'image' => 'images/team/john-doe.jpg',
            'social' => [
                'github' => 'https://github.com/johndoe',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'twitter' => 'https://twitter.com/johndoe'
            ]
        ];

        // Company information
        $company = [
            'name' => 'Nexwear',
            'founded' => '2020',
            'mission' => 'To provide high-quality, affordable products with exceptional customer service.',
            'vision' => 'To become the leading e-commerce platform for premium products in the region.'
        ];

        return view('pages.customer.about.index', compact('developer', 'company'));
    }
}
