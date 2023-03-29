<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->text(10), 
            "author" => $this->faker->name ,
            "isbn" => $this->faker->randomNumber(5, true), 
            "NP" => $this->faker->randomNumber(4, true), 
            "status" => $this->faker->text ,
            "publish_date" =>$this->faker->date(),
            "genre_id" => $this->faker->numberBetween(1,5) , 
            "collection_id" => $this->faker->numberBetween(1,5)

        ];
    }
}
