<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">

                <h4 class="me-3">Manufacture</h4>
                <nav class="nav">

                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />

        </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="container">
            <div class="d-flex justify-content-between align-items-center ">
                <div>
                    <h4 class="fw-bold" style="margin-bottom: 0px;">Manufacture </h4>
                    <nav aria-label="breadcrumb" style="margin-bottom: 5px;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('admin.dashboard.creating.new.manufacture.order') }}" wire:navigate
                        class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>&nbsp;Create Manufacture Order
                    </a>
                </div>

            </div>


            <div class="row mb-4">
                <div class="col-md-12" wire:ignore>
                    <div id="manufacturing-calendar"></div>
                </div>
            </div>

            <!-- Include necessary CSS and JS files for FullCalendar -->
            <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

            <script>
                 window.manufactureLines = @json($manufactureline);

                 function initializeCalendar() {
    var calendarEl = document.getElementById('manufacturing-calendar');
    if (!calendarEl) return;

    // Convert PHP data to calendar events
    var manufactureEvents = window.manufactureLines.map(function(item) {
        return {
            title: 'Order #' + item.mo_no,
            start: item.st_date,
            end: item.ed_date,
            color: item.mo_status === 'ongoing' ? '#28a745' : // green for ongoing
                   item.mo_status === 'finished' ? '#ffc107' : // yellow for finished
                   item.mo_status === 'rejected' ? '#6c757d' :
                   '#6c757d' // default color (gray) for other statuses
        };
    });

    // Check if calendar already exists and destroy it first
    if (calendarEl._fullCalendar) {
        calendarEl._fullCalendar.destroy();
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay search'
        },
        customButtons: {
            search: {
                text: 'Search',
                click: function() {
                    const searchTerm = prompt('Enter order number to search:');
                    if (searchTerm) {
                        const events = calendar.getEvents();
                        const foundEvent = events.find(event =>
                            event.title.toLowerCase().includes(searchTerm.toLowerCase())
                        );

                        if (foundEvent) {
                            calendar.gotoDate(foundEvent.start);
                            foundEvent.setProp('backgroundColor', '#ffcc00');
                            setTimeout(() => {
                                foundEvent.setProp('backgroundColor', '');
                            }, 3000);
                        } else {
                            alert('Order not found');
                        }
                    }
                }
            }
        },
        events: manufactureEvents,
        editable: true,
        selectable: true,
        eventClick: function(info) {
            const moNo = info.event.title.replace('Order #', '');
            @this.call('openManufactureModal', moNo);
        }
    });

    calendar.render();
    calendarEl._fullCalendar = calendar; // Store reference to the calendar
}

// Initialize on first load and after navigation
document.addEventListener('DOMContentLoaded', initializeCalendar);
document.addEventListener('livewire:navigated', initializeCalendar);
document.addEventListener('manufactureorderAdded', initializeCalendar);

window.addEventListener('manufactureorderAdded', function() {

    location.reload();
                    });


            </script>

            <style>
                #manufacturing-calendar {
                    max-width: 1100px;
                    margin: 0 auto;
                    background-color: white;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
            </style>

      <livewire:admin.dashboard.dep.manufacture.order.modal.editmanufacturemodal/>

        </div>
    </div>


</div>
