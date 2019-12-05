<?php

use App\Category;
use Illuminate\Database\Seeder;

class PrizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['1st Draw', '2nd Draw', '3rd Draw'];
        $levels = [1, 2, 3];
        $prizenames = ['Dreamscape Hat', 'Sodexo PHP 1000', 'Headphones', 'Under Armor Bag', 'Flight Ticket', 'Grocery Package',
        'Vivo Phone', 'iPhone X', 'Sony A7 III DSLR Camera', 'Yamaha NMAX', 'Toyota Rush', 'Hose and Lot'];
        foreach($categories as $k => $name) {
            $category = Category::create(['name' => $name]);

            $prizes = [];
            foreach(range(1,12) as $i) {
                $value = 1000 * ($k+1) + ($i * 100);
                $prizes[] = [
                    'name' => $prizenames[$i-1],
                    'value' => $value,
                    'level' => $i == 12 ? 2 : 1,
                    'category_id' => $category->id
                ];
            }
            DB::table('prizes')->insert($prizes);
        }
    }
}
