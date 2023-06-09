@extends('backend/layouts.template')
@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data E-KTP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"></a>Dashboard</li>
                <li class="breadcrumb-item active">Data E-KTP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#basicModal">
                                Tambah
                            </button>
                        </li>
                    </ul>
                    
                    <!-- Show success or error message after form submission -->
                    @if(session('success'))
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- modal tambah --}}
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah E-KTP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="daftar_ektp_form" method="POST"
                                    action="{{ route('daftar_ektp.store') }}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group mb-3">
                                            <label for="nama">Nama </label>
                                            <input type="text" class="form-control" name="nama" id="nama" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="nama">NIK </label>
                                            <input type="number" class="form-control" name="nik" id="nik" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama">Telepon </label>
                                            <input type="text" class="form-control" name="telepon" id="telepon" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="tingkatan">Pendidikan Terakhir</label>
                                            <select class="form-select" aria-label="Default select example" name="tingkatan" id="tingkatan" required>
                                                <option value="1">TK</option>
                                                <option value="2">SD</option>
                                                <option value="3">SMP</option>
                                                <option value="4">SMA/SMK</option>
                                                <option value="5">D3</option>
                                                <option value="6">D4/S1</option>
                                                <option value="7">S2</option>
                                                <option value="8">S3</option>
                                              </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="tahun_masuk">Tahun Daftar</label>
                                            <input type="number" class="form-control" name="tahun_daftar"
                                                id="tahun_daftar" min="1900" max="{{ date('Y') }}" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <h5 class="card-title">Daftar E-KTP</h5>
                {{-- data E-KTP --}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama </th>
                                <th>NIK</th>
                                <th>Telepon</th>
                                <th>Tingkatan</th>
                                <th>Tahun Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftar_ektp as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>
                                    @if ($item->tingkatan==1)
                                        Tk
                                    @elseif ($item->tingkatan==2)
                                        SD
                                    @elseif ($item->tingkatan==3)
                                        SMP
                                    @elseif ($item->tingkatan==4)
                                        SMA/SMK
                                    @elseif ($item->tingkatan==5)
                                        D3
                                    @elseif ($item->tingkatan==6)
                                        D4/S1
                                    @elseif ($item->tingkatan==7)
                                        S2
                                    @elseif ($item->tingkatan==8)
                                        S3
                                    @endif
                                </td>
                                <td>{{ $item->tahun_daftar }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('daftar_ektp.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            {{-- // modal edit --}}
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit E-KTP</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="edit_daftar_ktp_form" method="POST"
                                            action="{{ route('daftar_ektp.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="form-group mb-3">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        value="{{ $item->nama }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">NIK</label>
                                                    <input type="number" class="form-control" name="nik" id="nik"
                                                        value="{{ $item->nik }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="nama">Telepon</label>
                                                    <input type="text" class="form-control" name="telepon" id="telepon"
                                                        value="{{ $item->telepon }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="jabatan">Tingkatan</label>
                                                    <select class="form-select" aria-label="Default select example" name="tingkatan" id="tingkatan" required>
                                                        <option value="1"{{ (isset($item) && $item->tingkatan == 1) ? 'selected' : '' }}>TK</option>
                                                        <option value="2"{{ (isset($item) && $item->tingkatan == 2) ? 'selected' : '' }}>SD</option>
                                                        <option value="3"{{ (isset($item) && $item->tingkatan == 3) ? 'selected' : '' }}>SMP</option>
                                                        <option value="4"{{ (isset($item) && $item->tingkatan == 4) ? 'selected' : '' }}>SMA/SMK</option>
                                                        <option value="5"{{ (isset($item) && $item->tingkatan == 5) ? 'selected' : '' }}>D3</option>
                                                        <option value="6"{{ (isset($item) && $item->tingkatan == 6) ? 'selected' : '' }}>D4/S1</option>
                                                        <option value="7"{{ (isset($item) && $item->tingkatan == 7) ? 'selected' : '' }}>S2</option>
                                                        <option value="8"{{ (isset($item) && $item->tingkatan == 8) ? 'selected' : '' }}>S3</option>
                                                      </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tahun_masuk">Tahun Daftar</label>
                                                    <input type="number" class="form-control" name="tahun_daftar"
                                                        id="tahun_daftar" min="1900" max="{{ date('Y') }}"
                                                        value="{{ $item->tahun_daftar }}" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endsection
    <section class="section dashboard">
        <div class="row">
            <div class="card">

            </div>
        </div>
    </section>


</main>

@section('scripts')
<script>
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='daftar_ektp_form']").validate({
        // Specify validation rules
        rules: {
            nama: "required",
            jabatan: "required",
            tahun_masuk: {
                required: true,
                digits: true,
                min: 1900,
                max: parseInt(new Date().getFullYear())
            },
        },

        // Specify validation error messages
        messages: {
            nama: "Mohon isi nama perusahaan",
            jabatan: "Mohon isi jabatan",
            tahun_masuk: {
                required: "Mohon isi tahun masuk",
                digits: "Mohon isi tahun dengan angka",
                min: "Tahun masuk tidak valid",
                max: "Tahun masuk tidak valid"
            },
        },

        // Specify submit handler
        submitHandler: function (form) {
            // Submit the form via Ajax
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    // Show success message
                    $('#daftar_ektp_form')[0].reset();
                    $('.alert-success').fadeIn().html(response.message);
                },
                error: function (xhr) {
                    // Show error message
                    var errors = xhr.responseJSON.errors;
                    var errorString = '';
                    $.each(errors, function (key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    $('.alert-danger').fadeIn().html(errorString);
                }
            });
        }
    });
</script>
@endsection