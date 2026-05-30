@extends('company.layouts.app')
@section('content')
<div class="flex flex-col xl:flex-row gap-4 lg:gap-6 h-full w-full max-w-full overflow-hidden" x-data="interviewCalendar()" x-init="initCalendar()" x-cloak>
    
    <!-- Calendar Section -->
    <div class="flex-1 min-w-0 bg-white rounded-2xl lg:rounded-3xl p-4 sm:p-5 lg:p-6 xl:p-8 shadow-sm flex flex-col border border-gray-100">
        
        <!-- Calendar Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-5 lg:mb-6">
            <h2 class="text-xl sm:text-2xl font-black text-gray-900 uppercase tracking-wide" x-text="monthNames[currentMonth] + ' ' + currentYear"></h2>
            <div class="flex items-center gap-2 sm:gap-3">
                <button @click="prevMonth()" class="p-2 rounded-xl bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition border border-gray-100 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <input type="month" 
                       class="w-full sm:w-auto px-3 sm:px-4 py-1.5 rounded-xl bg-gray-50 text-gray-600 text-xs sm:text-sm font-bold hover:bg-blue-50 hover:text-blue-600 transition border border-gray-100 focus:outline-none cursor-pointer"
                       x-bind:value="currentYear + '-' + String(currentMonth + 1).padStart(2, '0')"
                       @change="let parts = $event.target.value.split('-'); currentYear = parseInt(parts[0]); currentMonth = parseInt(parts[1]) - 1;">
                <button @click="nextMonth()" class="p-2 rounded-xl bg-gray-50 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition border border-gray-100 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Scrollable Date Area -->
        <div class="flex-1 min-h-0 max-h-[calc(100vh-260px)] overflow-auto pr-1">
            <div class="min-w-[520px] sm:min-w-0">
                <!-- Days Header -->
                <div class="grid mb-2 sm:mb-4 gap-1 sm:gap-2 lg:gap-3 sticky top-0 z-10 bg-white pb-2" style="grid-template-columns: repeat(7, minmax(0, 1fr));">
                    <template x-for="day in days" :key="day">
                        <div class="text-center text-[10px] sm:text-xs font-bold text-gray-400 tracking-wide sm:tracking-widest uppercase" x-text="day"></div>
                    </template>
                </div>

                <!-- Calendar Grid -->
                <div class="grid gap-1 sm:gap-2 lg:gap-3" style="grid-template-columns: repeat(7, minmax(0, 1fr));">
            
            <!-- Blank days from previous month -->
            <template x-for="blankDay in blankDays">
                <div class="border border-gray-100 rounded-xl lg:rounded-2xl p-1.5 sm:p-2 lg:p-3 min-h-[64px] sm:min-h-[82px] lg:min-h-[100px] xl:min-h-[110px] flex flex-col opacity-40 bg-gray-50/50">
                    <span class="text-xs sm:text-sm font-semibold text-gray-500" x-text="blankDay.date"></span>
                </div>
            </template>

            <!-- Current month days -->
            <template x-for="dayObj in noOfDays" :key="dayObj.date">
                <div @click="selectDate(dayObj.fullDate)" 
                     class="border rounded-xl lg:rounded-2xl p-1.5 sm:p-2 lg:p-3 min-h-[64px] sm:min-h-[82px] lg:min-h-[100px] xl:min-h-[110px] flex flex-col relative transition-all cursor-pointer group"
                     :class="{
                         'border-2 border-blue-500 bg-[#eff4ff] shadow-sm': isSelected(dayObj.fullDate),
                         'border-gray-100 hover:border-blue-300 hover:shadow-sm': !isSelected(dayObj.fullDate)
                     }">
                    
                    <div class="flex justify-between items-start mb-1 sm:mb-2">
                        <span class="text-xs sm:text-sm font-bold flex items-center justify-center rounded-full transition-colors"
                              :class="{
                                  'w-6 h-6 sm:w-7 sm:h-7 bg-blue-600 text-white': isSelected(dayObj.fullDate),
                                  'text-gray-800 group-hover:text-blue-600': !isSelected(dayObj.fullDate)
                              }"
                              x-text="dayObj.date">
                        </span>
                        
                        <!-- Event count badge -->
                        <template x-if="getInterviewsForDate(dayObj.fullDate).length > 0 && !isSelected(dayObj.fullDate)">
                            <span class="flex items-center justify-center w-4 h-4 sm:w-5 sm:h-5 bg-blue-600 text-white rounded-full text-[9px] sm:text-[10px] font-bold" x-text="getInterviewsForDate(dayObj.fullDate).length"></span>
                        </template>
                    </div>

                    <!-- List of events for the day -->
                    <div class="hidden sm:block mt-auto space-y-1 overflow-hidden" style="max-height: 50px;">
                        <template x-for="(interview, index) in getInterviewsForDate(dayObj.fullDate)" :key="index">
                            <template x-if="index < 2">
                                <div class="text-[9px] font-bold border rounded py-1 px-1.5 flex items-center gap-1.5 overflow-hidden"
                                     :class="getBadgeColorClass(interview.color)">
                                    <span class="w-1.5 h-1.5 rounded-full shrink-0" :class="getBadgeDotClass(interview.color)"></span>
                                    <span class="truncate" x-text="interview.name"></span>
                                </div>
                            </template>
                        </template>
                        <template x-if="getInterviewsForDate(dayObj.fullDate).length > 2">
                            <div class="text-[9px] font-bold text-gray-500 py-0.5 px-1.5">
                                +<span x-text="getInterviewsForDate(dayObj.fullDate).length - 2"></span> jadwal lain
                            </div>
                        </template>
                    </div>

                </div>
            </template>

            <!-- Blank days from next month -->
            <template x-for="nextDay in nextBlankDays">
                <div class="border border-gray-100 rounded-xl lg:rounded-2xl p-1.5 sm:p-2 lg:p-3 min-h-[64px] sm:min-h-[82px] lg:min-h-[100px] xl:min-h-[110px] flex flex-col opacity-40 bg-gray-50/50">
                    <span class="text-xs sm:text-sm font-semibold text-gray-500" x-text="nextDay.date"></span>
                </div>
            </template>

                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar (Schedule Detail) -->
    <div class="w-full xl:w-[320px] bg-white rounded-2xl lg:rounded-3xl p-4 sm:p-6 lg:p-8 shadow-sm flex flex-col h-fit border border-gray-100 shrink-0">
        <div class="mb-5 lg:mb-6">
            <div class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-black bg-blue-50 text-blue-600 tracking-widest mb-4 lg:mb-6 border border-blue-100">
                DETAIL JADWAL
            </div>
            <h2 class="text-[22px] sm:text-[28px] font-black text-gray-900 leading-tight mb-2 tracking-wide uppercase" style="font-family: 'Arial Black', Impact, sans-serif;">
                <span x-html="formatSelectedDateForSidebar().day"></span><br>
                <span x-text="formatSelectedDateForSidebar().year"></span>
            </h2>
            <p class="text-sm text-gray-400 font-medium">Sesi wawancara terjadwal</p>
        </div>

        <hr class="border-gray-100 mb-5 lg:mb-6">

        <!-- When there are interviews -->
        <template x-if="getSelectedDateInterviews().length > 0">
            <div class="flex-1 flex flex-col overflow-hidden max-h-[420px] lg:max-h-[500px]">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-gray-800"><span x-text="getSelectedDateInterviews().length"></span> Jadwal Interview</h3>
                </div>
                
                <!-- Scrollable List -->
                <div class="flex-1 overflow-y-auto pr-2 space-y-3 pb-4">
                    <template x-for="(interview, index) in getSelectedDateInterviews()" :key="index">
                        <div class="p-3 sm:p-4 rounded-2xl border border-gray-100 bg-gray-50 hover:bg-white hover:border-blue-300 hover:shadow-sm transition-all group cursor-pointer">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition-colors" x-text="interview.name"></h4>
                                    <p class="text-xs text-gray-500 mt-0.5" x-text="interview.role"></p>
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-bold"
                                      :class="getBadgeColorClass(interview.color)"
                                      x-text="interview.time">
                                </span>
                            </div>
                            <div class="flex flex-col w-full text-xs font-medium text-gray-500 gap-3 mt-1">
                                <div class="flex items-center gap-1.5">
                                    <template x-if="interview.type.toLowerCase().includes('meet') || interview.type.toLowerCase().includes('zoom') || interview.type.toLowerCase().includes('online')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    </template>
                                    <template x-if="!(interview.type.toLowerCase().includes('meet') || interview.type.toLowerCase().includes('zoom') || interview.type.toLowerCase().includes('online'))">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    </template>
                                    <span x-text="interview.type"></span>
                                </div>
                                <template x-if="interview.link_zoom && interview.link_zoom !== '#'">
                                    <a :href="interview.link_zoom" target="_blank" @click.stop class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold flex justify-center items-center gap-2 transition-colors shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                        Gabung Zoom Meeting
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <!-- Empty State -->
        <template x-if="getSelectedDateInterviews().length === 0">
            <div class="flex-1 flex flex-col items-center justify-center text-center pb-8 sm:pb-12 mt-4">
                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gray-50 rounded-[20px] flex items-center justify-center mb-5 sm:mb-6 border border-gray-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 sm:w-8 sm:h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-2">Tidak ada jadwal</h3>
                <p class="text-sm text-gray-400 max-w-[220px] mx-auto leading-relaxed">
                    Pilih tanggal dengan indikator biru<br>untuk melihat jadwal wawancara.
                </p>
            </div>
        </template>
    </div>

</div>
@endsection

@php
    $mappedEvents = collect($events ?? [])->map(function($e) {
        $colors = ['emerald', 'purple', 'indigo', 'blue'];
        // Generate warna konsisten berdasarkan ID notifikasi
        $colorIndex = crc32($e['notifikasi_id'] ?? rand()) % 4;
        return [
            'id' => $e['notifikasi_id'] ?? rand(),
            'date' => $e['tanggal_iso'],
            'name' => $e['nama_pelamar'],
            'role' => $e['posisi'],
            'time' => $e['jam'] . ' WIB',
            'type' => (!empty($e['link_zoom']) && $e['link_zoom'] !== '#') ? 'Online Meeting' : 'Wawancara Langsung',
            'color' => $colors[$colorIndex],
            'link_zoom' => $e['link_zoom'] ?? '#'
        ];
    })->values()->all();
@endphp

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('interviewCalendar', () => ({
            todayDate: new Date(),
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            selectedDate: new Date(),
            
            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            days: ['MIN', 'SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB'],
            
            // Data diambil dari Controller InterviewController ($events)
            interviews: @json($mappedEvents),

            initCalendar() {
                // Set the selected date to today initially
                this.selectedDate = new Date(this.currentYear, this.currentMonth, this.todayDate.getDate());
            },

            get blankDays() {
                let daysInMonth = new Date(this.currentYear, this.currentMonth, 1).getDay();
                let blankDaysArray = [];
                let prevMonthDays = new Date(this.currentYear, this.currentMonth, 0).getDate();
                for (let i = 1; i <= daysInMonth; i++) {
                    blankDaysArray.push({
                        date: prevMonthDays - daysInMonth + i,
                    });
                }
                return blankDaysArray;
            },

            get noOfDays() {
                let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
                let daysArray = [];
                for (let i = 1; i <= daysInMonth; i++) {
                    daysArray.push({
                        date: i,
                        fullDate: new Date(this.currentYear, this.currentMonth, i)
                    });
                }
                return daysArray;
            },
            
            get nextBlankDays() {
                let totalDaysSoFar = this.blankDays.length + this.noOfDays.length;
                let nextDays = 42 - totalDaysSoFar;
                let daysArray = [];
                for (let i = 1; i <= nextDays; i++) {
                    daysArray.push({
                        date: i,
                    });
                }
                return daysArray;
            },

            isSelected(dateObj) {
                return this.selectedDate && 
                       this.selectedDate.getDate() === dateObj.getDate() &&
                       this.selectedDate.getMonth() === dateObj.getMonth() &&
                       this.selectedDate.getFullYear() === dateObj.getFullYear();
            },

            selectDate(dateObj) {
                this.selectedDate = dateObj;
            },

            nextMonth() {
                if (this.currentMonth === 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                } else {
                    this.currentMonth++;
                }
            },

            prevMonth() {
                if (this.currentMonth === 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                } else {
                    this.currentMonth--;
                }
            },

            today() {
                this.currentMonth = this.todayDate.getMonth();
                this.currentYear = this.todayDate.getFullYear();
                this.selectedDate = new Date(this.currentYear, this.currentMonth, this.todayDate.getDate());
            },

            formatDate(date) {
                if(!date) return '';
                let d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },

            getInterviewsForDate(dateObj) {
                let formattedStr = this.formatDate(dateObj);
                return this.interviews.filter(i => i.date === formattedStr);
            },
            
            getSelectedDateInterviews() {
                if(!this.selectedDate) return [];
                return this.getInterviewsForDate(this.selectedDate);
            },

            formatSelectedDateForSidebar() {
                if(!this.selectedDate) return { day: '', year: '' };
                let dayName = this.days[this.selectedDate.getDay()];
                let fullDayName = {'MIN':'Minggu', 'SEN':'Senin', 'SEL':'Selasa', 'RAB':'Rabu', 'KAM':'Kamis', 'JUM':'Jumat', 'SAB':'Sabtu'}[dayName];
                return {
                    day: fullDayName + ', ' + this.selectedDate.getDate() + ' ' + this.monthNames[this.selectedDate.getMonth()],
                    year: this.selectedDate.getFullYear()
                };
            },

            getBadgeColorClass(color) {
                const colors = {
                    'emerald': 'bg-emerald-50 text-emerald-700 border-emerald-100',
                    'purple': 'bg-purple-50 text-purple-700 border-purple-100',
                    'indigo': 'bg-indigo-50 text-indigo-700 border-indigo-100',
                    'blue': 'bg-blue-50 text-blue-700 border-blue-100',
                };
                return colors[color] || colors['blue'];
            },

            getBadgeDotClass(color) {
                const colors = {
                    'emerald': 'bg-emerald-500',
                    'purple': 'bg-purple-500',
                    'indigo': 'bg-indigo-500',
                    'blue': 'bg-blue-500',
                };
                return colors[color] || colors['blue'];
            }
        }));
    });
</script>
@endpush