<?php
/**
 * Created by PhpStorm.
 * User: janaka
 * Date: 22/01/19
 * Time: 5:05 PM
 */

namespace App\Repositories;


use App\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{
    /**
     * @return mixed
     */
    public function getCategories()
    {
        return Category::get();
    }

    /**
     * @param array $request
     * @return Category
     */
    public function createCategory(array $request)
    {
        $category = new Category($request);
        $category->save();
        return $category;
    }

    /**
     * @param string $category
     * @return Category
     */
    public function getCategory(String $category)
    {
        return Category::where('name', '=', $category)->first();
    }
}