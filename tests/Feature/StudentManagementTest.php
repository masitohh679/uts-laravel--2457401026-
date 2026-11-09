<?php

namespace Tests\Feature;

use App\Models\Student;
use Database\Seeders\StudentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_the_school_identity_and_student_summary(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('Halaman Beranda')
            ->assertSee('SMKN 1 Wirausaha')
            ->assertSee('2457401026');
    }

    public function test_student_seeder_creates_three_students_for_case_six(): void
    {
        $this->seed(StudentSeeder::class);

        $this->assertDatabaseCount('students', 3);
        $this->assertDatabaseHas('students', ['nim' => '2457401026']);
    }

    public function test_student_list_displays_seeded_records(): void
    {
        $this->seed(StudentSeeder::class);

        $this->get(route('siswa.index'))
            ->assertOk()
            ->assertSee('Halaman daftar data')
            ->assertSee('Alya Putri Ramadhani')
            ->assertSee('2457401026');
    }

    public function test_empty_create_form_is_available(): void
    {
        $this->get(route('siswa.create'))
            ->assertOk()
            ->assertSee('Form tambah data')
            ->assertSee('name="nim"', false)
            ->assertSee('value=""', false);
    }

    public function test_invalid_student_data_returns_validation_errors(): void
    {
        $this->from(route('siswa.create'))
            ->post(route('siswa.store'), [])
            ->assertRedirect(route('siswa.create'))
            ->assertSessionHasErrors(['nim', 'name', 'classroom', 'birth_date', 'average_score', 'is_active']);

        $this->get(route('siswa.create'))
            ->assertOk()
            ->assertSee('Form tambah data yang menampilkan pesan error validasi')
            ->assertSee('Periksa kembali data yang dimasukkan.');

        $this->assertDatabaseCount('students', 0);
    }

    public function test_nim_must_contain_only_digits(): void
    {
        foreach (['ABC24574010', '2457-401026', '2457 401026', '2457.401026'] as $nim) {
            $this->from(route('siswa.create'))
                ->post(route('siswa.store'), array_merge(
                    $this->validStudent(),
                    ['nim' => $nim],
                ))
                ->assertRedirect(route('siswa.create'))
                ->assertSessionHasErrors([
                    'nim' => 'NIM hanya boleh berisi angka (0-9).',
                ]);
        }

        $this->assertDatabaseCount('students', 0);
    }

    public function test_valid_student_can_be_created_and_success_is_shown_on_list(): void
    {
        $this->post(route('siswa.store'), $this->validStudent())
            ->assertRedirect(route('siswa.index'))
            ->assertSessionHas('resultAction', 'created');

        $this->get(route('siswa.index'))
            ->assertOk()
            ->assertSee('Halaman daftar dengan pesan sukses setelah menambah data')
            ->assertSee('Data Bima Pratama berhasil ditambahkan.')
            ->assertSee('Bima Pratama');

        $this->assertDatabaseHas('students', [
            'nim' => '2457401030',
            'name' => 'Bima Pratama',
            'is_active' => true,
        ]);
    }

    public function test_student_can_be_saved_as_inactive(): void
    {
        $this->post(route('siswa.store'), array_merge(
            $this->validStudent(),
            ['is_active' => '0'],
        ))
            ->assertRedirect(route('siswa.index'));

        $this->assertDatabaseHas('students', [
            'nim' => '2457401030',
            'is_active' => false,
        ]);
    }

    public function test_student_detail_and_prefilled_edit_form_are_available(): void
    {
        $student = Student::query()->create($this->validStudent());

        $this->get(route('siswa.show', $student))
            ->assertOk()
            ->assertSee('Halaman detail data')
            ->assertSee($student->name)
            ->assertSee($student->address);

        $this->get(route('siswa.edit', $student))
            ->assertOk()
            ->assertSee('Form ubah yang sudah terisi data lama')
            ->assertSee('value="2457401030"', false)
            ->assertSee('value="Bima Pratama"', false);
    }

    public function test_student_can_be_updated(): void
    {
        $student = Student::query()->create($this->validStudent());

        $this->put(route('siswa.update', $student), array_merge(
            $this->validStudent(),
            ['name' => 'Bima Pratama Wijaya'],
        ))
            ->assertRedirect(route('siswa.show', $student))
            ->assertSessionHas('status', 'Data Bima Pratama Wijaya berhasil diperbarui.');

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Bima Pratama Wijaya',
        ]);
    }

    public function test_student_deletion_requires_confirmation_and_shows_success(): void
    {
        $student = Student::query()->create($this->validStudent());

        $this->get(route('siswa.confirm-destroy', $student))
            ->assertOk()
            ->assertSee('Konfirmasi sebelum menghapus data')
            ->assertSee('Bima Pratama')
            ->assertSee('name="_method" value="DELETE"', false);

        $this->delete(route('siswa.destroy', $student))
            ->assertRedirect(route('siswa.index'))
            ->assertSessionHas('resultAction', 'deleted');

        $this->get(route('siswa.index'))
            ->assertOk()
            ->assertSee('Halaman daftar dengan pesan sukses setelah menghapus data')
            ->assertSee('Data Bima Pratama berhasil dihapus.');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    private function validStudent(): array
    {
        return [
            'nim' => '2457401030',
            'name' => 'Bima Pratama',
            'classroom' => 'X IPA 1',
            'birth_date' => '2008-04-15',
            'average_score' => '88.25',
            'is_active' => '1',
            'address' => 'Jl. Merdeka No. 10',
            'parent_phone' => '0812-1111-2222',
        ];
    }
}
