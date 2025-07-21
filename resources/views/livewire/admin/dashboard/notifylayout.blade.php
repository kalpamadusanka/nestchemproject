<div>
  <div class="notification-container">
    <!-- Notification Bell with Badge -->
    <div class="notification-bell-container">
        <button class="notification-bell" id="notificationDropdownBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="notification-badge" id="notificationCount">{{ count($notifications) }}</span>
        </button>

        <!-- Notification Dropdown -->
        <div id="notificationDropdown" class="notification-dropdown">
            <div class="notification-header">
                <h3>Notifications</h3>
                <button class="mark-all-read">Mark all as read</button>
            </div>

            <div class="notification-list" id="notificationList">
                @if(count($notifications) > 0)
                    @foreach($notifications as $notification)
                        @php
                            $data = json_decode($notification->data);
                            $timeAgo = $notification->created_at;
                        @endphp
                        <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}">
                            <div class="notification-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <div class="notification-content">
                                <p class="notification-message
    @if(str_contains($data->message ?? 'Notification message', 'Material has expired'))
        priority-medium
    @elseif(str_contains($data->message ?? 'Notification message', 'Low product stock'))
        priority-high
    @endif">
    {{ $data->message ?? 'Notification message' }}
</p>
                                <div class="notification-meta">
                                    <span class="notification-time">{{ $timeAgo }}</span>
                                 @if (isset($data->lot_id) && $data->lot_id)
    <span class="notification-details">ID: {{ $data->id ?? 'N/A' }} • Lot: {{ $data->lot_id ?? 'N/A' }}</span>
@elseif (isset($data->product_code) && $data->product_code)
    <span class="notification-details">ID: {{ $data->id ?? 'N/A' }} • Product Code: {{ $data->product_code ?? 'N/A' }}</span>
@endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <p>No new notifications</p>
                    </div>
                @endif
            </div>

            <div class="notification-footer">
                <a href="#" class="view-all">View all notifications</a>
            </div>
        </div>
    </div>

    <!-- User Profile -->
    <div class="user-profile">
        <div class="profile-avatar">A</div>
    </div>

    <!-- System Info -->
    <div class="system-info">
    <div class="info-item">
        <span class="info-label">Load:</span>
        <span class="info-value">{{ $load }}</span>
    </div>
    <div class="info-item">
        <span class="info-label">Storage:</span>
        <span class="info-value">{{ $storage }}%</span>
    </div>
    <div class="info-item">
        <span class="info-label">Working:</span>
        <span class="info-value">{{ $working }}</span>
    </div>
</div>
</div>
<script>
    document.addEventListener('livewire:navigated', function() {
        setInterval(() => {
            Livewire.dispatch('refresh');
        }, 5000); // Refresh every 5 seconds
    });
</script>
<style>
    .priority-high {
    color: #d32f2f; /* Red for high priority */
    font-weight: bold;
    border-left: 4px solid #d32f2f;
    padding-left: 8px;
}

.priority-medium {
    color: #ff9800; /* Orange for medium priority */
    border-left: 4px solid #ff9800;
    padding-left: 8px;
}

/* Default styling */
.notification-message {
    color: #333;
    padding-left: 8px;
}
.notification-container {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 12px 16px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Notification Bell Styles */
.notification-bell-container {
    position: relative;
}

.notification-bell {
    position: relative;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.2s ease;
    color: #64748b;
}

.notification-bell:hover {
    background-color: #f1f5f9;
    color: #334155;
}

.notification-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background-color: #ef4444;
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
}

/* Notification Dropdown Styles */
.notification-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 360px;
    max-height: 500px;
    overflow-y: auto;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid #e2e8f0;
    z-index: 1000;
    display: none;
    flex-direction: column;
    margin-top: 8px;
}

.notification-dropdown.show {
    display: flex;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    border-bottom: 1px solid #f1f5f9;
}

.notification-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
}

.mark-all-read {
    background: none;
    border: none;
    color: #3b82f6;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
}

.mark-all-read:hover {
    background-color: #eff6ff;
}

.notification-list {
    display: flex;
    flex-direction: column;
}

.notification-item {
    display: flex;
    gap: 12px;
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s ease;
    cursor: pointer;
}

.notification-item.unread {
    background-color: #f8fafc;
}

.notification-item:hover {
    background-color: #f8fafc;
}

.notification-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #e0f2fe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0369a1;
}

.notification-item.unread .notification-icon {
    background-color: #dbeafe;
    color: #1d4ed8;
}

.notification-content {
    flex-grow: 1;
    min-width: 0;
}

.notification-message {
    margin: 0 0 4px 0;
    font-size: 14px;
    font-weight: 500;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.notification-meta {
    display: flex;
    gap: 8px;
    font-size: 12px;
    color: #64748b;
}

.notification-time {
    font-weight: 500;
}

.notification-details {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.empty-notifications {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 32px 16px;
    text-align: center;
    color: #64748b;
}

.empty-notifications svg {
    margin-bottom: 12px;
    color: #cbd5e1;
}

.empty-notifications p {
    margin: 0;
    font-size: 14px;
}

.notification-footer {
    padding: 12px 16px;
    border-top: 1px solid #f1f5f9;
    text-align: center;
}

.view-all {
    color: #3b82f6;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
}

.view-all:hover {
    text-decoration: underline;
}

/* User Profile Styles */
.user-profile {
    margin-left: auto;
}

.profile-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #3b82f6;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    cursor: pointer;
}

/* System Info Styles */
.system-info {
    display: flex;
    gap: 16px;
    margin-right: 16px;
    font-size: 13px;
}

.info-item {
    display: flex;
    gap: 4px;
    align-items: center;
}

.info-label {
    color: #64748b;
}

.info-value {
    font-weight: 500;
    color: #1e293b;
}

/* Animation for new notifications */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.notification-item.unread {
    animation: pulse 0.5s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .notification-dropdown {
        width: 300px;
        right: -50px;
    }

    .system-info {
        display: none;
    }
}
</style>

<script>
document.addEventListener('livewire:navigated', function() {
    const notificationBtn = document.getElementById('notificationDropdownBtn');
    const notificationDropdown = document.getElementById('notificationDropdown');

    // Toggle dropdown on click
    notificationBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationDropdown.contains(e.target) && e.target !== notificationBtn) {
            notificationDropdown.classList.remove('show');
        }
    });

    // Mark notifications as read when clicked
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function() {
            this.classList.remove('unread');
            this.classList.add('read');
            // Here you would typically send an AJAX request to mark the notification as read
        });
    });

    // Mark all as read functionality
    const markAllReadBtn = document.querySelector('.mark-all-read');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', function() {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                item.classList.add('read');
            });
            // Here you would typically send an AJAX request to mark all notifications as read
        });
    }
});
</script>
</div>
