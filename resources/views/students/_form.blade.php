@if ($errors->any())
    <div class="alert alert-error" role="alert">
        <strong>Periksa kembali data yang dimasukkan.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="panel form-panel">
    <div class="form-section-heading">
        <span class="form-section-number">01</span>
        <div><h2>Informasi siswa</h2><p>Lengkapi identitas dan informasi akademik siswa.</p></div>
    </div>

    <div class="form-grid">
        <div class="field">
            <label for="nim">NIM <span class="required-mark">*</span></label>
            <input id="nim" name="nim" type="text" inputmode="numeric" pattern="[0-9]+" value="{{ old('nim', $student?->nim) }}" maxlength="20" placeholder="Contoh: 2457401026" required aria-describedby="nim-help nim-error">
            <small id="nim-help" class="field-hint">Nomor induk siswa harus berbeda untuk setiap siswa.</small>
            @error('nim')<span id="nim-error" class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="name">Nama lengkap <span class="required-mark">*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name', $student?->name) }}" maxlength="255" placeholder="Nama lengkap siswa" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="classroom">Kelas <span class="required-mark">*</span></label>
            <select id="classroom" name="classroom" required>
                <option value="">Pilih kelas</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom }}" @selected(old('classroom', $student?->classroom) === $classroom)>{{ $classroom }}</option>
                @endforeach
            </select>
            @error('classroom')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="birth_date">Tanggal lahir <span class="required-mark">*</span></label>
            <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $student?->birth_date?->format('Y-m-d')) }}" required>
            @error('birth_date')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="average_score">Nilai rata-rata <span class="required-mark">*</span></label>
            <div class="input-suffix">
                <input id="average_score" name="average_score" type="number" value="{{ old('average_score', $student?->average_score) }}" min="0" max="100" step="0.01" placeholder="0,00" required>
                <span>/ 100</span>
            </div>
            @error('average_score')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="parent_phone">Telepon orang tua</label>
            <input id="parent_phone" name="parent_phone" type="tel" value="{{ old('parent_phone', $student?->parent_phone) }}" maxlength="30" placeholder="Contoh: 0812-3456-7890">
            @error('parent_phone')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field field-wide">
            <label for="address">Alamat</label>
            <textarea id="address" name="address" rows="3" maxlength="2000" placeholder="Alamat tempat tinggal siswa">{{ old('address', $student?->address) }}</textarea>
            @error('address')<span class="field-error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="active-toggle">
        <span class="toggle-icon">✓</span>
        <div><strong>Status siswa aktif</strong><small>Nonaktifkan bila siswa tidak lagi terdaftar.</small></div>
        <label class="switch" for="is_active">
            <input name="is_active" type="hidden" value="0">
            <input id="is_active" name="is_active" type="checkbox" value="1" @checked((bool) old('is_active', $student?->is_active ?? true))>
            <span class="switch-slider"></span>
        </label>
    </div>
</div>

<div class="form-actions">
    <a class="button button-quiet" href="{{ $student ? route('siswa.show', $student) : route('siswa.index') }}">Batal</a>
    <button class="button button-primary" type="submit">{{ $student ? 'Simpan perubahan' : 'Simpan data siswa' }} <span aria-hidden="true">→</span></button>
</div>
