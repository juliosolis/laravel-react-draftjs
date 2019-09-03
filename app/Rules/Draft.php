<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Draft implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $content = json_decode($value, true);

        if (is_array($content) === false) {
            return false;
        }

        return !empty($content['content']['blocks'][0]['text']);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email body is required.';
    }
}
