<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        $departments = Department::all();
        
        $statusSummary = Employee::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusLabels = [
            'emp' => 'Employee',
            'cont' => 'Contract',
            'not_act' => 'Not Active'
        ];

        $statusSummary = array_map(function($count, $status) use ($statusLabels) {
            return [
                'status' => $statusLabels[$status] ?? $status,
                'count' => $count
            ];
        }, $statusSummary, array_keys($statusSummary));

        $departmentSummary = Department::withCount([
            'employees as cont_count' => function ($query) {
                $query->where('status', 'cont');
            },
            'employees as emp_count' => function ($query) {
                $query->where('status', 'emp');
            },
            'employees as not_act_count' => function ($query) {
                $query->where('status', 'not_act');
            }
        ])->get()->mapWithKeys(function ($department) {
            return [
                $department->name => [
                    'cont' => $department->cont_count,
                    'emp' => $department->emp_count,
                    'not_act' => $department->not_act_count,
                    'total' => $department->cont_count + $department->emp_count + $department->not_act_count
                ]
            ];
        })->toArray();

        return view('index', compact('employees', 'departments', 'statusSummary', 'departmentSummary'));
    }

    public function create()
    {
        $employee = new Employee();
        $departments = Department::all();
        return view('form', compact('employee', 'departments'));
    }

    public function store(Request $request)
    {
        Employee::create($request->all());
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('form', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('update', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('delete', 'Employee deleted successfully.');
    }

    public function reportSummaryStatusEmployee()
    {
        $statusSummary = Employee::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusLabels = [
            'emp' => 'Employee',
            'cont' => 'Contract',
            'not_act' => 'Not Active'
        ];

        $statusSummary = array_map(function($count, $status) use ($statusLabels) {
            return [
                'status' => $statusLabels[$status] ?? $status,
                'count' => $count
            ];
        }, $statusSummary, array_keys($statusSummary));

        return view('reportsummarystatusemployee', compact('statusSummary'));
    }
}
