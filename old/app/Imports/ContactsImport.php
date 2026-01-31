<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function model(array $row)
    {
        return new Contact([
            'name' => $row['name'],
            'gender' => $row['gender'],
            'phone' => $row['phone'],
            'user_id' => $this->user_id, // Assign the user_id
        ]);
    }
}