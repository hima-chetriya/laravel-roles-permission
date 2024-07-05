<?php
  
namespace App\Imports;
  
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
  
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        // dd($row['hobbies'],json_decode($row['hobbies']));
        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'gender'    => $row['gender'], 
            'country'    => $row['country'], 
            'countries'    => $row['countries'], 
            'hobbies'  => $row['hobbies'],
        ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required',
    //         'gender' => 'required',
    //         'hobbies' => 'required',
    //         // 'password' => 'required|min:5',
    //         'email' => 'required|email|unique:users'
    //     ];
    // }
}