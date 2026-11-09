<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    private const CLASSROOMS = ['X IPA 1', 'X IPS 1', 'XI IPA 2'];

    public function index(): View
    {
        return view('students.index', [
            'students' => Student::query()->orderBy('name')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('students.create', [
            'student' => null,
            'classrooms' => self::CLASSROOMS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $student = Student::query()->create($this->validatedData($request));

        return redirect()
            ->route('siswa.index')
            ->with('status', "Data {$student->name} berhasil ditambahkan.")
            ->with('resultAction', 'created');
    }

    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', [
            'student' => $student,
            'classrooms' => self::CLASSROOMS,
        ]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $student->update($this->validatedData($request, $student));

        return redirect()
            ->route('siswa.show', $student)
            ->with('status', "Data {$student->name} berhasil diperbarui.");
    }

    public function confirmDestroy(Student $student): View
    {
        return view('students.confirm-destroy', compact('student'));
    }

    public function destroy(Student $student): RedirectResponse
    {
        $name = $student->name;
        $student->delete();

        return redirect()
            ->route('siswa.index')
            ->with('status', "Data {$name} berhasil dihapus.")
            ->with('resultAction', 'deleted');
    }

    private function validatedData(Request $request, ?Student $student = null): array
    {
        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'max:20',
                Rule::unique('students', 'nim')->ignore($student?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'classroom' => ['required', Rule::in(self::CLASSROOMS)],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'average_score' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:100'],
            'is_active' => ['required', 'boolean'],
            'address' => ['nullable', 'string', 'max:2000'],
            'parent_phone' => ['nullable', 'string', 'max:30'],
        ], [
            'nim.regex' => 'NIM hanya boleh berisi angka (0-9).',
        ]);

        $validated['is_active'] = (bool) $validated['is_active'];

        return $validated;
    }
}
