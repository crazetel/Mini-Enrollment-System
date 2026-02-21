<!-- Student Course Catalog View -->
<div class="min-h-screen p-8">
    <div class="mb-12">
        <p class="text-[10px] font-black uppercase tracking-[0.5em] text-pink-500">Academic Modules</p>
        <h1 class="text-6xl font-serif italic text-white">Course <span class="opacity-30">Catalog</span></h1>
    </div>

    <!-- Search Bar -->
    <div class="mb-20 w-full">
        <div class="glass flex items-center p-2 rounded-full border border-white/5 shadow-2xl w-full">
            <input type="text" id="courseSearch" onkeyup="filterCourses()" placeholder="Search by name or code..."
                   class="flex-1 bg-transparent border-none outline-none px-10 py-3 text-white placeholder:text-white/20 text-sm tracking-widest font-light">
            
            <div class="h-5 w-[1px] bg-white/10 mx-2"></div>
            
            <button class="bg-white text-black px-14 py-3 rounded-full text-[10px] font-black uppercase tracking-[0.2em] hover:bg-cyan-400 hover:text-white transition-all transform hover:scale-[1.02] active:scale-95 ml-2">
                Search
            </button>
        </div>
    </div>

    <!-- Course Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="courseGrid">
        @forelse($courses as $course)
        <div class="course-card glass p-10 rounded-[3rem] border border-white/5 hover:border-white/20 transition-all group relative">
            <div class="flex justify-between items-start mb-6">
                <span class="bg-pink-500/20 text-pink-400 text-[10px] px-4 py-1.5 rounded-full font-bold uppercase tracking-widest course-code">{{ $course->course_code }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest opacity-30">Slots: {{ $course->students->count() }}/{{ $course->capacity }}</span>
            </div>

            <h3 class="text-3xl font-bold text-white mb-3 course-title leading-tight">{{ $course->course_name }}</h3>
            <p class="text-sm text-white/40 mb-12 h-12 overflow-hidden leading-relaxed">{{ $course->description }}</p>

            <div class="flex items-center space-x-3">
                <!-- View Details Button -->
                <a href="{{ route('courses.show', $course->id) }}" class="flex-1 p-4 rounded-2xl bg-white/5 hover:bg-white/10 text-white transition-all border border-white/5 text-center text-[10px] font-black uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Details
                </a>

                <!-- Enroll/Unenroll Button -->
                @php
                    $isEnrolled = auth()->user()->courses()->where('course_id', $course->id)->exists();
                    $isFull = $course->students->count() >= $course->capacity;
                @endphp

                @if($isEnrolled)
                    <form method="POST" action="{{ route('courses.unenroll', $course->id) }}" style="flex: 1;">
                        @csrf
                        <button type="submit" class="w-full p-4 rounded-2xl bg-pink-500/20 hover:bg-pink-500/30 text-pink-400 transition-all border border-pink-500/30 text-[10px] font-black uppercase tracking-widest">
                            Withdraw
                        </button>
                    </form>
                @elseif($isFull)
                    <button disabled class="flex-1 p-4 rounded-2xl bg-gray-600/20 text-gray-400 border border-gray-600/30 text-[10px] font-black uppercase tracking-widest cursor-not-allowed opacity-50">
                        Full
                    </button>
                @else
                    <form method="POST" action="{{ route('courses.enroll', $course->id) }}" style="flex: 1;">
                        @csrf
                        <button type="submit" class="w-full p-4 rounded-2xl bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-400 transition-all border border-cyan-500/30 text-[10px] font-black uppercase tracking-widest transform hover:scale-[1.02] active:scale-95">
                            Enroll
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <p class="text-white/40 text-lg">No courses available at this time.</p>
        </div>
        @endforelse
    </div>

    <!-- Enrolled Courses Summary -->
    <div class="mt-20 pt-12 border-t border-white/10">
        <div class="mb-8">
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400 mb-2">Your Progress</p>
            <h2 class="text-4xl font-bold text-white">My Enrollments</h2>
        </div>

        @php
            $enrolledCourses = auth()->user()->courses;
        @endphp

        @if($enrolledCourses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($enrolledCourses as $course)
            <div class="glass p-8 rounded-2xl border border-cyan-500/20 hover:border-cyan-500/40 transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="bg-cyan-500/20 text-cyan-400 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest">{{ $course->course_code }}</span>
                        <h3 class="text-2xl font-bold text-white mt-3">{{ $course->course_name }}</h3>
                    </div>
                </div>
                <p class="text-white/40 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                <form method="POST" action="{{ route('courses.unenroll', $course->id) }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-pink-500/20 hover:bg-pink-500/30 text-pink-400 rounded-xl text-[10px] font-bold uppercase tracking-widest transition-all border border-pink-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        Withdraw from Course
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <div class="glass p-12 rounded-2xl border border-white/5 text-center">
            <p class="text-white/40 text-lg mb-4">You haven't enrolled in any courses yet.</p>
            <p class="text-white/30 text-sm">Browse the catalog above and select courses to enroll in.</p>
        </div>
        @endif
    </div>
</div>

<script>
    function filterCourses() {
        let input = document.getElementById('courseSearch').value.toLowerCase();
        let cards = document.getElementsByClassName('course-card');
        for (let i = 0; i < cards.length; i++) {
            let title = cards[i].querySelector('.course-title').innerText.toLowerCase();
            let code = cards[i].querySelector('.course-code').innerText.toLowerCase();
            cards[i].style.display = (title.includes(input) || code.includes(input)) ? "" : "none";
        }
    }
</script>
