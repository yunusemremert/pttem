<?php

namespace PtteM\Service\Feed;

abstract class AbstractFeedService
{
    public function getProductsData(): array
    {
        // or database query row
        return [
            [
              'id' => 1,
              'name' => 'Product 1',
              'price' => 1.0,
              'category' => 'Electronic',
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'price' => 2.0,
                'category' => 'Fashion',
            ],
            [
                'id' => 3,
                'name' => 'Product 3',
                'price' => 3.0,
                'category' => 'Home Decor',
            ],
            [
                'id' => 4,
                'name' => 'Product 4',
                'price' => 4.0,
                'category' => 'Electronic',
            ],
            [
                'id' => 5,
                'name' => 'Product 5',
                'price' => 5.0,
                'category' => 'Fashion',
            ],
            [
                'id' => 6,
                'name' => 'Product 6',
                'price' => 6.0,
                'category' => 'Home Decor',
            ],
            [
                'id' => 7,
                'name' => 'Product 7',
                'price' => 7.0,
                'category' => 'Electronic',
            ],
            [
                'id' => 8,
                'name' => 'Product 8',
                'price' => 8.0,
                'category' => 'Fashion',
            ],
            [
                'id' => 9,
                'name' => 'Product 9',
                'price' => 9.0,
                'category' => 'Home Decor',
            ],
            [
                'id' => 10,
                'name' => 'Product 10',
                'price' => 10.0,
                'category' => 'Electronic',
            ]
        ];
    }
}