@extends('admin.layout.master')

@section('title', 'Add Attendance Record')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-card">
                    <div class="card-header">
                        <h3 class="mb-0">Add New Attendance Record</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.attendance-records.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee_id">Employee</label>
                                        <select class="form-control" id="employee_id" name="employee_id" required>
                                            <option value="">Select Employee</option>
                                            <option value="1">John Smith</option>
                                            <option value="2">Sarah Johnson</option>
                                            <option value="3">Michael Johnson</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attendance_date">Date</label>
                                        <input type="date" class="form-control" id="attendance_date" name="attendance_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_in">Check In Time</label>
                                        <input type="time" class="form-control" id="check_in" name="check_in" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_out">Check Out Time</label>
                                        <input type="time" class="form-control" id="check_out" name="check_out">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Present">Present</option>
                                            <option value="Absent">Absent</option>
                                            <option value="Late">Late</option>
                                            <option value="On Leave">On Leave</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department" name="department">
                                            <option value="Operations">Operations</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Transport">Transport</option>
                                            <option value="Finance">Finance</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hours_worked">Hours Worked</label>
                                        <input type="number" class="form-control" id="hours_worked" name="hours_worked" step="0.1" min="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="overtime">Overtime (hours)</label>
                                        <input type="number" class="form-control" id="overtime" name="overtime" step="0.1" min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save mr-2"></i> Save Attendance Record
                                    </button>
                                    <a href="{{ route('admin.attendance-records.index') }}" class="btn btn-outline-custom">
                                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection