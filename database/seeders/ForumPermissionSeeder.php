<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\forums_sections;
class ForumPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = forums_sections::all();
        foreach ($sections as $section)
        {
            $section_name = 'section_'.$section->id;
            $exists_already = Permission::where("name",$section_name)->first();
            if (!$exists_already)
            {
                Permission::create(['name' => $section_name, 'guard_name' => 'web']);
                $categories = $section->categories()->get();
                foreach ($categories as $category)
                {
                    $category_name = 'category_' . $category->id;
                    $exists_already = Permission::where("name",$category_name)->first();
                    if (!$exists_already)
                    {
                        Permission::create(['name' => $category_name, 'guard_name' => 'web']);
                    }
                }
            }
        }
    }

}
