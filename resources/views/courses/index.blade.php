@extends('layouts.app')

@section('content')
<div class="min-h-screen p-8">
    <div class="flex justify-between items-center mb-12">
        <div>
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-cyan-400">Academic Modules</p>
            <h1 class="text-6xl font-serif italic text-white">Course <span class="opacity-30">Catalog</span></h1>
        </div>
        <div class="flex items-center space-x-8">
            <a href="{{ route('courses.create') }}" class="glass px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white hover:bg-white/10 transition">
                Add New Course
            </a>
        </div>
    </div>

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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="courseGrid">
        @foreach($courses as $course)
        <div class="course-card glass p-10 rounded-[3rem] border border-white/5 hover:border-white/20 transition-all group relative">
            <div class="flex justify-between items-start mb-6">
                <span class="bg-cyan-500/20 text-cyan-400 text-[10px] px-4 py-1.5 rounded-full font-bold uppercase tracking-widest course-code">{{ $course->course_code }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest opacity-30">Slots: {{ $course->students->count() }}/{{ $course->capacity }}</span>
            </div>

            <h3 class="text-3xl font-bold text-white mb-3 course-title leading-tight">{{ $course->course_name }}</h3>
            <p class="text-sm text-white/40 mb-12 h-12 overflow-hidden leading-relaxed">{{ $course->description }}</p>

            <div class="flex items-center space-x-3">
                <a href="{{ route('courses.show', $course->id) }}" class="p-4 rounded-2xl bg-white/5 hover:bg-white/10 text-white transition-all border border-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </a>
                <a href="{{ route('courses.edit', $course->id) }}" class="p-4 rounded-2xl bg-white/5 hover:bg-cyan-500/20 text-cyan-400 transition-all border border-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </a>
                <button onclick="confirmDelete({{ $course->id }}, '{{ $course->course_name }}')" class="p-4 rounded-2xl bg-white/5 hover:bg-pink-500/20 text-pink-500 transition-all border border-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </div>
        </div>
        @endforeach
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

    function confirmDelete(id, name) {
        document.getElementById('deleteFormAction').action = '/courses/' + id;
        document.getElementById('deleteModalTitle').innerText = name;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    function submitDelete() {
        document.getElementById('deleteFormAction').submit();
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/40">
    <div class="glass p-10 rounded-[3rem] border border-white/5 max-w-md w-full mx-4 relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-40 h-40 bg-pink-500/10 blur-[100px] -z-10"></div>
        
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Purge Course</h2>
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-pink-500">Permanent deletion</p>
        </div>

        <div class="mb-8">
            <p class="text-white/60 text-sm leading-relaxed">
                You are about to permanently delete the course: <span class="font-bold text-white" id="deleteModalTitle"></span>
            </p>
            <p class="text-white/40 text-xs mt-3">This action cannot be undone. All course data and enrollments will be removed.</p>
        </div>

        <form id="deleteFormAction" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex flex-col gap-3">
                <button type="submit" class="w-full bg-pink-500 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-pink-600 transition transform hover:scale-[1.02] active:scale-95">
                    Confirm Purge
                </button>
                <button type="button" onclick="closeDeleteModal()" class="w-full bg-white/5 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest hover:bg-white/10 transition border border-white/5">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection