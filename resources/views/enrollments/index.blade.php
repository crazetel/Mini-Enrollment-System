<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Available Courses</h1>
            
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('courses.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                    + Create New Course
                </a>
            @endif
        </div>

    </div>
</x-app-layout>