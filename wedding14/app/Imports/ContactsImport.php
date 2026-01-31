<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    public function model(array $row)
    {
        return new Contact([
            'name' => $row['name'],
            'gender' => $row['gender'],
            'phone' => $row['phone'],
            'event_id' => $this->event_id,
        ]);
    }
}