<?php

namespace App\Rules;

use App\Models\Users;
use Illuminate\Contracts\Validation\Rule;

class Is_User_Exist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $email;
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Users::where(["email" => $this->email])->first() ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Email tidak ditemukan";
    }
}
