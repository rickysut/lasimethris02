<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;

    public function definition(): array
    {

        $title = implode(' ', array_slice(explode(' ', $this->faker->sentence), 0, 5));
        $title = substr($title, 0, 25);
        $slug = Str::slug($title, '-');
        $category = Category::all()->random();
        $category_id = $category->id;
        return [
            'title' => $title,
            'slug' => $slug,
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut malesuada libero lectus, a viverra dui consectetur vel. Ut eu bibendum mauris. Donec erat ante, volutpat et euismod et, semper nec arcu. Nunc scelerisque quam eros, bibendum semper massa ultrices ac. Cras quis mi eget dui pellentesque scelerisque. Integer gravida ligula sed ex bibendum consectetur. Cras feugiat id massa eu congue. Donec id egestas nunc. Integer auctor in enim quis aliquam. Nulla in dictum dolor. Aenean lacinia, ex eu porttitor lacinia, nulla justo vestibulum neque, vitae congue quam dolor a nunc. Maecenas elit diam, consectetur nec congue vitae, dictum vitae risus. Morbi ac arcu velit. Donec ac quam blandit felis ultrices dictum ut eget quam. Pellentesque fringilla mauris ante, ut tincidunt sem scelerisque eget. Proin nulla erat, egestas a elit vitae, aliquam sodales turpis.</p>

            <p>Proin at tempor metus, tincidunt commodo neque. Aenean dolor urna, tincidunt vitae blandit id, vehicula eget libero. Suspendisse justo nulla, semper porta nibh venenatis, gravida laoreet risus. Duis id quam a nisl condimentum tincidunt. Sed aliquet ipsum bibendum porta tempor. Aliquam erat volutpat. Morbi a pretium ante.</p>
            
            <p>Maecenas ullamcorper, lorem in scelerisque efficitur, sapien leo rhoncus felis, vel elementum magna magna et augue. Suspendisse mattis arcu vitae magna tempor, eget egestas tortor pulvinar. Quisque cursus tellus vitae varius varius. Etiam faucibus nec felis et rutrum. Mauris eu quam turpis. Nunc tincidunt nec nulla in ultricies. Vestibulum venenatis sodales ipsum at suscipit. Nunc tempor justo eu gravida tristique. Proin semper sed nisi quis bibendum. In eleifend neque vel dictum tempor. Ut sed arcu a nunc hendrerit convallis at sit amet leo. Praesent leo mi, venenatis non interdum ut, faucibus et quam. Integer congue nunc et ipsum posuere sagittis. Quisque ut nunc imperdiet velit dignissim eleifend. Donec ex eros, interdum eget lacus ac, egestas faucibus est.</p>
            
            <p>Praesent congue massa facilisis orci volutpat bibendum. Mauris sed purus leo. Morbi convallis convallis fringilla. Proin cursus orci sed eros euismod vehicula. Quisque ut nunc malesuada, iaculis neque sodales, viverra est. Donec vulputate sem non justo ultricies consequat. Suspendisse eget congue velit. Aenean quis venenatis erat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur nec rhoncus ante. Morbi convallis est vel magna interdum, in aliquam nisi accumsan. Aliquam erat volutpat.</p>',
            'user_id' => 1,
            'category_id' => $category_id,
            'tags' => $this->faker->word(),
            'exerpt' => $this->faker->sentence(),
            'priority' => $this->faker->numberBetween(1, 4),
            'is_active' => 'on',
            'published_at' => now(),
            'visibility' => 'on',
        ];
    }
}
