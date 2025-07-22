import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
import idLocale from "@fullcalendar/core/locales/id";

// Sample event data (akan diisi array hasil fetch)
let sampleEvents = [];

// Calendar instance
let calendar;

// Initialize calendar

document.addEventListener("DOMContentLoaded", async function () {
    // Fetch event data once
    try {
        const res = await fetch("/agenda");
        sampleEvents = await res.json();
    } catch (e) {
        sampleEvents = [];
    }

    const calendarEl = document.getElementById("calendar");

    calendar = new Calendar(calendarEl, {
        initialView: "dayGridMonth",
        locale: idLocale,
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        height: 650,
        aspectRatio: 1.8,
        headerToolbar: {
            left: "prev,next today",
            center: "",
            right: "title",
        },
        buttonText: {
            today: "Hari Ini",
            month: "Bulan",
            week: "Minggu",
            day: "Hari",
        },
        events: sampleEvents,
        eventClick: function (info) {
            showEventModal(info.event);
        },
        // dateClick: function (info) {
        //     // Handle date click if needed
        //     console.log("Date clicked:", info.dateStr);
        // },
        eventMouseEnter: function (info) {
            info.el.style.transform = "translateY(-3px) scale(1.02)";
            info.el.style.boxShadow = "0 8px 25px rgba(0, 0, 0, 0.15)";
            info.el.style.zIndex = "10";
        },
        eventMouseLeave: function (info) {
            info.el.style.transform = "translateY(0)";
            info.el.style.boxShadow = "none";
            info.el.style.zIndex = "auto";
        },
        dayMaxEvents: 3,
        moreLinkClick: "popover",
        eventDisplay: "block",
        displayEventTime: true,
        eventTimeFormat: {
            hour: "2-digit",
            minute: "2-digit",
            hour12: false,
        },
    });

    calendar.render();

    // Initialize other components
    initializeEventListeners();
    updateUpcomingEvents();
    // setupCategoryFilters();
    setupMobileMenu();
    updateCurrentTime();
    setInterval(updateCurrentTime, 60000);
});

// Initialize event listeners
function initializeEventListeners() {
    // Tampilan buttons
    document.getElementById("listView").addEventListener("click", function () {
        calendar.changeView("listMonth");
    });

    document.getElementById("monthView").addEventListener("click", function () {
        calendar.changeView("dayGridMonth");
    });

    document.getElementById("weekView").addEventListener("click", function () {
        calendar.changeView("timeGridWeek");
    });

    document.getElementById("dayView").addEventListener("click", function () {
        calendar.changeView("timeGridDay");
    });

    // Modal controls
    document
        .getElementById("closeModal")
        .addEventListener("click", closeEventModal);
    document
        .getElementById("eventModal")
        .addEventListener("click", function (e) {
            if (e.target === this) {
                closeEventModal();
            }
        });

    // Back to main website button
    document
        .getElementById("backMainWebBtn")
        .addEventListener("click", function () {
            window.location.href = "https://lampung.pom.go.id/";
        });
}

// Setup mobile menu functionality
function setupMobileMenu() {
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    // Toggle sidebar on mobile
    mobileMenuBtn.addEventListener("click", function () {
        toggleMobileSidebar();
    });

    // Close sidebar when clicking overlay
    overlay.addEventListener("click", function () {
        closeMobileSidebar();
    });

    // Close sidebar on window resize if screen becomes large
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 1024) {
            // lg breakpoint
            closeMobileSidebar();
        }
    });
}

// Toggle mobile sidebar
function toggleMobileSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    if (sidebar.classList.contains("-translate-x-full")) {
        // Show sidebar
        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");
        overlay.classList.remove("hidden");
    } else {
        // Hide sidebar
        closeMobileSidebar();
    }
}

// Close mobile sidebar
function closeMobileSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("sidebarOverlay");

    sidebar.classList.remove("translate-x-0");
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
}

// Setup category filters
function setupCategoryFilters() {
    const filters = document.querySelectorAll(".category-filter");

    filters.forEach((filter) => {
        filter.addEventListener("change", function () {
            filterEvents();
        });
    });
}

// Filter events based on category selection
function filterEvents() {
    const checkedFilters = Array.from(
        document.querySelectorAll(".category-filter:checked")
    ).map((filter) => filter.value);

    const filteredEvents = sampleEvents.filter((event) =>
        checkedFilters.includes(event.extendedProps.category)
    );

    calendar.removeAllEvents();
    calendar.addEventSource(filteredEvents);
    updateUpcomingEvents();
}

// Show event modal with details
function showEventModal(event) {
    const modal = document.getElementById("eventModal");
    const details = document.getElementById("eventDetails");

    const startDate = new Date(event.start);
    const endDate = event.end ? new Date(event.end) : null;

    const formatDate = (date) => {
        return date.toLocaleDateString("id-ID", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        });
    };

    const formatTime = (date) => {
        return date.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
        });
    };

    details.innerHTML = `
        <div class="space-y-6">
            <div>
                <h4 class="text-2xl font-bold text-gray-900 leading-tight">${
                    event.title
                }</h4>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900 mb-1">Tanggal & Waktu</p>
                        <p class="text-lg font-semibold text-gray-800">${formatDate(
                            startDate
                        )}</p>
                        ${
                            endDate
                                ? `<p class="text-sm text-gray-600 font-medium">${formatTime(
                                      startDate
                                  )} - ${formatTime(endDate)}</p>`
                                : `<p class="text-sm text-gray-600 font-medium">Sepanjang Hari</p>`
                        }
                    </div>
                </div>
                
                ${
                    event.extendedProps.tempat
                        ? `
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900 mb-1">Lokasi</p>
                        <p class="text-lg font-semibold text-gray-800">${event.extendedProps.tempat}</p>
                    </div>
                </div>
                `
                        : ""
                }
                
                ${
                    event.extendedProps.pic
                        ? `
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900 mb-1">PIC</p>
                        <p class="text-gray-700 leading-relaxed">${event.extendedProps.pic}</p>
                    </div>
                </div>
                `
                        : ""
                }
                
            </div>
        </div>
    `;

    modal.classList.remove("hidden");
    modal.classList.add("fade-in");
    details.classList.add("scale-in");
}

// Close event modal
function closeEventModal() {
    const modal = document.getElementById("eventModal");
    modal.classList.add("hidden");
    modal.classList.remove("fade-in");
}

// Update upcoming events in sidebar
async function updateUpcomingEvents() {
    const upcomingContainer = document.getElementById("upcomingEvents");
    const today = new Date();
    const nextWeek = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);

    const events = sampleEvents;
    const upcomingEvents = events
        .filter((event) => {
            const eventDate = new Date(event.start);
            return eventDate >= today && eventDate <= nextWeek;
        })
        .sort((a, b) => new Date(a.start) - new Date(b.start))
        .slice(0, 5);

    const fallbackColor = "#3b82f6";

    if (upcomingEvents.length === 0) {
        upcomingContainer.innerHTML = `
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-sm text-gray-500 font-medium">Tidak ada event dalam 7 hari ke depan</p>
            </div>
        `;
        return;
    }

    upcomingContainer.innerHTML = upcomingEvents
        .map((event) => {
            const eventDate = new Date(event.start);
            const isToday = eventDate.toDateString() === today.toDateString();
            const color = event.backgroundColor || fallbackColor;
            return `
            <div class="group flex items-start space-x-4 p-4 rounded-xl hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:scale-105" data-event-uuid="${
                event.uuid
            }">
                <div class="w-3 h-3 rounded-full mt-2 flex-shrink-0 shadow-lg" style="background: linear-gradient(135deg, ${color}, ${color}dd);"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 truncate group-hover:text-primary transition-colors duration-300">${
                        event.title
                    }</p>
                    <p class="text-xs text-gray-500 font-medium mt-1">
                        ${
                            isToday
                                ? "🔥 Hari ini"
                                : eventDate.toLocaleDateString("id-ID", {
                                      weekday: "short",
                                      month: "short",
                                      day: "numeric",
                                  })
                        }
                        ${
                            event.end
                                ? ` • ${eventDate.toLocaleTimeString("id-ID", {
                                      hour: "2-digit",
                                      minute: "2-digit",
                                  })}`
                                : ""
                        }
                    </p>
                </div>
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        `;
        })
        .join("");

    // Add event listeners to upcoming events
    const eventElements =
        upcomingContainer.querySelectorAll("[data-event-uuid]");
    eventElements.forEach((element) => {
        element.addEventListener("click", function () {
            const eventUuid = this.getAttribute("data-event-uuid");
            showEventFromSidebar(eventUuid);
        });
    });
}

// Show event from sidebar click (fetch by uuid from backend)
async function showEventFromSidebar(eventUuid) {
    const event = sampleEvents.find((e) => e.uuid === eventUuid);
    if (event) {
        // Gabungkan properti tempat dan pic ke extendedProps
        const extendedProps = Object.assign({}, event.extendedProps || {});
        if (event.tempat) extendedProps.tempat = event.tempat;
        if (event.pic) extendedProps.pic = event.pic;
        const fcEvent = {
            title: event.title,
            start: event.start,
            end: event.end,
            extendedProps,
        };
        showEventModal(fcEvent);
    }
}

// Update current time display every minute
function updateCurrentTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString("en-US", {
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
    });
    const el = document.getElementById("currentTime");
    if (el) el.textContent = timeString;
}

// Handle escape key to close modal
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeEventModal();
    }
});

// Handle window resize
window.addEventListener("resize", function () {
    if (calendar) {
        calendar.updateSize();
    }
});
