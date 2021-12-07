<?php
namespace app\classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{

    private static $error = [];

    private static $error_messages = [
        'string' => 'The :attribute cannot contains numbers',
        'required' => 'The :attribute field is requied',
        'minLength' => 'The :attribute field must be a minimum of :policy characters',
        'maxLength' => 'The :attribute field must be a minimum of :policy characters',
        'mixed' => 'The :attribute field can contain letters, numbers, dash and space only',
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20',
        'email' => 'Email address is not valid',
        'unique' => 'That :attribute is already taken, try to another one'
    ];

    /**
     * Colum
     *
     * @param array $dataAndValues,
     *            column and value to validate
     * @param array $policies,
     *            the rules that validation must satisfy
     */
    public function abide(array $dataAndValues, array $policies)
    {
        // loop through array
        foreach ($dataAndValues as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                // do validation
                self::doValidation([
                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column]
                ]
                );
            }
        }
    }

    /**
     * Perform validation for the data provider and set error messages
     *
     * @param array $data
     */
    private static function doValidation(array $data)
    {
        $column = $data['column'];
        foreach ($data['policies'] as $rule => $policy) {
            // rule = required, maxlength etc.
            $valid = call_user_func_array([
                self::class,
                $rule
            ], [
                $column,
                $data['value'],
                $policy
            ]);
            if (! $valid) {
                self::setErrorMsgs(
                    // replace attribute, >police and dash
                    str_replace([
                        ':attribute',
                        ':policy',
                        '_'
                    ], [
                        $column,
                        $policy,
                        ' '
                    ], self::$error_messages[$rule]), $column
                );
            }
        }
    }

    /**
     * Validate if record exists in database
     *
     * @param
     *            $column,name,column
     * @param
     *            $value,
     * @param $policy, ,
     *            e.g. min lenght = 5
     * @return boolean, true or false
     */
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }

    /**
     * this field is required
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return boolean
     */
    public static function required($column, $value, $policy)
    {
        return $value != null && ! empty(trim($value));
    }

    /**
     * this validate min length of value inserted into form field
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return boolean
     */
    public static function minLength($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            return strlen($value) >= $policy;
        }
    }

    /**
     * check max lenght of value inserted into form
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return boolean
     */
    protected static function maxLength($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            return strlen($value) <= $policy;
        }
        return true;
    }

    /**
     * validate email in form field
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return mixed|boolean
     */
    protected static function email($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
        return true;
    }

    protected static function mixed($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            if (! preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * allow only string into form field
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return boolean
     */
    protected static function string($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            if (! preg_match('/^[A-Za-z ]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * allow only numbers
     *
     * @param
     *            $column
     * @param
     *            $value
     * @param
     *            $policy
     * @return boolean
     */
    protected static function number($column, $value, $policy)
    {
        if ($value != null && ! empty(trim($value))) {
            if (! preg_match('/^[0-9.]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Set specific error
     *
     * @param
     *            $error
     * @param
     *            $key
     */
    private static function setErrorMsgs($error, $key = null)
    {
        if ($key) {
            self::$error[$key][] = $error;
        } else {
            self::$error[] = $error;
        }
    }

    /**
     * return true if there is a validation error
     *
     * @return boolean
     */
    public function hasError()
    {
        return count(self::$error) > 0 ? true : false;
    }

    /**
     * Return all validation Errors
     *
     * @return array
     */
    public function getErrorMsgs()
    {
        return self::$error;
    }
}
