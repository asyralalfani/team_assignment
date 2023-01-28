<?php

namespace App\Rules;

use App\Models\Users;
use Illuminate\Contracts\Validation\Rule;

class Is_Password_Same implements Rule
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
        $data = Users::where(["email" => $this->email])->first();
        return !$data || ($data && $data->password != hash("sha256", md5($value))) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password salah';
    }
}
