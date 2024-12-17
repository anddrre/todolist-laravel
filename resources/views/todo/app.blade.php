<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            border-bottom: 2px solid #000000;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }
        .btn-primary, .btn-secondary {
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }
        .task-text {
            font-size: 1.1rem;
        }
        .task-completed {
            text-decoration: line-through;
            color: #999;
        }
        .card {
            border-radius: 15px;
        }
        .list-group-item {
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .card-body {
            padding: 1.5rem;
        }
        .input-group .form-control {
            border-radius: 20px;
        }
        .radio label {
            margin-right: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Aplikasi to do list sederhana</div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Content -->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Form Input Task -->
                <div class="card mb-3 shadow-lg">
                    <div class="card-body">
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" required value="{{ old('task') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Task List -->
                <div class="card shadow-lg">
                    <div class="card-body">
                        <!-- Search -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                        
                        <ul class="list-group">
                            @foreach ($data as $item)
                                <!-- Task Item -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text {{ $item->is_done == '1' ? 'task-completed' : '' }}">
                                        {{ $item->task }}
                                    </span>
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete',['id'=>$item->id]) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </li>

                                <!-- Update Task Form -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update',['id'=>$item->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task" value="{{ $item->task }}">
                                            <button class="btn btn-outline-primary" type="submit">
                                                <i class="fas fa-sync-alt"></i> Update
                                            </button>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label>
                                                    <input type="radio" value="1" name="is_done" {{ $item->is_done == '1'?'checked':'' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done"{{ $item->is_done == '0'?'checked':'' }}> Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
