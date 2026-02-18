@extends('admin.layout.master')

@section('title', 'Team Members')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: #E5EAF2;
    }

    .dashboard-wrapper {
        display: flex;
        min-height: 100vh;
        margin-left: 70px;
        background: #E5EAF2;
    }

    .team-container-wrapper {
        width: 100%;
    }

    /* Top Navbar */
    .top-navbar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .search-container {
        position: relative;
        flex: 0 0 353px;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #666262;
        font-size: 18px;
    }

    .search-input {
        width: 100%;
        height: 60px;
        border: none;
        border-radius: 30px;
        padding: 10px 20px 10px 55px;
        font-size: 18px;
        font-weight: 700;
        color: #666262;
        background: #fff;
    }

    .search-input::placeholder {
        color: #666262;
    }

    .task-dropdown {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 11px 0;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 11px 20px;
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .btn-main-account {
        background: #003B67;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 46px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .icon-btn {
        width: 50px;
        height: 48px;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn i {
        font-size: 22px;
        color: #000;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .user-avatar i {
        font-size: 30px;
        color: #666;
    }

    /* Team Members Container */
    .team-container {
        padding: 50px 40px;
        width: 100%;
    }

    /* Header Section */
    .team-header {
        background: #fff;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        padding: 12px 37px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .team-header h1 {
        font-size: 22px;
        font-weight: 500;
        color: #003B67;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 20px;
    }

    .btn-view-roles {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 9px 14px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
    }

    .btn-add-new {
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: transparent;
        padding: 9px 14px;
        font-size: 16px;
        color: #000;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    /* Main Content Area */
    .team-content {
        display: flex;
        gap: 48px;
    }

    /* Left Sidebar - User Roles */
    .roles-sidebar {
        flex: 0 0 194px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .roles-title {
        font-size: 24px;
        font-weight: 400;
        color: #003B67;
        text-align: center;
        margin-bottom: 0;
        text-transform: uppercase;
    }

    .role-btn {
        width: 100%;
        height: 60px;
        border: 1px solid #6C6C6C;
        border-radius: 10px;
        background: #fff;
        font-size: 18px;
        font-weight: 400;
        color: #000;
        cursor: pointer;
        transition: all 0.3s;
    }

    .role-btn.active {
        border: 3px solid #317FF1;
        font-weight: 600;
        color: #317FF1;
    }

    .role-btn:hover {
        background: #f8f9fa;
    }

    /* Vertical Divider Line */
    .vertical-line {
        width: 1px;
        background: #317FF1;
        margin: 0 11px;
    }

    /* Right Content Area */
    .members-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Status Tabs */
    .status-tabs {
        display: flex;
        gap: 123px;
        padding: 20px 30px;
        border-bottom: 2px solid #E5EAF2;
    }

    .status-tabs::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: var(--underline-left, 27px);
        width: var(--underline-width, 126px);
        height: 4px;
        background: #33C17F;
        transition: left 0.3s ease, width 0.3s ease;
    }

    .tabs-container {
        display: flex;
        gap: 90px;
        padding-left: 33px;
    }

    .tab {
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
    }

    .tab.all {
        color: #33C17F;
    }

    .tab.active-status {
        color: #ED5A68;
    }

    .tab.inactive {
        color: #F4CE5B;
    }

    /* Table Header */
    .table-header {
        background: #003B67;
        border-radius: 10px;
        padding: 19px 15px;
        display: grid;
        grid-template-columns: 122px 168px 178px 155px 120px 140px;
        gap: 57px;
    }

    .table-header span {
        font-size: 16px;
        font-weight: 500;
        color: #fff;
        text-align: left;
    }

    /* Member Row */
    .tab.active-tab {
        font-weight: 600;
    }

    .member-row {
        background: #fff;
        border: 1px solid #003B67;
        border-radius: 10px;
        padding: 15px;
        display: grid;
        grid-template-columns: 122px 168px 178px 155px 120px 140px;
        gap: 53px;
        align-items: center;
        margin-bottom: 10px;
    }

    .member-row.hidden {
        display: none;
    }

    .member-name {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .member-icon {
        width: 25px;
        height: 25px;
        background: #317FF1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .member-icon i {
        color: #fff;
        font-size: 12px;
    }

    .member-row span {
        font-size: 14px;
        color: #000;
    }

    .status-toggle {
        width: 33px;
        height: 16px;
        background: #B5B5B5;
        border-radius: 8px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }

    .status-toggle.active {
        background: #15B700;
    }

    .status-toggle::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 16px;
        height: 16px;
        background: #fff;
        border: 0.25px solid #B5B5B5;
        border-radius: 50%;
        transition: left 0.3s;
    }

    .status-toggle.active::after {
        left: calc(100% - 16px);
    }

    /* Action Icons */
    .action-icons {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .action-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .action-icon.view {
        color: #317FF1;
        background: rgba(49, 127, 241, 0.1);
    }

    .action-icon.edit {
        color: #F4CE5B;
        background: rgba(244, 206, 91, 0.1);
    }

    .action-icon.delete {
        color: #ED5A68;
        background: rgba(237, 90, 104, 0.1);
    }

    .action-icon:hover {
        transform: scale(1.1);
    }

    /* Pagination */
    .pagination-controls {
        border: 1px solid #003B67;
        border-radius: 10px;
        padding: 18px 16px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .entries-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .entries-control span {
        font-size: 14px;
        color: #000;
    }

    .entries-dropdown {
        border: 1.5px solid #33C17F;
        border-radius: 10px;
        padding: 5px 10px;
        font-size: 14px;
        background: #fff;
        cursor: pointer;
    }

    .showing-text {
        font-size: 14px;
        color: #000;
    }

    .pagination-btns {
        display: flex;
        gap: 20px;
    }

    .pagination-btn {
        border: 1.5px solid #ED5A68;
        border-radius: 10px;
        padding: 5px 27px;
        font-size: 14px;
        color: #000;
        background: #fff;
        cursor: pointer;
    }

    .pagination-btn.next {
        border-color: #F4CE5B;
    }
</style>

<div class="dashboard-wrapper">
<div class="team-container-wrapper">

    <!-- Team Members Container -->
    <div class="team-container">
        <!-- Header -->
        <div class="team-header">
            <h1>My Team</h1>
            <div class="header-actions">
                <button class="btn-view-roles" onclick="openRolesModal()">View Roles</button>
                <a href="{{ route('admin.team-members.create') }}" class="btn-add-new">
                    <i class="fas fa-plus"></i> Add new
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="team-content">
            <!-- Left Sidebar - Roles -->
            <div class="roles-sidebar">
                <h2 class="roles-title">User Roles</h2>
                <button class="role-btn active" data-role="all">All</button>
                @php
                    $roles = \App\Models\Role::where('is_active', true)->get();
                @endphp
                @foreach($roles as $role)
                    <button class="role-btn" data-role="{{ $role->slug }}">{{ $role->name }}</button>
                @endforeach
            </div>

            <!-- Vertical Line -->
            <div class="vertical-line"></div>

            <!-- Right Content -->
            <div class="members-content">
                <!-- Status Tabs -->
                <div class="status-tabs">
                    <div class="tabs-container">
                        <button class="tab all active-tab" data-status="all">All (<span id="count-all">{{ $teamMembers->count() }}</span>)</button>
                        <button class="tab active-status" data-status="active">Active (<span id="count-active">{{ $teamMembers->where('status', 'Active')->count() }}</span>)</button>
                        <button class="tab inactive" data-status="inactive">Inactive (<span id="count-inactive">{{ $teamMembers->where('status', 'Inactive')->count() }}</span>)</button>
                    </div>
                </div>

                <!-- Table Header -->
                <div class="table-header">
                    <span>Name</span>
                    <span>Email</span>
                    <span>Mobile</span>
                    <span>Role</span>
                    <span>Status</span>
                    <span>Actions</span>
                </div>

                <!-- Dynamic Member Rows -->
                @forelse($teamMembers as $member)
                <div class="member-row" data-role="{{ $member->role ? $member->role->slug : 'no-role' }}" data-status="{{ strtolower($member->status) }}">
                    <div class="member-name">
                        <div class="member-icon">
                            @if($member->profile_image)
                                <img src="{{ asset($member->profile_image) }}" alt="{{ $member->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <span>{{ $member->name }}</span>
                    </div>
                    <span>{{ $member->email }}</span>
                    <span>{{ $member->mobile ?: 'N/A' }}</span>
                    <span>{{ $member->role_name }}</span>
                    <div class="status-toggle {{ $member->status == 'Active' ? 'active' : '' }}" onclick="toggleStatus(this)" data-user-id="{{ $member->id }}"></div>
                    <div class="action-icons">
                        <a href="{{ route('admin.team-members.show', $member->id) }}" class="action-icon view" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.team-members.edit', $member->id) }}" class="action-icon edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.team-members.destroy', $member->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon delete" title="Delete" onclick="return confirm('Are you sure you want to delete this member?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="member-row">
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #666;">
                        No team members found. <a href="{{ route('admin.team-members.create') }}">Add your first team member</a>.
                    </div>
                </div>
                @endforelse

                <!-- Pagination -->
                <div class="pagination-controls">
                    <div class="entries-control">
                        <span>Show Entries</span>
                        <select class="entries-dropdown">
                            <option>15</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                    </div>
                    <span class="showing-text">Showing 1 to {{ $teamMembers->count() }} of {{ $teamMembers->count() }}</span>
                    <div class="pagination-btns">
                        <button class="pagination-btn">Previous</button>
                        <button class="pagination-btn next">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Roles Modal -->
<div id="rolesModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Manage Roles</h3>
            <button class="modal-close" onclick="closeRolesModal()">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Add New Role Form -->
            <div class="add-role-section">
                <h4>Add New Role</h4>
                <form id="addRoleForm">
                    <div class="form-row">
                        <input type="text" id="roleName" placeholder="Role Name" required>
                        <input type="text" id="roleDescription" placeholder="Description (optional)">
                        <button type="submit" class="btn-add-role">Add Role</button>
                    </div>
                </form>
            </div>

            <!-- Roles List -->
            <div class="roles-list">
                <h4>Existing Roles</h4>
                <div id="rolesContainer">
                    <p style="text-align: center; color: #666;">Loading roles...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.modal-content {
    background: #fff;
    border-radius: 15px;
    width: 100%;
    max-width: 750px;
    max-height: 97vh;
    overflow-y: auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    border-bottom: 1px solid #eee;
}

.modal-header h3 {
    margin: 0;
    color: #003B67;
    font-size: 24px;
}

.modal-close {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
    color: #666;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-body {
    padding: 30px;
}

.add-role-section {
    margin-bottom: 30px;
}

.add-role-section h4 {
    color: #003B67;
    margin-bottom: 15px;
    font-size: 18px;
}

.form-row {
    display: flex;
    gap: 15px;
    align-items: center;
}

.form-row input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
}

.btn-add-role {
    background: #317FF1;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
}

.btn-add-role:hover {
    background: #2669cc;
}

.roles-list h4 {
    color: #003B67;
    margin-bottom: 15px;
    font-size: 18px;
}

#rolesContainer {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.role-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 8px;
    background: #f9f9f9;
}

.role-info h5 {
    margin: 0 0 5px 0;
    color: #003B67;
    font-size: 16px;
}

.role-info p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.role-actions {
    display: flex;
    gap: 10px;
}

.btn-role-action {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
}

.btn-edit-role {
    background: #F4CE5B;
    color: #000;
}

.btn-delete-role {
    background: #ED5A68;
    color: #fff;
}
</style>

<script>
// CSRF Token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// Toggle Status Function
function toggleStatus(element) {
    const userId = element.getAttribute('data-user-id');
    const isActive = element.classList.contains('active');
    const newStatus = isActive ? 'Inactive' : 'Active';

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
            element.classList.toggle('active');
            const row = element.closest('.member-row');
            row.setAttribute('data-status', newStatus.toLowerCase());
            updateCounts();
            filterMembers();
        } else {
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update status');
    });
}

// Role Filter Functionality
document.querySelectorAll('.role-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        // Filter members and update counts
        filterMembers();
        updateCounts();
    });
});

// Status Tab Functionality
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active-tab class from all tabs
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active-tab'));
        // Add active-tab class to clicked tab
        this.classList.add('active-tab');
        // Update underline position
        updateUnderline(this);
        // Filter members
        filterMembers();
    });
});

// Update underline position based on active tab
function updateUnderline(activeTab) {
    const statusTabs = document.querySelector('.status-tabs');
    const tabs = document.querySelectorAll('.tab');
    const index = Array.from(tabs).indexOf(activeTab);

    // Remove existing underline styles
    statusTabs.style.setProperty('--underline-left', '27px');
    statusTabs.style.setProperty('--underline-width', '126px');

    // Calculate new position based on active tab
    if (index === 0) { // All
        statusTabs.style.setProperty('--underline-left', '27px');
        statusTabs.style.setProperty('--underline-width', '126px');
    } else if (index === 1) { // Active
        statusTabs.style.setProperty('--underline-left', '160px');
        statusTabs.style.setProperty('--underline-width', '140px');
    } else if (index === 2) { // Inactive
        statusTabs.style.setProperty('--underline-left', '330px');
        statusTabs.style.setProperty('--underline-width', '150px');
    }
}

// Filter Members Function
function filterMembers() {
    const activeRole = document.querySelector('.role-btn.active').getAttribute('data-role');
    const activeStatus = document.querySelector('.tab.active-tab').getAttribute('data-status');
    const memberRows = document.querySelectorAll('.member-row');

    memberRows.forEach(row => {
        const memberRole = row.getAttribute('data-role');
        const memberStatus = row.getAttribute('data-status');

        let showRow = true;

        // Filter by role
        if (activeRole !== 'all' && memberRole !== activeRole) {
            showRow = false;
        }

        // Filter by status
        if (activeStatus !== 'all' && memberStatus !== activeStatus) {
            showRow = false;
        }

        if (showRow) {
            row.classList.remove('hidden');
        } else {
            row.classList.add('hidden');
        }
    });

    updatePaginationText();
}

// Update Counts (The Fix)
// This function now calculates counts based on the Selected Role, not the visible rows
function updateCounts() {
    const activeRole = document.querySelector('.role-btn.active').getAttribute('data-role');
    const allRows = document.querySelectorAll('.member-row');

    let totalRoleCount = 0;
    let activeRoleCount = 0;
    let inactiveRoleCount = 0;

    allRows.forEach(row => {
        const memberRole = row.getAttribute('data-role');
        const memberStatus = row.getAttribute('data-status');

        // Check if row belongs to the currently selected role (or "All")
        if (activeRole === 'all' || memberRole === activeRole) {
            totalRoleCount++;

            if (memberStatus === 'active') {
                activeRoleCount++;
            } else if (memberStatus === 'inactive') {
                inactiveRoleCount++;
            }
        }
    });

    document.getElementById('count-all').textContent = totalRoleCount;
    document.getElementById('count-active').textContent = activeRoleCount;
    document.getElementById('count-inactive').textContent = inactiveRoleCount;
}

// Update Pagination Text
function updatePaginationText() {
    const visibleRows = document.querySelectorAll('.member-row:not(.hidden)');
    const showingText = document.querySelector('.showing-text');
    const count = visibleRows.length;

    if (count > 0) {
        showingText.textContent = `Showing 1 to ${count} of ${count}`;
    } else {
        showingText.textContent = 'Showing 0 to 0 of 0';
    }
}

// Initialize counts on page load
updateCounts();

// Initialize underline position
const initialActiveTab = document.querySelector('.tab.active-tab');
if (initialActiveTab) {
    updateUnderline(initialActiveTab);
}

// Modal Functions
function openRolesModal() {
    document.getElementById('rolesModal').style.display = 'flex';
    loadRoles();
}

function closeRolesModal() {
    document.getElementById('rolesModal').style.display = 'none';
}

// Close modal when clicking outside
document.getElementById('rolesModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRolesModal();
    }
});

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
                document.getElementById('rolesContainer').innerHTML = '<p style="color: red; text-align: center;">Failed to load roles. Please try again.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading roles:', error);
            document.getElementById('rolesContainer').innerHTML = '<p style="color: red; text-align: center;">Error loading roles: ' + error.message + '</p>';
        });
}

// Display roles in the modal
function displayRoles(roles) {
    console.log('Displaying roles:', roles);
    const container = document.getElementById('rolesContainer');
    container.innerHTML = '';

    if (roles.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #666;">No roles found.</p>';
        return;
    }

    roles.forEach(role => {
        const roleElement = document.createElement('div');
        roleElement.className = 'role-item';
        roleElement.innerHTML = `
            <div class="role-info">
                <h5>${role.name}</h5>
                <p>${role.description || 'No description'}</p>
            </div>
            <div class="role-actions">
                <button class="btn-role-action btn-edit-role" onclick="editRole(${role.id})">Edit</button>
                <button class="btn-role-action btn-delete-role" onclick="deleteRole(${role.id})">Delete</button>
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
            updateRoleButtons(); // Update the sidebar buttons
        } else {
            alert('Failed to create role');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to create role');
    });
});

// Update role buttons in sidebar
function updateRoleButtons() {
    fetch('/admin/roles')
        .then(response => response.json())
        .then(data => {
            const rolesSidebar = document.querySelector('.roles-sidebar');
            const existingButtons = rolesSidebar.querySelectorAll('.role-btn');

            // Keep only the 'All' button and remove others
            existingButtons.forEach(button => {
                if (button.getAttribute('data-role') !== 'all') {
                    button.remove();
                }
            });

            // Add role buttons
            data.roles.forEach(role => {
                const slug = role.slug;
                if (!document.querySelector(`[data-role="${slug}"]`)) {
                    const button = document.createElement('button');
                    button.className = 'role-btn';
                    button.setAttribute('data-role', slug);
                    button.textContent = role.name;
                    rolesSidebar.appendChild(button);
                }
            });

            // Re-attach event listeners to new buttons
            document.querySelectorAll('.role-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    // Filter members
                    filterMembers();
                });
            });
        })
        .catch(error => {
            console.error('Error updating role buttons:', error);
        });
}

// Edit role functionality
function editRole(roleId) {
    // Find the role element
    const roleElement = document.querySelector(`[onclick="editRole(${roleId})"]`).closest('.role-item');
    const roleName = roleElement.querySelector('h5').textContent;
    const roleDescription = roleElement.querySelector('p').textContent;

    // Create edit form
    const editForm = `
        <div class="edit-role-form" style="margin-top: 15px; padding: 15px; background: #f0f8ff; border-radius: 8px; border: 1px solid #317FF1;">
            <h6 style="margin: 0 0 10px 0; color: #003B67;">Edit Role</h6>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="text" id="editRoleName" value="${roleName}" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <input type="text" id="editRoleDescription" value="${roleDescription === 'No description' ? '' : roleDescription}" placeholder="Description (optional)" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 5px;">
                <button onclick="saveRoleEdit(${roleId})" style="background: #317FF1; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Save</button>
                <button onclick="cancelRoleEdit()" style="background: #666; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">Cancel</button>
            </div>
        </div>
    `;

    // Remove any existing edit forms
    document.querySelectorAll('.edit-role-form').forEach(form => form.remove());

    // Add edit form after the role element
    roleElement.insertAdjacentHTML('afterend', editForm);
}

// Save role edit
function saveRoleEdit(roleId) {
    const newName = document.getElementById('editRoleName').value.trim();
    const newDescription = document.getElementById('editRoleDescription').value.trim();

    if (!newName) {
        alert('Role name is required');
        return;
    }

    fetch(`/admin/roles/${roleId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            name: newName,
            description: newDescription
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Role updated successfully!');
            loadRoles(); // Reload roles list
            updateRoleButtons(); // Update the sidebar buttons
            cancelRoleEdit(); // Remove edit form
        } else {
            alert('Failed to update role: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update role');
    });
}

// Cancel role edit
function cancelRoleEdit() {
    document.querySelectorAll('.edit-role-form').forEach(form => form.remove());
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
                updateRoleButtons(); // Update the sidebar buttons
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
</script>
@endsection
