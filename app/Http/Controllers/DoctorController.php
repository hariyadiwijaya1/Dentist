<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Facades\Storage;
use function PHPSTORM_META\registerArgumentsSet;

class DoctorController extends Controller
{
    public function index()
    {
        return new ApiResource(true, 'Daftar Dokter', Doctor::get());
    }

    public function show(Doctor $doctor)
    {
        return new ApiResource(true, 'Details Dokter', $doctor);
    }

    public function store(DoctorRequest $request)
    {
        $request->validated();

        $doctor = Doctor::create([
            'name'          => request('name'),
            'gender'        => request('gender'),
            'phone'         => request('phone'),
            'address'       => request('address'),
            'specialist'    => request('specialist'),
            'status'        => request('status'),
            'photo'         => request()->file('photo')->store('img/doctors'),
        ]);

        return new ApiResource(true, 'Dokter berhasil ditambahkan', $doctor);
    }

    public function destroy(Doctor $doctor )
    {
        $doctor->delete();
        return new ApiResource(true, 'Dokter berhasil dihapus');
    }

    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $request->validated();

        if(request('photo'))
        {
            Storage::delete($doctor->photo);
            $photo = request()->file('photo')->store('img/doctors');
        } else {
            $photo = $doctor->photo;
        }

        $doctor->update([
            'name'          => request('name'),
            'gender'        => request('gender'),
            'phone'         => request('phone'),
            'address'       => request('address'),
            'specialist'    => request('specialist'),
            'status'        => request('status'),
            'photo'         => $photo,
        ]);

        return new ApiResource(true, 'Dokter berhasil dirubah', $doctor);
    }
}
