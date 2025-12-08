document.addEventListener('DOMContentLoaded', function() {
    const monthSelectBtn = document.getElementById('month-select');
    const yearSelectBtn = document.getElementById('year-select');
    const monthDrop = document.getElementById('month-dropdown');
    const yearDrop = document.getElementById('year-dropdown');
    const gotoTodayBtn = document.getElementById('today-btn');

    const today = new Date();
    const calendarEl = document.getElementById('calendar');
    const countryCode = 'PH';

    async function getHolidays(year) {
        const holidaysReply = await fetch(`https://date.nager.at/api/v3/PublicHolidays/${year}/${countryCode}`);
        const holidaysData = await holidaysReply.json();

        return holidaysData.map(h => ({
            title: h.localName,
            start: h.date,
            color: '#F59E0B',
            textColor: '#fff',
            editable: false
        }));
    }
    
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        contentHeight: 'auto',
        initialDate: today,
        selectable: true,
        editable: true,
        events: [],
        headerToolbar: false,
        dateClick: function(info) {
            console.log("You clicked: "+info.dateStr);
        },

        datesSet: async function() {
            const currentDay = calendar.getDate();
            const monthName = currentDay.toLocaleString('default', { month: 'long' });
            const year = currentDay.getFullYear();

            const holidays = await getHolidays(year);
            calendar.removeAllEvents();

            // For fetch agenda events from backend
            // const eventResponse = await fetch('/events');
            // const myEvents = await eventResponse.json();

            const myEvents =  [
                { title: 'Meeting with Team', start: '2025-10-03' },
                { title: 'Dentist Appointment', start: '2025-10-08', color: '#10B981' },
                { title: 'Project Deadline', start: '2025-10-15' },
                { title: 'Weekend Trip', start: '2025-10-22', end: '2025-10-24' },
                { title: '23rd Year', start: '2026-01-07', color: '#EF4444' },
            ];
            const allEvents = [...myEvents, ...holidays];
            calendar.addEventSource(allEvents);

            document.getElementById('h2-month').textContent = monthName;
            document.getElementById('h3-year').textContent = year;
        },
    });

    calendar.render();

    monthSelectBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        monthDrop.classList.toggle('hidden');
        yearDrop.classList.add('hidden');
    });

    yearSelectBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        yearDrop.classList.toggle('hidden');
        monthDrop.classList.add('hidden');
    });

    document.querySelectorAll('#month-dropdown button').forEach(btn => {
        btn.addEventListener('click', function() {
            const selMonth = parseInt(this.dataset.month);
            const currentYr = calendar.getDate().getFullYear();
            calendar.gotoDate(new Date(currentYr, selMonth, 1));
            monthDrop.classList.add('hidden');
        })
    });

    document.querySelectorAll('#year-dropdown button').forEach(btn => {
        btn.addEventListener('click', function() {
            const selYr = parseInt(this.dataset.year);
            const currentMonth = calendar.getDate().getMonth();
            calendar.gotoDate(new Date(selYr, currentMonth, 1));
            yearDrop.classList.add('hidden');
        })
    });

    gotoTodayBtn.addEventListener('click', function() {
        calendar.today();
    });

    window.onclick = function() {
        monthDrop.classList.add('hidden');
        yearDrop.classList.add('hidden');
    };

    document.getElementById('prev-month').addEventListener('click', () => calendar.prev());
    document.getElementById('next-month').addEventListener('click', () => calendar.next());
});