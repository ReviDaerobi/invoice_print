<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class InvoiceItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'ItemId' => 2,
                'ItemName' => 'Assembly Instruction S&H DEVON ARMCHAIR',
                'Unit' => 'PCS',
                'UnitPrice' => 250.00
            ],
            [
                'ItemId' => 3,
                'ItemName' => 'Assembly Instruction S&H DEVON CHAIR',
                'Unit' => 'PCS',
                'UnitPrice' => 250.00
            ],
            [
                'ItemId' => 4,
                'ItemName' => 'KARTU NAMA RICKY HERMAWAN',
                'Unit' => 'BOX',
                'UnitPrice' => 50000.00
            ],
            [
                'ItemId' => 5,
                'ItemName' => 'XXXXXXXXXXX',
                'Unit' => 'XXX',
                'UnitPrice' => 222222.00
            ],
            [
                'ItemId' => 6,
                'ItemName' => 'Amplop Jaya PT. GEMA SERVICE MOTORINDO',
                'Unit' => 'BOX',
                'UnitPrice' => 30000.00
            ],
            [
                'ItemId' => 7,
                'ItemName' => 'AAAAAAAAAAAAAAAAAAAAAAAAAAAA',
                'Unit' => 'PCS',
                'UnitPrice' => 115.00
            ],
            [
                'ItemId' => 8,
                'ItemName' => 'abcdefghij',
                'Unit' => 'pcs',
                'UnitPrice' => 275.00
            ],
            [
                'ItemId' => 9,
                'ItemName' => 'klmnopqrst',
                'Unit' => 'box',
                'UnitPrice' => 25000.00
            ],
            [
                'ItemId' => 10,
                'ItemName' => 'abcdefghijhjhjhj',
                'Unit' => 'pcs',
                'UnitPrice' => 275.00
            ],
            [
                'ItemId' => 11,
                'ItemName' => 'klmnopqrsthjhjhj',
                'Unit' => 'box',
                'UnitPrice' => 25000.00
            ],
            [
                'ItemId' => 12,
                'ItemName' => 'hjkhjkhjkhjkhjk',
                'Unit' => 'dus',
                'UnitPrice' => 100.00
            ],
            [
                'ItemId' => 13,
                'ItemName' => 'Sticker OVVIO UPC# 91549488 (KSL-0276)',
                'Unit' => 'pcs',
                'UnitPrice' => 250.00
            ],
        ];

        foreach ($items as $item) {
            Produk::create($item);
        }
    }
}