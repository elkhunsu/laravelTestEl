<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'article_id' => 1,
            'comment_text' => $this->faker->paragraph,
        ];
    }
}
