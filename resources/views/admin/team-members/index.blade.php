@extends('admin.layout.master')

@section('title', 'Team Members')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-container" style="padding: 24px; width: 100%;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold"><i class="fas fa-users me-2 text-primary"></i>Team Members</h4>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="openRolesModal()">
                <i class="fas fa-user-tag me-1"></i> View Roles
            </button>
            <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Member
            </a>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-primary mb-0">{{ $teamMembers->count() }}</div>
                <small class="text-muted">Total Members</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-success mb-0">{{ $teamMembers->where('status', 'Active')->count() }}</div>
                <small class="text-muted">Active</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-warning mb-0">{{ $teamMembers->where('status', 'Inactive')->count() }}</div>
                <small class="text-muted">Inactive</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center py-3">
                <div class="h3 fw-bold text-info mb-0">{{ \App\Models\Role::where('is_active', true)->count() }}</div>
                <small class="text-muted">Roles</small>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">Search</label>
                    <input type="text" id="searchInput" class="form-control form-control-sm"
                        placeholder="Name, email, mobile...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Role</label>
                    <select id="roleFilter" class="form-select form-select-sm">
                        <option value="all">All Roles</option>
                        @php
                            $roles = \App\Models\Role::where('is_active', true)->get();
                        @endphp
                        @foreach($roles as $role)
                            <option value="{{ $role->slug }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Status</label>
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">&nbsp;</label>
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-primary btn-sm flex-grow-1" onclick="applyFilters()">
                            <i class="fas fa-search"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearFilters()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Member</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th width="130">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teamMembers as $index => $member)
                        <tr class="member-row" 
                            data-name="{{ strtolower($member->name) }}"
                            data-email="{{ strtolower($member->email) }}"
                            data-mobile="{{ strtolower($member->mobile ?? '') }}"
                            data-role="{{ $member->role ? $member->role->slug : 'no-role' }}"
                            data-status="{{ strtolower($member->status) }}">
                            <td class="text-muted small">{{ $index + 1 }}</td>

                            {{-- Member Name + Avatar --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($member->profile_image)
                                        <img src="{{ asset($member->profile_image) }}"
                                            alt="{{ $member->name }}"
                                            class="rounded-circle border"
                                            style="width:38px; height:38px; object-fit:cover;"
                                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=38&background=4e73df&color=fff'">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                                            style="width:38px; height:38px; font-size:1rem; flex-shrink:0;">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold">{{ $member->name }}</div>
                                    </div>
                                </div>
                            </td>

                            <td><span class="small">{{ $member->email }}</span></td>

                            <td><span class="small">{{ $member->mobile ?: '—' }}</span></td>

                            <td>
                                <span class="badge bg-secondary" style="font-size:0.75rem;">
                                    {{ $member->role_name }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox"
                                        {{ $member->status == 'Active' ? 'checked' : '' }}
                                        onchange="toggleStatus(this, {{ $member->id }})"
                                        style="width: 3em; height: 1.5em;">
                                    <label class="form-check-label small ms-2">
                                        {{ $member->status }}
                                    </label>
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.team-members.show', $member->id) }}"
                                       class="btn btn-outline-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.team-members.edit', $member->id) }}"
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.team-members.destroy', $member->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete member {{ addslashes($member->name) }}?')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-users fa-3x mb-3 d-block opacity-25"></i>
                                <span class="fs-5">No team members found.</span>
                                <br>
                                <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-plus me-1"></i> Add First Member
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
</div>

<!-- Roles Modal -->
<div class="modal fade" id="rolesModal" tabindex="-1" aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesModalLabel">
                    <i class="fas fa-user-tag me-2"></i>Manage Roles
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add New Role Form -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Role</h6>
                    </div>
                    <div class="card-body">
                        <form id="addRoleForm">
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" id="roleName" class="form-control form-control-sm"
                                        placeholder="Role Name" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="roleDescription" class="form-control form-control-sm"
                                        placeholder="Description (optional)">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-plus me-1"></i>Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Roles List -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-list me-2"></i>Existing Roles</h6>
                    </div>
                    <div class="card-body">
                        <div id="rolesContainer">
                            <p class="text-center text-muted">Loading roles...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// CSRF Token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// Toggle Status Function
function toggleStatus(element, userId) {
    const isActive = element.checked;
    const newStatus = isActive ? 'Active' : 'Inactive';

    // Make AJAX request to update status
    fetch(`/admin/team-members/${userId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = element.closest('.member-row');
            row.setAttribute('data-status', newStatus.toLowerCase());
            const label = row.querySelector('.form-check-label');
            if (label) {
                label.textContent = newStatus;
            }
            updateStats();
        } else {
            alert('Failed to update status');
            element.checked = !isActive; // Revert
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status');
        element.checked = !isActive; // Revert
    });
}

// Filter Functions
function applyFilters() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;

    const rows = document.querySelectorAll('.member-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const email = row.getAttribute('data-email');
        const mobile = row.getAttribute('data-mobile');
        const role = row.getAttribute('data-role');
        const status = row.getAttribute('data-status');

        let showRow = true;

        // Search filter
        if (searchTerm && !name.includes(searchTerm) && !email.includes(searchTerm) && !mobile.includes(searchTerm)) {
            showRow = false;
        }

        // Role filter
        if (roleFilter !== 'all' && role !== roleFilter) {
            showRow = false;
        }

        // Status filter
        if (statusFilter !== 'all' && status !== statusFilter) {
            showRow = false;
        }

        if (showRow) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update showing text
    const showingText = document.querySelector('.card-footer small');
    if (showingText) {
        showingText.textContent = `Showing ${visibleCount} of ${rows.length} members`;
    }
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('roleFilter').value = 'all';
    document.getElementById('statusFilter').value = 'all';
    applyFilters();
}

// Update Stats
function updateStats() {
    const rows = document.querySelectorAll('.member-row');
    const total = rows.length;
    const active = Array.from(rows).filter(row => row.getAttribute('data-status') === 'active').length;
    const inactive = total - active;

    // Update stat cards
    const statCards = document.querySelectorAll('.card.border-0.shadow-sm.text-center');
    if (statCards.length >= 3) {
        statCards[0].querySelector('.h3').textContent = total;
        statCards[1].querySelector('.h3').textContent = active;
        statCards[2].querySelector('.h3').textContent = inactive;
    }
}

// Modal Functions
function openRolesModal() {
    const modal = new bootstrap.Modal(document.getElementById('rolesModal'));
    modal.show();
    loadRoles();
}

// Load roles from server
function loadRoles() {
    fetch('/admin/roles')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Roles loaded:', data);
            if (data.roles && Array.isArray(data.roles)) {
                displayRoles(data.roles);
            } else {
                console.error('Invalid roles data:', data);
                document.getElementById('rolesContainer').innerHTML = '<p class="text-danger text-center">Failed to load roles. Please try again.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading roles:', error);
            document.getElementById('rolesContainer').innerHTML = '<p class="text-danger text-center">Error loading roles: ' + error.message + '</p>';
        });
}

// Display roles in the modal
function displayRoles(roles) {
    console.log('Displaying roles:', roles);
    const container = document.getElementById('rolesContainer');
    container.innerHTML = '';

    if (roles.length === 0) {
        container.innerHTML = '<p class="text-center text-muted">No roles found.</p>';
        return;
    }

    roles.forEach(role => {
        const roleElement = document.createElement('div');
        roleElement.className = 'd-flex justify-content-between align-items-center p-2 border-bottom';
        roleElement.innerHTML = `
            <div>
                <strong class="text-primary">${role.name}</strong>
                ${role.description ? `<br><small class="text-muted">${role.description}</small>` : ''}
            </div>
            <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-warning" onclick="editRole(${role.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-outline-danger" onclick="deleteRole(${role.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(roleElement);
    });
}

// Handle add role form submission
document.getElementById('addRoleForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const roleName = document.getElementById('roleName').value;
    const roleDescription = document.getElementById('roleDescription').value;

    fetch('/admin/roles', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            name: roleName,
            description: roleDescription
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Role created successfully!');
            document.getElementById('roleName').value = '';
            document.getElementById('roleDescription').value = '';
            loadRoles(); // Reload roles list
            updateRoleFilter(); // Update the role filter dropdown
        } else {
            alert('Failed to create role');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to create role');
    });
});

// Update role filter dropdown
function updateRoleFilter() {
    fetch('/admin/roles')
        .then(response => response.json())
        .then(data => {
            const roleFilter = document.getElementById('roleFilter');
            const currentValue = roleFilter.value;
            
            // Keep the first option (All Roles)
            roleFilter.innerHTML = '<option value="all">All Roles</option>';
            
            // Add role options
            data.roles.forEach(role => {
                const option = document.createElement('option');
                option.value = role.slug;
                option.textContent = role.name;
                roleFilter.appendChild(option);
            });
            
            // Restore selected value
            roleFilter.value = currentValue;
        })
        .catch(error => {
            console.error('Error updating role filter:', error);
        });
}

// Edit role functionality
function editRole(roleId) {
    const roleName = prompt('Enter new role name:');
    if (!roleName) return;

    const roleDescription = prompt('Enter description (optional):');

    fetch(`/admin/roles/${roleId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            name: roleName,
            description: roleDescription
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Role updated successfully!');
            loadRoles(); // Reload roles list
            updateRoleFilter(); // Update the role filter dropdown
        } else {
            alert('Failed to update role: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update role');
    });
}

// Delete role functionality
function deleteRole(roleId) {
    if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
        fetch(`/admin/roles/${roleId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Role deleted successfully!');
                loadRoles(); // Reload roles list
                updateRoleFilter(); // Update the role filter dropdown
            } else {
                alert('Failed to delete role: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete role');
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for real-time filtering
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('roleFilter').addEventListener('change', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);
});
</script>
@endsection
