<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kalender Kegiatan | Balai Besar POM di Bandar Lampung</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/css/agenda.css', 'resources/js/publicAgenda.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100 font-inter min-h-screen">
    <!-- Header with Gradient -->
    <header class="bg-gradient-to-r from-primary via-primary-light to-primary shadow-xl border-b border-primary/20 top-0 z-30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <!-- Enhanced Logo -->
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-white to-gray-100 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-all duration-300">
                            <img src="{{ asset('img/bpom-logo-500x500.png') }}" alt="Logo BPOM">
                        </div>
                    </div>
                    <div class="text-white">
                        <h1 class="text-2xl font-bold tracking-tight">Kalender Kegiatan</h1>
                        <p class="text-sm font-medium opacity-90">Balai Besar POM di Bandar Lampung</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Enhanced Today Button -->
                    <div class="group px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm rounded-xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-accent-light rounded-full"></div>
                            <span id="currentTime" class="text-sm"></span>
                        </span>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="lg:hidden p-3 text-white/90 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Enhanced Add Event Button -->
                    <button id="backMainWebBtn" class="group px-6 py-3 text-sm font-semibold text-white bg-accent hover:bg-accent-light rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center space-x-2">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Kembali</span>
                        </span>
                    </button>
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content with Enhanced Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 relative">
            <!-- Enhanced Sidebar -->
            <div id="sidebar" class="lg:col-span-1 space-y-6 fixed lg:static inset-y-0 left-0 z-40 w-80 lg:w-auto bg-white lg:bg-transparent transform -translate-x-full lg:translate-x-0 transition-all duration-500 ease-out lg:transition-none overflow-y-auto lg:overflow-visible pt-24 lg:pt-0 px-6 lg:px-0 shadow-2xl lg:shadow-none">
                
                <!-- Calendar Navigation with Glass Effect -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 animate-fade-in">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-light rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Tampilan Kalender</h3>
                    </div>
                    <div class="space-y-4">
                        <button id="monthView" class="group w-full px-5 py-3 text-sm font-semibold text-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-primary hover:to-primary-light hover:text-white transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-lg">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Bulan</span>
                            </span>
                        </button>
                        <button id="weekView" class="group w-full px-5 py-3 text-sm font-semibold text-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-primary hover:to-primary-light hover:text-white transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-lg">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Minggu</span>
                            </span>
                        </button>
                        <button id="dayView" class="group w-full px-5 py-3 text-sm font-semibold text-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-primary hover:to-primary-light hover:text-white transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-lg">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Hari</span>
                            </span>
                        <button id="listView" class="group w-full px-5 py-3 text-sm font-semibold text-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-primary hover:to-primary-light hover:text-white transition-all duration-300 transform hover:scale-105 shadow-sm hover:shadow-lg">
                            <span class="flex items-center justify-center space-x-2">
                                <span>List</span>
                            </span>
                        </button>
                        </button>
                    </div>
                </div>

                <!-- Enhanced Event Categories -->
                {{-- <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 animate-slide-up">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-accent to-accent-light rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Kategori Event</h3>
                    </div>
                    <div class="space-y-4">
                        <label class="group flex items-center space-x-4 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-all duration-300">
                            <input type="checkbox" class="category-filter w-5 h-5 rounded-lg border-2 border-gray-300 text-primary focus:ring-primary focus:ring-2" value="meeting" checked>
                            <div class="flex items-center space-x-3">
                                <span class="w-4 h-4 rounded-full bg-gradient-to-br from-primary to-primary-light shadow-lg"></span>
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-primary transition-colors duration-300">Meeting</span>
                            </div>
                        </label>
                        <label class="group flex items-center space-x-4 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-all duration-300">
                            <input type="checkbox" class="category-filter w-5 h-5 rounded-lg border-2 border-gray-300 text-accent focus:ring-accent focus:ring-2" value="training" checked>
                            <div class="flex items-center space-x-3">
                                <span class="w-4 h-4 rounded-full bg-gradient-to-br from-accent to-accent-light shadow-lg"></span>
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-accent transition-colors duration-300">Training</span>
                            </div>
                        </label>
                        <label class="group flex items-center space-x-4 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-all duration-300">
                            <input type="checkbox" class="category-filter w-5 h-5 rounded-lg border-2 border-gray-300 text-orange-500 focus:ring-orange-500 focus:ring-2" value="event" checked>
                            <div class="flex items-center space-x-3">
                                <span class="w-4 h-4 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 shadow-lg"></span>
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-orange-500 transition-colors duration-300">Corporate Event</span>
                            </div>
                        </label>
                        <label class="group flex items-center space-x-4 cursor-pointer p-3 rounded-xl hover:bg-gray-50 transition-all duration-300">
                            <input type="checkbox" class="category-filter w-5 h-5 rounded-lg border-2 border-gray-300 text-blue-500 focus:ring-blue-500 focus:ring-2" value="deadline" checked>
                            <div class="flex items-center space-x-3">
                                <span class="w-4 h-4 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg"></span>
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-500 transition-colors duration-300">Deadline</span>
                            </div>
                        </label>
                    </div>
                </div> --}}

                <!-- Enhanced Upcoming Events -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300 animate-bounce-gentle">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 2.05v3.03c3.39.49 6 3.39 6 6.92 0 .9-.18 1.75-.48 2.54l2.6 1.53c.56-1.24.88-2.62.88-4.07 0-5.18-3.95-9.45-9-9.95zM12 19c-3.87 0-7-3.13-7-7 0-3.53 2.61-6.43 6-6.92V2.05c-5.06.5-9 4.76-9 9.95 0 5.52 4.47 10 9.99 10 3.31 0 6.24-1.61 8.06-4.09l-2.6-1.53C16.17 17.98 14.21 19 12 19z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Event Mendatang</h3>
                    </div>
                    <div id="upcomingEvents" class="space-y-3">
                        <!-- Upcoming events will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Enhanced Calendar -->
            <div class="lg:col-span-3 transition-all duration-500">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8 hover:shadow-3xl transition-all duration-500 animate-fade-in">
                    <div id="calendar" class="calendar-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-gradient-to-br from-black/60 via-black/40 to-black/60 backdrop-blur-md z-30 lg:hidden hidden transition-all duration-500"></div>

    <!-- Enhanced Event Modal -->
    <div id="eventModal" class="fixed inset-0 bg-gradient-to-br from-black/60 via-black/40 to-black/60 backdrop-blur-md hidden z-50 transition-all duration-500">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-3xl max-w-lg w-full p-8 transform transition-all duration-500 scale-95 hover:scale-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-sm text-gray-400">Detail Agenda</h3>
                    <button id="closeModal" class="group p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-300">
                        <svg class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="eventDetails" class="space-y-6">
                    <!-- Event details will be populated here -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>