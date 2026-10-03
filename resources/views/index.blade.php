<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">
    <style>
        .header {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .user-info {
            background-color: #f8f9fa;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-secondary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .table thead {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .text-center {
            text-align: center;
        }
        .modal-header {
            background: linear-gradient(45deg, #28a745, #218838);
            color: white;
        }
        .modal-footer {
            background: #f1f1f1;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .table tbody tr {
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            transform: scale(1.02);
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        .table th, .table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="header">
            <h1><i class="fas fa-users"></i> Report List Employee</h1>
        </div>
        @if(auth()->check())
            <div class="user-info">
                <p><i class="fas fa-user"></i> Logged in as: {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
            </div>
        @endif
        <hr>
        <div class="d-flex justify-content-between mb-3">
            <div class="btn-group">
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#employeeModal"><i class="fas fa-plus"></i> Add New Employee</button>
                @endif
                <button class="btn btn-secondary" data-toggle="modal" data-target="#statusSummaryModal"><i class="fas fa-chart-bar"></i> Report Summary Status Employee</button>
                <button class="btn btn-info" data-toggle="modal" data-target="#departmentSummaryModal"><i class="fas fa-chart-bar"></i> Report Status Employee per Department</button>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th><i class="fas fa-user"></i> First Name</th>
                    <th><i class="fas fa-user"></i> Last Name</th>
                    <th><i class="fas fa-venus-mars"></i> Gender</th>
                    <th><i class="fas fa-map-marker-alt"></i> Address</th>
                    <th><i class="fas fa-calendar-alt"></i> Date of Birth</th>
                    <th><i class="fas fa-building"></i> Department</th>
                    <th><i class="fas fa-info-circle"></i> Status</th>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $index => $employee)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->firstname }}</td>
                    <td>{{ $employee->lastname }}</td>
                    <td>{{ ucfirst($employee->gender) }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>
                        @if($employee->status == 'emp')
                            Employee
                        @elseif($employee->status == 'cont')
                            Contract
                        @elseif($employee->status == 'not_act')
                            Not Active
                        @endif
                    </td>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#employeeModal" onclick="editEmployee({{ $employee }})"><i class="fas fa-edit"></i> Edit</button>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Employee Modal -->
    <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Employee Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="dept_id">Department:</label>
                            <select class="form-control" id="dept_id" name="dept_id" required>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="emp">Employee</option>
                                <option value="cont">Contract</option>
                                <option value="not_act">Not Active</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Summary Modal -->
    <div class="modal fade" id="statusSummaryModal" tabindex="-1" role="dialog" aria-labelledby="statusSummaryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusSummaryModalLabel">Report Summary Status Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Status</th>
                                <th>Total Employee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalEmployee = 0;
                            @endphp
                            @foreach ($statusSummary as $summary)
                            <tr class="text-center">
                                <td>{{ $summary['status'] }}</td>
                                <td>{{ $summary['count'] }}</td>
                            </tr>
                            @php
                                $totalEmployee += $summary['count'];
                            @endphp
                            @endforeach
                            <tr class="text-center font-weight-bold">
                                <td>Grand Total</td>
                                <td>{{ $totalEmployee }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <canvas id="statusSummaryChart" class="mt-3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Summary Modal -->
    <div class="modal fade" id="departmentSummaryModal" tabindex="-1" role="dialog" aria-labelledby="departmentSummaryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentSummaryModalLabel">Report Status Employee per Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Department</th>
                                <th>Contract</th>
                                <th>Employee</th>
                                <th>Not Active</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grandTotalContract = 0;
                                $grandTotalEmployee = 0;
                                $grandTotalNotActive = 0;
                                $grandTotalAll = 0;
                            @endphp
                            @foreach ($departmentSummary as $department => $summary)
                            <tr class="text-center">
                                <td>{{ $department }}</td>
                                <td>{{ $summary['cont'] }}</td>
                                <td>{{ $summary['emp'] }}</td>
                                <td>{{ $summary['not_act'] }}</td>
                                <td>{{ $summary['total'] }}</td>
                            </tr>
                            @php
                                $grandTotalContract += $summary['cont'];
                                $grandTotalEmployee += $summary['emp'];
                                $grandTotalNotActive += $summary['not_act'];
                                $grandTotalAll += $summary['total'];
                            @endphp
                            @endforeach
                            <tr class="text-center font-weight-bold">
                                <td>Grand Total</td>
                                <td>{{ $grandTotalContract }}</td>
                                <td>{{ $grandTotalEmployee }}</td>
                                <td>{{ $grandTotalNotActive }}</td>
                                <td>{{ $grandTotalAll }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <canvas id="departmentSummaryChart" class="mt-3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function editEmployee(employee) {
            $('#employeeModalLabel').text('Edit Employee');
            $('#employeeForm').attr('action', `/employee/${employee.id}`);
            $('#employeeForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#firstname').val(employee.firstname);
            $('#lastname').val(employee.lastname);
            $('#gender').val(employee.gender.toLowerCase());
            $('#address').val(employee.address);
            $('#dob').val(employee.dob);
            $('#dept_id').val(employee.dept_id);
            $('#status').val(employee.status);
        }

        $('#employeeModal').on('hidden.bs.modal', function () {
            $('#employeeModalLabel').text('Add New Employee');
            $('#employeeForm').attr('action', '{{ route('employee.store') }}');
            $('#employeeForm').find('input[name="_method"]').remove();
            $('#employeeForm')[0].reset();
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if(session('update'))
            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: '{{ session('update') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if(session('delete'))
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: '{{ session('delete') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if(auth()->check() && session('success') === null && session('update') === null && session('delete') === null)
            Swal.fire({
                icon: 'info',
                title: 'Welcome!',
                text: 'Logged in as: {{ auth()->user()->name }} ({{ auth()->user()->role }})',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        // Chart.js for Status Summary
        const statusSummaryCtx = document.getElementById('statusSummaryChart').getContext('2d');
        const statusSummaryChart = new Chart(statusSummaryCtx, {
            type: 'pie',
            data: {
                labels: @json(array_column($statusSummary, 'status')),
                datasets: [{
                    data: @json(array_column($statusSummary, 'count')),
                    backgroundColor: ['#28a745', '#007bff', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        // Chart.js for Department Summary
        const departmentSummaryCtx = document.getElementById('departmentSummaryChart').getContext('2d');
        const departmentSummaryChart = new Chart(departmentSummaryCtx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($departmentSummary)),
                datasets: [
                    {
                        label: 'Contract',
                        data: @json(array_column($departmentSummary, 'cont')),
                        backgroundColor: '#007bff',
                    },
                    {
                        label: 'Employee',
                        data: @json(array_column($departmentSummary, 'emp')),
                        backgroundColor: '#28a745',
                    },
                    {
                        label: 'Not Active',
                        data: @json(array_column($departmentSummary, 'not_act')),
                        backgroundColor: '#dc3545',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    }
                }
            }
        });
    </script>
</body>
</html>
